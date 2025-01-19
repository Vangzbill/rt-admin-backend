<?php

namespace Database\Seeders;

use App\Models\Rumah;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RumahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rumah = [
            [
                'nomor_rumah' => 'A1',
                'status_dihuni' => true
            ],
            [
                'nomor_rumah' => 'A2',
                'status_dihuni' => false
            ],
            [
                'nomor_rumah' => 'A3',
                'status_dihuni' => true
            ],
            [
                'nomor_rumah' => 'A4',
                'status_dihuni' => false
            ]
        ];

        foreach ($rumah as $data) {
            Rumah::insert($data);
        }
    }
}
