<?php

use Illuminate\Support\Facades\Route;


Route::post('login', [App\Http\Controllers\Api\AuthController::class, 'login']);

Route::group(['middleware' => 'auth:api'], function () {
    Route::get('company/list', [App\Http\Controllers\Api\CompanyController::class, 'list']);
});
