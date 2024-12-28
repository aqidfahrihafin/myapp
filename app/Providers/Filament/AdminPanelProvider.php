<?php

namespace App\Providers\Filament;

use Filament\Facades\Filament;
use Filament\Navigation\NavigationItem;
use Filament\Navigation\UserMenuItem;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Filament\Widgets\AccountWidget;
use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->sidebarCollapsibleOnDesktop(true)
            ->id('admin')
            ->path('admin')
            ->login()
            ->colors([
                'danger' => Color::Rose,
                'gray' => Color::Gray,
                'info' => Color::Blue,
                'primary' => Color::Indigo,
                'success' => Color::Emerald,
                'warning' => Color::Orange,
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([Widgets\AccountWidget::class])  // Widget akun
            // ->databaseNotifications()
            ->spa()
            ->profile(isSimple:false)
            ->registration()
            // ->passwordReset()
            // ->emailVerification()
            ->middleware([  // Middleware yang digunakan untuk Filament
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
            ])
            ->viteTheme('resources/css/filament/admin/theme.css')
            ->authMiddleware([\Filament\Http\Middleware\Authenticate::class]);
    }

    public function boot(): void
    {
        Filament::serving(function () {
            // Menambahkan item navigasi ke menu user
            Filament::getNavigation()->addItem(
                NavigationItem::make('Profil')
                    ->url(route('admin/profile'))
                    ->icon('heroicon-o-user-circle')
            );

            // Menambahkan menu pengguna tambahan (seperti pengaturan)
            Filament::getUserMenu()->addItem(
                UserMenuItem::make()
                    ->label('Pengaturan')  // Menambahkan label untuk menu pengguna
                    ->icon('heroicon-o-cog')  // Ikon pengaturan
                    // Anda bisa menambahkan URL atau aksi sesuai kebutuhan
            );
        });
    }
}
