<?php

namespace App\Http\Traits;


trait DistrictTrait
{
  /**
   * Check if district is sub province.
   *
   * @param int $id Id of province
   * @return bool
   */
  public function isProvince($id)
  {
    return $this->city->province_id == $id ? true : false;
  }

  /**
   * Check if district is sub city.
   *
   * @param int $id Id of city
   * @return bool
   */
  public function isCity($id)
  {
    return $this->city_id == $id ? true : false;
  }

  /**
   * District belongs to Province.
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function province()
  {
    return $this->city->province();
  }
}
