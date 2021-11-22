<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\AdminPageController;

Route::middleware('permission.check:admin')->group(function () {
    Route::get('admin/pages', [AdminPageController::class, 'index'])->name('admin-pages');
    Route::get('admin/pages/{page:slug}', [AdminPageController::class, 'show'])->name('admin-page');
    Route::get('admin/page/create', [AdminPageController::class, 'create'])->name('admin-page-create');
    Route::get('admin/page/{page:slug}/edit', [AdminPageController::class, 'edit'])->name('admin-page-edit');
    Route::post('admin/page/store', [AdminPageController::class, 'store'])->name('admin-page-store');
    Route::patch('admin/page/{page:slug}/update', [AdminPageController::class, 'update'])->name('admin-page-update');
    Route::delete('admin/page/{page:slug}/destroy', [AdminPageController::class, 'destroy'])->name('admin-page-destroy');    
});