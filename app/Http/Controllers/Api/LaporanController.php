<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pembayaran;
use App\Models\Pengeluaran;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    private function generateResponse($status, $data = null, $message = null, $statusCode = 200)
    {
        return response()->json([
            'status' => $status,
            'data' => $data,
            'message' => $message
        ], $statusCode);
    }

    public function dashboard(Request $request)
    {
        try {
            $bulan = $request->input('bulan', date('m'));

            $totalPemasukan = Pembayaran::whereMonth('periode', $bulan)->sum('jumlah_iuran');
            $totalPengeluaran = Pengeluaran::whereMonth('tanggal', $bulan)->sum('jumlah');
            $totalSaldo = $totalPemasukan - $totalPengeluaran;

            $data = [
                'total_pemasukan' => $totalPemasukan,
                'total_pengeluaran' => $totalPengeluaran,
                'total_saldo' => $totalSaldo
            ];

            return $this->generateResponse(true, $data, 'Data dashboard berhasil diambil');
        } catch (\Exception $e) {
            return $this->generateResponse(false, null, $e->getMessage(), 500);
        }
    }

    public function summaryTahunan(Request $request)
    {
        try {
            $tahun = $request->input('tahun', date('Y'));
            $pemasukan = Pembayaran::select(
                DB::raw('MONTH(periode) as bulan'),
                DB::raw('SUM(jumlah_iuran) as total_pemasukan')
            )
                ->whereYear('periode', $tahun)
                ->groupBy('bulan')
                ->get();

            $pengeluaran = Pengeluaran::select(
                DB::raw('MONTH(tanggal) as bulan'),
                DB::raw('SUM(jumlah) as total_pengeluaran')
            )
                ->whereYear('tanggal', $tahun)
                ->groupBy('bulan')
                ->get();

            $data = collect(range(1, 12))->map(function ($bulan) use ($pemasukan, $pengeluaran) {
                $pemasukanBulan = $pemasukan->firstWhere('bulan', $bulan);
                $pengeluaranBulan = $pengeluaran->firstWhere('bulan', $bulan);

                return [
                    'bulan' => Carbon::create()->month($bulan)->format('F'),
                    'pemasukan' => $pemasukanBulan ? $pemasukanBulan->total_pemasukan : 0,
                    'pengeluaran' => $pengeluaranBulan ? $pengeluaranBulan->total_pengeluaran : 0,
                    'saldo' => ($pemasukanBulan ? $pemasukanBulan->total_pemasukan : 0) -
                              ($pengeluaranBulan ? $pengeluaranBulan->total_pengeluaran : 0)
                ];
            });

            return $this->generateResponse(true, $data, 'Data laporan tahunan berhasil diambil');
        } catch (\Exception $e) {
            return $this->generateResponse(false, null, $e->getMessage(), 500);
        }
    }

    public function detailBulanan(Request $request)
    {
        try {
            $tahun = $request->input('tahun', date('Y'));
            $bulan = $request->input('bulan', date('m'));

            $totalPemasukan = Pembayaran::whereMonth('periode', $bulan)->whereYear('periode', $tahun)->sum('jumlah_iuran');
            $totalPengeluaran = Pengeluaran::whereMonth('tanggal', $bulan)->whereYear('tanggal', $tahun)->sum('jumlah');
            $totalSaldo = $totalPemasukan - $totalPengeluaran;

            $data = [
                'total_pemasukan' => $totalPemasukan,
                'total_pengeluaran' => $totalPengeluaran,
                'total_saldo' => $totalSaldo
            ];

            return $this->generateResponse(true, $data, 'Data dashboard berhasil diambil');
        } catch (\Exception $e) {
            return $this->generateResponse(false, null, $e->getMessage(), 500);
        }
    }
}
