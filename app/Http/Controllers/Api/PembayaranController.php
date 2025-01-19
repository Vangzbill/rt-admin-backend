<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pembayaran;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    private function generateResponse($status, $data = null, $message = null, $statusCode = 200)
    {
        return response()->json([
            'status' => $status,
            'data' => $data,
            'message' => $message
        ], $statusCode);
    }

    public function index()
    {
        try {
            $pembayaran = Pembayaran::with('penghuni', 'rumah')->get();

            $data = [];

            foreach ($pembayaran as $item) {
                $data[] = [
                    'id' => $item->id,
                    'penghuni' => $item->penghuni->nama_lengkap,
                    'rumah' => $item->rumah->nomor_rumah,
                    'jenis_iuran' => $item->jenis_iuran,
                    'jumlah_iuran' => $item->jumlah_iuran,
                    'periode' => $item->periode,
                    'status_pembayaran' => $item->status_pembayaran,
                ];
            }

            return $this->generateResponse(true, $data, 'Data pembayaran berhasil diambil');
        } catch (\Exception $e) {
            return $this->generateResponse(false, null, $e->getMessage(), 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $pembayaran = Pembayaran::create($request->all());
            return $this->generateResponse(true, $pembayaran, 'Data pembayaran berhasil ditambahkan', 201);
        } catch (\Exception $e) {
            return $this->generateResponse(false, null, $e->getMessage(), 500);
        }
    }

    public function history($id)
    {
        try {
            $pembayaran = Pembayaran::with('penghuni', 'rumah')->where('id', $id)->get();

            $data = [];

            foreach ($pembayaran as $item) {
                $data[] = [
                    'id' => $item->id,
                    'penghuni' => $item->penghuni->nama_lengkap,
                    'rumah' => $item->rumah->nomor_rumah,
                    'jenis_iuran' => $item->jenis_iuran,
                    'jumlah_iuran' => $item->jumlah_iuran,
                    'periode' => $item->periode,
                    'status_pembayaran' => $item->status_pembayaran,
                ];
            }

            return $this->generateResponse(true, $data, 'Data pembayaran berhasil diambil');
        } catch (\Exception $e) {
            return $this->generateResponse(false, null, $e->getMessage(), 500);
        }
    }
}
