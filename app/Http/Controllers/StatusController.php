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
        $statuses = Status::$statuses;
        $company = null;
        $persons = collect();
        if ($request->has('company_id')) {
            $company = Company::find($request->company_id);
            $persons = Person::where('company_id', $company->id)->get();
        }
        return view('projects.project_create', compact('company', 'persons', 'statuses'));
    }

    
    public function update(Request $request,Project $project, Status $status)
    {  
        $inputs = $request->validate([
            'status_id' => 'required|max:255',
        ]);

        $status->status_id = $inputs['status_id'];
        $status->save();

        return back()->with('message', '進捗状況を更新しました');
    }
    

}
