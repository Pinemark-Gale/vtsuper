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
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\SubmissionController;

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

/* Activity routes. */
Route::get('/activities', [ActivityController::class, 'index'])->name('acitivities');
Route::get('/activity/{activityDetail:slug}', [ActivityController::class, 'show'])->name('activity');
Route::get('/activities/search', [ActivityController::class, 'search'])->name('activities-search');

/* Submission routes. */
Route::get('/submissions', [SubmissionController::class, 'index'])->name('submissions');
Route::get('/submission/{activityDetail:slug}', [SubmissionController::class, 'show'])->name('submission');
Route::get('/submission/create/{activityDetail:slug}', [SubmissionController::class, 'create'])->name('submission-create');
Route::get('/submissions/search', [SubmissionController::class, 'search'])->name('submissions-search');

/* Resource routes. */
Route::get('/resources', [ResourceController::class, 'index'])->name('resources');
Route::get('/resources/student', [ResourceController::class, 'index_student'])->name('resources');
Route::get('/resources/educator', [ResourceController::class, 'index_educator'])->name('resources');
Route::get('/resources/search', [ResourceController::class, 'search'])->name('resources-search');

/* Resource source routes. */

/* Resource tag routes. */

/* Resource type routes. */

/* User routes. */
Route::get('/register', [UserController::class, 'create'])->middleware('guest')->name('user-create');
Route::post('/register', [UserController::class, 'store'])->middleware('guest')->name('user-store');
Route::get('/my-settings', [UserController::class, 'edit'])->name('user-edit');
Route::patch('/my-settings/{user:name}', [UserController::class, 'update'])->middleware('permission.self')->name('user-update');
Route::get('/my-settings/reset-password', [UserController::class, 'editPassword'])->name('user-edit-password');
Route::patch('/my-settings/reset-password/{user:name}', [UserController::class, 'updatePassword'])->middleware('permission.self:{user:name}')->name('user-update-password');

/* Privilege routes. */

/* School routes. */

/* Page routes. */
Route::get('/pages/{page:slug}', [PageController::class, 'show'])->name('page');

/* Add other route files. */
require __DIR__.'/auth.php';
require __DIR__.'/admin.php';