<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;




Route::view('/','create');
Route::resource('/users', UserController::class);