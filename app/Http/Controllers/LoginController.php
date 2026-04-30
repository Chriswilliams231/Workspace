<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\HTTP\RedirectResponse;

class LoginController extends Controller
{
    // @route GET /login
    public function login(): View {
        return view('auth.login');
    }
}
