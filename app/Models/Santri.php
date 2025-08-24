<?php

namespace App\Models;

use App\Models\Kamar;
use App\Models\Periode;
use App\Models\PersentaseTagihan;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB; // Tambahkan use DB

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
         'image_wali', 
        'tempat_lahir',
        'tanggal_lahir',
        'alamat',
        'jenis_kelamin',
        'status_santri',
        'email_wali',
        'tanggal_lahir_wali',
        'alamat_wali',
        'no_hp_wali',
    ];

    public function index()
{
    return Santri::with([
        'rayon',
        'kamar',
        'lembaga',
        'periode',
        'tagihan'
    ])->get();
}

    // Tambahkan method boot() di sini
    protected static function boot()
    {
        parent::boot();

        static::updating(function ($santri) {
            if ($santri->isDirty('status_santri') && $santri->status_santri === 'alumni') {
                // Salin data santri ke tabel alumni
                DB::table('alumni')->insert([
                    'kamar_id' => $santri->kamar_id,
                    'periode_id' => $santri->periode_id,
                    'persentase_tagihan_id' => $santri->persentase_tagihan_id,
                    'nama_wali' => $santri->nama_wali,
                    'nis' => $santri->nis,
                    'nik' => $santri->nik,
                    'no_kk' => $santri->no_kk,
                    'nama' => $santri->nama,
                    'image' => $santri->image,
                     'image_wali' => $santri->image_wali,
                    'tempat_lahir' => $santri->tempat_lahir,
                    'tanggal_lahir' => $santri->tanggal_lahir,
                    'alamat' => $santri->alamat,
                    'jenis_kelamin' => $santri->jenis_kelamin,
                    'status_santri' => 'alumni',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                // Hapus data santri dari tabel santri
                $santri->delete();
            }
        });
    }

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
    public function rayon()
{
    return $this->belongsTo(Rayon::class, 'rayon_id');
}

    // Relasi dengan model PersentaseTagihan
    public function persentase_tagihan()
    {
        return $this->belongsTo(PersentaseTagihan::class);
    }

    public function lembaga()
{
    return $this->belongsTo(Lembaga::class, 'lembaga_id');
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
