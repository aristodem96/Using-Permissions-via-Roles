<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});






Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/dashboard', [\App\Http\Controllers\PostController::class, 'index'])->name('dashboard')->middleware('can:show posts');


    Route::get('/add-post', [\App\Http\Controllers\PostController::class, 'create'])->name('add-post')->middleware('can:add posts');
    Route::post('/store-post', [\App\Http\Controllers\PostController::class, 'store'])->name('store-post')->middleware('can:add posts');
    Route::get('/edit-post/{id}', [\App\Http\Controllers\PostController::class, 'edit'])->name('edit-post')->middleware('can:edit posts');
    Route::put('/update-post/{id}', [\App\Http\Controllers\PostController::class, 'update'])->name('update-post')->middleware('can:edit posts');
    Route::delete('/delete-post/{id}', [\App\Http\Controllers\PostController::class, 'delete'])->name('delete-post')->middleware('can:delete posts');

    Route::resource('roles', \App\Http\Controllers\RoleController::class)->middleware('role:super-user');
    Route::resource('users', \App\Http\Controllers\MyUserController::class)->middleware('role:super-user');
});



require __DIR__.'/auth.php';
