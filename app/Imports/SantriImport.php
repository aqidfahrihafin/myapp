<?php

namespace App\Imports;

use App\Models\Kamar;
use App\Models\Periode;
use App\Models\PersentaseTagihan;
use App\Models\Santri;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Illuminate\Support\Facades\Log;

class SantriImport implements ToModel, WithHeadingRow, WithValidation
{
    private $successCount = 0;
    private $failCount = 0;

    public function model(array $row)
    {
        // Validasi nama_periode
        $periode = Periode::where('nama_periode', $row['periode'])->first();
        if (!$periode) {
            $this->failCount++;
            Log::error("Periode tidak ditemukan: " . $row['periode'], $row); // Log error untuk debug
            return null;  // Tidak disimpan jika periode tidak valid
        }

        // Validasi nama_kamar
        $kamar = Kamar::where('nama_kamar', $row['kamar'])->first();
        if (!$kamar) {
            $this->failCount++;
            Log::error("Kamar tidak ditemukan: " . $row['kamar'], $row);
            return null;  // Tidak disimpan jika kamar tidak valid
        }

        // Validasi jabatan_santri (persentase_tagihan)
        $persentaseTagihan = PersentaseTagihan::where('jabatan_santri', $row['jabatan_santri'])->first();
        if (!$persentaseTagihan) {
            $this->failCount++;
            Log::error("Persentase tagihan tidak ditemukan: " . $row['jabatan_santri'], $row);
            return null;  // Tidak disimpan jika persentase_tagihan tidak valid
        }

        // Konversi tanggal_lahir
        $tanggalLahir = $this->convertTanggalLahir($row['tanggal_lahir']);

        // Jika semua validasi berhasil, lanjutkan untuk menyimpan data
        $this->successCount++;

        // Mengembalikan data model
        return new Santri([
            'periode_id' => $periode->id,
            'kamar_id' => $kamar->id,
            'persentase_tagihan_id' => $persentaseTagihan->id,
            'nama_wali' => $row['nama_wali'],
            'hubungan_wali' => $row['hubungan_wali'],
            'nama' => $row['nama'],
            'nis' => $row['nis'],
            'nik' => $row['nik'],
            'no_kk' => $row['no_kk'],
            'tempat_lahir' => $row['tempat_lahir'],
            'tanggal_lahir' => $tanggalLahir,
            'alamat' => $row['alamat'],
            'jenis_kelamin' => $row['jenis_kelamin'],
            'status_santri' => $row['status_santri'],
            'image' => $row['image'],
        ]);
    }

    private function convertTanggalLahir($tanggalLahir)
    {
        // Jika tanggal_lahir berupa angka (misalnya serial date Excel), konversi ke format tanggal
        if (is_numeric($tanggalLahir)) {
            return Date::excelToDateTimeObject($tanggalLahir)->format('Y-m-d');
        }
        return $tanggalLahir; // Jika sudah dalam format tanggal
    }

    public function rules(): array
    {
        return [
            '*.nis' => ['required', 'unique:santri,nis'],
            '*.nik' => ['required', 'unique:santri,nik'],
            // Jika perlu validasi untuk kolom lain, tambahkan di sini
        ];
    }

    public function getSuccessCount()
    {
        return $this->successCount;
    }

    public function getFailCount()
    {
        return $this->failCount;
    }
}
