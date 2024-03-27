<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function update(Request $request, $id)
    {
        // Find the user by ID
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'department' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'job_title' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'organization' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
        ]);
    
        $user->update($validated);

        return response()->json($user);
    }
}
