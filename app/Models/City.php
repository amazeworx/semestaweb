<?php

namespace App\Models;

use App\Http\Traits\CityTrait;
use Illuminate\Database\Eloquent\Model;

/**
 * Regency Model.
 */
class City extends Model
{
  use CityTrait;

  /**
   * Table name.
   *
   * @var string
   */
  protected $table = 'cities';

  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  protected $hidden = [
    'province_id'
  ];

  /**
   * City belongs to Province.
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function province()
  {
    return $this->belongsTo(Province::class);
  }

  /**
   * City has many districts.
   *
   * @return \Illuminate\Database\Eloquent\Relations\HasMany
   */
  public function districts()
  {
    return $this->hasMany(District::class);
  }
}
