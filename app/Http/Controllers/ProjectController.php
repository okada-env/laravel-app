<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Company;
use App\Models\Person;
use App\Models\Status;

class ProjectController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function create(Company $company)
    {
        $persons = Person::where('company_id', $company->id)->get();
        $statuses = Status::all()->pluck('status', 'id');
        return view('projects.project_create', compact('company', 'persons', 'statuses'));
    }
    
    public function store(Request $request)
    {      
        $validated = $request->validate([
            'contact_project' => 'required|string|max:255',
            'company_id' => 'required|exists:companies,id',
            'person_id' => 'required|exists:people,id',
            'status_id' => 'required|exists:statuses,id', 
        ]);

        $project = new Project();
        $project->contact_project = $request->contact_project;
        $project->user_id = auth()->user()->id;
        $project->company_id = $request->company_id;
        $project->save();

        $person = Person::find($validated['person_id']);
        $person->projects()->attach($project->id, [
            'company_id' => $request->company_id,
            'status_id' => $request->status_id
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
        $project->load(['persons' => function($query) use ($company) {
            $query->where('person_project.company_id', $company->id)
                  ->withPivot('status_id');
        }]);
        $persons = Person::where('company_id', $company->id)->get();
        $statuses = Status::all()->pluck('status', 'id');
        return view('projects.project_edit', compact('company', 'project', 'persons', 'statuses'));
    }
    
    public function update(Request $request, Company $company, Project $project)
    {  
        $inputs = $request->validate([
            'contact_project' => 'required|max:255',
            'person_id' => 'required|exists:people,id',
            'status_id' => 'required|exists:statuses,id',
        ]);

        $project->contact_project = $inputs['contact_project'];
        $project->save();

        $project->persons()->wherePivot('company_id', $company->id)->detach();

        $person = Person::find($inputs['person_id']);
        $person->projects()->attach($project->id, [
            'company_id' => $company->id,
            'status_id' => $inputs['status_id']
        ]);

        return back()->with('message', '案件情報を更新しました');
    }
    
    public function destroy(Company $company, Project $project)
    {        
        $project->delete();
        return back()->with('message', '案件情報を削除しました');
    }

    public function persons()
    {
        return $this->belongsToMany(Person::class, 'person_project')
                    ->withPivot('company_id', 'status_id');
    }

    public function assignPersonToProject(Request $request)
    {
        $person = Person::find($person_id);
        $person->projects()->attach($project_id, ['company_id' => $company_id]);
    }
}
