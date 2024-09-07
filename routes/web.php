<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;





Route::view('/','create');
Route::post('/users', [UserController::class, 'store'])->name('users');
Route::patch('/users/{id}', [UserController::class, 'update'])->name('users');
