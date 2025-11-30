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
        Schema::create('absensi', function (Blueprint $table) {
            $table->id(); // Kolom ID
            $table->foreignId('id_karyawan')->constrained('karyawans'); // Kolom ID Karyawan
            $table->date('tanggal_absensi'); // Kolom Tanggal Absensi
            $table->time('jam_masuk'); // Kolom Jam Masuk
            $table->time('jam_keluar')->nullable(); // Kolom Jam Keluar
            $table->enum('status', ['Hadir', 'Izin', 'Sakit', 'Alpha']); // Kolom Status
            $table->timestamps(); // Kolom Timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('absensi');
    }
};
