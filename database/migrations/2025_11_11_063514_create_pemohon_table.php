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
        Schema::create('pemohon', function (Blueprint $table) {
            $table->id('pemohon_id');
            // tambahkan kolom pendaftaran_id dulu
            $table->unsignedBigInteger('pendaftaran_id');

            // lalu buat foreign key
            $table->foreign('pendaftaran_id')->references('pendaftaran_id')->on('pendaftaran')->onDelete('cascade');
            $table->string('nama_lengkap', 100);
            $table->string('nik', 16);
            $table->date('tanggal_lahir');
            $table->text('alamat');
            $table->string('no_telepon', 20);
            $table->string('no_paspor_lama', 20)->nullable();
            $table->enum('status_data', ['Lengkap','Perlu Perbaikan'])->default('Perlu Perbaikan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemohon');
    }
};
