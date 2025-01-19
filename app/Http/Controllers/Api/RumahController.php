<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Rumah;
use Illuminate\Http\Request;

class RumahController extends Controller
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
            $rumah = Rumah::with('historiPenghuni')->get();
            return $this->generateResponse(true, $rumah, 'Data rumah berhasil diambil');
        } catch (\Exception $e) {
            return $this->generateResponse(false, null, $e->getMessage(), 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $rumah = Rumah::create($request->all());
            return $this->generateResponse(true, $rumah, 'Data rumah berhasil ditambahkan', 201);
        } catch (\Exception $e) {
            return $this->generateResponse(false, null, $e->getMessage(), 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $rumah = Rumah::find($id);
            if (!$rumah) {
                return $this->generateResponse(false, null, 'Data rumah tidak ditemukan', 404);
            }
            $rumah->update($request->all());
            return $this->generateResponse(true, $rumah, 'Data rumah berhasil diubah');
        } catch (\Exception $e) {
            return $this->generateResponse(false, null, $e->getMessage(), 500);
        }
    }

    public function history($id)
    {
        try {
            $rumah = Rumah::with('historiPenghuni.penghuni')->find($id);

            $data = [];

            foreach ($rumah->historiPenghuni as $item) {
                $data[] = [
                    'id' => $item->id,
                    'penghuni' => $item->penghuni->nama_lengkap,
                    'tanggal_mulai' => $item->tanggal_mulai,
                    'tanggal_selesai' => $item->tanggal_selesai,
                    'status_aktif' => $item->status_aktif,
                ];
            }

            return $this->generateResponse(true, $data, 'Data histori penghuni rumah berhasil diambil');
        } catch (\Exception $e) {
            return $this->generateResponse(false, null, $e->getMessage(), 500);
        }
    }

    public function destroy($id)
    {
        try {
            $rumah = Rumah::find($id);
            if (!$rumah) {
                return $this->generateResponse(false, null, 'Data rumah tidak ditemukan', 404);
            }
            $rumah->delete();
            return $this->generateResponse(true, null, 'Data rumah berhasil dihapus');
        } catch (\Exception $e) {
            return $this->generateResponse(false, null, $e->getMessage(), 500);
        }
    }

    public function show($id)
    {
        try {
            $rumah = Rumah::find($id);
            if (!$rumah) {
                return $this->generateResponse(false, null, 'Data rumah tidak ditemukan', 404);
            }
            return $this->generateResponse(true, $rumah, 'Data rumah berhasil diambil');
        } catch (\Exception $e) {
            return $this->generateResponse(false, null, $e->getMessage(), 500);
        }
    }
}
