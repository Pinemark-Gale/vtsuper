<?php
namespace App\Models;

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\PrivilegeController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\ResourceTypeController;
use App\Http\Controllers\ResourceTagController;
use App\Http\Controllers\SourceController;
use App\Http\Controllers\ResourceController;

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
Route::get('resources', [ResourceController::class, 'index'])->name('resources');
Route::get('resources/{resource:name}', [ResourceController::class, 'show'])->middleware('permission.check:student')->name('resource');
Route::get('admin/resource/create', [ResourceController::class, 'create'])->middleware('permission.check:contributor')->name('resource-create');
Route::get('admin/resource/{resource:name}/edit', [ResourceController::class, 'edit'])->middleware('permission.check:contributor')->name('resource-edit');
Route::post('admin/resource/store', [ResourceController::class, 'store'])->middleware('permission.check:contributor')->name('resource-store');
Route::patch('admin//resource/{resource:name}/update', [ResourceController::class, 'update'])->middleware('permission.check:contributor')->name('resource-update');
Route::delete('admin/resource/{resource:name}/destroy', [ResourceController::class, 'destroy'])->middleware('permission.check:teacher')->name('resource-destroy');

/* Resource source routes. */
Route::get('admin/sources', [SourceController::class, 'index'])->middleware('permission.check:contributor')->name('sources');
Route::get('admin/sources/{source:source}', [SourceController::class, 'show'])->middleware('permission.check:contributor')->name('source');
Route::get('admin/source/create', [SourceController::class, 'create'])->middleware('permission.check:contributor')->name('source-create');
Route::get('admin/source/{source:source}/edit', [SourceController::class, 'edit'])->middleware('permission.check:contributor')->name('source-edit');
Route::post('admin/source/store', [SourceController::class, 'store'])->middleware('permission.check:contributor')->name('source-store');
Route::patch('admin//source/{source:source}/update', [SourceController::class, 'update'])->middleware('permission.check:contributor')->name('source-update');
Route::delete('admin/source/{source:source}/destroy', [SourceController::class, 'destroy'])->middleware('permission.check:teacher')->name('source-destroy');

/* Resource tag routes. */
Route::get('admin/resource-tags', [ResourceTagController::class, 'index'])->middleware('permission.check:teacher')->name('resource-tags');
Route::get('admin/resource-tags/{resourceTag:tag}', [ResourceTagController::class, 'show'])->middleware('permission.check:teacher')->name('resource-tag');
Route::get('admin/resource-tag/create', [ResourceTagController::class, 'create'])->middleware('permission.check:teacher')->name('resource-tag-create');
Route::get('admin/resource-tag/{resourceTag:tag}/edit', [ResourceTagController::class, 'edit'])->middleware('permission.check:teacher')->name('resource-tag-edit');
Route::post('admin/resource-tag/store', [ResourceTagController::class, 'store'])->middleware('permission.check:teacher')->name('resource-tag-store');
Route::patch('admin//resource-tag/{resourceTag:tag}/update', [ResourceTagController::class, 'update'])->middleware('permission.check:teacher')->name('resource-tag-update');
Route::delete('admin/resource-tag/{resourceTag:tag}/destroy', [ResourceTagController::class, 'destroy'])->middleware('permission.check:admin')->name('resource-tag-destroy');

/* Resource type routes. */
Route::get('admin/resource-types', [ResourceTypeController::class, 'index'])->middleware('permission.check:teacher')->name('resource-types');
Route::get('admin/resource-types/{resourceType:type}', [ResourceTypeController::class, 'show'])->middleware('permission.check:teacher')->name('resource-type');
Route::get('admin/resource-type/create', [ResourceTypeController::class, 'create'])->middleware('permission.check:teacher')->name('resource-type-create');
Route::get('admin/resource-type/{resourceType:type}/edit', [ResourceTypeController::class, 'edit'])->middleware('permission.check:teacher')->name('resource-type-edit');
Route::post('admin/resource-type/store', [ResourceTypeController::class, 'store'])->middleware('permission.check:teacher')->name('resource-type-store');
Route::patch('admin//resource-type/{resourceType:type}/update', [ResourceTypeController::class, 'update'])->middleware('permission.check:teacher')->name('resource-type-update');
Route::delete('admin/resource-type/{resourceType:type}/destroy', [ResourceTypeController::class, 'destroy'])->middleware('permission.check:admin')->name('resource-type-destroy');

/* User routes. */
Route::get('admin/users', [UserController::class, 'index'])->middleware('permission.check:admin')->name('users');
Route::get('admin/users/{user:name}', [UserController::class, 'show'])->middleware('permission.check:admin')->name('user');
Route::get('register', [UserController::class, 'create'])->middleware('guest')->name('user-create');
Route::get('admin/users/{user:name}/edit', [UserController::class, 'edit'])->middleware('permission.check:admin')->name('user-edit');
Route::post('register', [UserController::class, 'store'])->middleware('guest')->name('user-store');
Route::patch('admin/user/{user:name}/update', [UserController::class, 'update'])->middleware('permission.check:admin')->name('user-update');
Route::delete('admin/user/{user:name}/destroy', [UserController::class, 'destroy'])->middleware('permission.check:admin')->name('user-destroy');

/* Privilege routes. */
Route::get('admin/privileges', [PrivilegeController::class, 'index'])->middleware('permission.check:admin')->name('privileges');
Route::get('admin/privileges/{privilege:title}', [PrivilegeController::class, 'show'])->middleware('permission.check:admin')->name('privilege');
Route::get('admin/privilege/create', [PrivilegeController::class, 'create'])->middleware('permission.check:admin')->name('privilege-create');
Route::get('admin/privilege/{privilege:title}/edit', [PrivilegeController::class, 'edit'])->middleware('permission.check:admin')->name('privilege-edit');
Route::post('admin/privilege/store', [PrivilegeController::class, 'store'])->middleware('permission.check:admin')->name('privilege-store');
Route::patch('admin//privilege/{privilege:title}/update', [PrivilegeController::class, 'update'])->middleware('permission.check:admin')->name('privilege-update');
Route::delete('admin/privilege/{privilege:title}/destroy', [PrivilegeController::class, 'destroy'])->middleware('permission.check:admin')->name('privilege-destroy');

/* School routes. */
Route::get('/schools', [SchoolController::class, 'index'])->middleware('permission.check:teacher')->name('schools');
Route::get('/schools/{school:name}', [SchoolController::class, 'show'])->middleware('permission.check:teacher')->name('school');
Route::get('admin/school/create', [SchoolController::class, 'create'])->middleware('permission.check:teacher')->name('school-create');
Route::get('admin/school/{school:name}/edit', [SchoolController::class, 'edit'])->middleware('permission.check:teacher')->name('school-edit');
Route::post('admin/school/store', [SchoolController::class, 'store'])->middleware('permission.check:teacher')->name('school-store');
Route::patch('admin/school/{school:name}/update', [SchoolController::class, 'update'])->middleware('permission.check:teacher')->name('school-update');
Route::delete('admin/school/{school:name}/destroy', [SchoolController::class, 'destroy'])->middleware('permission.check:admin')->name('school-destroy');

require __DIR__.'/auth.php';
