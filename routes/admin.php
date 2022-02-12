<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\AdminPageController;
use App\Http\Controllers\Admin\AdminSchoolController;
use App\Http\Controllers\Admin\AdminPrivilegeController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminResourceTagController;
use App\Http\Controllers\Admin\AdminSourceController;
use App\Http\Controllers\Admin\AdminResourceController;
use App\Http\Controllers\Admin\AdminResourceTypeController;
use App\Http\Controllers\Admin\AdminActivityController;

/* ==== ADMIN ROUTES === */
Route::middleware('permission.check:admin')->group(function () {
    /* School routes. */
    Route::delete('admin/school/{school:name}/destroy', [AdminSchoolController::class, 'destroy'])->name('admin-school-destroy');

    /* Resource type routes. */
    Route::delete('admin/resource-type/{resourceType:type}/destroy', [AdminResourceTypeController::class, 'destroy'])->name('admin-resource-type-destroy');

    /* Privilege routes. */
    Route::get('admin/privileges', [AdminPrivilegeController::class, 'index'])->name('admin-privileges');
    Route::get('admin/privileges/search', [AdminPrivilegeController::class, 'search'])->name('admin-privileges-search');
    Route::get('admin/privileges/{privilege:title}', [AdminPrivilegeController::class, 'show'])->name('admin-privilege');
    Route::get('admin/privilege/create', [AdminPrivilegeController::class, 'create'])->name('admin-privilege-create');
    Route::get('admin/privilege/{privilege:title}/edit', [AdminPrivilegeController::class, 'edit'])->name('admin-privilege-edit');
    Route::post('admin/privilege/store', [AdminPrivilegeController::class, 'store'])->name('admin-privilege-store');
    Route::patch('admin//privilege/{privilege:title}/update', [AdminPrivilegeController::class, 'update'])->name('admin-privilege-update');
    Route::delete('admin/privilege/{privilege:title}/destroy', [AdminPrivilegeController::class, 'destroy'])->name('admin-privilege-destroy');

    /* Page routes. */
    Route::get('admin/pages', [AdminPageController::class, 'index'])->name('admin-pages');
    Route::get('admin/pages/search', [AdminPageController::class, 'search'])->name('admin-pages-search');
    Route::get('admin/pages/{page:slug}', [AdminPageController::class, 'show'])->name('admin-page');
    Route::get('admin/page/create', [AdminPageController::class, 'create'])->name('admin-page-create');
    Route::get('admin/page/{page:slug}/edit', [AdminPageController::class, 'edit'])->name('admin-page-edit');
    Route::post('admin/page/store', [AdminPageController::class, 'store'])->name('admin-page-store');
    Route::patch('admin/page/{page:slug}/update', [AdminPageController::class, 'update'])->name('admin-page-update');
    Route::delete('admin/page/{page:slug}/destroy', [AdminPageController::class, 'destroy'])->name('admin-page-destroy');    

    /* User routes. */
    Route::get('admin/users', [AdminUserController::class, 'index'])->name('admin-users');
    Route::get('admin/users/search', [AdminUserController::class, 'search'])->name('admin-users-search');
    Route::get('admin/users/{user:name}', [AdminUserController::class, 'show'])->name('admin-user');
    Route::get('admin/user/register', [AdminUserController::class, 'create'])->name('admin-user-create');
    Route::post('admin/user/register', [AdminUserController::class, 'store'])->name('admin-user-store');
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
    Route::get('admin/schools/search', [AdminSchoolController::class, 'search'])->name('admin-schools-search');
    Route::get('admin/schools/{school:name}', [AdminSchoolController::class, 'show'])->name('admin-school');
    Route::get('admin/school/create', [AdminSchoolController::class, 'create'])->name('admin-school-create');
    Route::get('admin/school/{school:name}/edit', [AdminSchoolController::class, 'edit'])->name('admin-school-edit');
    Route::post('admin/school/store', [AdminSchoolController::class, 'store'])->name('admin-school-store');
    Route::patch('admin/school/{school:name}/update', [AdminSchoolController::class, 'update'])->name('admin-school-update');

    /* Resource type routes. */
    Route::get('admin/resource-types', [AdminResourceTypeController::class, 'index'])->name('admin-resource-types');
    Route::get('admin/resource-types/search', [AdminResourceTypeController::class, 'search'])->name('admin-resource-types-search');
    Route::get('admin/resource-types/{resourceType:type}', [AdminResourceTypeController::class, 'show'])->name('admin-resource-type');
    Route::get('admin/resource-type/create', [AdminResourceTypeController::class, 'create'])->name('admin-resource-type-create');
    Route::get('admin/resource-type/{resourceType:type}/edit', [AdminResourceTypeController::class, 'edit'])->name('admin-resource-type-edit');
    Route::post('admin/resource-type/store', [AdminResourceTypeController::class, 'store'])->name('admin-resource-type-store');
    Route::patch('admin//resource-type/{resourceType:type}/update', [AdminResourceTypeController::class, 'update'])->name('admin-resource-type-update');

    /* Resource tag routes. */
    Route::get('admin/resource-tags', [AdminResourceTagController::class, 'index'])->name('admin-resource-tags');
    Route::get('admin/resource-tags/search', [AdminResourceTagController::class, 'search'])->name('admin-resource-tags-search');
    Route::get('admin/resource-tags/{resourceTag:tag}', [AdminResourceTagController::class, 'show'])->name('admin-resource-tag');
    Route::get('admin/resource-tag/create', [AdminResourceTagController::class, 'create'])->name('admin-resource-tag-create');
    Route::get('admin/resource-tag/{resourceTag:tag}/edit', [AdminResourceTagController::class, 'edit'])->name('admin-resource-tag-edit');
    Route::post('admin/resource-tag/store', [AdminResourceTagController::class, 'store'])->name('admin-resource-tag-store');
    Route::patch('admin//resource-tag/{resourceTag:tag}/update', [AdminResourceTagController::class, 'update'])->name('admin-resource-tag-update');

    /* Resource source routes. */
    Route::delete('admin/source/{source:source}/destroy', [AdminSourceController::class, 'destroy'])->name('admin-source-destroy');
    Route::patch('admin//source/{source:source}/update', [AdminSourceController::class, 'update'])->name('admin-source-update');

    /* Resource routes. */
    Route::delete('admin/resource/{resource:name}/destroy', [AdminResourceController::class, 'destroy'])->name('admin-resource-destroy');

    /* Activity routes. */
    Route::get('admin/activities', [AdminActivityController::class, 'index'])->name('admin-activities');
    Route::get('admin/activities/search', [AdminActivityController::class, 'search'])->name('admin-activities-search');
    Route::get('admin/activities/{activity:name}', [AdminActivityController::class, 'show'])->name('admin-activity');
    Route::get('admin/activity/create', [AdminActivityController::class, 'create'])->name('admin-activity-create');
    Route::get('admin/activity/{activity:name}/edit', [AdminActivityController::class, 'edit'])->name('admin-activity-edit');
    Route::post('admin/activity/store', [AdminActivityController::class, 'store'])->name('admin-activity-store');
    Route::delete('admin/activity/{activity:name}/destroy', [AdminActivityController::class, 'destroy'])->name('admin-activity-destroy');
});

