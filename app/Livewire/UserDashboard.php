<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;

class UserDashboard extends Component
{
    public function cancelBooking($bookingId)
    {
        $booking = Booking::where('id', $bookingId)
            ->where('user_id', Auth::id())
            ->first();

        if ($booking) {
            $booking->update(['status' => 'cancelled']);
            session()->flash('success', 'Votre réservation a été annulée.');
        }
    }

    public function render()
    {
        $userId = Auth::id();

        $upcomingBookings = Booking::with(['trainingSession.training'])
            ->where('user_id', $userId)
            ->where('status', 'confirmed')
            ->get();

        $pastBookings = Booking::with(['trainingSession.training'])
            ->where('user_id', $userId)
            ->where('status', '!=', 'confirmed')
            ->get();

        return view('livewire.user-dashboard', [
            'upcomingBookings' => $upcomingBookings,
            'pastBookings'     => $pastBookings,
        ]);
    }
}
