<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
    /**
     * Show the form for creating a new booking.
     */
    public function create(Room $room)
    {
        // Pastikan kamar tersedia
        if (!$room->isAvailable()) {
            return redirect()->route('rooms.index')
                ->with('error', 'Kamar tidak tersedia untuk dipesan.');
        }

        return view('bookings.create', compact('room'));
    }

    /**
     * Store a newly created booking in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'name' => 'required|string|max:100',
            'contact' => 'required|string|max:20',
            'duration_months' => 'required|integer|min:1|max:12',
            'move_in_date' => 'required|date|after_or_equal:today',
            'notes' => 'nullable|string',
        ]);

        try {
            DB::beginTransaction();

            // Periksa lagi apakah kamar masih tersedia
            $room = Room::lockForUpdate()->findOrFail($validated['room_id']);
            
            if (!$room->isAvailable()) {
                DB::rollBack();
                return redirect()->route('rooms.index')
                    ->with('error', 'Maaf, kamar sudah dipesan oleh orang lain.');
            }

            // Buat booking
            $booking = Booking::create($validated);

            // Update status kamar
            $room->update(['status' => 'Disewa']);

            DB::commit();

            return redirect()->route('bookings.success', $booking)
                ->with('success', 'Pemesanan berhasil! Kami akan menghubungi Anda segera.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan. Silakan coba lagi.')
                ->withInput();
        }
    }

    /**
     * Display the success page after booking.
     */
    public function success(Booking $booking)
    {
        return view('bookings.success', compact('booking'));
    }

    /**
     * Display a listing of all bookings (admin view).
     */
    public function index()
    {
        $bookings = Booking::with('room')->latest()->get();
        
        return view('bookings.index', compact('bookings'));
    }
}
