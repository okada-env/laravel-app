<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Company;
use App\Models\Person;
use App\Models\Status;

class StatusController extends Controller
{
    
    public function index(Company $company)
    {
        $projects = $company->projects;
        return view('projects.project_index', compact('company', 'projects'));
    }
    
    public function show(Status $status)
    {
        return view('projects.project_show', compact('status'));
    }
    
    public function create(Request $request)
    {
        $statuses = Status::all();
        $company = null;
        $persons = collect();
        if ($request->has('company_id')) {
            $company = Company::find($request->company_id);
            $persons = Person::where('company_id', $company->id)->get();
        }
        return view('projects.project_create', compact('company', 'persons', 'statuses'));
    }

    public function update(Request $request, Project $project)
    {  
        $inputs = $request->validate([
            'status_id' => 'required|exists:statuses,id',
        ]);

        $project->companies()->updateExistingPivot(
            $request->company_id,
            ['status_id' => $inputs['status_id']]
        );

        return back()->with('message', '進捗状況を更新しました');
    }
}
