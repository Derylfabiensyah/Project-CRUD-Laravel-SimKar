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
        Schema::create('jadwal_kerjas', function (Blueprint $table) {
            $table->id('id_jadwal');
            $table->foreignId('id_karyawan')->constrained('karyawans')->onDelete('cascade');
            $table->date('tanggal_kerja');
            $table->enum('shift',['Pagi','Siang','Malam']);
            $table->time('jam_mulai');
            $table->time('jam_selesai');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal_kerjas');
    }
};
