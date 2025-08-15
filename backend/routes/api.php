<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountsController;

Route::get('/accounts', [AccountsController::class, 'index']);
Route::post('/register', [AccountsController::class, 'register']);
Route::delete('/delete', [AccountsController::class, 'remove']);
Route::get('/accounts/{id}', [AccountsController::class, 'show']);
