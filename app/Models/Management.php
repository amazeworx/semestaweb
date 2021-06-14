<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Management extends Model
{
  use HasFactory;
  use SoftDeletes;

  protected $table = 'managements';

  protected $fillable = [
    'name', 'position', 'biography', 'image_src', 'post_status'
  ];
}
