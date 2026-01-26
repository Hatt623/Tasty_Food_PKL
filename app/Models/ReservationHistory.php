<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReservationHistory extends Model
{
    public $fillable = ['reservation_id', 'staff_name', 'old_status', 'new_status', 'note'];

    //relasi dengan reservation
    public function reservation(){
        return $this->belongsTo(Reservation::class, 'reservation_id');
    }
}
