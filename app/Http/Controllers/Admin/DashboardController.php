<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\User;
use App\Models\Training;
use App\Models\Comment;

class DashboardController extends Controller
{
    public function index()
    {
        $kpis = [
            [
                'label' => 'Réservations',
                'value' => Booking::count(),
                'icon'  => '📅',
            ],
            [
                'label' => 'Membres',
                'value' => User::count(),
                'icon'  => '💶',
            ],
            [
                'label' => 'Nouveaux messages',
                'value' => Comment::where('is_read', false)->count(),
                'icon'  => '💬',
            ],
            [
                'label' => 'Ateliers actifs',
                'value' => Training::count(),
                'icon'  => '🎨',
            ],
        ];

        return view('admin.dashboard', compact('kpis'));
    }
}
