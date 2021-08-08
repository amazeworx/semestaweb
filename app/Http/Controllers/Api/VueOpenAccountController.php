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
use App\Models\TemporaryFile;

class VueOpenAccountController extends Controller
{

  public function get(Request $request)
  {
    $data = OpenAccount::orderBy('created_at', 'desc')->get();
    return response()->json($data);
  }

  public function getData($id)
  {
    $data = OpenAccount::where('id', '=', $id)->first();
    //return response()->json($data);

    $account_id = $data->id;
    $lead_id = $data->lead_id;
    $status = $data->status;
    $bca_account_number = $data->bca_existing_account;
    $bca_account_name = $data->bank_2_accname;
    $has_bca = NULL;
    if ($bca_account_number) {
      $has_bca = 1;
    }
    $full_name = $data->full_name;
    $nationality = $data->nationality;
    $id_type = $data->id_type;
    $ktp_number = $data->ktp_number;
    $ktp_expired_date = $data->ktp_expired_date;
    if ($ktp_expired_date != NULL) {
      if ($ktp_expired_date == "99999999") {
        $ktp_expired_day = NULL;
        $ktp_expired_month = NULL;
        $ktp_expired_year = NULL;
        $ktp_expired_lifetime = true;
      } else {
        $ktp_expired_day = substr($ktp_expired_date, -2);
        if (substr($ktp_expired_day, 0, 1) == "0") {
          $ktp_expired_day = substr($ktp_expired_day, 1, 1);
        }
        $ktp_expired_month = substr($ktp_expired_date, 4, 2);
        if (substr($ktp_expired_month, 0, 1) == "0") {
          $ktp_expired_month = substr($ktp_expired_month, 1, 1);
        }
        $ktp_expired_year = substr($ktp_expired_date, 0, 4);
        $ktp_expired_lifetime = true;
      }
    } else {
      $ktp_expired_day = NULL;
      $ktp_expired_month = NULL;
      $ktp_expired_year = NULL;
      $ktp_expired_lifetime = false;
    }
    $passport_number = $data->passport_number;
    $passport_expired_date = $data->passport_expired_date;
    if ($passport_expired_date != NULL) {
      $passport_expired_day = substr($passport_expired_date, -2);
      if (substr($passport_expired_day, 0, 1) == "0") {
        $passport_expired_day = substr($passport_expired_day, 1, 1);
      }
      $passport_expired_month = substr($passport_expired_date, 4, 2);
      if (substr($passport_expired_month, 0, 1) == "0") {
        $passport_expired_month = substr($passport_expired_month, 1, 1);
      }
      $passport_expired_year = substr($passport_expired_date, 0, 4);
    } else {
      $passport_expired_day = NULL;
      $passport_expired_month = NULL;
      $passport_expired_year = NULL;
    }
    $has_kitas = $data->has_kitas;
    $kitas_number = $data->kitas_number;
    $kitas_expired_date = $data->kitas_expired_date;
    if ($kitas_expired_date != NULL) {
      $kitas_expired_day = substr($kitas_expired_date, -2);
      if (substr($kitas_expired_day, 0, 1) == "0") {
        $kitas_expired_day = substr($kitas_expired_day, 1, 1);
      }
      $kitas_expired_month = substr($kitas_expired_date, 4, 2);
      if (substr($kitas_expired_month, 0, 1) == "0") {
        $kitas_expired_month = substr($kitas_expired_month, 1, 1);
      }
      $kitas_expired_year = substr($kitas_expired_date, 0, 4);
    } else {
      $kitas_expired_day = NULL;
      $kitas_expired_month = NULL;
      $kitas_expired_year = NULL;
    }
    $has_npwp = $data->has_npwp;
    $npwp_number = $data->npwp_number;
    $npwp_issue_date = $data->npwp_issue_date;
    if ($npwp_issue_date != NULL) {
      $npwp_issue_day = substr($npwp_issue_date, -2);
      if (substr($npwp_issue_day, 0, 1) == "0") {
        $npwp_issue_day = substr($npwp_issue_day, 1, 1);
      }
      $npwp_issue_month = substr($npwp_issue_date, 4, 2);
      if (substr($npwp_issue_month, 0, 1) == "0") {
        $npwp_issue_month = substr($npwp_issue_month, 1, 1);
      }
      $npwp_issue_year = substr($npwp_issue_date, 0, 4);
    } else {
      $npwp_issue_day = NULL;
      $npwp_issue_month = NULL;
      $npwp_issue_year = NULL;
    }
    $birth_country = $data->birth_country;
    $birth_place = $data->birth_place;
    $birth_place_foreign = NULL;
    if ($birth_country != 'INDONESIA') {
      $birth_place = NULL;
      $birth_place_foreign = $data->birth_place;
    }
    $birth_date = $data->birth_date;
    if ($birth_date != NULL) {
      $birth_day = substr($birth_date, -2);
      if (substr($birth_day, 0, 1) == "0") {
        $birth_day = substr($birth_day, 1, 1);
      }
      $birth_month = substr($birth_date, 4, 2);
      if (substr($birth_month, 0, 1) == "0") {
        $birth_month = substr($birth_month, 1, 1);
      }
      $birth_year = substr($birth_date, 0, 4);
    } else {
      $birth_day = NULL;
      $birth_month = NULL;
      $birth_year = NULL;
    }
    $gender = $data->gender;
    $marital_status = $data->marital_status;
    $religion = $data->religion;
    $education = $data->education;
    $mother_name = $data->mother_name;
    $email = $data->email;
    $mobile_country_code = $data->mobile_country_code;
    $mobile_number_formatted = $data->mobile_number_formatted;
    $phone_country_code = $data->phone_country_code;
    $phone_number_formatted = $data->phone_number_formatted;
    $id_country = $data->id_country;
    $id_street_1 = $data->id_street_1;
    $id_street_2 = $data->id_street_2;
    $id_rt_rw = $data->id_rt_rw;
    $id_province = $data->id_province_id;
    $id_province_text = NULL;
    if ($id_country != 'INDONESIA') {
      $id_province = NULL;
      $id_province_text = $data->id_province;
    }
    $id_city = $data->id_city_id;
    $id_city_text = NULL;
    if ($id_country != 'INDONESIA') {
      $id_city = NULL;
      $id_city_text = $data->id_city;
    }
    $id_district = $data->id_district_id;
    $id_district_text = NULL;
    if ($id_country != 'INDONESIA') {
      $id_district = NULL;
      $id_district_text = $data->id_district;
    }
    $id_subdistrict = $data->id_subdistrict_id;
    $id_subdistrict_text = NULL;
    if ($id_country != 'INDONESIA') {
      $id_subdistrict = NULL;
      $id_subdistrict_text = $data->id_subdistrict;
    }
    $id_zip = $data->id_zip;
    $home_is_id = $data->home_is_id;
    $home_country = $data->home_country;
    $home_street_1 = $data->home_street_1;
    $home_street_2 = $data->home_street_2;
    $home_rt_rw = $data->home_rt_rw;
    $home_province = $data->home_province_id;
    $home_province_text = NULL;
    if ($home_country != 'INDONESIA') {
      $home_province = NULL;
      $home_province_text = $data->home_province;
    }
    $home_city = $data->home_city_id;
    $home_city_text = NULL;
    if ($home_country != 'INDONESIA') {
      $home_city = NULL;
      $home_city_text = $data->home_city;
    }
    $home_district = $data->home_district_id;
    $home_district_text = NULL;
    if ($home_country != 'INDONESIA') {
      $home_district = NULL;
      $home_district_text = $data->home_district;
    }
    $home_subdistrict = $data->home_subdistrict_id;
    $home_subdistrict_text = NULL;
    if ($home_country != 'INDONESIA') {
      $home_subdistrict = NULL;
      $home_subdistrict_text = $data->home_subdistrict;
    }
    $home_zip = $data->home_zip;
    $home_status = $data->home_status;
    $home_since = $data->home_since;
    if ($home_since != NULL) {
      $home_month = substr($home_since, 0, 2);
      if (substr($home_month, 0, 1) == "0") {
        $home_month = substr($home_month, 1, 1);
      }
      $home_year = substr($home_since, 3, 4);
    } else {
      $home_month = NULL;
      $home_year = NULL;
    }
    $postal_preference = $data->postal_preference;
    $info_q1 = $data->info_q1;
    $info_q1_text = $data->info_q1_text;
    $info_q2 = $data->info_q2;
    $info_q2_text = $data->info_q2_text;
    $info_q3 = $data->info_q3;
    $info_q3_text = $data->info_q3_text;

    // STEP 2
    $occupation_id_bca = $data->occupation_id_bca;
    $occupation_id_ksei = $data->occupation_id_ksei;
    $occupation_name = $data->occupation_name;
    $occupation_text = NULL;
    if ($occupation_id_bca == '18') {
      $occupation_text = $data->occupation_name;
    }
    $job_position = $data->job_position_id;
    $job_position_text = NULL;
    if ($job_position == '99' || $job_position == NULL) {
      $job_position_text = $data->job_position;
    }
    $business_field = $data->business_field_id;
    $business_field_text = NULL;
    if ($business_field == '99' || $business_field == NULL) {
      $business_field_text = $data->business_field;
    }
    $company_name = $data->company_name;
    $company_address = $data->company_address;
    $company_country = $data->company_country;
    $company_city = $data->company_city;
    $company_city_text = NULL;
    if ($company_country != "INDONESIA") {
      $company_city = NULL;
      $company_city_text = $data->company_city;
    }
    $company_zip = $data->company_zip;
    $company_phone_country_code = $data->company_phone_country_code;
    $company_phone_number = $data->company_phone_number;
    $company_phone_number_formatted = $data->company_phone_number_formatted;
    $company_fax_country_code = $data->company_fax_country_code;
    $company_fax_number = $data->company_fax_number;
    $company_fax_number_formatted = $data->company_fax_number_formatted;
    $company_email = $data->company_email;
    $work_year = $data->work_year;
    $work_month = $data->work_month;
    $income_yearly = $data->income_yearly;
    $income_source = $data->income_source;
    $income_source_other = $data->income_source_other;
    $extra_income_yearly = $data->extra_income_yearly;
    $extra_income_source = $data->extra_income_source;
    $extra_income_source_other = $data->extra_income_source_other;
    $expenses_monthly = $data->expenses_monthly;
    $objectives = explode(",", $data->objectives);
    $heir_name = $data->heir_name;
    $heir_relationship = $data->heir_relationship;
    $heir_address = $data->heir_address;
    $heir_country = $data->heir_country;
    $heir_city = $data->heir_city;
    $heir_city_text = NULL;
    if ($heir_country != "INDONESIA") {
      $heir_city = NULL;
      $heir_city_text = $data->heir_city;
    }
    $heir_zip = $data->heir_zip;
    $heir_mobile_number_formatted = $data->heir_mobile_number_formatted;
    $heir_email = $data->heir_email;
    $bank_3_name = $data->bank_3_name;
    $bank_3_accname = $data->bank_3_accname;
    $bank_3_accnumber = $data->bank_3_accnumber;
    $fatca_holder = $data->fatca_holder;
    if ($fatca_holder == 1) {
      $fatca_holder = true;
    } else {
      $fatca_holder = false;
    }
    $tin_ssn_number = null;
    if ($fatca_holder == 1) {
      $tin_ssn_number = $data->tin_ssn_number;
    }
    $other_taxpayer = $data->other_taxpayer;
    if ($other_taxpayer == 1) {
      $other_taxpayer = true;
    } else {
      $other_taxpayer = false;
    }

    $spouse_name = $data->spouse_name;
    $parent_name = $data->parent_name;
    $family_relation = $data->family_relation;
    $family_nationality = $data->family_nationality;
    $family_id_type = $data->family_id_type;
    $family_ktp_number = $data->family_ktp_number;
    if ($spouse_name) {
      $family_name = $spouse_name;
    } else {
      $family_name = $parent_name;
    }
    $family_ktp_expired_date = $data->family_ktp_expired_date;
    if ($family_ktp_expired_date != NULL) {
      if ($family_ktp_expired_date == "99999999") {
        $family_ktp_expired_day = NULL;
        $family_ktp_expired_month = NULL;
        $family_ktp_expired_year = NULL;
        $family_ktp_expired_lifetime = true;
      } else {
        $family_ktp_expired_day = substr($family_ktp_expired_date, -2);
        if (substr($family_ktp_expired_day, 0, 1) == "0") {
          $family_ktp_expired_day = substr($family_ktp_expired_day, 1, 1);
        }
        $family_ktp_expired_month = substr($family_ktp_expired_date, 4, 2);
        if (substr($family_ktp_expired_month, 0, 1) == "0") {
          $family_ktp_expired_month = substr($family_ktp_expired_month, 1, 1);
        }
        $family_ktp_expired_year = substr($family_ktp_expired_date, 0, 4);
        $family_ktp_expired_lifetime = true;
      }
    } else {
      $family_ktp_expired_day = NULL;
      $family_ktp_expired_month = NULL;
      $family_ktp_expired_year = NULL;
      $family_ktp_expired_lifetime = false;
    }
    $family_passport_number = $data->family_passport_number;
    $family_passport_expired_date = $data->family_passport_expired_date;
    if ($family_passport_expired_date != NULL) {
      $family_passport_expired_day = substr($family_passport_expired_date, -2);
      if (substr($family_passport_expired_day, 0, 1) == "0") {
        $family_passport_expired_day = substr($family_passport_expired_day, 1, 1);
      }
      $family_passport_expired_month = substr($family_passport_expired_date, 4, 2);
      if (substr($family_passport_expired_month, 0, 1) == "0") {
        $family_passport_expired_month = substr($family_passport_expired_month, 1, 1);
      }
      $family_passport_expired_year = substr($family_passport_expired_date, 0, 4);
    } else {
      $family_passport_expired_day = NULL;
      $family_passport_expired_month = NULL;
      $family_passport_expired_year = NULL;
    }

    $family_occupation_id_bca = $data->family_occupation_id;
    $family_occupation_name = $data->family_occupation;
    $family_occupation_text = NULL;
    if ($family_occupation_id_bca == '18') {
      $family_occupation_name = NULL;
      $family_occupation_text = $data->family_occupation;
    }
    $family_job_position = $data->family_job_position_id;
    $family_job_position_text = NULL;
    if ($family_job_position == '99' || $family_job_position == NULL) {
      $family_job_position_text = $data->family_job_position;
    }
    $family_business_field = $data->family_business_field_id;
    $family_business_field_text = NULL;
    if ($family_business_field == '99' || $family_business_field == NULL) {
      $family_business_field_text = $data->family_business_field;
    }
    $family_company_name = $data->family_company_name;
    $family_company_address = $data->family_company_address;
    $family_company_country = $data->family_company_country;
    $family_company_city = $data->family_company_city;
    $family_company_city_text = NULL;
    if ($family_company_country != "INDONESIA") {
      $family_company_city = NULL;
      $family_company_city_text = $data->family_company_city;
    }
    $family_company_zip = $data->family_company_zip;
    $family_company_phone_country_code = $data->family_company_phone_country_code;
    $family_company_phone_number_formatted = $data->family_company_phone_number_formatted;
    $family_company_fax_country_code = $data->family_company_fax_country_code;
    $family_company_fax_number_formatted = $data->family_company_fax_number_formatted;
    $family_company_email = $data->family_company_email;
    $family_work_year = $data->family_work_year;
    $family_work_month = $data->family_work_month;
    $family_income_yearly = $data->family_income_yearly;
    $family_income_source = $data->family_income_source;
    $family_income_source_other = $data->family_income_source_other;
    $family_extra_income_yearly = $data->family_extra_income_yearly;
    $family_extra_income_source = $data->family_extra_income_source;
    $family_extra_income_source_other = $data->family_extra_income_source_other;
    $application_term = $data->application_term;
    $bca_term = $data->bca_term;
    $upload_ktp = $data->upload_ktp;
    $upload_passport = $data->upload_passport;
    $upload_npwp = $data->upload_npwp;
    $upload_signature = $data->upload_signature;
    //RETURN JSON
    $json = [
      'account_id' => $account_id,
      'lead_id' => $lead_id,
      'status' => $status,
      'has_bca' => $has_bca,
      'bca_account_number' => $bca_account_number,
      'bca_account_name' => $bca_account_name,
      'full_name' => $full_name,
      'nationality' => $nationality,
      'id_type' => $id_type,
      'ktp_number' => $ktp_number,
      'ktp_expired_day' => $ktp_expired_day,
      'ktp_expired_month' => $ktp_expired_month,
      'ktp_expired_year' => $ktp_expired_year,
      'ktp_expired_lifetime' => $ktp_expired_lifetime,
      'passport_number' => $passport_number,
      'passport_expired_day' => $passport_expired_day,
      'passport_expired_month' => $passport_expired_month,
      'passport_expired_year' => $passport_expired_year,
      'has_kitas' => $has_kitas,
      'kitas_number' => $kitas_number,
      'kitas_expired_day' => $kitas_expired_day,
      'kitas_expired_month' => $kitas_expired_month,
      'kitas_expired_year' => $kitas_expired_year,
      'has_npwp' => $has_npwp,
      'npwp_number' => $npwp_number,
      'npwp_issue_day' => $npwp_issue_day,
      'npwp_issue_month' => $npwp_issue_month,
      'npwp_issue_year' => $npwp_issue_year,
      'birth_country' => $birth_country,
      'birth_place' => $birth_place,
      'birth_place_foreign' => $birth_place_foreign,
      'birth_day' => $birth_day,
      'birth_month' => $birth_month,
      'birth_year' => $birth_year,
      'gender' => $gender,
      'marital_status' => $marital_status,
      'religion' => $religion,
      'education' => $education,
      'mother_name' => $mother_name,
      'email' => $email,
      'mobile_country_code' => $mobile_country_code,
      'mobile_number_formatted' => $mobile_number_formatted,
      'phone_country_code' => $phone_country_code,
      'phone_number_formatted' => $phone_number_formatted,
      'id_country' => $id_country,
      'id_street_1' => $id_street_1,
      'id_street_2' => $id_street_2,
      'id_rt_rw' => $id_rt_rw,
      'id_province' => $id_province,
      'id_province_text' => $id_province_text,
      'id_city' => $id_city,
      'id_city_text' => $id_city_text,
      'id_district' => $id_district,
      'id_district_text' => $id_district_text,
      'id_subdistrict' => $id_subdistrict,
      'id_subdistrict_text' => $id_subdistrict_text,
      'id_zip' => $id_zip,
      'home_is_id' => $home_is_id,
      'home_country' => $home_country,
      'home_street_1' => $home_street_1,
      'home_street_2' => $home_street_2,
      'home_rt_rw' => $home_rt_rw,
      'home_province' => $home_province,
      'home_province_text' => $home_province_text,
      'home_city' => $home_city,
      'home_city_text' => $home_city_text,
      'home_district' => $home_district,
      'home_district_text' => $home_district_text,
      'home_subdistrict' => $home_subdistrict,
      'home_subdistrict_text' => $home_subdistrict_text,
      'home_zip' => $home_zip,
      'home_status' => $home_status,
      'home_month' => $home_month,
      'home_year' => $home_year,
      'postal_preference' => $postal_preference,
      'info_q1' => $info_q1,
      'info_q1_text' => $info_q1_text,
      'info_q2' => $info_q2,
      'info_q2_text' => $info_q2_text,
      'info_q3' => $info_q3,
      'info_q3_text' => $info_q3_text,
      'occupation_id_bca' => $occupation_id_bca,
      'occupation_id_ksei' => $occupation_id_ksei,
      'occupation_name' => $occupation_name,
      'occupation_text' => $occupation_text,
      'job_position' => $job_position,
      'job_position_text' => $job_position_text,
      'business_field' => $business_field,
      'business_field_text' => $business_field_text,
      'company_name' => $company_name,
      'company_address' => $company_address,
      'company_country' => $company_country,
      'company_city' => $company_city,
      'company_city_text' => $company_city_text,
      'company_zip' => $company_zip,
      'company_phone_country_code' => $company_phone_country_code,
      'company_phone_number_formatted' => $company_phone_number_formatted,
      'company_fax_country_code' => $company_fax_country_code,
      'company_fax_number_formatted' => $company_fax_number_formatted,
      'company_email' => $company_email,
      'work_year' => $work_year,
      'work_month' => $work_month,
      'income_yearly' => $income_yearly,
      'income_source' => $income_source,
      'income_source_other' => $income_source_other,
      'extra_income_yearly' => $extra_income_yearly,
      'extra_income_source' => $extra_income_source,
      'extra_income_source_other' => $extra_income_source_other,
      'expenses_monthly' => $expenses_monthly,
      'objectives' => $objectives,
      'heir_name' => $heir_name,
      'heir_relationship' => $heir_relationship,
      'heir_address' => $heir_address,
      'heir_country' => $heir_country,
      'heir_city' => $heir_city,
      'heir_city_text' => $heir_city_text,
      'heir_zip' => $heir_zip,
      'heir_mobile_number_formatted' => $heir_mobile_number_formatted,
      'heir_email' => $heir_email,
      'bank_3_name' => $bank_3_name,
      'bank_3_accname' => $bank_3_accname,
      'bank_3_accnumber' => $bank_3_accnumber,
      'fatca_holder' => $fatca_holder,
      'tin_ssn_number' => $tin_ssn_number,
      'other_taxpayer' => $other_taxpayer,
      'family_name' => $family_name,
      'family_relation' => $family_relation,
      'family_nationality' => $family_nationality,
      'family_id_type' => $family_id_type,
      'family_ktp_number' => $family_ktp_number,
      'family_ktp_expired_day' => $family_ktp_expired_day,
      'family_ktp_expired_month' => $family_ktp_expired_month,
      'family_ktp_expired_year' => $family_ktp_expired_year,
      'family_ktp_expired_lifetime' => $family_ktp_expired_lifetime,
      'family_passport_number' => $family_passport_number,
      'family_passport_expired_day' => $family_passport_expired_day,
      'family_passport_expired_month' => $family_passport_expired_month,
      'family_passport_expired_year' => $family_passport_expired_year,
      'family_occupation_id_bca' => $family_occupation_id_bca,
      'family_occupation_name' => $family_occupation_name,
      'family_occupation_text' => $family_occupation_text,
      'family_job_position' => $family_job_position,
      'family_job_position_text' => $family_job_position_text,
      'family_business_field' => $family_business_field,
      'family_business_field_text' => $family_business_field_text,
      'family_company_name' => $family_company_name,
      'family_company_address' => $family_company_address,
      'family_company_country' => $family_company_country,
      'family_company_city' => $family_company_city,
      'family_company_city_text' => $family_company_city_text,
      'family_company_zip' => $family_company_zip,
      'family_company_phone_country_code' => $family_company_phone_country_code,
      'family_company_phone_number_formatted' => $family_company_phone_number_formatted,
      'family_company_fax_country_code' => $family_company_fax_country_code,
      'family_company_fax_number_formatted' => $family_company_fax_number_formatted,
      'family_company_email' => $family_company_email,
      'family_work_year' => $family_work_year,
      'family_work_month' => $family_work_month,
      'family_income_yearly' => $family_income_yearly,
      'family_income_source' => $family_income_source,
      'family_income_source_other' => $family_income_source_other,
      'family_extra_income_yearly' => $family_extra_income_yearly,
      'family_extra_income_source' => $family_extra_income_source,
      'family_extra_income_source_other' => $family_extra_income_source_other,
      'application_term' => $application_term,
      'bca_term' => $bca_term,
      'upload_ktp' => $upload_ktp,
      'upload_passport' => $upload_passport,
      'upload_npwp' => $upload_npwp,
      'upload_signature' => $upload_signature,
    ];
    return response()->json($json);
  }

