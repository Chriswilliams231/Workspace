<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class JobController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jobs = Job::simplePaginate(6);

        return view('jobs.index')->with('jobs', $jobs);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // if(!Auth::check()){
        //     return redirect()->route('login');
        // }
        return view('jobs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
       
        $validatedData = $request->validate([
            'title' => 'required|string|max:255', 
            'description' => 'required|string|max:255', 
            'salary' => 'required|integer', 
            'tags' => 'nullable|string', 
            'job_type' => 'required|string', 
            'remote' => 'required|boolean', 
            'requirements' => 'nullable|string', 
            'benefits' => 'nullable|string', 
            'address' => 'nullable|string', 
            'city' => 'required|string', 
            'state' => 'required|string', 
            'zipcode' => 'nullable|string', 
            'contact_email' => 'required|string', 
            'contact_phone' => 'nullable|string', 
            'company_name' => 'required|string', 
            'company_description' => 'nullable|string', 
            'company_logo' => 'nullable|image|mimes:jpeg,jpg,png,gif|max:2048', 
            'company_website' => 'nullable|url',
        ]);

        // Temp Hard coded User ID data
        $validatedData['user_id'] = auth()->user()->id;

        // Checking for the image
        if($request->hasFile('company_logo')){
            // Store the file and get the path
            $path = $request->file('company_logo')->store('logos', 'public');

            // Add path to the database
            $validatedData['company_logo'] = $path;
        }
        Job::create($validatedData);

        return redirect()->route('jobs.index')->with('success', 'Job listing created.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Job $job)
    {
        return view('jobs.show')->with('job', $job);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Job $job)
    {
       // Checking for authorization
        $this->authorize('update', $job);
        
        return view('jobs.edit')->with('job', $job);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Job $job)
    {
        // Checking for authorization
        $this->authorize('update', $job);

        $validatedData = $request->validate([
            'title' => 'required|string|max:255', 
            'description' => 'required|string|max:255', 
            'salary' => 'required|integer', 
            'tags' => 'nullable|string', 
            'job_type' => 'required|string', 
            'remote' => 'required|boolean', 
            'requirements' => 'nullable|string', 
            'benefits' => 'nullable|string', 
            'address' => 'nullable|string', 
            'city' => 'required|string', 
            'state' => 'required|string', 
            'zipcode' => 'nullable|string', 
            'contact_email' => 'required|string', 
            'contact_phone' => 'nullable|string', 
            'company_name' => 'required|string', 
            'company_description' => 'nullable|string', 
            'company_logo' => 'nullable|image|mimes:jpeg,jpg,png,gif|max:2048', 
            'company_website' => 'nullable|url',
        ]);


        // Checking for the image
        if($request->hasFile('company_logo')){
            // Delete old images
            Storage::disk('public')->delete($job->company_logo);

            // Store the file and get the path
            $path = $request->file('company_logo')->store('logos', 'public');

            // Add path to the database
            $validatedData['company_logo'] = $path;
        }
        $job->update($validatedData);

        return redirect()->route('jobs.index')->with('success', 'Job listing updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Job $job): RedirectResponse
    {
        // Checking for authorization
        $this->authorize('delete', $job);

        if(!Auth::check()){
            return redirect()->route('login');
        }

        if($job->company_logo) {
            // Delete the image
            Storage::disk('public')->delete($job->company_logo);
        }

        $job->delete();

        // Checking if the query came from the dashboard
        if(request()->query('from') == 'dashboard'){
            return redirect()->route('dashboard.index')->with('success', 'Job listing was deleted!');
        }

        return redirect()->route('jobs.index')->with('success', 'Job listing was deleted!');
    }
}
