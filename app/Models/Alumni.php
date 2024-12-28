<?php

namespace App\Models;

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumni extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika tidak sesuai dengan nama model (optional)
    protected $table = 'santri';
 protected $fillable = [
        'kamar_id',
        'periode_id',
        'nama_wali',
        'persentase_tagihan_id',
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

     public function scopeAlumni($query)
    {
        return $query->where('status_santri', 'alumni');
    }
}
