<?php

namespace App\Models;

use App\Models\Santri;
use App\Models\Periode;
use App\Models\Transaksi;
use App\Models\RiwayatTransaksi;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tagihan extends Model
{
    use HasFactory;

    protected $table = 'tagihan';

    protected $keyType = 'string'; // Pastikan ini sesuai dengan tipe kunci di database

    public $timestamps = true;

    protected $fillable = [
        'tagihan_id',
        'santri_id',
        'periode_id',
        'jenis_tagihan',
        'jumlah_tagihan',
        'tanggal_jatuh_tempo',
        'deskripsi',
        'status',
    ];

    /**
     * Relasi dengan model Santri
     */


    public static function createTagihan($record)
    {
        $santri = Santri::where('status_santri', 'aktif')->get();

        foreach ($santri as $santri) {
            // Tambahkan tagihan untuk setiap santri aktif
            self::create([
                'santri_id' => $santri->santri_id,
                'periode_id' => $record->periode_id,
                'jenis_tagihan' => $record->jenis_tagihan,
                'jumlah_tagihan' => $record->jumlah_tagihan,
                'tanggal_jatuh_tempo' => $record->tanggal_jatuh_tempo,
                'deskripsi' => $record->deskripsi,
                'status' => 'Belum Lunas', // Status default
            ]);
        }
    }
    public function santri()
    {
        return $this->belongsTo(Santri::class, 'santri_id');
    }

   public function getPotonganAttribute()
    {
        return $this->santri->persentaseTagihan->potongan ?? null; // Jika tidak ada, kembalikan null
    }

    /**
     * Relasi dengan model Periode
     */
    public function periode()
    {
        return $this->belongsTo(Periode::class);
    }

    /**
     * Mendapatkan transaksi terkait tagihan ini
     */
    public function transaksi()
    {
        return $this->hasMany(Transaksi::class, 'tagihan_id', 'tagihan_id');
    }

    /**
     * Mendapatkan riwayat transaksi terkait tagihan ini
     */
    public function riwayatTransaksi()
    {
        return $this->hasManyThrough(RiwayatTransaksi::class, Transaksi::class, 'tagihan_id', 'transaksi_id', 'tagihan_id', 'transaksi_id');
    }
}
