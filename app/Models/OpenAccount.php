<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OpenAccount extends Model
{
  use HasFactory;
  use SoftDeletes;

  // protected $fillable = [
  //   'full_name',
  //   'nationality',
  //   'ktp_number',
  //   'email',
  // ];

  protected $guarded = [];
}
