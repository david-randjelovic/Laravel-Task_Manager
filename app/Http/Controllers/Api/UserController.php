<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function update(Request $request)
    {
        $user = auth()->user();

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

    public function uploadPicture(Request $request)
    {
        $request->validate([
            'image' => 'required|image|max:2048',
        ]);

        $user = auth()->user();
        $path = $request->file('image')->store('profile_pictures', 'public');

        $user->profile_picture = $path;
        $user->save();

        return response()->json(['path' => $path], 201);
    }
}
