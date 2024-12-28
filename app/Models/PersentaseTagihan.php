<?php

namespace App\Models;

use App\Models\Santri;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PersentaseTagihan extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'id';
    protected $table = 'persentase_tagihan';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'jabatan_santri',
        'potongan',
        'pembayaran',
        'deskripsi',
    ];

    public function santri()
    {
        return $this->hasMany(Santri::class, 'santri_id');
    }

}
