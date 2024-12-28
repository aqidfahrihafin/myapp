<?php

namespace App\Models;

use App\Models\Kamar;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rayon extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'rayon';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'nama_rayon',
        'image',
        'deskripsi',
    ];

    public function kamar()
    {
        return $this->hasMany(Kamar::class, 'rayon_id');
    }
}

