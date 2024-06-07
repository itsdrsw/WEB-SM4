<?php

namespace Database\Seeders;

use App\Models\Pendanaan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PendanaanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pendanaan = [
            [
                'user_id' => 3,
                'anggaran_tersedia' => 20000000,
                'periode' => 2024,
            ],
            [
                'user_id' => 4,
                'anggaran_tersedia' => 25000000,
                'periode' => 2024,
            ],
            // Tambahkan data contoh lainnya sesuai kebutuhan
        ];
        // Masukkan data ke dalam tabel Prestasi
        foreach ($pendanaan as $data) {
            Pendanaan::create($data);
        }
    }
}
