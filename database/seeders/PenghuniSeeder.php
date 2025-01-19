<?php

namespace Database\Seeders;

use App\Models\Penghuni;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PenghuniSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $penghuni = [
            [
                'nama_lengkap' => 'Budi Santoso',
                'foto_ktp' => 'budi.jpg',
                'status_penghuni' => 'Kontrak',
                'nomor_telepon' => '081234567890',
                'status_pernikahan' => true
            ],
            [
                'nama_lengkap' => 'Ani Rahayu',
                'foto_ktp' => 'ani.jpg',
                'status_penghuni' => 'Tetap',
                'nomor_telepon' => '081234567891',
                'status_pernikahan' => true
            ],
            [
                'nama_lengkap' => 'Joko Susilo',
                'foto_ktp' => 'joko.jpg',
                'status_penghuni' => 'Tetap',
                'nomor_telepon' => '081234567892',
                'status_pernikahan' => false
            ],
            [
                'nama_lengkap' => 'Rina Wati',
                'foto_ktp' => 'rina.jpg',
                'status_penghuni' => 'Tetap',
                'nomor_telepon' => '081234567893',
                'status_pernikahan' => false
            ]
        ];

        foreach ($penghuni as $data) {
            Penghuni::insert($data);
        }
    }
}
