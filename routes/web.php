<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;


Route::get('/', function () {
    return view('welcome');
});


Route::get('/home', function () {
    echo "This is homepage";
});


Route::get('/about', function () {
    return view('about');
})->middleware('age');

Route::get('/contact', [ContactController::class, 'index'])->name('contc');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
