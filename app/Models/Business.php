<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
  use HasFactory;

  public function occupations()
  {
    return $this->belongsToMany(Occupation::class, 'business_occupation_positions');
  }

  public function positions()
  {
    return $this->belongsToMany(Position::class, 'business_occupation_positions');
  }
}
