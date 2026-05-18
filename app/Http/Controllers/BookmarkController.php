<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class BookmarkController extends Controller
{
    public function index(): View {
        
        $user = Auth::user();

        $bookmarks = $user->bookmarkedJobs()->paginate(6);

        return view('jobs.bookmarked')->with('bookmarks', $bookmarks);
    }
}
