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
        Schema::create('kegiatan', function (Blueprint $table) {
            $table->increments('idkegiatan');
            $table->unsignedBigInteger('user_id'); // Kolom foreign key
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedInteger('proker_id'); // Kolom foreign key
            $table->foreign('proker_id')->references('idproker')->on('progam_kerja');
            $table->string('nama_kegiatan'); // Kolom untuk Nama Kegiatan
            $table->string('penanggung_jawab'); // Kolom untuk Penanggung Jawab
            $table->integer('pengajuan_dana'); // Kolom untuk Pengajuan Dana
            $table->integer('dana_cair')->nullable(); // Kolom untuk Pengajuan Dana
            $table->year('periode'); // Kolom untuk Periode
            $table->string('proposal_kegiatan')->nullable(); // Kolom untuk Proposal Kegiatan to store the PDF filename
            $table->enum('status_kegiatan', ['terkirim', 'revisi', 'pencairan', 'selesai']); // Kolom untuk Status Kegiatan
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kegiatan');
    }
};
