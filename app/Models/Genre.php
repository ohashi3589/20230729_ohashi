<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
  protected $table = 'genres';

  public function stores()
  {
    return $this->hasMany(Store::class);
  }
}