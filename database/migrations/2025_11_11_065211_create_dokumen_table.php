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
        Schema::create('dokumen', function (Blueprint $table) {
                $table->id('dokumen_id'); // PK
                $table->unsignedBigInteger('pemohon_id'); // FK ke pemohon
                $table->enum('jenis_dokumen', ['KTP','KK','Paspor_Lama','Akta_Kelahiran']);
                $table->string('file_path', 255);
                $table->dateTime('tanggal_upload');
                $table->timestamps();

                // Foreign key constraint
                $table->foreign('pemohon_id')
                      ->references('pemohon_id')
                      ->on('pemohon')
                      ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('dokumen', function (Blueprint $table) {
            //
        });
    }
};
