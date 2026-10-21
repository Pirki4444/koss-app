<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->string('room_number', 10)->unique();
            $table->string('type', 50); // Contoh: Single, Double, Suite
            $table->text('facilities')->nullable(); // Fasilitas kamar (AC, WiFi, dll)
            $table->decimal('price', 10, 2); // Harga sewa per bulan
            $table->enum('status', ['Tersedia', 'Disewa'])->default('Tersedia');
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
