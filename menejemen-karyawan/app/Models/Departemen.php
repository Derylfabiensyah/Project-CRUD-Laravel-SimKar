<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Departemen extends Model
{
    use HasFactory;

    protected $table = 'departemens';
    protected $primaryKey = 'id_departemen';
    protected $keyType = 'int';
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = ['nama_departemen'];
}
