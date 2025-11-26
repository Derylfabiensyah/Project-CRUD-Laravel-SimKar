<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    use HasFactory;

    protected $table = 'absensi';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id_karyawan',
        'tanggal_absensi',
        'jam_masuk',
        'jam_keluar',
        'status'
    ];

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'id_karyawan', 'id');
    }

}
