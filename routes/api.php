<?php

use App\Http\Controllers\Api\HistoriPenghuni;
use App\Http\Controllers\Api\LaporanController;
use App\Http\Controllers\Api\PembayaranController;
use App\Http\Controllers\Api\PengeluaranController;
use App\Http\Controllers\Api\PenghuniController;
use App\Http\Controllers\Api\RumahController;
use Illuminate\Support\Facades\Route;

Route::apiResource('penghunis', PenghuniController::class);

    Route::apiResource('rumahs', RumahController::class);
    Route::get('rumahs/{rumah}/history', [RumahController::class, 'history']);

    Route::post('penghuni-rumah', [HistoriPenghuni::class, 'store']);
    Route::put('penghuni-rumah/{penghuniRumah}', [HistoriPenghuni::class, 'update']);

    Route::post('pembayarans', [PembayaranController::class, 'store']);
    Route::get('pembayarans/rumah/{penghuniRumah}', [PembayaranController::class, 'getHistoryByRumah']);

    Route::apiResource('pengeluarans', PengeluaranController::class);

    Route::get('laporan/tahunan', [LaporanController::class, 'summaryTahunan']);
    Route::get('laporan/bulanan', [LaporanController::class, 'detailBulanan']);
