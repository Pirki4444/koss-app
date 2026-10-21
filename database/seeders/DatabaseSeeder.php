<?php

namespace Database\Seeders;

use App\Models\Room;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed data kamar untuk testing
        $rooms = [
            [
                'room_number' => 'A01',
                'type' => 'Single',
                'facilities' => 'AC, WiFi, Kasur, Lemari',
                'price' => 1500000,
                'status' => 'Tersedia',
                'description' => 'Kamar single nyaman dengan fasilitas lengkap'
            ],
            [
                'room_number' => 'A02',
                'type' => 'Single',
                'facilities' => 'AC, WiFi, Kasur, Lemari, Meja Belajar',
                'price' => 1700000,
                'status' => 'Tersedia',
                'description' => 'Kamar single plus meja belajar'
            ],
            [
                'room_number' => 'B01',
                'type' => 'Double',
                'facilities' => 'AC, WiFi, 2 Kasur, Lemari, Kamar Mandi Dalam',
                'price' => 2500000,
                'status' => 'Tersedia',
                'description' => 'Kamar double dengan kamar mandi dalam'
            ],
            [
                'room_number' => 'B02',
                'type' => 'Double',
                'facilities' => 'AC, WiFi, 2 Kasur, Lemari',
                'price' => 2200000,
                'status' => 'Disewa',
                'description' => 'Kamar double standar'
            ],
            [
                'room_number' => 'C01',
                'type' => 'Suite',
                'facilities' => 'AC, WiFi, Kasur Queen, Lemari, Kamar Mandi Dalam, Dapur Mini, TV',
                'price' => 3500000,
                'status' => 'Tersedia',
                'description' => 'Kamar suite mewah dengan fasilitas premium'
            ],
        ];

        foreach ($rooms as $room) {
            Room::create($room);
        }
    }
}
