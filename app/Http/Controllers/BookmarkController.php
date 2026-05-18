<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\Job;


class BookmarkController extends Controller
{
    // @route GET /bookmarks
    public function index(): View {
        
        $user = Auth::user();

        $bookmarks = $user->bookmarkedJobs()->orderBy('job_user_bookmarks', 'desc')->paginate(6);

        return view('jobs.bookmarked')->with('bookmarks', $bookmarks);
    }

        // @desc Creating a new bookmarkded job
        // @route POST /bookmarks/{job}
    public function store(Job $job): RedirectResponse {
        
        $user = Auth::user();

       if($user->bookmarkedJobs()->where('job_id', $job->id)->exists()){

        return back()->with('error', 'Job is already bookmarked');
       }

       $user->bookmarkedJobs()->attach($job->id);

       return back()->with('success', 'Bookmarked Successfully');
    }

       // @desc Removing bookmarkded job
        // @route DELETE /bookmarks/{job}
    public function destroy(Job $job): RedirectResponse {
        
        $user = Auth::user();

       if(!$user->bookmarkedJobs()->where('job_id', $job->id)->exists()){

        return back()->with('error', 'Job is not bookmarked');
       }

       $user->bookmarkedJobs()->detach($job->id);

       return back()->with('success', 'Bookmarked Removed');
    }
}
