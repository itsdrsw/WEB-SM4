<?php

namespace Database\Seeders;

use App\Models\ProgamKerja;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProkerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProgamKerja::create([
            'user_id' => 1,
            'nama_proker' => 'Pembuatan Buletin',
            'penanggung_jawab' => 'Eko Patrio',
            'uraian_proker' => 'Deskripsi Proker Pembuatan Buletin',
            'periode' => 2024,
            'status_proker' => 'Terkirim',
        ]);

        ProgamKerja::create([
            'user_id' => 2,
            'nama_proker' => 'Bakti Sosial',
            'penanggung_jawab' => 'Mega Astuti',
            'uraian_proker' => 'Deskripsi Proker Bakti Sosial',
            'periode' => 2024,
            'status_proker' => 'Terkirim',
        ]);
    }
}
