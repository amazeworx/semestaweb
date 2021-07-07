<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Position;
use App\Models\Business;
use App\Models\Province;
use App\Models\City;
use App\Models\District;
use App\Models\SubDistrict;
use App\Models\OpenAccount;

class VueOpenAccountController extends Controller
{

  public function get(Request $request)
  {
    $data = OpenAccount::orderBy('created_at', 'desc')->get();
    return response()->json($data);
  }

  public function store(Request $request)
  {
    $occupation_id_bca = $request->occupation_id_bca;
    $occupation_id_ksei = $request->occupation_id_ksei;
    $occupation_name = $request->occupation_name;
    $occupation_text = $request->occupation_text;
    if ($occupation_text) {
      $occupation_name = $occupation_text;
    }
    $job_position = Position::where('id', $request->job_position)->value('name');
    $job_position_text = $request->job_position_text;
    if ($job_position_text) {
      $job_position = $job_position_text;
    }
    $business_field = Business::where('id', $request->business_field)->value('name');
    $business_field_text = $request->business_field_text;
    if ($business_field_text) {
      $business_field = $business_field_text;
    }

    if ($request->id_country === 'INDONESIA') {
      $id_province = Province::where('id', $request->id_province)->value('ksei_name');
      $id_city = City::where('id', $request->id_city)->value('ksei_name');
      $id_district = District::where('id', $request->id_district)->value('name');
      $id_subdistrict = SubDistrict::where('id', $request->id_subdistrict)->value('name');
    } else {
      $id_province = $request->id_province_text;
      $id_city = $request->id_city_text;
      $id_district = $request->id_district_text;
      $id_subdistrict = $request->id_subdistrict_text;
    }

    $upload_ktp = $request->upload_ktp;

    $storeData = OpenAccount::create([
      'full_name' => $request->full_name,
      'nationality' => $request->nationality,
      'occupation_id_bca' => $occupation_id_bca,
      'occupation_id_ksei' => $occupation_id_ksei,
      'occupation_name' => $occupation_name,
      'job_position' => $job_position,
      'business_field' => $business_field,
      'id_country' => $request->id_country,
      'id_street_1' => $request->id_street_1,
      'id_street_2' => $request->id_street_2,
      'id_rt_rw' => $request->id_rt_rw,
      'id_province' => $id_province,
      'id_city' => $id_city,
      'id_district' => $id_district,
      'id_subdistrict' => $id_subdistrict,
      'id_zip' => $request->id_zip,
    ]);

    // if ($this->uploadKtp) {
    //   $this->uploadKtp->storePubliclyAs('files/' . $stored_data->id, 'KTP.' . $this->uploadKtp->extension(), 'public');
    // }

    return response()->json($storeData);
  }

  public function delete($id)
  {
    OpenAccount::destroy($id);

    return response()->json("ok");
  }
}
