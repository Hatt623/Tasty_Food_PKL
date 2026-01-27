<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    public $fillable = ['user_id', 'reservation_date', 'reservation_time', 'guest_count', 'status', 'payment_status'];

    //relasi dengan user
    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    //relasi dengan reservation history
    public function reservationHistories(){
        return $this->hasMany(ReservationHistory::class, 'reservation_id');
    }

    //relasi dengan product melalui reservation_product
    public function products(){
        return $this->belongsToMany(Product::class, 'reservation_product')
                    ->withPivot('quantity', 'note')
                    ->withTimestamps();
    }
}
