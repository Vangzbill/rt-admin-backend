<?php

use App\Http\Controllers\Api\HistoriPenghuni;
use App\Http\Controllers\Api\LaporanController;
use App\Http\Controllers\Api\PembayaranController;
use App\Http\Controllers\Api\PengeluaranController;
use App\Http\Controllers\Api\PenghuniController;
use App\Http\Controllers\Api\RumahController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::apiResource('penghunis', PenghuniController::class);

Route::apiResource('rumahs', RumahController::class);
Route::get('rumahs/{rumah}/history', [RumahController::class, 'history']);

Route::post('penghuni-rumah', [HistoriPenghuni::class, 'store']);
Route::put('penghuni-rumah/{penghuniRumah}', [HistoriPenghuni::class, 'update']);

Route::apiResource('pembayarans', PembayaranController::class);
Route::get('pembayarans/rumah/{penghuniRumah}', [PembayaranController::class, 'history']);

Route::apiResource('pengeluarans', PengeluaranController::class);

Route::get('laporan/tahunan', [LaporanController::class, 'summaryTahunan']);
Route::get('laporan/bulanan', [LaporanController::class, 'detailBulanan']);
Route::get('dashboard', [LaporanController::class, 'dashboard']);
