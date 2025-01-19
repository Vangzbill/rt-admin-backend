<?php

namespace Database\Seeders;

use App\Models\Pengeluaran;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PengeluaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pengeluaran = [
            [
                'deskripsi' => 'Pembelian kebutuhan dapur',
                'jumlah' => 500000,
                'tanggal' => '2021-01-01'
            ],
            [
                'deskripsi' => 'Pembelian kebutuhan dapur',
                'jumlah' => 500000,
                'tanggal' => '2021-01-02'
            ],
            [
                'deskripsi' => 'Pembelian kebutuhan dapur',
                'jumlah' => 500000,
                'tanggal' => '2021-01-03'
            ],
            [
                'deskripsi' => 'Pembelian kebutuhan dapur',
                'jumlah' => 500000,
                'tanggal' => '2021-01-04'
            ]
        ];

        foreach ($pengeluaran as $data) {
            Pengeluaran::insert($data);
        }
    }
}
