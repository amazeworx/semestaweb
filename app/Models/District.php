<?php

namespace App\Models;

use App\Http\Traits\DistrictTrait;
use Illuminate\Database\Eloquent\Model;
use App\Models\City;
use App\Models\SubDistrict;

/**
 * District Model.
 */
class District extends Model
{
  use DistrictTrait;

  /**
   * Table name.
   *
   * @var string
   */
  protected $table = 'districts';

  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  protected $hidden = [
    'city_id'
  ];

  /**
   * District belongs to City.
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function city()
  {
    return $this->belongsTo(City::class);
  }

  /**
   * District has many subDistrict.
   *
   * @return \Illuminate\Database\Eloquent\Relations\HasMany
   */
  public function subDistricts()
  {
    return $this->hasMany(SubDistrict::class);
  }
}
