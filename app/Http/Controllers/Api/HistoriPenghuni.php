<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\HistoriPenghuni as ModelsHistoriPenghuni;
use App\Models\Rumah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HistoriPenghuni extends Controller
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
        $validated = $request->validate([
            'rumah_id' => 'required|exists:rumahs,id',
            'penghuni_id' => 'required|exists:penghunis,id',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'nullable|date|after:tanggal_mulai',
        ]);

        DB::transaction(function () use ($validated) {

            ModelsHistoriPenghuni::create($validated);

            Rumah::where('id', $validated['rumah_id'])
                ->update(['status_dihuni' => 'dihuni']);
        });

        return $this->generateResponse(true, null, 'Histori penghuni berhasil ditambahkan', 201);
    }

    public function update(Request $request, ModelsHistoriPenghuni $penghuniRumah)
    {
        $validated = $request->validate([
            'tanggal_selesai' => 'required|date|after:tanggal_mulai',
        ]);

        DB::transaction(function () use ($penghuniRumah, $validated) {
            $penghuniRumah->update([
                'tanggal_selesai' => $validated['tanggal_selesai'],
                'status_aktif' => false
            ]);

            if (!$penghuniRumah->rumah->penghuniAktif()) {
                $penghuniRumah->rumah->update(['status_dihuni' => 'tidak_dihuni']);
            }
        });

        return $this->generateResponse(true, null, 'Histori penghuni berhasil diubah');
    }
}
