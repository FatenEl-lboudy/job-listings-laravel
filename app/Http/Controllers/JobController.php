<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class JobController extends Controller
{
    // Index
    public function index()
    {
        // $jobs = Job::all(); results in N +1 problem
        //$jobs = Job::with('employer')->paginate(3); //Fixing N +1 problem with eager loading the relationship/ Standard Pagination used
        $jobs = Job::with('employer')->latest()->simplePaginate(3); //Simple Pagination
        //$jobs = Job::with('employer')->cursorPaginate(3);
        return view('jobs.index', ['jobs' => $jobs]); //['jobs' => $jobs]);
        //return 'Jobs page';
        //return ['foo' => 'bar']; 
    }


    // Show
    public function show(Job $job)
    {
        // $job = Job::find($id);
        return view('jobs.show', ['job' => $job]);
    }

    // Create
    public function create()
    {
        return view('jobs.create');
    }

    // Store
    public function store()
    {
        request()->validate([
            'title' => ['required', 'min:3'],
            'salary' => ['required']
        ]);

        // dd(request()->all());
        Job::create([
            'title' => request('title'),
            'Salary' => request('salary'),
            'employer_id' => 2
        ]);
        return redirect('/jobs');
    }

    // Edit
    public function edit(Request $request, Job $job)
    { 
        // Gate::authorize('edit-job', $job);
        // $job = Job::find($id);
        return view('jobs.edit', ['job' => $job]);
    }

    // Update
    public function update(Job $job)
    {
        // Validate
        request()->validate([
            'title' => ['required', 'min:3'],
            'salary' => ['required']
        ]);

        // authorize...(On hold)

        // update
        // $job = Job::findOrFail($id);
        $job->update([
            'title' => request('title'),
            'Salary' => request('salary'),
        ]);
        // persist
        // $job['title'] = request('title');
        // $job['Salary'] = request('salary');
        // $job->save();

        // redirect to the job page
        return redirect('/jobs/' . $job->id);
    }

    // Destroy
    public function destroy(Job $job)
    {
        // authorize...(on hold)

        // delete the job
        // Job::findOrFail($id)->delete();
        $job->delete();

        //redirect
        return redirect('/jobs');
    }
}
