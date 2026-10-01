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
                'primary' => Color::Hex('#f2522e'), // Couleur d'accentuation principale
                'gray'    => Color::Zinc,
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                // Vos widgets personnalisés seront découverts automatiquement via discoverWidgets
            ])
            // Injection du CSS pour reproduire fidèlement le design
->renderHook(
    PanelsRenderHook::HEAD_END,
    fn (): string => Blade::render('
        <style>
            /* Fond global gris doux */
            body, .fi-body { background-color: #f1f5f9 !important; }

            /* Sidebar sombre */
            aside.fi-sidebar { background-color: #2c2525 !important; border-right: none !important; }
            aside.fi-sidebar * { color: #a39e9e !important; }
            aside.fi-sidebar .fi-sidebar-item-active * { color: #ffffff !important; }
            aside.fi-sidebar .fi-sidebar-item-active { background-color: #3d3434 !important; }
            
            /* En-tête de la sidebar en couleur Terracotta */
            .fi-sidebar-header { background-color: #f2522e !important; padding: 1.25rem !important; }
            .fi-sidebar-header * { color: #ffffff !important; font-weight: bold !important; }

            /* Personnalisation des cartes StatsOverview */
            .fi-wi-stats-overview-stat {
                border-radius: 0.75rem !important;
                border: 1px solid #e2e8f0 !important;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.03) !important;
            }

            /* Couleur de la barre supérieure/icône selon les statuts */
            .fi-wi-stats-overview-stat:nth-child(1) { border-top: 4px solid #f2522e !important; }
            .fi-wi-stats-overview-stat:nth-child(2) { border-top: 4px solid #eab308 !important; }
            .fi-wi-stats-overview-stat:nth-child(3) { border-top: 4px solid #22c55e !important; }
            .fi-wi-stats-overview-stat:nth-child(4) { border-top: 4px solid #06b6d4 !important; }
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
                DispatchServingFilamentEvent::class, // <-- Correction ici (référence la classe importée en haut)
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}