<?php

use App\Http\Controllers\SisaMakananController;
use Illuminate\Support\Facades\Route;

Route::get('/', [SisaMakananController::class, 'index']);
Route::post('/store', [SisaMakananController::class, 'store']);

Route::get('/edit/{id}', [SisaMakananController::class, 'edit']);
Route::put('/update/{id}', [SisaMakananController::class, 'update']);

Route::delete('/delete/{id}', [SisaMakananController::class, 'destroy']);

Route::get('/export', [SisaMakananController::class, 'export']);