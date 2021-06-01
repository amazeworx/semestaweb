<?php

namespace App\Http\Traits;


use App\Models\District;
use App\Models\SubDistrict;

trait CityTrait
{
  /**
   * City has many District.
   *
   * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
   */
  public function subDistricts()
  {
    return $this->hasManyThrough(SubDistrict::class, District::class);
  }

  /**
   * check if city has subDistricts by name.
   *
   * @param string|array $name subDistricts name or array of subDistricts names.
   * @param bool $requireAll All subDistricts in the array are required.
   *
   * @return bool
   */
  public function hasSubDistrictName($name, $requireAll = false)
  {
    if (is_array($name)) {
      foreach ($name as $subDistrictName) {
        $hasSubDistrict = $this->hasSubDistrictName(strtoupper($subDistrictName));
        if ($hasSubDistrict && !$requireAll) {
          return true;
        } elseif (!$hasSubDistrict && $requireAll) {
          return false;
        }
      }

      // If we've made it this far and $requireAll is FALSE, then NONE of the subDistricts were found
      // If we've made it this far and $requireAll is TRUE, then ALL of the subDistricts were found.
      // Return the value of $requireAll;
      return $requireAll;
    } else {
      $getSubDistrictName = array_column($this->subDistricts->toArray(), "name");
      if (in_array(strtoupper($name), $getSubDistrictName)) {
        return true;
      }
    }
    return false;
  }

  /**
   * check if city has subDistricts by ID.
   *
   * @param string|array $name subDistricts name or array of subDistricts names.
   * @param bool $requireAll All subDistricts in the array are required.
   *
   * @return bool
   */
  public function hasSubDistrictId($id, $requireAll = false)
  {
    if (is_array($id)) {
      foreach ($id as $subDistrictId) {
        $hasSubDistrict = $this->hasSubDistrictId($subDistrictId);
        if ($hasSubDistrict && !$requireAll) {
          return true;
        } elseif (!$hasSubDistrict && $requireAll) {
          return false;
        }
      }

      // If we've made it this far and $requireAll is FALSE, then NONE of the subDistricts were found
      // If we've made it this far and $requireAll is TRUE, then ALL of the subDistricts were found.
      // Return the value of $requireAll;
      return $requireAll;
    } else {
      $getSubDistrictId = array_column($this->subDistricts->toArray(), "id");
      if (in_array(strtoupper($id), $getSubDistrictId)) {
        return true;
      }
    }
    return false;
  }
}
