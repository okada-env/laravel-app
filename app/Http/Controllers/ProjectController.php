<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Company;
use App\Models\Status;

class ProjectController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function create(Company $company)
    {
        $statuses = Status::all()->pluck('status', 'id');
        $people = $company->people;
        return view('projects.project_create', compact('company', 'statuses', 'people'));
    }
    
    public function store(Request $request)
    {      
        $validated = $request->validate([
            'contact_project' => 'required|string|max:255',
            'company_id' => 'required|exists:companies,id',
            'status_id' => 'required|exists:statuses,id',
            'person_id' => 'required|exists:people,id',
        ]);

        $project = new Project();
        $project->contact_project = $request->contact_project;
        $project->user_id = auth()->user()->id;
        $project->save();

        $project->people()->attach($validated['person_id'], [
            'status_id' => $validated['status_id'],
            'company_id' => $validated['company_id']
        ]);

        return redirect()->route('companies.show', ['company' => $request->company_id])
            ->with('message', '案件を作成しました');
    }

    public function index(Company $company)
    {
        $projects = $company->projects;
        return view('projects.project_index', compact('company', 'projects'));
    }
    
    public function show(Project $project)
    {
        return view('projects.project_show', compact('project'));
    }
    
    public function edit(Company $company, Project $project)
    {
        $statuses = Status::all()->pluck('status', 'id');
        $currentStatus = $project->companies()->where('company_project.company_id', $company->id)->first()->pivot->status_id ?? null;
        $people = $company->people;
        $currentPerson = $project->people()->wherePivot('company_id', $company->id)->first();
        $currentPersonId = $currentPerson ? $currentPerson->id : null;
        return view('projects.project_edit', compact('company', 'project', 'statuses', 'currentStatus', 'people', 'currentPersonId'));
    }
    
    public function update(Request $request, Company $company, Project $project)
    {  
        $inputs = $request->validate([
            'contact_project' => 'required|max:255',
            'status_id' => 'required|exists:statuses,id',
            'person_id' => 'required|exists:people,id',
        ]);

        $project->contact_project = $inputs['contact_project'];
        $project->save();

        $project->companies()->updateExistingPivot($company->id, [
            'status_id' => $inputs['status_id']
        ]);

        $project->people()->detach();
        $project->people()->attach($inputs['person_id'], [
            'status_id' => $inputs['status_id'],
            'company_id' => $company->id
        ]);

        return back()->with('message', '案件情報を更新しました');
    }
    
    public function destroy(Company $company, Project $project)
    {        
        $project->delete();
        return back()->with('message', '案件情報を削除しました');
    }
}
