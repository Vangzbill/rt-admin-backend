<?php

namespace Database\Seeders;

use App\Models\Pembayaran;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PembayaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pembayaran = [
            [
                'penghuni_id' => 1,
                'rumah_id' => 1,
                'jenis_iuran' => 'Satpam',
                'jumlah_iuran' => 100000,
                'periode' => '2021-01-01',
                'status_pembayaran' => 'Lunas'
            ],
            [
                'penghuni_id' => 1,
                'rumah_id' => 1,
                'jenis_iuran' => 'Kebersihan',
                'jumlah_iuran' => 15000,
                'periode' => '2021-01-01',
                'status_pembayaran' => 'Lunas'
            ],
            [
                'penghuni_id' => 2,
                'rumah_id' => 2,
                'jenis_iuran' => 'Satpam',
                'jumlah_iuran' => 100000,
                'periode' => '2021-01-01',
                'status_pembayaran' => 'Lunas'
            ],
            [
                'penghuni_id' => 2,
                'rumah_id' => 2,
                'jenis_iuran' => 'Kebersihan',
                'jumlah_iuran' => 15000,
                'periode' => '2021-01-01',
                'status_pembayaran' => 'Lunas'
            ],
            [
                'penghuni_id' => 3,
                'rumah_id' => 3,
                'jenis_iuran' => 'Satpam',
                'jumlah_iuran' => 100000,
                'periode' => '2021-01-01',
                'status_pembayaran' => 'Lunas'
            ],
            [
                'penghuni_id' => 3,
                'rumah_id' => 3,
                'jenis_iuran' => 'Kebersihan',
                'jumlah_iuran' => 15000,
                'periode' => '2021-01-01',
                'status_pembayaran' => 'Lunas'
            ],
            [
                'penghuni_id' => 4,
                'rumah_id' => 4,
                'jenis_iuran' => 'Satpam',
                'jumlah_iuran' => 100000,
                'periode' => '2022-01-01',
                'status_pembayaran' => 'Lunas'
            ],
        ];

        foreach ($pembayaran as $data) {
            Pembayaran::create($data);
        }
    }
}
