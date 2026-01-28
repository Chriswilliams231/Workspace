<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobController;
use App\Http\Controllers\HomeController;



// Get Methods 
Route::get('/', [HomeController::class, 'index']);
Route::resource('jobs', JobController::class);



