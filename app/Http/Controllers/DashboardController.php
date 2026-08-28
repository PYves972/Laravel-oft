<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DashboardController extends Controller
{
public function __invoke(): View
    {
        /** @var User $user */
        $user = Auth::user();

        $bookings = $user->bookings()
            ->with(['trainingSession.training'])
            ->where('status', 'confirmed')
            ->get();

        return view('dashboard', compact('bookings'));
    }
}
