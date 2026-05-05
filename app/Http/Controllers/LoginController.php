<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\HTTP\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // @route GET /login
    public function login(): View {
        return view('auth.login');
    }

     // @desc This will authenticate the user
    // @route POST /register 
    public function authenticate(Request $request): RedirectResponse 
    {
        $credentials = $request->validate([
            'email' => 'required|string|email|max:100',
            'password' => 'required|string',
        ]);

        if(Auth::attempt($credentials)){
            // Regenerating the session to prevent attacks
            $request->session()->regenerate();

            return redirect()->intended(route('home'))->with('success', 'You are now logged in!');
        }

        return back()->withErrors([
            "email" => "The information provided do not match our records."
        ])->onlyInput('email');
        
    }
}
