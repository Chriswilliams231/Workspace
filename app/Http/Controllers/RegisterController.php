<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function register(): View {
        return view('auth.register');
    }

    // @desc Store user data in the database
    // @route POST /register 
    public function store(Request $request): RedirectResponse {
        $validateData = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Hash password
        $validateData['password'] = Hash::make($validateData['password']);

        // Create user
        $user = User::create($validateData);

        return redirect()->route('login')->with('success', 'You are now registered. Please login.');
    }
}
