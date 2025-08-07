<?php

namespace App\Filament\Resources\DashboardResource\Widgets;

use App\Models\Santri;
use App\Models\Tagihan;
use App\Models\User;
use App\Models\Alumni;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class DashboardStats extends BaseWidget
{
    public function getCards(): array
    {


        return [
            // Section 1: User & Santri Stats
            Card::make('Total Users', User::count())->icon('heroicon-o-user')
                ->descriptionIcon('heroicon-o-users')
                ->color('success'),

           Card::make('Total Santri Aktif', Santri::where('status_santri', 'aktif')->count())->icon('heroicon-o-user')
                ->descriptionColor('success'),

            // Section 2: Tagihan Belum Lunas
            Card::make('Total Alumni', Alumni::count())
    ->icon('heroicon-o-users')
    ->color('danger')
    ->descriptionIcon('heroicon-o-document'),

        ];
    }
}
