<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Person;
use App\Models\Company;

class PersonController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function create(Company $company)
    {
        return view('person.person_create', compact('company'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'contact_person' => 'required|string|max:255',
            'post_id' => 'required|exists:posts,id'
        ]);

        $person = new Person();
        $person->contact_person = $request->contact_person;
        $person->user_id = auth()->user()->id;
        $person->post_id = $request->post_id;
        $person->save();

        return redirect()->route('post.show', ['post' => $request->post_id])
            ->with('message', '担当者を作成しました');
    }

    public function index(Company $company)
    {
        $people = $company->people;
        return view('person.person_create', compact('company', 'people'));
    }
    
    public function show(Person $person)
    {
        return view('person.person_show', compact('person'));
    }
    
    public function edit(Person $person)
    {
        return view('person.person_edit', compact('person'));
    }
    
    public function update(Request $request, Person $person)
    {  
        $inputs = $request->validate([
            'contact_person' => 'required|max:255',
        ]);

        $person->contact_person = $inputs['contact_person'];
        $person->save();

        return back()->with('message', '担当者情報を更新しました');
    }
    
    public function destroy(Person $person)
    {        
        $person->delete();
        return back()->with('message', '担当者情報を削除しました');
    }
}
