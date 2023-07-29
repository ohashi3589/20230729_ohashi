<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $table = 'reservations'; 

    protected $fillable = ['shop_id', 'user_id', 'reservation_date']; 


    public function deleteReservation($reservationId)
    {
        $reservation = Reservation::find($reservationId);

        if (!$reservation) {
            return false;
        }

        $reservation->delete();

        return true;
    }
    
    public function restaurant()
    {
        return $this->belongsTo(Store::class, 'restaurant_id');
    }

}
