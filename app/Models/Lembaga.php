<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lembaga extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'lembaga';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'lembaga_id',
        'nama_lembaga',
        'nsm',
        'npsm',
        'kecamatan',
        'kabupaten',
        'provinsi',
        'alamat',
        'image',
        'nama_pinpinan',
        'nip',
    ];
}
