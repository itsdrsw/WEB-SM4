<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('prestasi', function (Blueprint $table) {
            $table->increments('idprestasi');
            $table->unsignedBigInteger('user_id'); // Kolom foreign key
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('namalomba', 50);
            $table->enum('kategorilomba', ['individu', 'kelompok']);
            $table->dateTime('tanggallomba');
            $table->enum('juara', ['Juara 1', 'Juara 2', 'Juara 3', 'Harapan 1', 'Harapan 2', 'lainnya']);
            $table->string('penyelenggara', 30);
            $table->enum('lingkup', ['kabupaten', 'provinsi', 'nasional', 'lainnya']);
            $table->string('sertifikat')->nullable();
            $table->string('dokumentasi')->nullable();
            $table->string('note')->nullable();
            $table->enum('statusprestasi', ['belum disetujui', 'disetujui', 'ditolak'])->default('belum disetujui');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prestasi');
    }
};
