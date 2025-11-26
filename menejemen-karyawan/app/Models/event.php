<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $table = 'events';
    protected $primaryKey = 'id_event'; // ← sesuaikan dengan kolom PK di DB
    protected $keyType = 'int';
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = [
        'id_karyawan',
        'jenis_event',
        'tanggal_event',
        'keterangan',
    ];
}
