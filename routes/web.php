<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
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

//catagory controller 
Route::get('/category/all', [CategoryController::class, 'AllCat'])->name(('all.category'));

Route::post('/category/add', [CategoryController::class, 'AddCat'])->name('store.category');

Route::get("/category/edit/{id}", [CategoryController::class, 'EditCat']);

Route::post("/category/update/{id}", [CategoryController::class, 'UpdateCat']);

Route::get("/category/softdelete/{id}", [CategoryController::class, 'SoftDeleteCat']);

Route::get('/category/restore/{id}', [CategoryController::class, 'RestoreCat']);

Route::get('/category/permanentDelete/{id}', [CategoryController::class, 'PermanentDeleteCat']);



//brand route
Route::get('/brand/all', [BrandController::class, 'AllBrand'])->name('all.brand');

Route::post('/brand/add', [BrandController::class, 'AddBrand'])->name('store.brand');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    //eloquent ORM read users
    $users = User::all();

    //Query builder read users
    // $users = DB::table('users')->get();
    return view('dashboard', compact('users'));
})->name('dashboard');
