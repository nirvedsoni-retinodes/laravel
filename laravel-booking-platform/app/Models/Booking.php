<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\Uid\Ulid;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_code',
        'user_id',
        'facility_id',
        'start_time',
        'end_time',
        'total_hours',
        'total_amount',
        'status',
        'payment_status',
        'razorpay_order_id',
        'razorpay_payment_id',
        'notes',
        'created_by_admin',
        'admin_id',
    ];

    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
        'total_hours' => 'decimal:2',
        'total_amount' => 'decimal:2',
        'created_by_admin' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($booking) {
            if (empty($booking->booking_code)) {
                $booking->booking_code = (string) new Ulid();
            }
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function facility()
    {
        return $this->belongsTo(Facility::class);
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    public function venue()
    {
        return $this->hasOneThrough(Venue::class, Facility::class);
    }

    public function getFormattedStartTimeAttribute()
    {
        return $this->start_time->setTimezone('Asia/Kolkata')->format('M d, Y g:i A');
    }

    public function getFormattedEndTimeAttribute()
    {
        return $this->end_time->setTimezone('Asia/Kolkata')->format('M d, Y g:i A');
    }
}
