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
            $pembayaran = Pembayaran::with('penghuni', 'rumah')->find($id);
            if (!$pembayaran) {
                return $this->generateResponse(false, null, 'Data pembayaran tidak ditemukan', 404);
            }
            return $this->generateResponse(true, $pembayaran, 'Data pembayaran berhasil diambil');
        } catch (\Exception $e) {
            return $this->generateResponse(false, null, $e->getMessage(), 500);
        }
    }
}
