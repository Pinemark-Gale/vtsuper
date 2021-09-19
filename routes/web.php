<?php
namespace App\Models;

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\PrivilegeController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\ResourceTypeController;
use App\Http\Controllers\ResourceTagController;
use App\Http\Controllers\SourceController;

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

/* Resource tag routes. */
Route::get('admin/sources', [SourceController::class, 'index'])->middleware('admin')->name('sources');
Route::get('admin/sources/{source:source}', [SourceController::class, 'show'])->middleware('admin')->name('source');
Route::get('admin/source/create', [SourceController::class, 'create'])->middleware('admin')->name('source-create');
Route::get('admin/source/{source:source}/edit', [SourceController::class, 'edit'])->middleware('admin')->name('source-edit');
Route::post('admin/source/store', [SourceController::class, 'store'])->middleware('admin')->name('source-store');
Route::post('admin//source/{source:source}/update', [SourceController::class, 'update'])->middleware('admin')->name('source-update');
Route::delete('admin/source/{source:source}/destroy', [SourceController::class, 'destroy'])->middleware('admin')->name('source-destroy');

/* Resource tag routes. */
Route::get('admin/resource-tags', [ResourceTagController::class, 'index'])->middleware('admin')->name('resource-tags');
Route::get('admin/resource-tags/{resourceTag:tag}', [ResourceTagController::class, 'show'])->middleware('admin')->name('resource-tag');
Route::get('admin/resource-tag/create', [ResourceTagController::class, 'create'])->middleware('admin')->name('resource-tag-create');
Route::get('admin/resource-tag/{resourceTag:tag}/edit', [ResourceTagController::class, 'edit'])->middleware('admin')->name('resource-tag-edit');
Route::post('admin/resource-tag/store', [ResourceTagController::class, 'store'])->middleware('admin')->name('resource-tag-store');
Route::post('admin//resource-tag/{resourceTag:tag}/update', [ResourceTagController::class, 'update'])->middleware('admin')->name('resource-tag-update');
Route::delete('admin/resource-tag/{resourceTag:tag}/destroy', [ResourceTagController::class, 'destroy'])->middleware('admin')->name('resource-tag-destroy');

/* Resource type routes. */
Route::get('admin/resource-types', [ResourceTypeController::class, 'index'])->middleware('admin')->name('resource-types');
Route::get('admin/resource-types/{resourceType:type}', [ResourceTypeController::class, 'show'])->middleware('admin')->name('resource-type');
Route::get('admin/resource-type/create', [ResourceTypeController::class, 'create'])->middleware('admin')->name('resource-type-create');
Route::get('admin/resource-type/{resourceType:type}/edit', [ResourceTypeController::class, 'edit'])->middleware('admin')->name('resource-type-edit');
Route::post('admin/resource-type/store', [ResourceTypeController::class, 'store'])->middleware('admin')->name('resource-type-store');
Route::post('admin//resource-type/{resourceType:type}/update', [ResourceTypeController::class, 'update'])->middleware('admin')->name('resource-type-update');
Route::delete('admin/resource-type/{resourceType:type}/destroy', [ResourceTypeController::class, 'destroy'])->middleware('admin')->name('resource-type-destroy');

/* User routes. */
Route::get('admin/users', [UserController::class, 'index'])->middleware('admin')->name('users');
Route::get('admin/users/{user:name}', [UserController::class, 'show'])->middleware('admin')->name('user');
Route::get('admin/users/{user:name}/edit', [UserController::class, 'edit'])->middleware('admin')->name('user-edit');
Route::post('admin/user/{user:name}/update', [UserController::class, 'update'])->middleware('admin')->name('user-update');
Route::delete('admin/user/{user:name}/destroy', [UserController::class, 'destroy'])->middleware('admin')->name('user-destroy');

/* Privilege routes. */
Route::get('admin/privileges', [PrivilegeController::class, 'index'])->middleware('admin')->name('privileges');
Route::get('admin/privileges/{privilege:title}', [PrivilegeController::class, 'show'])->middleware('admin')->name('privilege');
Route::get('admin/privilege/create', [PrivilegeController::class, 'create'])->middleware('admin')->name('privilege-create');
Route::get('admin/privilege/{privilege:title}/edit', [PrivilegeController::class, 'edit'])->middleware('admin')->name('privilege-edit');
Route::post('admin/privilege/store', [PrivilegeController::class, 'store'])->middleware('admin')->name('privilege-store');
Route::post('admin//privilege/{privilege:title}/update', [PrivilegeController::class, 'update'])->middleware('admin')->name('privilege-update');
Route::delete('admin/privilege/{privilege:title}/destroy', [PrivilegeController::class, 'destroy'])->middleware('admin')->name('privilege-destroy');

/* School routes. */
Route::get('/schools', [SchoolController::class, 'index'])->middleware('auth')->name('schools');
Route::get('/schools/{school:name}', [SchoolController::class, 'show'])->middleware('auth')->name('school');
Route::get('admin/school/create', [SchoolController::class, 'create'])->middleware('admin')->name('school-create');
Route::get('admin/school/{school:name}/edit', [SchoolController::class, 'edit'])->middleware('admin')->name('school-edit');
Route::post('admin/school/store', [SchoolController::class, 'store'])->middleware('admin')->name('school-store');
Route::post('admin/school/{school:name}/update', [SchoolController::class, 'update'])->middleware('admin')->name('school-update');
Route::delete('admin/school/{school:name}/destroy', [SchoolController::class, 'destroy'])->middleware('admin')->name('school-destroy');

require __DIR__.'/auth.php';
