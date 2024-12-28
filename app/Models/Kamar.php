<?php

namespace App\Models;

use App\Models\Rayon;
use App\Models\Santri;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kamar extends Model
{

    use SoftDeletes;

    protected $table = 'kamar';

    protected $fillable = [
        'rayon_id',
        'nama_kamar',
        'kapasitas',
        'deskripsi',
    ];

    public function rayon()
    {
        return $this->belongsTo(Rayon::class, 'rayon_id');
    }

    public function santri()
    {
        return $this->hasMany(Santri::class, 'kamar_id');
    }
}

