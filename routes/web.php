<?php
namespace App\Models;

use Illuminate\Support\Facades\Route;

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

Route::get('/users', function() {
    return view('users', [
        'users' => User::with(['school', 'privilege'])->orderby('name')->get()
    ]);
})->name('users');

Route::get('/users/{user:name}', function(User $user) {
    return view('user', [
        'user' => $user
    ]);
});

require __DIR__.'/auth.php';
