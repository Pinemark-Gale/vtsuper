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
Route::get('/users/{user:name}', [UserController::class, 'show'])->middleware('auth');
Route::get('/users/{user:name}/edit', [UserController::class, 'edit'])->middleware('auth')->name('user-edit');
Route::post('/user/{user:name}/update', [UserController::class, 'update'])->middleware('auth')->name('user-update');
Route::delete('/user/{user:name}/destroy', [UserController::class, 'destroy'])->middleware('auth')->name('user-destroy');

/* Privilege routes. */
Route::get('/privileges', [PrivilegeController::class, 'index'])->middleware('auth')->name('privileges');

/* School routes. */
Route::get('/schools', [SchoolController::class, 'index'])->middleware('auth')->name('schools');

require __DIR__.'/auth.php';
