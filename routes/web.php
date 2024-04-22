<?php

use App\Http\Controllers\MenuController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/pos/dashboard', [MenuController::class, 'dashboard'])->name('dashboard');
Route::get('/pos/ticket_details', [MenuController::class, 'ticketDetails'])->name('ticketDetails');