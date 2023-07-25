<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\JenisController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\SatuanController;
use App\Http\Livewire\Kategori\MainIndex;
use Illuminate\Support\Facades\Route;


Route::get('/', [MainController::class, 'index'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::prefix('backend')->name('backend.')->group(function () {
        Route::get('/', [MainController::class, 'main'])->name('main');

        Route::resource('jenis', JenisController::class);
        Route::resource('satuan', SatuanController::class);
        Route::resource('barang', BarangController::class);
    });
});

