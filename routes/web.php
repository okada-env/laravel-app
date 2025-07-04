<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\PersonController;
use App\Http\Controllers\ProjectController;


Route::get('companies/', [CompanyController::class, 'index']);
Route::resource('companies', CompanyController::class);
Route::resource('companies.people', PersonController::class);
Route::resource('companies.projects', ProjectController::class);

// routes/web.php
Route::get('/debug-db', function () {
    return config('database.connections.mysql.host');
});

Route::get('/status/create', [StatusController::class, 'create'])->name('status.create');

Route::resource('person', PersonController::class);
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');