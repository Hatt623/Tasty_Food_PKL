<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReservationProduct extends Model
{
    public $fillable = ['reservation_id', 'product_id', 'quantity', 'note'];

    //relasi dengan reservation
    public function reservation(){
        return $this->belongsTo(Reservation::class, 'reservation_id');
    }
    //relasi dengan product
     public function product(){
        return $this->belongsTo(Product::class, 'product_id');
    }
}
