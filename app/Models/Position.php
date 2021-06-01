<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
  use HasFactory;

  public function occupations()
  {
    return $this->belongsToMany(Occupation::class, 'business_occupation_positions');
  }

  public function businesses()
  {
    return $this->belongsToMany(Business::class, 'business_occupation_positions');
  }
}
