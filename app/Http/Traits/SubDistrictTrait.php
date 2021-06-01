<?php

namespace App\Http\Traits;


trait SubDistrictTrait
{
  /**
   * Check if subDistrict is sub province.
   *
   * @param int $id Id of province
   * @return bool
   */
  public function isProvince($id)
  {
    return $this->district->city->province_id == $id ? true : false;
  }

  /**
   * Check if subDistrict is sub city.
   *
   * @param int $id Id of city
   * @return bool
   */
  public function isCity($id)
  {
    return $this->district->city_id == $id ? true : false;
  }

  /**
   * Check if subDistrict is sub district.
   *
   * @param int $id Id of district
   * @return bool
   */
  public function isDistrict($id)
  {
    return $this->district_id == $id ? true : false;
  }

  /**
   * SubDistrict belongs to City.
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function city()
  {
    return $this->district->city();
  }

  /**
   * SubDistrict belongs to Province.
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function province()
  {
    return $this->district->city->province();
  }
}
