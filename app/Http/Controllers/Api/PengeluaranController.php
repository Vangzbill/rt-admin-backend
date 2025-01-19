<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pengeluaran;
use Illuminate\Http\Request;

class PengeluaranController extends Controller
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
            $pengeluaran = Pengeluaran::all();
            return $this->generateResponse(true, $pengeluaran, 'Data pengeluaran berhasil diambil');
        } catch (\Exception $e) {
            return $this->generateResponse(false, null, $e->getMessage(), 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $pengeluaran = Pengeluaran::create($request->all());
            return $this->generateResponse(true, $pengeluaran, 'Data pengeluaran berhasil ditambahkan', 201);
        } catch (\Exception $e) {
            return $this->generateResponse(false, null, $e->getMessage(), 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $pengeluaran = Pengeluaran::find($id);
            if (!$pengeluaran) {
                return $this->generateResponse(false, null, 'Data pengeluaran tidak ditemukan', 404);
            }
            $pengeluaran->update($request->all());
            return $this->generateResponse(true, $pengeluaran, 'Data pengeluaran berhasil diubah');
        } catch (\Exception $e) {
            return $this->generateResponse(false, null, $e->getMessage(), 500);
        }
    }

    public function destroy($id)
    {
        try {
            $pengeluaran = Pengeluaran::find($id);
            if (!$pengeluaran) {
                return $this->generateResponse(false, null, 'Data pengeluaran tidak ditemukan', 404);
            }
            $pengeluaran->delete();
            return $this->generateResponse(true, null, 'Data pengeluaran berhasil dihapus');
        } catch (\Exception $e) {
            return $this->generateResponse(false, null, $e->getMessage(), 500);
        }
    }
}
