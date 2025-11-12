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
        Schema::create('surat_pemberitahuan', function (Blueprint $table) {
            $table->id('surat_id');
            $table->unsignedBigInteger('jadwal_id');
            $table->string('nomor_surat', 50);
            $table->string('file_surat', 255);
            $table->dateTime('tanggal_terbit');
            $table->unsignedBigInteger('diterima_oleh');
            $table->timestamps();
            $table->foreign('jadwal_id')->references('jadwal_id')->on('rencana_jadwal')->onDelete('cascade');
            $table->foreign('diterima_oleh')->references('user_id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surat_pemberitahuan');
    }
};
