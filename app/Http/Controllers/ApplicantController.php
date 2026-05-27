<?php

namespace App\Http\Controllers;

use App\Models\Applicant;
use App\Models\Job;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ApplicantController extends Controller
{
    //@route POST /jobs/{job}/apply
    public function store(Request $request, Job $job): RedirectResponse {
        // Validating incoming data
        $validateData = $request->validate([
            'fullname' => 'required|string',
            'contact_phone' => 'string',
            'contact_email' => 'required|string|email',
            'message' => 'string',
            'location' => 'string',
            'resume' => 'required|file|mimes:pdf|max:2048',
        ]);

        // Handling resume upload
        if($request->hasFile('resume')) {
            $path = $request->file('resume')->store('resumes', 'public');

            $validateData['resume_path'] = $path;
        }

        // Storing the application
        $application = new Applicant($validateData);
        $application->job_id = $job->id;
        $application->user_id = auth()->id();
        $application->save();

        return redirect()->back()->with('success', 'Your application has been submitted');
    }
    
}
