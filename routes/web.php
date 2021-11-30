<?php
namespace App\Models;

use App\Http\Controllers\Admin\AdminUserController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PageController;
use App\Http\Controllers\PrivilegeController;
use App\Http\Controllers\ResourceController;
use App\Http\Controllers\ResourceTagController;
use App\Http\Controllers\ResourceTypeController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\SourceController;
use App\Http\Controllers\UserController;

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

/* Resource routes. */

/* Resource source routes. */

/* Resource tag routes. */

/* Resource type routes. */

/* User routes. */

/* Privilege routes. */

/* School routes. */

/* Page routes. */
Route::get('/pages/{page:slug}', [PageController::class, 'show'])->name('page');

/* Add other route files. */
require __DIR__.'/auth.php';
require __DIR__.'/admin.php';