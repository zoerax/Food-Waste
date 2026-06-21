<?php

use App\Http\Controllers\SisaMakananController;
use Illuminate\Support\Facades\Route;

Route::get('/', [SisaMakananController::class, 'dashboard'])->name('dashboard');
Route::get('/tabel', [SisaMakananController::class, 'index'])->name('tabel');
Route::get('/tambah', [SisaMakananController::class, 'create'])->name('tambah');

Route::post('/store', [SisaMakananController::class, 'store'])->name('store');
Route::get('/edit/{id}', [SisaMakananController::class, 'edit'])->name('edit');
Route::put('/update/{id}', [SisaMakananController::class, 'update'])->name('update');
Route::delete('/delete/{id}', [SisaMakananController::class, 'destroy'])->name('delete');

Route::get('/export', [SisaMakananController::class, 'export'])->name('export');