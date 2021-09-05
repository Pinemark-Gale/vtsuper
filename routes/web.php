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

/* User routes. */
Route::get('/users', [UserController::class, 'index'])->name('users');
Route::get('/users/{user:name}', [UserController::class, 'show']);
Route::get('/users/{user:name}/edit', [UserController::class, 'edit'])->name('user-edit');
Route::post('/user/update', [UserController::class, 'update'])->name('user-update');

/* Privilege routes. */
Route::get('/privileges', [PrivilegeController::class, 'index'])->name('privileges');

/* School routes. */
Route::get('/schools', [SchoolController::class, 'index'])->name('schools');

require __DIR__.'/auth.php';