/* ==== CONTRIBUTOR ROUTES === */
Route::middleware('permission.check:contributor')->group(function () {
    /* Resource source routes. */
    Route::get('admin/sources', [AdminSourceController::class, 'index'])->name('admin-sources');
    Route::get('admin/sources/search', [AdminSourceController::class, 'search'])->name('admin-sources-search');
    Route::get('admin/sources/{source:source}', [AdminSourceController::class, 'show'])->name('admin-source');
    Route::get('admin/source/create', [AdminSourceController::class, 'create'])->name('admin-source-create');
    Route::get('admin/source/{source:source}/edit', [AdminSourceController::class, 'edit'])->name('admin-source-edit');
    Route::post('admin/source/store', [AdminSourceController::class, 'store'])->name('admin-source-store');
    
    /* Resource routes. */
    Route::get('admin/resources', [AdminResourceController::class, 'index'])->name('admin-resources');
    Route::get('admin/resources/search', [AdminResourceController::class, 'search'])->name('admin-resources-search');
    Route::get('admin/resource/create', [AdminResourceController::class, 'create'])->name('admin-resource-create');
    Route::get('admin/resource/{resource:name}/edit', [AdminResourceController::class, 'edit'])->name('admin-resource-edit');
    Route::post('admin/resource/store', [AdminResourceController::class, 'store'])->name('admin-resource-store');
    Route::patch('admin//resource/{resource:name}/update', [AdminResourceController::class, 'update'])->name('admin-resource-update');
    
});

/* ==== STUDENT ROUTES === */
Route::middleware('permission.check:student')->group(function () {
    /* Resource routes. */
    Route::get('resources/{resource:name}', [AdminResourceController::class, 'show'])->name('admin-resource');
});


