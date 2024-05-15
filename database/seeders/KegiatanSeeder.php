<?php

namespace Database\Seeders;

use App\Models\Kegiatan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KegiatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kegiatan = [
            [
                'user_id' => 1,
                'proker_id' => 1,
                'nama_kegiatan' => 'Kegiatan Wawancara Narasumber',
                'penanggung_jawab' => 'Eko Patrio',
                'pengajuan_dana' => 1000000,
                'periode' => 2024,
                'status_kegiatan' => 'terkirim',
            ],
            [
                'user_id' => 2,
                'proker_id' => 2,
                'nama_kegiatan' => 'Kegiatan Jumat Berkah',
                'penanggung_jawab' => 'Mega Astuti',
                'pengajuan_dana' => 2000000,
                'periode' => 2024,
                'status_kegiatan' => 'revisi',
            ],
            [
                'user_id' => 2,
                'proker_id' => 2,
                'nama_kegiatan' => 'Kegiatan Jumat Berkah',
                'penanggung_jawab' => 'Mega Astuti',
                'pengajuan_dana' => 2000000,
                'periode' => 2024,
                'status_kegiatan' => 'revisi',
            ],
            // Tambahkan data contoh lainnya sesuai kebutuhan
        ];
        // Masukkan data ke dalam tabel Prestasi
        foreach ($kegiatan as $data) {
            Kegiatan::create($data);
        }
    }
}
