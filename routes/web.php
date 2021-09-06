<?php
namespace App\Models;

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\PrivilegeController;
use App\Http\Controllers\SchoolController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/unauthorized-access', function() {
    return view('unauthorized-access');
})->name('unauthorized-access');

/* User routes. */
Route::get('/users', [UserController::class, 'index'])->middleware('auth')->name('users');
Route::get('/users/{user:name}', [UserController::class, 'show'])->middleware('auth')->name('user');
Route::get('/users/{user:name}/edit', [UserController::class, 'edit'])->middleware('auth')->name('user-edit');
Route::post('/user/{user:name}/update', [UserController::class, 'update'])->middleware('auth')->name('user-update');
Route::delete('/user/{user:name}/destroy', [UserController::class, 'destroy'])->middleware('auth')->name('user-destroy');

/* Privilege routes. */
Route::get('/privileges', [PrivilegeController::class, 'index'])->middleware('auth')->name('privileges');
Route::get('/privileges/{privilege:title}', [PrivilegeController::class, 'show'])->middleware('auth')->name('privilege');
Route::get('/privilege/create', [PrivilegeController::class, 'create'])->middleware('auth')->name('privilege-create');
Route::get('/privilege/{privilege:title}/edit', [PrivilegeController::class, 'edit'])->middleware('auth')->name('privilege-edit');
Route::post('/privilege/store', [PrivilegeController::class, 'store'])->middleware('auth')->name('privilege-store');
Route::post('/privilege/{privilege:title}/update', [PrivilegeController::class, 'update'])->middleware('auth')->name('privilege-update');
Route::delete('privilege/{privilege:title}/destroy', [PrivilegeController::class, 'destroy'])->middleware('auth')->name('privilege-destroy');

/* School routes. */
Route::get('/schools', [SchoolController::class, 'index'])->middleware('auth')->name('schools');
Route::get('/schools/{school:name}', [SchoolController::class, 'show'])->middleware('auth')->name('school');
Route::get('/school/create', [SchoolController::class, 'create'])->middleware('auth')->name('school-create');
Route::get('/school/{school:name}/edit', [SchoolController::class, 'edit'])->middleware('auth')->name('school-edit');
Route::post('/school/store', [SchoolController::class, 'store'])->middleware('auth')->name('school-store');
Route::post('/school/{school:name}/update', [SchoolController::class, 'update'])->middleware('auth')->name('school-update');
Route::delete('/school/{school:name}/destroy', [SchoolController::class, 'destroy'])->middleware('auth')->name('school-destroy');

require __DIR__.'/auth.php';
