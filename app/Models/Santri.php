<?php

namespace App\Models;

use App\Models\Kamar;
use App\Models\Periode;
use App\Models\PersentaseTagihan;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Santri extends Model
{
    use HasFactory;

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

     public function tagihans()
    {
        return $this->hasMany(Tagihan::class, 'santri_id');
    }
    public function persentaseTagihan()
    {
        return $this->belongsTo(PersentaseTagihan::class, 'persentase_tagihan_id');
    }
    public function tagihan()
    {
        return $this->hasMany(Tagihan::class);
    }
    // Relasi dengan model Periode
    public function periode()
    {
        return $this->belongsTo(Periode::class);
    }

    // Relasi dengan model Kamar
    public function kamar()
    {
        return $this->belongsTo(Kamar::class);
    }

    // Relasi dengan model PersentaseTagihan
    public function persentase_tagihan()
    {
        return $this->belongsTo(PersentaseTagihan::class);
    }

    // Scope untuk mengambil santri yang berstatus alumni
    public function scopeAlumni($query)
    {
        return $query->where('status_santri', 'alumni');
    }

    // Scope untuk mengambil santri yang berstatus aktif
    public function scopeAktif($query)
    {
        return $query->where('status_santri', 'aktif');
    }
}
