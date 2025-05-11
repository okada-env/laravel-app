<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;


class CompanyController extends Controller
{
    public function index()
    {
        $companies = Company::all();
        // dd($companies);
        return view('welcome', compact('companies'));
    }
}
