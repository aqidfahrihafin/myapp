<?php

namespace App\Filament\Resources\DashboardResource\Widgets;

use App\Models\Santri;
use App\Models\Tagihan;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class TagihanStats extends BaseWidget
{
    public function getCards(): array
    {
        // Hitung total tagihan sebelum potongan untuk tagihan belum lunas
        $totalTagihanSebelumPotongan = Tagihan::where('status', 'Belum Lunas')->sum('jumlah_tagihan');

        // Hitung total potongan untuk tagihan belum lunas
        $totalPotongan = Tagihan::where('status', 'Belum Lunas')->get()->sum(function ($tagihan) {
            return $tagihan->jumlah_tagihan * ($tagihan->potongan / 100);
        });

        // Hitung total setelah potongan untuk tagihan belum lunas
        $totalSetelahPotongan = Tagihan::where('status', 'Belum Lunas')->get()->sum(function ($tagihan) {
            return $tagihan->jumlah_tagihan - ($tagihan->jumlah_tagihan * ($tagihan->potongan / 100));
        });

        // Hitung total pendapatan (tagihan lunas setelah potongan)
        $totalPendapatan = Tagihan::where('status', 'Lunas')->get()->sum(function ($tagihan) {
            return $tagihan->jumlah_tagihan - ($tagihan->jumlah_tagihan * ($tagihan->potongan / 100));
        });

        return [
            // Section 2: Tagihan Belum Lunas
            Card::make('Total Tagihan', 'Rp ' . number_format($totalTagihanSebelumPotongan, 0, ',', '.'))->icon('heroicon-o-archive-box')
                ->description('(Belum Lunas)')
                ->descriptionIcon('heroicon-o-currency-dollar')
                ->color('info'),

            Card::make('Total Potongan', 'Rp ' . number_format($totalPotongan, 0, ',', '.'))->icon('heroicon-o-banknotes')
                ->description('(Belum Lunas)')
                ->descriptionIcon('heroicon-o-currency-dollar')
                ->color('warning'),

            Card::make('Tagihan', 'Rp ' . number_format($totalSetelahPotongan, 0, ',', '.'))->icon('heroicon-o-calculator')
                ->description('(Belum Lunas)')
                ->descriptionIcon('heroicon-o-currency-dollar')
                ->color('success'),

            // Section 3: Total Pendapatan
            Card::make('Total Pendapatan', 'Rp ' . number_format($totalPendapatan, 0, ',', '.'))->icon('heroicon-o-inbox-arrow-down')
                ->description('(Lunas Setelah Potongan)')
                ->descriptionIcon('heroicon-o-currency-dollar')
                ->color('primary'),
        ];
    }
}
