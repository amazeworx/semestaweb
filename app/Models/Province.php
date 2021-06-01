<?php

namespace App\Models;

use App\Http\Traits\ProvinceTrait;
use Illuminate\Database\Eloquent\Model;

/**
 * Province Model.
 */
class Province extends Model
{
  use ProvinceTrait;
  /**
   * Table name.
   *
   * @var string
   */
  protected $table = 'provinces';

  /**
   * Province has many regencies.
   *
   * @return \Illuminate\Database\Eloquent\Relations\HasMany
   */
  public function cities()
  {
    return $this->hasMany(City::class);
  }
}
