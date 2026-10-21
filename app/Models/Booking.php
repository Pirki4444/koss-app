<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Booking extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'room_id',
        'name',
        'contact',
        'duration_months',
        'move_in_date',
        'status',
        'notes',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'move_in_date' => 'date',
        'duration_months' => 'integer',
    ];

    /**
     * Get the room that owns the booking.
     */
    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class);
    }

    /**
     * Calculate the end date of the booking.
     */
    public function getEndDateAttribute()
    {
        return $this->move_in_date->addMonths($this->duration_months);
    }

    /**
     * Calculate the total price.
     */
    public function getTotalPriceAttribute()
    {
        return $this->room->price * $this->duration_months;
    }
}
