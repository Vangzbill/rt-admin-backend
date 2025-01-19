<?php

namespace Database\Seeders;

use App\Models\HistoriPenghuni;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HistoriPenghuniSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $historiPenghuni = [
            [
                'rumah_id' => 1,
                'penghuni_id' => 1,
                'tanggal_mulai' => '2021-01-01',
                'tanggal_selesai' => '2021-01-31'
            ],
            [
                'rumah_id' => 2,
                'penghuni_id' => 2,
                'tanggal_mulai' => '2021-01-01',
                'tanggal_selesai' => '2021-01-31'
            ],
            [
                'rumah_id' => 3,
                'penghuni_id' => 3,
                'tanggal_mulai' => '2021-01-01',
                'tanggal_selesai' => '2021-01-31'
            ],
            [
                'rumah_id' => 4,
                'penghuni_id' => 4,
                'tanggal_mulai' => '2021-01-01',
                'tanggal_selesai' => '2021-01-31'
            ]
        ];

        foreach ($historiPenghuni as $data) {
            HistoriPenghuni::insert($data);
        }
    }
}
