<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Person;
use App\Models\Project;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');
        $query = Company::query();

        if(!empty($keyword)) {
            $query->where('title', 'LIKE', "%{$keyword}%");
        }

        $companies = $query->with('people', 'projects')->orderBy('created_at', 'desc')->get();

        return view('home', compact('companies', 'keyword'));
    }
}
