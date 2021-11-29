<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\AdminPageController;
use App\Http\Controllers\Admin\AdminSchoolController;
use App\Http\Controllers\Admin\AdminPrivilegeController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminResourceTagController;

/* ==== ADMIN ROUTES === */
Route::middleware('permission.check:admin')->group(function () {
    /* School routes. */
    Route::delete('admin/school/{school:name}/destroy', [AdminSchoolController::class, 'destroy'])->name('admin-school-destroy');

    /* Resource routes. */
    Route::delete('admin/resource-type/{resourceType:type}/destroy', [ResourceTypeController::class, 'destroy'])->name('resource-type-destroy');

    /* Privilege routes. */
    Route::get('admin/privileges', [AdminPrivilegeController::class, 'index'])->name('admin-privileges');
    Route::get('admin/privileges/{privilege:title}', [AdminPrivilegeController::class, 'show'])->name('admin-privilege');
    Route::get('admin/privilege/create', [AdminPrivilegeController::class, 'create'])->name('admin-privilege-create');
    Route::get('admin/privilege/{privilege:title}/edit', [AdminPrivilegeController::class, 'edit'])->name('admin-privilege-edit');
    Route::post('admin/privilege/store', [AdminPrivilegeController::class, 'store'])->name('admin-privilege-store');
    Route::patch('admin//privilege/{privilege:title}/update', [AdminPrivilegeController::class, 'update'])->name('admin-privilege-update');
    Route::delete('admin/privilege/{privilege:title}/destroy', [AdminPrivilegeController::class, 'destroy'])->name('admin-privilege-destroy');

    /* Page routes. */
    Route::get('admin/pages', [AdminPageController::class, 'index'])->name('admin-pages');
    Route::get('admin/pages/{page:slug}', [AdminPageController::class, 'show'])->name('admin-page');
    Route::get('admin/page/create', [AdminPageController::class, 'create'])->name('admin-page-create');
    Route::get('admin/page/{page:slug}/edit', [AdminPageController::class, 'edit'])->name('admin-page-edit');
    Route::post('admin/page/store', [AdminPageController::class, 'store'])->name('admin-page-store');
    Route::patch('admin/page/{page:slug}/update', [AdminPageController::class, 'update'])->name('admin-page-update');
    Route::delete('admin/page/{page:slug}/destroy', [AdminPageController::class, 'destroy'])->name('admin-page-destroy');    

    /* User routes. */
    Route::get('admin/users', [AdminUserController::class, 'index'])->name('admin-users');
    Route::get('admin/users/{user:name}', [AdminUserController::class, 'show'])->name('admin-user');
    Route::get('admin/users/{user:name}/edit', [AdminUserController::class, 'edit'])->name('admin-user-edit');
    Route::patch('admin/user/{user:name}/update', [AdminUserController::class, 'update'])->name('admin-user-update');
    Route::delete('admin/user/{user:name}/destroy', [AdminUserController::class, 'destroy'])->name('admin-user-destroy');

    /* Resource tag routes. */
    Route::delete('admin/resource-tag/{resourceTag:tag}/destroy', [AdminResourceTagController::class, 'destroy'])->name('admin-resource-tag-destroy');

});

/* ==== TEACHER ROUTES === */
Route::middleware('permission.check:teacher')->group(function () {
    /* School routes. */
    Route::get('admin/schools', [AdminSchoolController::class, 'index'])->name('admin-schools');
    Route::get('admin/schools/{school:name}', [AdminSchoolController::class, 'show'])->name('admin-school');
    Route::get('admin/school/create', [AdminSchoolController::class, 'create'])->name('admin-school-create');
    Route::get('admin/school/{school:name}/edit', [AdminSchoolController::class, 'edit'])->name('admin-school-edit');
    Route::post('admin/school/store', [AdminSchoolController::class, 'store'])->name('admin-school-store');
    Route::patch('admin/school/{school:name}/update', [AdminSchoolController::class, 'update'])->name('admin-school-update');

    /* Resource routes. */
    Route::get('admin/resource-types', [ResourceTypeController::class, 'index'])->name('resource-types');
    Route::get('admin/resource-types/{resourceType:type}', [ResourceTypeController::class, 'show'])->name('resource-type');
    Route::get('admin/resource-type/create', [ResourceTypeController::class, 'create'])->name('resource-type-create');
    Route::get('admin/resource-type/{resourceType:type}/edit', [ResourceTypeController::class, 'edit'])->name('resource-type-edit');
    Route::post('admin/resource-type/store', [ResourceTypeController::class, 'store'])->name('resource-type-store');
    Route::patch('admin//resource-type/{resourceType:type}/update', [ResourceTypeController::class, 'update'])->name('resource-type-update');

    /* Resource tag routes. */
    Route::get('admin/resource-tags', [AdminResourceTagController::class, 'index'])->name('admin-resource-tags');
    Route::get('admin/resource-tags/{resourceTag:tag}', [AdminResourceTagController::class, 'show'])->name('admin-resource-tag');
    Route::get('admin/resource-tag/create', [AdminResourceTagController::class, 'create'])->name('admin-resource-tag-create');
    Route::get('admin/resource-tag/{resourceTag:tag}/edit', [AdminResourceTagController::class, 'edit'])->name('admin-resource-tag-edit');
    Route::post('admin/resource-tag/store', [AdminResourceTagController::class, 'store'])->name('admin-resource-tag-store');
    Route::patch('admin//resource-tag/{resourceTag:tag}/update', [AdminResourceTagController::class, 'update'])->name('admin-resource-tag-update');

});

/* ==== CONTRIBUTOR ROUTES === */
Route::middleware('permission.check:contributor')->group(function () {

});

/* ==== STUDENT ROUTES === */
Route::middleware('permission.check:student')->group(function () {
    
});

Route::get('register', [AdminUserController::class, 'create'])->middleware('guest')->name('admin-user-create');
Route::post('register', [AdminUserController::class, 'store'])->middleware('guest')->name('admin-user-store');

