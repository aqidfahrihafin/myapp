<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JenisTagihan extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'jenis_tagihan';
    protected $keyType = 'string'; // Pastikan ini sesuai dengan tipe kunci di database

    public $timestamps = true;

    protected $fillable = [
        'jenis_tagihan_id',
        'jenis_tagihan',
        'nama_jenis',
        'deskripsi',
    ];


}
