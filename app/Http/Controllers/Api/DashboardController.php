<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Santri;
use App\Models\Rayon;
use App\Models\Kamar;
use App\Models\Tagihan;

class DashboardController extends Controller
{
    public function index()
    {
        return response()->json([
            'total_santri' => Santri::count(),
            'total_rayon' => Rayon::count(),
            'total_kamar' => Kamar::count(),
            'total_tagihan' => Tagihan::count(),
            'santri_aktif' => Santri::aktif()->count(),
            'santri_alumni' => Santri::alumni()->count(),
            'tagihan_terbayar' => Tagihan::where('status', 'lunas')->count(),
            'tagihan_belum_terbayar' => Tagihan::where('status', 'belum lunas')->count(),
        ]);
    }
}
