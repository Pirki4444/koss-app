<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    /**
     * Display a listing of all rooms.
     */
    public function index()
    {
        $rooms = Room::orderBy('room_number', 'asc')->get();
        
        return view('rooms.index', compact('rooms'));
    }

    /**
     * Display the specified room.
     */
    public function show(Room $room)
    {
        return view('rooms.show', compact('room'));
    }

    /**
     * Display available rooms only.
     */
    public function available()
    {
        $rooms = Room::available()->orderBy('room_number', 'asc')->get();
        
        return view('rooms.index', compact('rooms'));
    }
}
