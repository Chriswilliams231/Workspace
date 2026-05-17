<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    //@desc Updating profile info
    // route PUT /profile

    public function update(Request $request): RedirectResponse {
        // Getting logged in user

        $user = Auth::user();

        $validatedData = $request->validate([
            'name' => 'required|string',
            'email' => 'required| string',
            'avatar' => 'nullable|image|mimes:jpeg,jpg,png,gif|max:2048',
        ]);
        
        // Get single user input
        $user->name = $request->input('name');
        $user->email = $request->input('email');

        // Handle avatar upload
        if($request->hasFile('avatar')) {
            // Delete the old image if it exists
            if($user->avatar){
                Storage::delete('public/' . $user->avatar);
            }

            // Storing new avatar
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = $avatarPath;
        }
        // Update user info
        $user->save();


        return redirect()->route('dashboard')->with('success', 'User info is updated');
    }
}
