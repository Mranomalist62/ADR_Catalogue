<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    // GET /api/user/addresses
    public function index()
    {
        $addresses = Address::where('id_user', Auth::id())->get();

        return response()->json([
            'success' => true,
            'data' => $addresses
        ]);
    }

    // GET /api/user/addresses/{id}
    public function show($id)
    {
        $address = Address::where('id_user', Auth::id())->find($id);

        if (!$address) {
            return response()->json(['success' => false, 'message' => 'Address not found'], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $address
        ]);
    }

    // POST /api/user/addresses
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'desk_alamat' => 'required|string',
        ]);

        $address = Address::create([
            'nama' => $request->nama,
            'desk_alamat' => $request->desk_alamat,
            'id_user' => Auth::id(),
            'selected' => false
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Address created successfully',
            'data' => $address
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