  public function storeDraft(Request $request)
  {
    $email = $request->email;
    $has_bca = $request->has_bca;
    $lead_id = $request->lead_id;
    $status = 'draft';

    if ($has_bca) {
      $bca_existing_account = $request->bca_account_number;
      $bank_2_name = "BANK CENTRAL ASIA";
      $bank_2_accname = $request->bca_account_name;
      $bank_2_accnumber = $request->bca_account_number;
    } else {
      $bca_existing_account = "";
      $bank_2_name = "";
      $bank_2_accname = "";
      $bank_2_accnumber = "";
    }

    $accountExist = OpenAccount::where('lead_id', '=', $lead_id)
      ->where('status', '=', 'draft')
      ->latest()
      ->first();

    if ($accountExist) {
      return response()->json([
        'id' => $accountExist->id
      ]);
    } else {
      $storeData = OpenAccount::create([
        'email' => $email,
        'bca_existing_account' => $bca_existing_account,
        'bank_2_name' => $bank_2_name,
        'bank_2_accname' => $bank_2_accname,
        'bank_2_accnumber' => $bank_2_accnumber,
        'lead_id' => $lead_id,
        'status' => $status,
      ]);

      return response()->json($storeData);
    }
  }

  public function updateDraft(Request $request)
  {

    // STEP 1
    $full_name = $request->full_name;
    $nationality = $request->nationality;
    $id_type = $request->id_type;
    $ktp_number = $request->ktp_number;
    $ktp_expired_lifetime = $request->ktp_expired_lifetime;
    $ktp_expired_date = NULL;
    if ($ktp_expired_lifetime) {
      $ktp_expired_date = '99999999';
    } else {
      $ktp_expired_day = $request->ktp_expired_day;
      if ($ktp_expired_day) {
        if ($ktp_expired_day < 10) {
          $ktp_expired_day = "0" . strval($ktp_expired_day);
        } else {
          $ktp_expired_day = strval($ktp_expired_day);
        }
      }

      $ktp_expired_month = $request->ktp_expired_month;
      if ($ktp_expired_month) {
        if ($ktp_expired_month < 10) {
          $ktp_expired_month = "0" . strval($ktp_expired_month);
        } else {
          $ktp_expired_month = strval($ktp_expired_month);
        }
      }

      $ktp_expired_year = strval($request->ktp_expired_year);
      if ($ktp_expired_day && $ktp_expired_month && $ktp_expired_year) {
        $ktp_expired_date = $ktp_expired_year . $ktp_expired_month . $ktp_expired_day;
      }
    }

    $passport_number = $request->passport_number;
    $passport_expired_day = $request->passport_expired_day;
    if ($passport_expired_day) {
      if ($passport_expired_day < 10) {
        $passport_expired_day = "0" . strval($passport_expired_day);
      } else {
        $passport_expired_day = strval($passport_expired_day);
      }
    }
    $passport_expired_month = $request->passport_expired_month;
    if ($passport_expired_month) {
      if ($passport_expired_month < 10) {
        $passport_expired_month = "0" . strval($passport_expired_month);
      } else {
        $passport_expired_month = strval($passport_expired_month);
      }
    }
    $passport_expired_year = strval($request->passport_expired_year);
    if ($passport_expired_day && $passport_expired_month && $passport_expired_year) {
      $passport_expired_date = $passport_expired_year . $passport_expired_month . $passport_expired_day;
    } else {
      $passport_expired_date = NULL;
    }

    $has_kitas = $request->has_kitas;
    $kitas_number = $request->kitas_number;
    $kitas_expired_date = NULL;
    $kitas_expired_day = $request->kitas_expired_day;
    if ($kitas_expired_day) {
      if ($kitas_expired_day < 10) {
        $kitas_expired_day = "0" . strval($kitas_expired_day);
      } else {
        $kitas_expired_day = strval($kitas_expired_day);
      }
    }
    $kitas_expired_month = $request->kitas_expired_month;
    if ($kitas_expired_month) {
      if ($kitas_expired_month < 10) {
        $kitas_expired_month = "0" . strval($kitas_expired_month);
      } else {
        $kitas_expired_month = strval($kitas_expired_month);
      }
    }
    $kitas_expired_year = strval($request->kitas_expired_year);
    if ($kitas_expired_day && $kitas_expired_month && $kitas_expired_year) {
      $kitas_expired_date = $kitas_expired_year . $kitas_expired_month . $kitas_expired_day;
    }

    $has_npwp = $request->has_npwp;
    $npwp_number = $request->npwp_number;
    $npwp_issue_date = NULL;
    $npwp_issue_day = $request->npwp_issue_day;
    if ($npwp_issue_day) {
      if ($npwp_issue_day < 10) {
        $npwp_issue_day = "0" . strval($npwp_issue_day);
      } else {
        $npwp_issue_day = strval($npwp_issue_day);
      }
    }
    $npwp_issue_month = $request->npwp_issue_month;
    if ($npwp_issue_month) {
      if ($npwp_issue_month < 10) {
        $npwp_issue_month = "0" . strval($npwp_issue_month);
      } else {
        $npwp_issue_month = strval($npwp_issue_month);
      }
    }
    $npwp_issue_year = strval($request->npwp_issue_year);
    if ($npwp_issue_day && $npwp_issue_month && $npwp_issue_year) {
      $npwp_issue_date = $npwp_issue_year . $npwp_issue_month . $npwp_issue_day;
    }

    $birth_country = $request->birth_country;
    $birth_place = NULL;
    if ($birth_country !== 'INDONESIA') {
      $birth_place = $request->birth_place_foreign;
    } else {
      $birth_place = $request->birth_place;
    }

    $birth_date = NULL;
    $birth_day = $request->birth_day;
    if ($birth_day) {
      if ($birth_day < 10) {
        $birth_day = "0" . strval($birth_day);
      } else {
        $birth_day = strval($birth_day);
      }
    }
    $birth_month = $request->birth_month;
    if ($birth_month) {
      if ($birth_month < 10) {
        $birth_month = "0" . strval($birth_month);
      } else {
        $birth_month = strval($birth_month);
      }
    }
    $birth_year = strval($request->birth_year);
    if ($birth_day && $birth_month && $birth_year) {
      $birth_date = $birth_year . $birth_month . $birth_day;
    }

    $gender = $request->gender;
    $marital_status = $request->marital_status;
    $religion = $request->religion;
    $education = $request->education;
    $mother_name = $request->mother_name;
    $email = $request->email;

    $mobile_country_code = str_replace("+", "", $request->mobile_country_code);
    $mobile_number = str_replace([' ', '-', '+'], "", $request->mobile_number_formatted);
    $mobile_number_formatted = $request->mobile_number_formatted;

    if ($request->phone_number_formatted) {
      $phone_country_code = str_replace("+", "", $request->phone_country_code);
      $phone_number_formatted = $request->phone_number_formatted;
      $phone_number = str_replace([' ', '-', '+'], "", $request->phone_number_formatted);
    } else {
      $phone_country_code = NULL;
      $phone_number_formatted = NULL;
      $phone_number = NULL;
    }

    if (strlen($phone_number_formatted) < 4) {
      $phone_country_code = NULL;
      $phone_number_formatted = NULL;
      $phone_number = NULL;
    }

    $id_country = $request->id_country;
    $id_street_1 = $request->id_street_1;
    $id_street_2 = $request->id_street_2;
    $id_rt_rw = $request->id_rt_rw;
    $id_province_id = NULL;
    $id_province = NULL;
    $id_city_id = NULL;
    $id_city = NULL;
    $id_district_id = NULL;
    $id_district = NULL;
    $id_subdistrict_id = NULL;
    $id_subdistrict = NULL;
    if ($request->id_country === 'INDONESIA') {
      $id_province_id = $request->id_province;
      $id_province = Province::where('id', $request->id_province)->value('ksei_name');
      $id_city_id = $request->id_city;
      $id_city = City::where('id', $request->id_city)->value('ksei_name');
      $id_district_id = $request->id_district;
      $id_district = District::where('id', $request->id_district)->value('name');
      $id_subdistrict_id = $request->id_subdistrict;
      $id_subdistrict = SubDistrict::where('id', $request->id_subdistrict)->value('name');
    } else {
      $id_province = $request->id_province_text;
      $id_city = $request->id_city_text;
      $id_district = $request->id_district_text;
      $id_subdistrict = $request->id_subdistrict_text;
    }
    $id_zip = $request->id_zip;

    $home_is_id = $request->home_is_id;
    $home_country = NULL;
    $home_street_1 = NULL;
    $home_street_2 = NULL;
    $home_rt_rw = NULL;
    $home_province_id = NULL;
    $home_province = NULL;
    $home_city_id = NULL;
    $home_city = NULL;
    $home_district_id = NULL;
    $home_district = NULL;
    $home_subdistrict_id = NULL;
    $home_subdistrict = NULL;
    $home_zip = NULL;
    if (!$home_is_id) {
      if ($request->home_country === 'INDONESIA') {
        $home_country = $request->home_country;
        $home_street_1 = $request->home_street_1;
        $home_street_2 = $request->home_street_2;
        $home_rt_rw = $request->home_rt_rw;
        $home_province_id = $request->home_province;
        $home_province = Province::where('id', $request->home_province)->value('ksei_name');
        $home_city_id = $request->home_city;
        $home_city = City::where('id', $request->home_city)->value('ksei_name');
        $home_district_id = $request->home_district;
        $home_district = District::where('id', $request->home_district)->value('name');
        $home_subdistrict_id = $request->home_subdistrict;
        $home_subdistrict = SubDistrict::where('id', $request->home_subdistrict)->value('name');
        $home_zip = $request->home_zip;
      } else {
        $home_country = $request->home_country;
        $home_street_1 = $request->home_street_1;
        $home_street_2 = $request->home_street_2;
        $home_rt_rw = $request->home_rt_rw;
        $home_province = $request->home_province_text;
        $home_city = $request->home_city_text;
        $home_district = $request->home_district_text;
        $home_subdistrict = $request->home_subdistrict_text;
        $home_zip = $request->home_zip;
      }
    }

    $home_status = $request->home_status;
    $home_month = $request->home_month;
    if ($home_month) {
      if ($home_month < 10) {
        $home_month = "0" . strval($home_month);
      } else {
        $home_month = strval($home_month);
      }
    }
    $home_year = strval($request->home_year);

    $home_since = NULL;
    if ($home_month && $home_year) {
      $home_since = $home_month . "-" . $home_year;
    }

    $postal_preference = $request->postal_preference;

    $info_q1 = $request->info_q1;
    $info_q1_text = $request->info_q1_text;
    if (!$info_q1) {
      $info_q1_text = NULL;
    }
    $info_q2 = $request->info_q2;
    $info_q2_text = $request->info_q2_text;
    if (!$info_q2) {
      $info_q2_text = NULL;
    }
    $info_q3 = $request->info_q3;
    $info_q3_text = $request->info_q3_text;
    if (!$info_q3) {
      $info_q3_text = NULL;
    }

    // STEP 2
    $occupation_id_bca = $request->occupation_id_bca;
    $occupation_id_ksei = $request->occupation_id_ksei;
    $occupation_name = $request->occupation_name;
    $occupation_text = $request->occupation_text;
    if ($occupation_text) {
      $occupation_name = $occupation_text;
    }
    $job_position_id = $request->job_position;
    $job_position = Position::where('id', $job_position_id)->value('name');
    $job_position_text = $request->job_position_text;
    if ($job_position_text) {
      $job_position = $job_position_text;
    }
    $business_field_id = $request->business_field;
    $business_field = Business::where('id', $business_field_id)->value('name');
    $business_field_text = $request->business_field_text;
    if ($business_field_text) {
      $business_field = $business_field_text;
    }

    $company_name = $request->company_name;
    $company_address = $request->company_address;
    $company_country = $request->company_country;
    $company_city = $request->company_city;
    $company_city_text = $request->company_city_text;
    $company_zip = $request->company_zip;

    if ($company_country !== 'INDONESIA') {
      $company_city = $company_city_text;
    }

    if ($request->company_phone_number) {
      $company_phone_country_code = str_replace("+", "", $request->company_phone_country_code);
      $company_phone_number = str_replace([' ', '-', '+'], "", $request->company_phone_number);
    } else {
      $company_phone_country_code = NULL;
      $company_phone_number = NULL;
    }
    if (strlen($company_phone_number) < 4) {
      $company_phone_country_code = NULL;
      $company_phone_number = NULL;
    }

    if ($request->company_fax_number) {
      $company_fax_country_code = str_replace("+", "", $request->company_fax_country_code);
      $company_fax_number = str_replace([' ', '-', '+'], "", $request->company_fax_number);
    } else {
      $company_fax_country_code = NULL;
      $company_fax_number = NULL;
    }
    if (strlen($company_fax_number) < 4) {
      $company_fax_country_code = NULL;
      $company_fax_number = NULL;
    }

    $company_email = $request->company_email;
    $work_year = $request->work_year;
    $work_month = $request->work_month;
    $income_yearly = $request->income_yearly;
    $income_source = $request->income_source;
    $income_source_other = $request->income_source_other;
    $extra_income_yearly = $request->extra_income_yearly;
    $extra_income_source = $request->extra_income_source;
    $extra_income_source_other = $request->extra_income_source_other;
    $objectives = implode(",", $request->objectives);
    $expenses_monthly = $request->expenses_monthly;
    $heir_name = $request->heir_name;
    $heir_relationship = $request->heir_relationship;

    $heir_address = $request->heir_address;
    $heir_country = $request->heir_country;
    $heir_city = $request->heir_city;
    $heir_city_text = $request->heir_city_text;
    if ($heir_country !== 'INDONESIA') {
      $heir_city = $heir_city_text;
    }
    $heir_zip = $request->heir_zip;
    $heir_mobile_country_code = NULL;
    $heir_mobile_number_formatted = NULL;
    $heir_mobile_number = NULL;
    if ($request->heir_mobile_number_formatted) {
      if (strlen($request->heir_mobile_number_formatted) > 4) {
        $heir_mobile_country_code = str_replace("+", "", $request->heir_mobile_country_code);
        $heir_mobile_number_formatted = $request->heir_mobile_number_formatted;
        $heir_mobile_number = str_replace([' ', '-', '+'], "", $request->heir_mobile_number_formatted);
      }
    }
    $heir_email = $request->heir_email;

    $bank_2_name = $request->bank_2_name;
    $bank_2_accname = $request->bank_2_accname;
    $bank_2_accnumber = $request->bank_2_accnumber;
    $bank_3_name = $request->bank_3_name;
    $bank_3_accname = $request->bank_3_accname;
    $bank_3_accnumber = $request->bank_3_accnumber;
    $fatca_holder = $request->fatca_holder;
    if ($fatca_holder == true) {
      $fatca_holder = 1;
    } else {
      $fatca_holder = 2;
    }
    $tin_ssn_number = $request->tin_ssn_number;
    $other_taxpayer = $request->other_taxpayer;
    if ($other_taxpayer == true) {
      $other_taxpayer = 1;
    } else {
      $other_taxpayer = 2;
    }

    // STEP 3
    $family_name = $request->family_name;
    $family_relation = $request->family_relation;
    $spouse_name = NULL;
    if ($family_relation == 'Suami' || $family_relation == 'Istri') {
      $spouse_name = $family_name;
    }
    $parent_name = NULL;
    if ($family_relation == 'Ayah' || $family_relation == 'Ibu') {
      $parent_name = $family_name;
    }
    $family_nationality = $request->family_nationality;

    $family_id_type = $request->family_id_type;
    $family_ktp_number = $request->family_ktp_number;
    $family_ktp_expired_lifetime = $request->family_ktp_expired_lifetime;
    $family_ktp_expired_date = NULL;
    if ($family_ktp_expired_lifetime) {
      $family_ktp_expired_date = '99999999';
    } else {
      $family_ktp_expired_day = $request->family_ktp_expired_day;
      if ($family_ktp_expired_day) {
        if ($family_ktp_expired_day < 10) {
          $family_ktp_expired_day = "0" . strval($family_ktp_expired_day);
        } else {
          $family_ktp_expired_day = strval($family_ktp_expired_day);
        }
      }

      $family_ktp_expired_month = $request->family_ktp_expired_month;
      if ($family_ktp_expired_month) {
        if ($family_ktp_expired_month < 10) {
          $family_ktp_expired_month = "0" . strval($family_ktp_expired_month);
        } else {
          $family_ktp_expired_month = strval($family_ktp_expired_month);
        }
      }

      $family_ktp_expired_year = strval($request->family_ktp_expired_year);
      if ($family_ktp_expired_day && $family_ktp_expired_month && $family_ktp_expired_year) {
        $family_ktp_expired_date = $family_ktp_expired_year . $family_ktp_expired_month . $family_ktp_expired_day;
      }
    }

    $family_passport_number = $request->family_passport_number;
    $family_passport_expired_day = $request->family_passport_expired_day;
    if ($family_passport_expired_day) {
      if ($family_passport_expired_day < 10) {
        $family_passport_expired_day = "0" . strval($family_passport_expired_day);
      } else {
        $family_passport_expired_day = strval($family_passport_expired_day);
      }
    }
    $family_passport_expired_month = $request->family_passport_expired_month;
    if ($family_passport_expired_month) {
      if ($family_passport_expired_month < 10) {
        $family_passport_expired_month = "0" . strval($family_passport_expired_month);
      } else {
        $family_passport_expired_month = strval($family_passport_expired_month);
      }
    }
    $family_passport_expired_year = strval($request->family_passport_expired_year);
    if ($family_passport_expired_day && $family_passport_expired_month && $family_passport_expired_year) {
      $family_passport_expired_date = $family_passport_expired_year . $family_passport_expired_month . $family_passport_expired_day;
    } else {
      $family_passport_expired_date = NULL;
    }

    $family_occupation_id_bca = $request->family_occupation_id_bca;
    $family_occupation = $request->family_occupation_name;
    $family_occupation_text = $request->family_occupation_text;
    if ($family_occupation_text) {
      $family_occupation = $family_occupation_text;
    }
    $family_job_position_id = $request->family_job_position;
    $family_job_position = Position::where('id', $request->family_job_position)->value('name');
    $family_job_position_text = $request->family_job_position_text;
    if ($family_job_position_text) {
      $family_job_position = $family_job_position_text;
    }
    $family_business_field_id = $request->family_business_field;
    $family_business_field = Business::where('id', $request->family_business_field)->value('name');
    $family_business_field_text = $request->family_business_field_text;
    if ($family_business_field_text) {
      $family_business_field = $family_business_field_text;
    }

    $family_company_name = $request->family_company_name;
    $family_company_address = $request->family_company_address;
    $family_company_country = $request->family_company_country;
    $family_company_city = $request->family_company_city;
    $family_company_city_text = $request->family_company_city_text;
    $family_company_zip = $request->family_company_zip;

    if ($family_company_country !== 'INDONESIA') {
      $family_company_city = $family_company_city_text;
    }

    $family_company_phone_country_code = NULL;
    $family_company_phone_number = NULL;
    $family_company_phone_number_formatted = $request->family_company_phone_number_formatted;
    if ($family_company_phone_number_formatted) {
      if (strlen($family_company_phone_number_formatted) > 4) {
        $family_company_phone_country_code = $request->family_company_phone_country_code;
        $family_company_phone_number = str_replace([' ', '-', '+'], "", $family_company_phone_number_formatted);
      }
    }

    $family_company_fax_country_code = NULL;
    $family_company_fax_number = NULL;
    $family_company_fax_number_formatted = $request->family_company_fax_number_formatted;
    if ($family_company_fax_number_formatted) {
      if (strlen($family_company_fax_number_formatted) > 4) {
        $family_company_fax_country_code = $request->family_company_fax_country_code;
        $family_company_fax_number = str_replace([' ', '-', '+'], "", $family_company_fax_number_formatted);
      }
    }

    $family_company_email = $request->family_company_email;
    $family_work_year = $request->family_work_year;
    $family_work_month = $request->family_work_month;
    $family_income_yearly = $request->family_income_yearly;
    $family_income_source = $request->family_income_source;
    $family_income_source_other = $request->family_income_source_other;
    $family_extra_income_yearly = $request->family_extra_income_yearly;
    $family_extra_income_source = $request->family_extra_income_source;
    $family_extra_income_source_other = $request->family_extra_income_source_other;

    $application_term = $request->application_term;
    if ($application_term) {
      $application_term = 1;
      $application_term_timestamp = date('Y-m-d H:i:s');
    } else {
      $application_term = 0;
      $application_term_timestamp = NULL;
    }

    $bca_term = $request->bca_term;
    if ($bca_term) {
      $bca_term = 1;
      $bca_term_timestamp = date('Y-m-d H:i:s');
    } else {
      $bca_term = 0;
      $bca_term_timestamp = NULL;
    }

    $status = $request->status;
    $account_id = $request->account_id;
    $lead_id = $request->lead_id;

    // UPLOADS
    $openAccount = OpenAccount::find($account_id);
    $upload_ktp = $request->upload_ktp;
    $temporaryKtp = TemporaryFile::where('folder', $upload_ktp)->first();
    if ($temporaryKtp) {
      $openAccount->addMedia(storage_path('app/public/uploads/tmp/' . $upload_ktp . '/' . $temporaryKtp->filename))
        ->withCustomProperties(['mime-type' => 'image/jpeg'])
        ->toMediaCollection('uploads', 'uploads');
      //rmdir(storage_path('app/public/uploads/tmp/' . $request->upload_ktp));
      //$temporaryKtp->delete();
    }

    $upload_passport = $request->upload_passport;
    $temporaryPassport = TemporaryFile::where('folder', $upload_passport)->first();
    if ($temporaryPassport) {
      $openAccount->addMedia(storage_path('app/public/uploads/tmp/' . $upload_passport . '/' . $temporaryPassport->filename))
        ->withCustomProperties(['mime-type' => 'image/jpeg'])
        ->toMediaCollection('uploads', 'uploads');
      //rmdir(storage_path('app/public/uploads/tmp/' . $request->upload_passport));
      //$temporaryPassport->delete();
    }

    $upload_npwp = $request->upload_npwp;
    $temporaryNpwp = TemporaryFile::where('folder', $upload_npwp)->first();
    if ($temporaryNpwp) {
      $openAccount->addMedia(storage_path('app/public/uploads/tmp/' . $upload_npwp . '/' . $temporaryNpwp->filename))
        ->withCustomProperties(['mime-type' => 'image/jpeg'])
        ->toMediaCollection('uploads', 'uploads');
      //rmdir(storage_path('app/public/uploads/tmp/' . $request->upload_npwp));
      //$temporaryNpwp->delete();
    }

    $upload_signature = $request->upload_signature;
    if ($upload_signature) {
      $data_uri = $upload_signature;
      $encoded_image = explode(",", $data_uri)[1];
      $openAccount->addMediaFromBase64($encoded_image)
        ->withCustomProperties(['mime-type' => 'image/jpeg'])
        ->usingFileName('TandaTangan.jpg')
        ->toMediaCollection('uploads', 'uploads');
    }

    // STORE
    $storeData = OpenAccount::where('id', $account_id)->update([
      'status' => $status,
      'lead_id' => $lead_id,
      'full_name' => strtoupper($full_name),
      'nationality' => strtoupper($nationality),
      'id_type' => strtoupper($id_type),
      'ktp_number' => $ktp_number,
      'ktp_expired_date' => $ktp_expired_date,
      'passport_number' => $passport_number,
      'passport_expired_date' => $passport_expired_date,
      'has_kitas' => $has_kitas,
      'kitas_number' => $kitas_number,
      'kitas_expired_date' => $kitas_expired_date,
      'has_npwp' => $has_npwp,
      'npwp_number' => $npwp_number,
      'npwp_issue_date' => $npwp_issue_date,
      'birth_country' => strtoupper($birth_country),
      'birth_place' => strtoupper($birth_place),
      'birth_date' => $birth_date,
      'gender' => $gender,
      'marital_status' => strtoupper($marital_status),
      'religion' => strtoupper($religion),
      'education' => strtoupper($education),
      'mother_name' => strtoupper($mother_name),
      'email' => $email,
      'mobile_country_code' => $mobile_country_code,
      'mobile_number' => $mobile_number,
      'mobile_number_formatted' => $mobile_number_formatted,
      'phone_country_code' => $phone_country_code,
      'phone_number' => $phone_number,
      'phone_number_formatted' => $phone_number_formatted,
      'id_country' => strtoupper($id_country),
      'id_street_1' => strtoupper($id_street_1),
      'id_street_2' => strtoupper($id_street_2),
      'id_rt_rw' => strtoupper($id_rt_rw),
      'id_province' => strtoupper($id_province),
      'id_province_id' => $id_province_id,
      'id_city_id' => $id_city_id,
      'id_city' => strtoupper($id_city),
      'id_district' => strtoupper($id_district),
      'id_district_id' => $id_district_id,
      'id_subdistrict' => strtoupper($id_subdistrict),
      'id_subdistrict_id' => $id_subdistrict_id,
      'id_zip' => $id_zip,
      'home_is_id' => $home_is_id,
      'home_country' => strtoupper($home_country),
      'home_street_1' => strtoupper($home_street_1),
      'home_street_2' => strtoupper($home_street_2),
      'home_rt_rw' => strtoupper($home_rt_rw),
      'home_province' => strtoupper($home_province),
      'home_province_id' => $home_province_id,
      'home_city_id' => $home_city_id,
      'home_city' => strtoupper($home_city),
      'home_district' => strtoupper($home_district),
      'home_district_id' => $home_district_id,
      'home_subdistrict' => strtoupper($home_subdistrict),
      'home_subdistrict_id' => $home_subdistrict_id,
      'home_zip' => $home_zip,
      'home_status' => strtoupper($home_status),
      'home_since' => $home_since,
      'postal_preference' => strtoupper($postal_preference),
      'info_q1' => $info_q1,
      'info_q1_text' => strtoupper($info_q1_text),
      'info_q2' => $info_q2,
      'info_q2_text' => strtoupper($info_q2_text),
      'info_q3' => $info_q3,
      'info_q3_text' => strtoupper($info_q3_text),
      'occupation_id_bca' => $occupation_id_bca,
      'occupation_id_ksei' => $occupation_id_ksei,
      'occupation_name' => strtoupper($occupation_name),
      'job_position' => strtoupper($job_position),
      'job_position_id' => $job_position_id,
      'business_field' => strtoupper($business_field),
      'business_field_id' => $business_field_id,
      'company_name' => strtoupper($company_name),
      'company_address' => strtoupper($company_address),
      'company_country' => strtoupper($company_country),
      'company_city' => strtoupper($company_city),
      'company_zip' => $company_zip,
      'company_phone_country_code' => $company_phone_country_code,
      'company_phone_number' => $company_phone_number,
      'company_fax_country_code' => $company_fax_country_code,
      'company_fax_number' => $company_fax_number,
      'company_email' => $company_email,
      'work_year' => $work_year,
      'work_month' => $work_month,
      'income_yearly' => $income_yearly,
      'income_source' => $income_source,
      'income_source_other' => strtoupper($income_source_other),
      'extra_income_yearly' => $extra_income_yearly,
      'extra_income_source' => $extra_income_source,
      'extra_income_source_other' => strtoupper($extra_income_source_other),
      'expenses_monthly' => $expenses_monthly,
      'objectives' => $objectives,
      'heir_name' => strtoupper($heir_name),
      'heir_relationship' => strtoupper($heir_relationship),
      'heir_address' => strtoupper($heir_address),
      'heir_country' => strtoupper($heir_country),
      'heir_city' => strtoupper($heir_city),
      'heir_zip' => strtoupper($heir_zip),
      'heir_mobile_country_code' => $heir_mobile_country_code,
      'heir_mobile_number' => $heir_mobile_number,
      'heir_mobile_number_formatted' => $heir_mobile_number_formatted,
      'heir_email' => $heir_email,
      'bank_2_name' => strtoupper($bank_2_name),
      'bank_2_accname' => strtoupper($bank_2_accname),
      'bank_2_accnumber' => $bank_2_accnumber,
      'bank_3_name' => strtoupper($bank_3_name),
      'bank_3_accname' => strtoupper($bank_3_accname),
      'bank_3_accnumber' => $bank_3_accnumber,
      'fatca_holder' => $fatca_holder,
      'tin_ssn_number' => $tin_ssn_number,
      'other_taxpayer' => $other_taxpayer,
      'spouse_name' => strtoupper($spouse_name),
      'parent_name' => strtoupper($parent_name),
      'family_relation' => strtoupper($family_relation),
      'family_nationality' => strtoupper($family_nationality),
      'family_id_type' => strtoupper($family_id_type),
      'family_ktp_number' => strtoupper($family_ktp_number),
      'family_ktp_expired_date' => $family_ktp_expired_date,
      'family_passport_number' => $family_passport_number,
      'family_passport_expired_date' => $family_passport_expired_date,
      'family_occupation' => strtoupper($family_occupation),
      'family_occupation_id' => $family_occupation_id_bca,
      'family_job_position' => strtoupper($family_job_position),
      'family_job_position_id' => $family_job_position_id,
      'family_business_field' => strtoupper($family_business_field),
      'family_business_field_id' => $family_business_field_id,
      'family_company_name' => strtoupper($family_company_name),
      'family_company_address' => strtoupper($family_company_address),
      'family_company_country' => strtoupper($family_company_country),
      'family_company_city' => strtoupper($family_company_city),
      'family_company_zip' => $family_company_zip,
      'family_company_phone_country_code' => $family_company_phone_country_code,
      'family_company_phone_number' => $family_company_phone_number,
      'family_company_phone_number' => $family_company_phone_number_formatted,
      'family_company_fax_country_code' => $family_company_fax_country_code,
      'family_company_fax_number' => $family_company_fax_number,
      'family_company_fax_number_formatted' => $family_company_fax_number_formatted,
      'family_company_email' => $family_company_email,
      'family_work_year' => $family_work_year,
      'family_work_month' => $family_work_month,
      'family_income_yearly' => $family_income_yearly,
      'family_income_source' => $family_income_source,
      'family_income_source_other' => strtoupper($family_income_source_other),
      'family_extra_income_yearly' => $family_extra_income_yearly,
      'family_extra_income_source' => $family_extra_income_source,
      'family_extra_income_source_other' => strtoupper($family_extra_income_source_other),
      'application_term' => $application_term,
      'application_term_timestamp' => $application_term_timestamp,
      'bca_term' => $bca_term,
      'bca_term_timestamp' => $bca_term_timestamp,
      'upload_ktp' => $upload_ktp,
      'upload_npwp' => $upload_npwp,
      'upload_passport' => $upload_passport,
      'upload_signature' => $upload_signature,
    ]);

    // RETURN
    return response()->json($storeData);
  }

