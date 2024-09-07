<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;




Route::view('/','create');
Route::patch('/users/{id}', [UserController::class,'update'])->name('users');
