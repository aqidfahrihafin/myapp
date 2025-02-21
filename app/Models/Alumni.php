<?php

namespace App\Models;

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumni extends Model
{
    use HasFactory;

    protected $table = 'alumni';

    protected $fillable = [
        'kamar_id',
        'periode_id',
        'persentase_tagihan_id',
        'nama_wali',
        'nis',
        'nik',
        'no_kk',
        'nama',
        'image',
        'tempat_lahir',
        'tanggal_lahir',
        'alamat',
        'jenis_kelamin',
        'status_santri',
    ];

    public function kamar()
{
    return $this->belongsTo(Kamar::class, 'kamar_id');
}
public function periode()
{
    return $this->belongsTo(Periode::class, 'periode_id');
}
}