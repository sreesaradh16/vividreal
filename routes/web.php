<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['register' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('company', App\Http\Controllers\CompanyController::class)->names('companies');

Route::resource('employee', App\Http\Controllers\EmployeeController::class)->names('employees');
