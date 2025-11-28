<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Departemen; // Pastikan ini ada

class Karyawan extends Model
{
    /** @use HasFactory<\Database\Factories\KaryawanFactory> */
    use HasFactory;

    protected $table = 'karyawans';
    protected $primaryKey = 'id'; // Ubah ini sesuai dengan kolom primary key yang benar
    protected $keyType = 'int';
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = [
        'nama_karyawan',
        'jabatan',
        'id_departemen',
        'tanggal_masuk'
    ];
    
    /**
     * Get the departemen that owns the karyawan.
     */
    public function departemen()
    {
        return $this->belongsTo(Departemen::class, 'id_departemen', 'id_departemen');
    }
}
