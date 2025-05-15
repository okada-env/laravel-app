<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;


class CompanyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function create(Request $request)
    {
        $company_id = $request->company_id;
        return view('companies.create', compact('company_id'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
        ]);
    
        $company = new Company();
        $company->title = $request->title;
        $company->user_id = auth()->user()->id;
        $company->company_id = $request->company_id ?? null;
        $company->contact_person = '';
        $company->save();
    
        return back()->with('message', '投稿を作成しました');
    }

    public function index(Request $request)
    {
        $keyword = $request->input('keyword');
        $user = auth()->user();
        $companies = Company::all();
        return view('home', ['companies' => $companies, 'keyword' => $keyword]);
    }
    
    public function show(Company $company, Request $request)
    {
        $person_keyword = $request->input('person_keyword');
        $peopleQuery = $company->people();

        if (!empty($person_keyword)) {
            $peopleQuery->where('contact_person', 'LIKE', "%{$person_keyword}%");
        }

        $people = $peopleQuery->get();

        return view('companies.show', compact('company', 'people'));
    }
    
    public function edit(Company $company)
    {
        return view('companies.edit', compact('company'));
    }
    
    public function update(Request $request, Company $company)
    {  
        $inputs = $request->validate([
            'title' => 'required|max:255',
        ]);

        $company->title = $inputs['title'];
        $company->save();

        return back()->with('message', '投稿を更新しました');
    }
    
    public function destroy(Company $company)
    {        
        $company->delete();
        return redirect()->route('home')->with('message', '投稿を削除しました');
    }


}

