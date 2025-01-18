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
            if (!$rumah) {
                return $this->generateResponse(false, null, 'Data rumah tidak ditemukan', 404);
            }
            return $this->generateResponse(true, $rumah, 'Data histori penghuni berhasil diambil');
        } catch (\Exception $e) {
            return $this->generateResponse(false, null, $e->getMessage(), 500);
        }
    }
}