  public function store(Request $request)
  {

    // STEP 1
    $full_name = $request->full_name;
    $nationality = $request->nationality;
    $id_type = $request->id_type;
    $ktp_number = $request->ktp_number;
    $ktp_expired_lifetime = $request->ktp_expired_lifetime;
    $ktp_expired_date = NULL;
    if ($ktp_expired_lifetime) {
      $ktp_expired_date = '99999999';
    } else {
      $ktp_expired_day = $request->ktp_expired_day;
      if ($ktp_expired_day) {
        if ($ktp_expired_day < 10) {
          $ktp_expired_day = "0" . strval($ktp_expired_day);
        } else {
          $ktp_expired_day = strval($ktp_expired_day);
        }
      }

      $ktp_expired_month = $request->ktp_expired_month;
      if ($ktp_expired_month) {
        if ($ktp_expired_month < 10) {
          $ktp_expired_month = "0" . strval($ktp_expired_month);
        } else {
          $ktp_expired_month = strval($ktp_expired_month);
        }
      }

      $ktp_expired_year = strval($request->ktp_expired_year);
      if ($ktp_expired_day && $ktp_expired_month && $ktp_expired_year) {
        $ktp_expired_date = $ktp_expired_year . $ktp_expired_month . $ktp_expired_day;
      }
    }

    $passport_number = $request->passport_number;
    $passport_expired_day = $request->passport_expired_day;
    if ($passport_expired_day) {
      if ($passport_expired_day < 10) {
        $passport_expired_day = "0" . strval($passport_expired_day);
      } else {
        $passport_expired_day = strval($passport_expired_day);
      }
    }
    $passport_expired_month = $request->passport_expired_month;
    if ($passport_expired_month) {
      if ($passport_expired_month < 10) {
        $passport_expired_month = "0" . strval($passport_expired_month);
      } else {
        $passport_expired_month = strval($passport_expired_month);
      }
    }
    $passport_expired_year = strval($request->passport_expired_year);
    if ($passport_expired_day && $passport_expired_month && $passport_expired_year) {
      $passport_expired_date = $passport_expired_year . $passport_expired_month . $passport_expired_day;
    } else {
      $passport_expired_date = NULL;
    }

    $has_kitas = $request->has_kitas;
    $kitas_number = $request->kitas_number;
    $kitas_expired_date = NULL;
    $kitas_expired_day = $request->kitas_expired_day;
    if ($kitas_expired_day) {
      if ($kitas_expired_day < 10) {
        $kitas_expired_day = "0" . strval($kitas_expired_day);
      } else {
        $kitas_expired_day = strval($kitas_expired_day);
      }
    }
    $kitas_expired_month = $request->kitas_expired_month;
    if ($kitas_expired_month) {
      if ($kitas_expired_month < 10) {
        $kitas_expired_month = "0" . strval($kitas_expired_month);
      } else {
        $kitas_expired_month = strval($kitas_expired_month);
      }
    }
    $kitas_expired_year = strval($request->kitas_expired_year);
    if ($kitas_expired_day && $kitas_expired_month && $kitas_expired_year) {
      $kitas_expired_date = $kitas_expired_year . $kitas_expired_month . $kitas_expired_day;
    }

    $has_npwp = $request->has_npwp;
    $npwp_number = $request->npwp_number;
    $npwp_issue_date = NULL;
    $npwp_issue_day = $request->npwp_issue_day;
    if ($npwp_issue_day) {
      if ($npwp_issue_day < 10) {
        $npwp_issue_day = "0" . strval($npwp_issue_day);
      } else {
        $npwp_issue_day = strval($npwp_issue_day);
      }
    }
    $npwp_issue_month = $request->npwp_issue_month;
    if ($npwp_issue_month) {
      if ($npwp_issue_month < 10) {
        $npwp_issue_month = "0" . strval($npwp_issue_month);
      } else {
        $npwp_issue_month = strval($npwp_issue_month);
      }
    }
    $npwp_issue_year = strval($request->npwp_issue_year);
    if ($npwp_issue_day && $npwp_issue_month && $npwp_issue_year) {
      $npwp_issue_date = $npwp_issue_year . $npwp_issue_month . $npwp_issue_day;
    }

    $birth_country = $request->birth_country;
    $birth_place = NULL;
    if ($birth_country !== 'INDONESIA') {
      $birth_place = $request->birth_place_foreign;
    } else {
      $birth_place = $request->birth_place;
    }

    $birth_date = NULL;
    $birth_day = $request->birth_day;
    if ($birth_day) {
      if ($birth_day < 10) {
        $birth_day = "0" . strval($birth_day);
      } else {
        $birth_day = strval($birth_day);
      }
    }
    $birth_month = $request->birth_month;
    if ($birth_month) {
      if ($birth_month < 10) {
        $birth_month = "0" . strval($birth_month);
      } else {
        $birth_month = strval($birth_month);
      }
    }
    $birth_year = strval($request->birth_year);
    if ($birth_day && $birth_month && $birth_year) {
      $birth_date = $birth_year . $birth_month . $birth_day;
    }

    $gender = $request->gender;
    $marital_status = $request->marital_status;
    $religion = $request->religion;
    $education = $request->education;
    $mother_name = $request->mother_name;
    $email = $request->email;

    $mobile_country_code = str_replace("+", "", $request->mobile_country_code);
    $mobile_number = str_replace([' ', '-', '+'], "", $request->mobile_number);

    if ($request->phone_number) {
      $phone_country_code = str_replace("+", "", $request->phone_country_code);
      $phone_number = str_replace([' ', '-', '+'], "", $request->phone_number);
    } else {
      $phone_country_code = NULL;
      $phone_number = NULL;
    }

    if (strlen($phone_number) < 4) {
      $phone_country_code = NULL;
      $phone_number = NULL;
    }

    $id_country = $request->id_country;
    $id_street_1 = $request->id_street_1;
    $id_street_2 = $request->id_street_2;
    $id_rt_rw = $request->id_rt_rw;
    $id_province = NULL;
    $id_city = NULL;
    $id_district = NULL;
    $id_subdistrict = NULL;
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
    $id_zip = $request->id_zip;

    $home_is_id = $request->home_is_id;
    $home_country = NULL;
    $home_street_1 = NULL;
    $home_street_2 = NULL;
    $home_rt_rw = NULL;
    $home_province = NULL;
    $home_city = NULL;
    $home_district = NULL;
    $home_subdistrict = NULL;
    $home_zip = NULL;
    if (!$home_is_id) {
      if ($request->home_country === 'INDONESIA') {
        $home_country = $request->home_country;
        $home_street_1 = $request->home_street_1;
        $home_street_2 = $request->home_street_2;
        $home_rt_rw = $request->home_rt_rw;
        $home_province = Province::where('id', $request->home_province)->value('ksei_name');
        $home_city = City::where('id', $request->home_city)->value('ksei_name');
        $home_district = District::where('id', $request->home_district)->value('name');
        $home_subdistrict = SubDistrict::where('id', $request->home_subdistrict)->value('name');
        $home_zip = $request->home_zip;
      } else {
        $home_country = $request->home_country;
        $home_street_1 = $request->home_street_1;
        $home_street_2 = $request->home_street_2;
        $home_rt_rw = $request->home_rt_rw;
        $home_province = $request->home_province_text;
        $home_city = $request->home_city_text;
        $home_district = $request->home_district_text;
        $home_subdistrict = $request->home_subdistrict_text;
        $home_zip = $request->home_zip;
      }
    }

    $home_status = $request->home_status;
    $home_month = $request->home_month;
    if ($home_month) {
      if ($home_month < 10) {
        $home_month = "0" . strval($home_month);
      } else {
        $home_month = strval($home_month);
      }
    }
    $home_year = strval($request->home_year);

    $home_since = NULL;
    if ($home_month && $home_year) {
      $home_since = $home_month . "-" . $home_year;
    }

    $postal_preference = $request->postal_preference;

    $info_q1 = $request->info_q1;
    $info_q1_text = $request->info_q1_text;
    if (!$info_q1) {
      $info_q1_text = NULL;
    }
    $info_q2 = $request->info_q2;
    $info_q2_text = $request->info_q2_text;
    if (!$info_q2) {
      $info_q2_text = NULL;
    }
    $info_q3 = $request->info_q3;
    $info_q3_text = $request->info_q3_text;
    if (!$info_q3) {
      $info_q3_text = NULL;
    }

    // STEP 2
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

    $company_name = $request->company_name;
    $company_address = $request->company_address;
    $company_country = $request->company_country;
    $company_city = $request->company_city;
    $company_city_text = $request->company_city_text;
    $company_zip = $request->company_zip;

    if ($company_country !== 'INDONESIA') {
      $company_city = $company_city_text;
    }

    if ($request->company_phone_number) {
      $company_phone_country_code = str_replace("+", "", $request->company_phone_country_code);
      $company_phone_number = str_replace([' ', '-', '+'], "", $request->company_phone_number);
    } else {
      $company_phone_country_code = NULL;
      $company_phone_number = NULL;
    }
    if (strlen($company_phone_number) < 4) {
      $company_phone_country_code = NULL;
      $company_phone_number = NULL;
    }

    if ($request->company_fax_number) {
      $company_fax_country_code = str_replace("+", "", $request->company_fax_country_code);
      $company_fax_number = str_replace([' ', '-', '+'], "", $request->company_fax_number);
    } else {
      $company_fax_country_code = NULL;
      $company_fax_number = NULL;
    }
    if (strlen($company_fax_number) < 4) {
      $company_fax_country_code = NULL;
      $company_fax_number = NULL;
    }

    $company_email = $request->company_email;
    $work_year = $request->work_year;
    $work_month = $request->work_month;
    $income_yearly = $request->income_yearly;
    $income_source = $request->income_source;
    $income_source_other = $request->income_source_other;
    $extra_income_yearly = $request->extra_income_yearly;
    $extra_income_source = $request->extra_income_source;
    $extra_income_source_other = $request->extra_income_source_other;
    $objectives = implode(",", $request->objectives);
    $expenses_monthly = $request->expenses_monthly;
    $heir_name = $request->heir_name;
    $heir_relationship = $request->heir_relationship;

    $heir_address = $request->heir_address;
    $heir_country = $request->heir_country;
    $heir_city = $request->heir_city;
    $heir_city_text = $request->heir_city_text;
    if ($heir_country !== 'INDONESIA') {
      $heir_city = $heir_city_text;
    }
    $heir_zip = $request->heir_zip;
    if ($request->heir_mobile_number) {
      $heir_mobile_number = str_replace([' ', '-', '+'], "", $request->heir_mobile_number);
    } else {
      $heir_mobile_number = NULL;
    }
    if (strlen($heir_mobile_number) < 4) {
      $heir_mobile_number = NULL;
    }
    $heir_email = $request->heir_email;

    $bank_2_name = $request->bank_2_name;
    $bank_2_accname = $request->bank_2_accname;
    $bank_2_accnumber = $request->bank_2_accnumber;
    $bank_3_name = $request->bank_3_name;
    $bank_3_accname = $request->bank_3_accname;
    $bank_3_accnumber = $request->bank_3_accnumber;
    $fatca_holder = $request->fatca_holder;
    if ($fatca_holder == true) {
      $fatca_holder = 1;
    } else {
      $fatca_holder = 2;
    }
    $tin_ssn_number = $request->tin_ssn_number;
    $other_taxpayer = $request->other_taxpayer;
    if ($other_taxpayer == true) {
      $other_taxpayer = 1;
    } else {
      $other_taxpayer = 2;
    }

    // STEP 3
    $family_name = $request->family_name;
    $family_relation = $request->family_relation;
    $spouse_name = NULL;
    if ($family_relation == 'Suami' || $family_relation == 'Istri') {
      $spouse_name = $family_name;
    }
    $parent_name = NULL;
    if ($family_relation == 'Ayah' || $family_relation == 'Ibu') {
      $parent_name = $family_name;
    }
    $family_nationality = $request->family_nationality;

    $family_id_type = $request->family_id_type;
    $family_ktp_number = $request->family_ktp_number;
    $family_ktp_expired_lifetime = $request->family_ktp_expired_lifetime;
    $family_ktp_expired_date = NULL;
    if ($family_ktp_expired_lifetime) {
      $family_ktp_expired_date = '99999999';
    } else {
      $family_ktp_expired_day = $request->family_ktp_expired_day;
      if ($family_ktp_expired_day) {
        if ($family_ktp_expired_day < 10) {
          $family_ktp_expired_day = "0" . strval($family_ktp_expired_day);
        } else {
          $family_ktp_expired_day = strval($family_ktp_expired_day);
        }
      }

      $family_ktp_expired_month = $request->family_ktp_expired_month;
      if ($family_ktp_expired_month) {
        if ($family_ktp_expired_month < 10) {
          $family_ktp_expired_month = "0" . strval($family_ktp_expired_month);
        } else {
          $family_ktp_expired_month = strval($family_ktp_expired_month);
        }
      }

      $family_ktp_expired_year = strval($request->family_ktp_expired_year);
      if ($family_ktp_expired_day && $family_ktp_expired_month && $family_ktp_expired_year) {
        $family_ktp_expired_date = $family_ktp_expired_year . $family_ktp_expired_month . $family_ktp_expired_day;
      }
    }

    $family_passport_number = $request->family_passport_number;
    $family_passport_expired_day = $request->family_passport_expired_day;
    if ($family_passport_expired_day) {
      if ($family_passport_expired_day < 10) {
        $family_passport_expired_day = "0" . strval($family_passport_expired_day);
      } else {
        $family_passport_expired_day = strval($family_passport_expired_day);
      }
    }
    $family_passport_expired_month = $request->family_passport_expired_month;
    if ($family_passport_expired_month) {
      if ($family_passport_expired_month < 10) {
        $family_passport_expired_month = "0" . strval($family_passport_expired_month);
      } else {
        $family_passport_expired_month = strval($family_passport_expired_month);
      }
    }
    $family_passport_expired_year = strval($request->family_passport_expired_year);
    if ($family_passport_expired_day && $family_passport_expired_month && $family_passport_expired_year) {
      $family_passport_expired_date = $family_passport_expired_year . $family_passport_expired_month . $family_passport_expired_day;
    } else {
      $family_passport_expired_date = NULL;
    }

    $family_occupation_id_bca = $request->family_occupation_id_bca;
    $family_occupation_id_ksei = $request->family_occupation_id_ksei;
    $family_occupation = $request->family_occupation_name;
    $family_occupation_text = $request->family_occupation_text;
    if ($family_occupation_text) {
      $family_occupation = $family_occupation_text;
    }
    $family_job_position = Position::where('id', $request->family_job_position)->value('name');
    $family_job_position_text = $request->family_job_position_text;
    if ($family_job_position_text) {
      $family_job_position = $family_job_position_text;
    }
    $family_business_field = Business::where('id', $request->family_business_field)->value('name');
    $family_business_field_text = $request->family_business_field_text;
    if ($family_business_field_text) {
      $family_business_field = $family_business_field_text;
    }

    $family_company_name = $request->family_company_name;
    $family_company_address = $request->family_company_address;
    $family_company_country = $request->family_company_country;
    $family_company_city = $request->family_company_city;
    $family_company_city_text = $request->family_company_city_text;
    $family_company_zip = $request->family_company_zip;

    if ($family_company_country !== 'INDONESIA') {
      $family_company_city = $family_company_city_text;
    }

    if ($request->family_company_phone_number) {
      $family_company_phone_number = str_replace([' ', '-', '+'], "", $request->family_company_phone_number);
    } else {
      $family_company_phone_number = NULL;
    }
    if (strlen($family_company_phone_number) < 4) {
      $family_company_phone_number = NULL;
    }

    if ($request->family_company_fax_number) {
      $family_company_fax_number = str_replace([' ', '-', '+'], "", $request->family_company_fax_number);
    } else {
      $family_company_fax_number = NULL;
    }
    if (strlen($family_company_fax_number) < 4) {
      $family_company_fax_number = NULL;
    }

    $family_company_email = $request->family_company_email;
    $family_work_year = $request->family_work_year;
    $family_work_month = $request->family_work_month;
    $family_income_yearly = $request->family_income_yearly;
    $family_income_source = $request->family_income_source;
    $family_income_source_other = $request->family_income_source_other;
    $family_extra_income_yearly = $request->family_extra_income_yearly;
    $family_extra_income_source = $request->family_extra_income_source;
    $family_extra_income_source_other = $request->family_extra_income_source_other;

    $application_term = $request->application_term;
    if ($application_term) {
      $application_term = 1;
      $application_term_timestamp = date('Y-m-d H:i:s');
    } else {
      $application_term = 0;
      $application_term_timestamp = NULL;
    }

    $bca_term = $request->bca_term;
    if ($bca_term) {
      $bca_term = 1;
      $bca_term_timestamp = date('Y-m-d H:i:s');
    } else {
      $bca_term = 0;
      $bca_term_timestamp = NULL;
    }

    // STORE
    $storeData = OpenAccount::create([
      'full_name' => $full_name,
      'nationality' => $nationality,
      'id_type' => $id_type,
      'ktp_number' => $ktp_number,
      'ktp_expired_date' => $ktp_expired_date,
      'passport_number' => $passport_number,
      'passport_expired_date' => $passport_expired_date,
      'has_kitas' => $has_kitas,
      'kitas_number' => $kitas_number,
      'kitas_expired_date' => $kitas_expired_date,
      'has_npwp' => $has_npwp,
      'npwp_number' => $npwp_number,
      'npwp_issue_date' => $npwp_issue_date,
      'birth_country' => $birth_country,
      'birth_place' => $birth_place,
      'birth_date' => $birth_date,
      'gender' => $gender,
      'marital_status' => $marital_status,
      'religion' => $religion,
      'education' => $education,
      'mother_name' => $mother_name,
      'email' => $email,
      'mobile_country_code' => $mobile_country_code,
      'mobile_number' => $mobile_number,
      'phone_country_code' => $phone_country_code,
      'phone_number' => $phone_number,
      'id_country' => $id_country,
      'id_street_1' => $id_street_1,
      'id_street_2' => $id_street_2,
      'id_rt_rw' => $id_rt_rw,
      'id_province' => $id_province,
      'id_city' => $id_city,
      'id_district' => $id_district,
      'id_subdistrict' => $id_subdistrict,
      'id_zip' => $id_zip,
      'home_is_id' => $home_is_id,
      'home_country' => $home_country,
      'home_street_1' => $home_street_1,
      'home_street_2' => $home_street_2,
      'home_rt_rw' => $home_rt_rw,
      'home_province' => $home_province,
      'home_city' => $home_city,
      'home_district' => $home_district,
      'home_subdistrict' => $home_subdistrict,
      'home_zip' => $home_zip,
      'home_status' => $home_status,
      'home_since' => $home_since,
      'postal_preference' => $postal_preference,
      'info_q1' => $info_q1,
      'info_q1_text' => $info_q1_text,
      'info_q2' => $info_q2,
      'info_q2_text' => $info_q2_text,
      'info_q3' => $info_q3,
      'info_q3_text' => $info_q3_text,
      'occupation_id_bca' => $occupation_id_bca,
      'occupation_id_ksei' => $occupation_id_ksei,
      'occupation_name' => $occupation_name,
      'job_position' => $job_position,
      'business_field' => $business_field,
      'company_name' => $company_name,
      'company_address' => $company_address,
      'company_country' => $company_country,
      'company_city' => $company_city,
      'company_zip' => $company_zip,
      'company_phone_country_code' => $company_phone_country_code,
      'company_phone_number' => $company_phone_number,
      'company_fax_country_code' => $company_fax_country_code,
      'company_fax_number' => $company_fax_number,
      'company_email' => $company_email,
      'work_year' => $work_year,
      'work_month' => $work_month,
      'income_yearly' => $income_yearly,
      'income_source' => $income_source,
      'income_source_other' => $income_source_other,
      'extra_income_yearly' => $extra_income_yearly,
      'extra_income_source' => $extra_income_source,
      'extra_income_source_other' => $extra_income_source_other,
      'expenses_monthly' => $expenses_monthly,
      'objectives' => $objectives,
      'heir_name' => $heir_name,
      'heir_relationship' => $heir_relationship,
      'heir_address' => $heir_address,
      'heir_country' => $heir_country,
      'heir_city' => $heir_city,
      'heir_zip' => $heir_zip,
      'heir_mobile_number' => $heir_mobile_number,
      'heir_email' => $heir_email,
      'bank_2_name' => $bank_2_name,
      'bank_2_accname' => $bank_2_accname,
      'bank_2_accnumber' => $bank_2_accnumber,
      'bank_3_name' => $bank_3_name,
      'bank_3_accname' => $bank_3_accname,
      'bank_3_accnumber' => $bank_3_accnumber,
      'fatca_holder' => $fatca_holder,
      'tin_ssn_number' => $tin_ssn_number,
      'other_taxpayer' => $other_taxpayer,
      'spouse_name' => $spouse_name,
      'parent_name' => $parent_name,
      'family_relation' => $family_relation,
      'family_nationality' => $family_nationality,
      'family_id_type' => $family_id_type,
      'family_ktp_number' => $family_ktp_number,
      'family_ktp_expired_date' => $family_ktp_expired_date,
      'family_passport_number' => $family_passport_number,
      'family_passport_expired_date' => $family_passport_expired_date,
      'family_occupation' => $family_occupation,
      'family_job_position' => $family_job_position,
      'family_business_field' => $family_business_field,
      'family_company_name' => $family_company_name,
      'family_company_address' => $family_company_address,
      'family_company_country' => $family_company_country,
      'family_company_city' => $family_company_city,
      'family_company_zip' => $family_company_zip,
      'family_company_phone_number' => $family_company_phone_number,
      'family_company_fax_number' => $family_company_fax_number,
      'family_company_email' => $family_company_email,
      'family_work_year' => $family_work_year,
      'family_work_month' => $family_work_month,
      'family_income_yearly' => $family_income_yearly,
      'family_income_source' => $family_income_source,
      'family_income_source_other' => $family_income_source_other,
      'family_extra_income_yearly' => $family_extra_income_yearly,
      'family_extra_income_source' => $family_extra_income_source,
      'family_extra_income_source_other' => $family_extra_income_source_other,
      'application_term' => $application_term,
      'application_term_timestamp' => $application_term_timestamp,
      'bca_term' => $bca_term,
      'bca_term_timestamp' => $bca_term_timestamp,
    ]);


    // UPLOADS
    $temporaryKtp = TemporaryFile::where('folder', $request->upload_ktp)->first();
    if ($temporaryKtp) {
      $storeData->addMedia(storage_path('app/public/uploads/tmp/' . $request->upload_ktp . '/' . $temporaryKtp->filename))
        ->withCustomProperties(['mime-type' => 'image/jpeg'])
        ->toMediaCollection('uploads', 'uploads');
      rmdir(storage_path('app/public/uploads/tmp/' . $request->upload_ktp));
      $temporaryKtp->delete();
    }

    $temporaryPassport = TemporaryFile::where('folder', $request->upload_passport)->first();
    if ($temporaryPassport) {
      $storeData->addMedia(storage_path('app/public/uploads/tmp/' . $request->upload_passport . '/' . $temporaryPassport->filename))
        ->withCustomProperties(['mime-type' => 'image/jpeg'])
        ->toMediaCollection('uploads', 'uploads');
      rmdir(storage_path('app/public/uploads/tmp/' . $request->upload_passport));
      $temporaryPassport->delete();
    }

    $temporaryNpwp = TemporaryFile::where('folder', $request->upload_npwp)->first();
    if ($temporaryNpwp) {
      $storeData->addMedia(storage_path('app/public/uploads/tmp/' . $request->upload_npwp . '/' . $temporaryNpwp->filename))
        ->withCustomProperties(['mime-type' => 'image/jpeg'])
        ->toMediaCollection('uploads', 'uploads');
      rmdir(storage_path('app/public/uploads/tmp/' . $request->upload_npwp));
      $temporaryNpwp->delete();
    }

    if ($request->upload_signature) {
      $data_uri = $request->upload_signature;
      $encoded_image = explode(",", $data_uri)[1];
      $decoded_image = base64_decode($encoded_image);
      $storeData->addMediaFromBase64($encoded_image)
        ->withCustomProperties(['mime-type' => 'image/jpeg'])
        ->usingFileName('TandaTangan.jpg')
        ->toMediaCollection('uploads', 'uploads');
    }

    // RETURN
    return response()->json($storeData);
  }

  public function delete($id)
  {
    OpenAccount::destroy($id);

    return response()->json("ok");
  }
}
