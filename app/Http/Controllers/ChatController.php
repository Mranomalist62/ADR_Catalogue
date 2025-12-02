<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chat;
use App\Models\User;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ChatController extends Controller
{
    /**
     * Display chat interface for user
     */
    public function userChat()
    {
        $user = Auth::guard('user')->user();
        if (!$user) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $chats = Chat::where('user_id', $user->id)
                     ->orderBy('created_at', 'asc')
                     ->get();

        return view('user_chat', compact('chats', 'user'));
    }

    /**
     * Display chat management interface for admin
     */
    public function adminChat()
    {
        $admin = Auth::guard('admin')->user();
        if (!$admin) {
            return redirect()->route('admin.login')->with('error', 'Silakan login sebagai admin.');
        }

        // Get all users who have sent messages
        $users = User::whereHas('chats')
                     ->with(['chats' => function($query) {
                         $query->latest()->first();
                     }])
                     ->withCount(['chats' => function($query) {
                         $query->where('is_read', false)->where('sender', 'user');
                     }])
                     ->orderByDesc('chats_count')
                     ->get();

        // Get unread count
        $unreadCount = Chat::where('is_read', false)
                           ->where('sender', 'user')
                           ->count();

        return view('admin_chat', compact('users', 'unreadCount', 'admin'));
    }

    /**
     * Get chat messages for specific user
     */
    public function getChatMessages($userId)
    {
        $admin = Auth::guard('admin')->user();
        if (!$admin) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $user = User::findOrFail($userId);
        $chats = Chat::where('user_id', $userId)
                     ->orderBy('created_at', 'asc')
                     ->get();

        // Mark messages as read
        Chat::where('user_id', $userId)
            ->where('sender', 'user')
            ->where('is_read', false)
            ->update(['is_read' => true, 'read_at' => now()]);

        return response()->json([
            'user' => $user,
            'chats' => $chats
        ]);
    }

    /**
     * Send message from user
     */
    public function sendUserMessage(Request $request)
    {
        try {
            $user = Auth::guard('user')->user();
            if (!$user) {
                return response()->json(['error' => 'Unauthorized'], 401);
            }

            $request->validate([
                'message' => 'required|string|max:1000'
            ]);

            // Save user message
            $chat = Chat::create([
                'user_id' => $user->id,
                'message' => $request->message,
                'sender' => 'user',
                'is_read' => false
            ]);

            // Check if there's an admin online (simplified logic)
            // In a real app, you might check if admin is actively monitoring
            $adminOnline = true; // Simplified - you could implement real admin presence detection
            
            if ($adminOnline) {
                // Don't send bot response if admin is available
                // Admin will respond from dashboard
                return response()->json([
                    'user_message' => $chat,
                    'status' => 'pending_admin_response',
                    'message' => 'Pesan Anda telah diterima. Admin akan segera merespons.'
                ]);
            } else {
                // Generate bot response only if no admin is available
                $botResponse = Chat::getBotResponse($request->message);
                
                // Save bot response
                $botChat = Chat::create([
                    'user_id' => $user->id,
                    'message' => $botResponse,
                    'sender' => 'bot',
                    'is_read' => true
                ]);

                return response()->json([
                    'user_message' => $chat,
                    'bot_response' => $botChat
                ]);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Send message from admin
     */
    public function sendAdminMessage(Request $request)
    {
        try {
            $admin = Auth::guard('admin')->user();
            if (!$admin) {
                return response()->json(['error' => 'Unauthorized'], 401);
            }

            $request->validate([
                'user_id' => 'required|exists:users,id',
                'message' => 'required|string|max:1000'
            ]);

            $chat = Chat::create([
                'user_id' => $request->user_id,
                'admin_id' => $admin->id,
                'message' => $request->message,
                'sender' => 'admin',
                'is_read' => false
            ]);

            return response()->json(['message' => $chat]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Get unread messages count for admin
     */
    public function getUnreadCount()
    {
        try {
            $admin = Auth::guard('admin')->user();
            if (!$admin) {
                return response()->json(['error' => 'Unauthorized'], 401);
            }

            $unreadCount = Chat::where('is_read', false)
                               ->where('sender', 'user')
                               ->count();

            return response()->json(['count' => $unreadCount]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Get recent users for admin sidebar
     */
    public function getRecentUsers()
    {
        try {
            $admin = Auth::guard('admin')->user();
            if (!$admin) {
                return response()->json(['error' => 'Unauthorized'], 401);
            }

            $users = User::whereHas('chats')
                         ->with(['chats' => function($query) {
                             $query->latest()->first();
                         }])
                         ->withCount(['chats' => function($query) {
                             $query->where('is_read', false)->where('sender', 'user');
                         }])
                         ->orderByDesc('chats_count')
                         ->get();

            return response()->json(['users' => $users]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Get user chat for AJAX refresh
     */
    public function getUserChatForRefresh()
    {
        $user = Auth::guard('user')->user();
        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $chats = Chat::where('user_id', $user->id)
                     ->orderBy('created_at', 'asc')
                     ->get();

        return response()->json([
            'chats' => $chats,
            'user' => $user
        ]);
    }

    /**
     * Get bot response for public users (no authentication required)
     */
    public function getBotResponse(Request $request)
    {
        try {
            $request->validate([
                'message' => 'required|string|max:1000'
            ]);

            $botResponse = Chat::getBotResponse($request->message);

            return response()->json([
                'bot_response' => $botResponse,
                'status' => 'bot_response'
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
