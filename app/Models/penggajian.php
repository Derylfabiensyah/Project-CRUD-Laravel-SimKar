<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Karyawan;

class penggajian extends Model
{
    /** @use HasFactory<\Database\Factories\PenggajianFactory> */
    use HasFactory;
    
    protected $table = 'penggajians';
    protected $primaryKey = 'id_gaji';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'id_karyawan',
        'bulan',
        'tahun',
        'gaji_pokok',
        'tunjangan',
        'potongan',
        'total_gaji',
        'tanggal_transfer'
    ];

    /**
     * Relation to Karyawan
     */
    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'id_karyawan', 'id');
    }
}
