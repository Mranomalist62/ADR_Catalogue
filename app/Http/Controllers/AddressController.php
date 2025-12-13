<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    // GET /api/user/addresses


    public function index(Request $request)
    {
        // Check which guard is authenticated
        if (Auth::guard('admin')->check()) {
            // Admin: can view all addresses or filter by user_id
            $userId = $request->query('user_id');

            $query = Address::query();

            if ($userId) {
                $query->where('id_user', $userId);
            }

            $addresses = $query->orderBy('created_at', 'desc')->get();

        } elseif (Auth::guard('user')->check()) {
            // User: can only view their own addresses
            $userId = Auth::guard('user')->id();
            $addresses = Address::where('id_user', $userId)
                            ->orderBy('selected', 'desc')
                            ->orderBy('created_at', 'desc')
                            ->get();
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Not authenticated'
            ], 401);
        }

        return response()->json([
            'success' => true,
            'data' => $addresses
        ]);
    }

    public function getDefaultAddress(Request $request)
    {
        $userId = null;

        if (Auth::guard('admin')->check()) {
            // Admin needs to specify which user
            $userId = $request->query('user_id');
            if (!$userId) {
                return response()->json([
                    'success' => false,
                    'message' => 'User ID required for admin access'
                ], 400);
            }
        } elseif (Auth::guard('user')->check()) {
            // User gets their own default address
            $userId = Auth::guard('user')->id();
        } else {
            return response()->json(['success' => false, 'message' => 'Not authenticated'], 401);
        }

        $address = Address::where('id_user', $userId)
                        ->where('selected', 1)
                        ->first();

        return response()->json([
            'success' => true,
            'data' => $address
        ]);
    }

    public function show($id)
    {
        $address = Address::find($id);

        if (!$address) {
            return response()->json(['success' => false, 'message' => 'Address not found'], 404);
        }

        // Check permissions
        if (Auth::guard('admin')->check()) {
            // Admin can view any address
            return response()->json(['success' => true, 'data' => $address]);
        }

        if (Auth::guard('user')->check()) {
            // User can only view their own addresses
            if ($address->id_user == Auth::guard('user')->id()) {
                return response()->json(['success' => true, 'data' => $address]);
            }
        }

        return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
    }

    // POST /api/user/addresses
    public function store(Request $request)
    {
        // Try all possible guard combinations
        $userId = null;
        $guardUsed = null;

        $guards = ['user'];
        foreach ($guards as $guard) {
            $id = Auth::guard($guard)->id();
            if ($id) {
                $userId = $id;
                $guardUsed = $guard;
                break;
            }
        }

        if (!$userId) {
            return response()->json([
                'success' => false,
                'message' => 'User not authenticated in any guard',
            ], 401);
        }

        $isFirstAddress = Address::where('id_user', $userId)->count() === 0;

        $address = Address::create([
            'nama' => $request->nama,
            'desk_alamat' => $request->desk_alamat,
            'id_user' => $userId,  // Use the found user ID
            'selected' => $isFirstAddress
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Address created successfully',
            'data' => $address,
            'debug_user_id' => $userId  // Add this for debugging
        ], 201);
    }

    // PUT /api/user/addresses/{id}
    public function update(Request $request, $id)
    {
        $address = Address::where('id_user', Auth::id())->find($id);

        if (!$address) {
            return response()->json(['success' => false, 'message' => 'Address not found'], 404);
        }

        $request->validate([
            'nama' => 'sometimes|string|max:255',
            'desk_alamat' => 'sometimes|string',
        ]);

        $address->update($request->only(['nama', 'desk_alamat']));

        return response()->json([
            'success' => true,
            'message' => 'Address updated successfully',
            'data' => $address
        ]);
    }

    // DELETE /api/user/addresses/{id}
    public function destroy($id)
    {
        $address = Address::where('id_user', Auth::id())->find($id);

        if (!$address) {
            return response()->json(['success' => false, 'message' => 'Address not found'], 404);
        }

        // If this was selected default, unselect it
        if ($address->selected) {
            $address->selected = false;
            $address->save();
        }

        $address->delete();

        return response()->json([
            'success' => true,
            'message' => 'Address deleted successfully'
        ]);
    }

    // POST /api/user/addresses/{id}/select
    public function select($id)
    {
        $address = Address::where('id_user', Auth::id())->find($id);

        if (!$address) {
            return response()->json(['success' => false, 'message' => 'Address not found'], 404);
        }

        // Unselect all user addresses
        Address::where('id_user', Auth::id())->update(['selected' => false]);

        // Select this one
        $address->selected = true;
        $address->save();

        return response()->json([
            'success' => true,
            'message' => 'Address selected as default',
            'data' => $address
        ]);
    }
}
