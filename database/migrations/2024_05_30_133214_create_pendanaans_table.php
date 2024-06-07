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
        Schema::create('pendanaan', function (Blueprint $table) {
            $table->increments('idpendanaan');
            $table->unsignedBigInteger('user_id'); // Kolom foreign key
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('anggaran_tersedia'); // Kolom untuk anggaran tersedia
            $table->year('periode'); // Kolom untuk periode
            $table->enum('status_anggaran', ['aktif', 'nonaktif'])->default('aktif'); // Kolom untuk status anggaran
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendanaan');
    }
};
