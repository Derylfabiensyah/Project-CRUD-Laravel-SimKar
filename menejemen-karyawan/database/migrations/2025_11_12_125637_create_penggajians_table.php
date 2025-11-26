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
        Schema::create('penggajians', function (Blueprint $table) {
            $table->id('id_gaji');
            $table->foreignId('id_karyawan')->constrained('karyawans')->onDelete('cascade');
            $table->string('bulan', 20);
            $table->integer('tahun');
            $table->decimal('gaji_pokok',10,2);
            $table->decimal('tunjangan',10,2);
            $table->decimal('potongan',10,2);
            $table->decimal('total_gaji',10,2);
            $table->date('tanggal_transfer');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penggajians');
    }
};
