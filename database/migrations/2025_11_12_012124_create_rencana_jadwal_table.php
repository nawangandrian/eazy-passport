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
        Schema::create('rencana_jadwal', function (Blueprint $table) {
            $table->id('jadwal_id');
            $table->unsignedBigInteger('pendaftaran_id');
            $table->date('tanggal_pelayanan');
            $table->time('waktu_mulai');
            $table->time('waktu_selesai');
            $table->string('lokasi_pelayanan', 150);
            $table->enum('status_jadwal', ['Menunggu Persetujuan', 'Disetujui', 'Ditolak', 'Revisi'])
                ->default('Menunggu Persetujuan');
            $table->text('catatan_kepala')->nullable();
            $table->unsignedBigInteger('created_by');
            $table->timestamps();

            // Relasi
            $table->foreign('pendaftaran_id')->references('pendaftaran_id')->on('pendaftaran')->onDelete('cascade');
            $table->foreign('created_by')->references('user_id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rencana_jadwal');
    }
};
