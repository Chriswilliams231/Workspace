<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\HTTP\RedirectResponse;

class RegisterController extends Controller
{
    public function register(): View {
        return view('auth.register');
    }
}
