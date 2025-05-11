<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PersonController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('companies/', [CompanyController::class, 'index']);
Route::resource('companies', CompanyController::class);
Route::resource('companies.people', PersonController::class);

// routes/web.php
Route::get('/debug-db', function () {
    return config('database.connections.mysql.host');
});

Route::resource('post', PostController::class);
Route::resource('person', PersonController::class);
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');