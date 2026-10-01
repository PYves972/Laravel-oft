<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\View\PanelsRenderHook;
use Filament\Widgets;
use Illuminate\Support\Facades\Blade;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()
            ->brandName('Admin OFT')
            ->font('Poppins')
            ->darkMode(false)
            ->colors([
                'primary' => Color::Hex('#f2522e'),
                'gray'    => Color::Zinc,
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([])
            ->renderHook(
                PanelsRenderHook::HEAD_END,
                fn (): string => Blade::render('
                    <style>
                        /* Fond global gris neutre */
                        body, .fi-body { background-color: #e2e8f0 !important; }

                        /* Sidebar sombre avec en-tête coloré */
                        aside.fi-sidebar { background-color: #2c2525 !important; border-right: none !important; }
                        aside.fi-sidebar * { color: #a39e9e !important; }
                        aside.fi-sidebar .fi-sidebar-item-active * { color: #ffffff !important; }
                        aside.fi-sidebar .fi-sidebar-item-active { background-color: #3d3434 !important; }
                        
                        /* Logo / En-tête de sidebar */
                        .fi-sidebar-header { background-color: #f2522e !important; padding: 1.25rem !important; }
                        .fi-sidebar-header * { color: #ffffff !important; font-weight: bold !important; }

                        /* Cartes KPI (Stats Overview) */
                        .fi-wi-stats-overview-stat {
                            background-color: #ffffff !important;
                            border-radius: 0.5rem !important;
                            border: none !important;
                            box-shadow: 0 1px 3px rgba(0,0,0,0.05) !important;
                        }
                    </style>
                ')
            )
            ->middleware([
                \Illuminate\Cookie\Middleware\EncryptCookies::class,
                \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
                \Illuminate\Session\Middleware\StartSession::class,
                \Illuminate\Session\Middleware\AuthenticateSession::class,
                \Illuminate\View\Middleware\ShareErrorsFromSession::class,
                \Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class,
                \Illuminate\Routing\Middleware\SubstituteBindings::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}