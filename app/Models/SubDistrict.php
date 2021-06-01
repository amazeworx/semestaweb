<?php

namespace App\Models;

use App\Http\Traits\SubDistrictTrait;
use Illuminate\Database\Eloquent\Model;
use App\Models\District;

/**
 * SubDistrict Model.
 */
class SubDistrict extends Model
{
  use SubDistrictTrait;

  /**
   * Table name.
   *
   * @var string
   */
  protected $table = 'sub_districts';

  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  protected $hidden = [
    'district_id'
  ];

  /**
   * SubDistrict belongs to District.
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function district()
  {
    return $this->belongsTo(District::class);
  }
}
