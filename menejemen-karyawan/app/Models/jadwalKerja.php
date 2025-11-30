<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Karyawan;

class jadwalKerja extends Model
{
    /** @use HasFactory<\Database\Factories\JadwalKerjaFactory> */
    use HasFactory;

    protected $table = 'jadwal_kerjas';
    protected $primaryKey = 'id_jadwal';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'id_karyawan',
        'tanggal_kerja',
        'shift',
        'jam_mulai',
        'jam_selesai'
    ];

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'id_karyawan', 'id');
    }
}
