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
                'user_id' => 3,
                'proker_id' => 1,
                'nama_kegiatan' => 'Kegiatan Explant 1',
                'penanggung_jawab' => 'Ibenil Amin',
                'pengajuan_dana' => 1000000,
                'periode' => 2024,
            ],
            [
                'user_id' => 3,
                'proker_id' => 1,
                'nama_kegiatan' => 'Kegiatan Explant 2',
                'penanggung_jawab' => 'Mega Astuti',
                'pengajuan_dana' => 800000,
                'periode' => 2024,
                'status_kegiatan' => 'revisibem',
            ],
            [
                'user_id' => 3,
                'proker_id' => 1,
                'nama_kegiatan' => 'Kegiatan Explant 3',
                'penanggung_jawab' => 'Ibenil Amin',
                'pengajuan_dana' => 1300000,
                'periode' => 2024,
                'status_kegiatan' => 'revisiukmbem',
            ],
            [
                'user_id' => 3,
                'proker_id' => 1,
                'nama_kegiatan' => 'Kegiatan Explant 4',
                'penanggung_jawab' => 'Ibenil Amin',
                'pengajuan_dana' => 1500000,
                'periode' => 2024,
                'status_kegiatan' => 'revisikemahasiswaan',
            ],
            [
                'user_id' => 4,
                'proker_id' => 1,
                'nama_kegiatan' => 'Kegiatan Explant 5',
                'penanggung_jawab' => 'Mega Astuti',
                'pengajuan_dana' => 750000,
                'periode' => 2024,
                'status_kegiatan' => 'pencairan',
                'dana_cair' => 700000,
            ],
            [
                'user_id' => 4,
                'proker_id' => 2,
                'nama_kegiatan' => 'Kegiatan Pramuka 1',
                'penanggung_jawab' => 'Ety Mulyana',
                'pengajuan_dana' => 2000000,
                'periode' => 2024,
                'status_kegiatan' => 'revisiukmbem',
            ],
            [
                'user_id' => 4,
                'proker_id' => 2,
                'nama_kegiatan' => 'Kegiatan Pramuka 2',
                'penanggung_jawab' => 'Sugeng Hariyadi',
                'pengajuan_dana' => 1200000,
                'periode' => 2024,
                'status_kegiatan' => 'ajuanukm',
            ],[
                'user_id' => 3,
                'proker_id' => 1,
                'nama_kegiatan' => 'Kegiatan Pramuka 3',
                'penanggung_jawab' => 'Ety Mulyana',
                'pengajuan_dana' => 1600000,
                'periode' => 2024,
                'status_kegiatan' => 'revisikemahasiswaan',
            ],
            [
                'user_id' => 4,
                'proker_id' => 2,
                'nama_kegiatan' => 'Kegiatan Pramuka 4',
                'penanggung_jawab' => 'Sugeng Hariyadi',
                'pengajuan_dana' => 750000,
                'periode' => 2024,
                'status_kegiatan' => 'revisiukmkemahasiswaan',
                'dana_cair' => 700000,
            ],
            [
                'user_id' => 4,
                'proker_id' => 2,
                'nama_kegiatan' => 'Kegiatan Pramuka 5',
                'penanggung_jawab' => 'Sulastri',
                'pengajuan_dana' => 1000000,
                'periode' => 2024,
                'status_kegiatan' => 'selesai',
                'dana_cair' => 900000,
            ],
            // Tambahkan data contoh lainnya sesuai kebutuhan
        ];
        // Masukkan data ke dalam tabel Prestasi
        foreach ($kegiatan as $data) {
            Kegiatan::create($data);
        }
    }
}
