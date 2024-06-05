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
        Schema::create('lpj', function (Blueprint $table) {
            $table->increments('idlpj');
            $table->unsignedInteger('proker_id'); // Kolom foreign key
            $table->foreign('proker_id')->references('idproker')->on('progam_kerja');
            $table->string('file_lpj')->nullable(); // Menambahkan kolom file_lpj
            $table->enum('status_lpj', ['terkirim','revisi','perbaikanrevisi','disetujui'])->default('terkirim');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lpj');
    }
};
