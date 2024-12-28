<?php

namespace App\Filament\Pages;

use Filament\Pages\Dashboard as BaseDashboard;
use App\Filament\Resources\DashboardResource\Widgets\DashboardStats; // Pastikan menggunakan kelas yang benar
use App\Filament\Resources\DashboardResource\Widgets\TagihanStats; // Pastikan menggunakan kelas yang benar

class Dashboard extends BaseDashboard
{
    public function getWidgets(): array
    {
        return [
            DashboardStats::class, // Widget yang telah diperbarui
            TagihanStats::class, // Widget yang telah diperbarui
        ];
    }
}
