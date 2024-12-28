<?php

namespace App\Models;

use App\Models\Santri;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Periode extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'periode';

    protected $fillable = [
        'periode_id',
        'nama_periode',
        'kode_periode',
        'status',
    ];

    public function santri()
    {
        return $this->hasMany(Santri::class, 'periode_id');
    }

}
