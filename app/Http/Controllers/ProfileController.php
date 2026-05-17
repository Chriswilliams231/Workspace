<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        ]);

        // Update user info
        $user->update($validatedData);


        return redirect()->route('dashboard')->with('success', 'User info is updated');
    }
}
