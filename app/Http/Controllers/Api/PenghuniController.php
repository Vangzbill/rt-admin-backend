<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Penghuni;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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
            $penghuni = Penghuni::with('historiPenghuni')->get();
            return $this->generateResponse(true, $penghuni, 'Data penghuni berhasil diambil');
        } catch (\Exception $e) {
            return $this->generateResponse(false, null, $e->getMessage(), 500);
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required|string',
            'foto_ktp' => 'required|string',
            'status_penghuni' => 'required|string',
            'nomor_telepon' => 'required|string',
            'status_pernikahan' => 'required|boolean',
        ]);

        $foto_ktp = $request->foto_ktp;
        $image = str_replace('data:image/png;base64,', '', $foto_ktp);
        $image = str_replace(' ', '+', $image);
        $imageName = 'foto_ktp_' . time() . '.png';
        $path = storage_path('app/public/foto_ktp/' . $imageName);

        file_put_contents($path, base64_decode($image));

        $penghuni = Penghuni::create([
            'nama_lengkap' => $request->nama_lengkap,
            'foto_ktp' => $imageName,
            'status_penghuni' => $request->status_penghuni,
            'nomor_telepon' => $request->nomor_telepon,
            'status_pernikahan' => $request->status_pernikahan,
        ]);

        return response()->json([
            'status' => true,
            'data' => $penghuni,
            'message' => 'Data penghuni berhasil ditambahkan',
        ], 201);
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

    public function destroy($id)
    {
        try {
            $penghuni = Penghuni::find($id);
            if (!$penghuni) {
                return $this->generateResponse(false, null, 'Data penghuni tidak ditemukan', 404);
            }
            $penghuni->delete();
            return $this->generateResponse(true, null, 'Data penghuni berhasil dihapus');
        } catch (\Exception $e) {
            return $this->generateResponse(false, null, $e->getMessage(), 500);
        }
    }

    public function show($id)
    {
        try {
            $penghuni = Penghuni::find($id);
            if (!$penghuni) {
                return $this->generateResponse(false, null, 'Data penghuni tidak ditemukan', 404);
            }
            return $this->generateResponse(true, $penghuni, 'Data penghuni berhasil diambil');
        } catch (\Exception $e) {
            return $this->generateResponse(false, null, $e->getMessage(), 500);
        }
    }
}
