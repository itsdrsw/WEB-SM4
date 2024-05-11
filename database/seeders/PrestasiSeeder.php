<?php

namespace Database\Seeders;

use App\Models\Prestasi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PrestasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $prestasi = [
            [
                'user_id' => 1,
                'namalomba' => 'Lomba Pidato',
                'kategorilomba' => 'individu',
                'tanggallomba' => '2024-05-01 09:00:00',
                'juara' => 'Juara 1',
                'penyelenggara' => 'Pemerintah Kabupaten Sidoarjo',
                'lingkup' => 'kabupaten',
                'statusprestasi' => 'disetujui'
            ],
            [
                'user_id' => 2,
                'namalomba' => 'Lomba Menulis',
                'kategorilomba' => 'kelompok',
                'tanggallomba' => '2024-04-15 13:00:00',
                'juara' => 'Juara 2',
                'penyelenggara' => 'Pemerintah Provinsi Jawa Timur',
                'lingkup' => 'provinsi',
            ],
            // Tambahkan data lainnya sesuai kebutuhan
        ];

        // Masukkan data ke dalam tabel Prestasi
        foreach ($prestasi as $data) {
            Prestasi::create($data);
        }
    }
}
