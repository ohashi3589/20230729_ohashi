<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Area;
use App\Models\Genre;

class Store extends Model
{
    protected $table = 'restaurants';
    protected $primaryKey = 'id';
    public $timestamps = true;

    public function area()
    {
        return $this->belongsTo(Area::class);
    }

    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'favorites', 'restaurant_id', 'user_id');
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class, 'shop_id');
    }
}
