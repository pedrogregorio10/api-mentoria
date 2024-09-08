<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;




Route::view('/','create');
Route::view('/update','update');
Route::post('/users', [UserController::class,'store'])->name('users.store');
Route::patch('/users/{id}', [UserController::class,'update'])->name('users');
