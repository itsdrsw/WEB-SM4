<?php

namespace Database\Seeders;

use App\Models\LPJ;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LPJSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        LPJ::create([
            'proker_id' => 1,
        ]);

        LPJ::create([
            'proker_id' => 2,
        ]);

        LPJ::create([
            'proker_id' => 3,
        ]);
    }
}
