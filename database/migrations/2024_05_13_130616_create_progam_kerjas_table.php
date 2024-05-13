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
        Schema::create('progam_kerja', function (Blueprint $table) {
            $table->increments('idproker');
            $table->unsignedBigInteger('user_id'); // Kolom foreign key
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('nama_proker', 50);
            $table->string('penanggung_jawab', 50);
            $table->string('uraian_proker', 150);
            $table->year('periode');
            $table->string('lampiran_proker')->nullable(); // Kolom file lampiran
            $table->enum('status_proker', ['Terkirim', 'Dilihat', 'Disetujui', 'Ditolak'])->default('Terkirim');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('progam_kerja');
    }
};
