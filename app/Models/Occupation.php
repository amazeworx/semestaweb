<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Occupation extends Model
{
  use HasFactory;

  public function positions()
  {
    return $this->belongsToMany(Position::class, 'business_occupation_positions');
  }

  public function businesses()
  {
    return $this->belongsToMany(Business::class, 'business_occupation_positions');
  }
}
