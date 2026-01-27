<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $fillable = ['name','description','image','price'];

    
    public function reviews() {
        return $this->hasMany(Review::class);
    }

    public function averageRating() {
        return $this->reviews()->avg('rating');
    }

    //relasi dengan reservation melalui reservation_product
    public function reservations(){
        return $this->belongsToMany(Reservation::class, 'reservation_product')
                    ->withPivot('quantity', 'note')
                    ->withTimestamps();
    }
}
