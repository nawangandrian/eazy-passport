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
        Schema::create('pendaftaran', function (Blueprint $table) {
            $table->id('pendaftaran_id');
            $table->unsignedBigInteger('user_id');

            // sesuaikan foreign key ke users.user_id
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');

            $table->string('lokasi_layanan', 150);
            $table->enum('jenis_layanan', ['Baru atau Penggantian', 'Reguler atau Percepatan']);
            $table->dateTime('tanggal_pengajuan');
            $table->enum('status_verifikasi', ['Menunggu', 'Valid', 'Tidak Valid', 'Perlu Perbaikan'])->default('Menunggu');
            $table->text('catatan_verifikasi')->nullable();
            $table->integer('jumlah_pemohon')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendaftaran');
    }
};
