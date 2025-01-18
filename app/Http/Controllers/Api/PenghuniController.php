<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Penghuni;
use Illuminate\Http\Request;

class PenghuniController extends Controller
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
            $penghuni = Penghuni::with('rumah', 'pembayaran')->get();
            return $this->generateResponse(true, $penghuni, 'Data penghuni berhasil diambil');
        } catch (\Exception $e) {
            return $this->generateResponse(false, null, $e->getMessage(), 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $penghuni = Penghuni::create($request->all());
            return $this->generateResponse(true, $penghuni, 'Data penghuni berhasil ditambahkan', 201);
        } catch (\Exception $e) {
            return $this->generateResponse(false, null, $e->getMessage(), 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $penghuni = Penghuni::find($id);
            if (!$penghuni) {
                return $this->generateResponse(false, null, 'Data penghuni tidak ditemukan', 404);
            }
            $penghuni->update($request->all());
            return $this->generateResponse(true, $penghuni, 'Data penghuni berhasil diubah');
        } catch (\Exception $e) {
            return $this->generateResponse(false, null, $e->getMessage(), 500);
        }
    }
}
