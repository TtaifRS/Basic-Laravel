<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Models\User;
use Illuminate\Support\Facades\DB;


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
    //eloquent ORM read users
    $users = User::all();

    //Query builder read users
    // $users = DB::table('users')->get();
    return view('dashboard', compact('users'));
})->name('dashboard');
