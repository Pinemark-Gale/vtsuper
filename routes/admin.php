<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\AdminPageController;
use App\Http\Controllers\Admin\AdminSchoolController;
use App\Http\Controllers\Admin\AdminPrivilegeController;

Route::middleware('permission.check:admin')->group(function () {
    /* School routes. */
    Route::delete('admin/school/{school:name}/destroy', [AdminSchoolController::class, 'destroy'])->name('admin-school-destroy');

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
});

Route::middleware('permission.check:teacher')->group(function () {
    /* School routes. */
    Route::get('admin/schools', [AdminSchoolController::class, 'index'])->name('admin-schools');
    Route::get('admin/schools/{school:name}', [AdminSchoolController::class, 'show'])->name('admin-school');
    Route::get('admin/school/create', [AdminSchoolController::class, 'create'])->name('admin-school-create');
    Route::get('admin/school/{school:name}/edit', [AdminSchoolController::class, 'edit'])->name('admin-school-edit');
    Route::post('admin/school/store', [AdminSchoolController::class, 'store'])->name('admin-school-store');
    Route::patch('admin/school/{school:name}/update', [AdminSchoolController::class, 'update'])->name('admin-school-update');

});
