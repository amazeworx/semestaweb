<?php

namespace App\Http\Livewire\OpenAccount;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\OpenAccount;
use App\Models\Country;
use App\Models\Province;
use App\Models\City;
use App\Models\District;
use App\Models\SubDistrict;
use App\Models\Occupation;
use App\Models\Position;
use App\Models\Business;
use App\Models\Bank;

class OpenAccountForm extends Component
{
  use WithFileUploads;

  public $currentStep = 1;
  public $countries, $provinces, $cities, $districts, $subDistricts;

  // Step 1
  public $nationality = NULL;
  public $fullName, $idType, $ktpNumber, $ktpExpiredDay, $ktpExpiredMonth, $ktpExpiredYear, $ktpExpiredLifetime, $passportNumber, $passportExpiredDay, $passportExpiredMonth, $passportExpiredYear, $hasNPWP, $npwpNumber, $npwpIssueDay, $npwpIssueMonth, $npwpIssueYear, $hasKitas, $kitasNumber, $kitasExpiredDay, $kitasExpiredMonth, $kitasExpiredYear, $gender, $birthCountry, $birthPlaces, $birthPlace, $birthPlaceForeign, $birthDay, $birthMonth, $birthYear, $maritalStatus, $religion, $education, $motherName;
  public $email, $mobileCountryCode, $mobileNumber, $phoneCountryCode, $phoneNumber;
  public $idStreet1, $idStreet2, $idProvince, $idProvinceText, $idCity, $idCityText, $idDistrict, $idDistrictText, $idSubDistrict, $idSubDistrictText, $idZip, $idRtRw;
  public $idCountry = NULL;
  public $idCities = [];
  public $idDistricts = [];
  public $idSubDistricts = [];
  public $homeIsId;
  public $homeStreet1, $homeStreet2, $homeProvince, $homeProvinceText, $homeCity, $homeCityText, $homeDistrict, $homeDistrictText, $homeSubDistrict, $homeSubDistrictText, $homeZip, $homeRtRw;
  public $homeCountry = NULL;
  public $homeCities = [];
  public $homeDistricts = [];
  public $homeSubDistricts = [];
  public $homeStatus, $homeMonth, $homeYear;
  public $postalPreference;
  public $confirmVia;
  public $infoQ1, $infoQ1Text, $infoQ2, $infoQ2Text, $infoQ3, $infoQ3Text;

  //Step 2
  public $occupations, $occupation, $occupationText, $occupationIsOther;
  public $jobPositions = [];
  public $jobPosition, $jobPositionText, $jobPositionIsText, $jobPositionIsOther;
  public $businessFields = [];
  public $businessField, $businessFieldText, $businessFieldIsText, $businessFieldIsOther;
  public $companyName;
  public $companyAddress, $companyCity, $companyCityText, $companyZip;
  public $companyCountry = NULL;
  public $companyCities = [];
  public $companyEmail, $companyPhoneNumber, $companyPhoneCountryCode, $companyFaxCountryCode, $companyFaxNumber, $workYear, $workMonth;
  public $incomeYearly, $incomeSource, $incomeSourceIsOther, $incomeSourceText;
  public $extraIncomeYearly, $extraIncomeSource, $extraIncomeSourceIsOther, $extraIncomeSourceText, $expensesMonthly;
  public $objectives = [];
  public $heirName, $heirRelationship, $heirAddress, $heirCity, $heirCityText, $heirZip, $heirEmail, $heirMobileNumber;
  public $heirCountry = NULL;
  public $heirCities = [];
  public $bankNames = [];
  public $bank2Name, $bank2AccName, $bank2AccNumber, $bank3Name, $bank3AccName, $bank3AccNumber;
  public $fatcaHolder, $fatcaTinSsn, $otherTaxPayer;

  // Step 3
  public $familyName, $familyRelation, $familyIdType, $familyKtpNumber, $familyKtpExpiredDay, $familyKtpExpiredMonth, $familyKtpExpiredYear, $familyKtpExpiredLifetime, $familyPassportNumber, $familyPassportExpiredDay, $familyPassportExpiredMonth, $familyPassportExpiredYear;
  public $familyNationality = NULL;
  public $familyOccupations, $familyOccupation, $familyOccupationText, $familyOccupationIsOther;
  public $familyJobPositions = [];
  public $familyJobPosition, $familyJobPositionText, $familyJobPositionIsText, $familyJobPositionIsOther;
  public $familyBusinessFields = [];
  public $familyBusinessField, $familyBusinessFieldText, $familyBusinessFieldIsText, $familyBusinessFieldIsOther;
  public $familyCompanyName;
  public $familyCompanyAddress, $familyCompanyCity, $familyCompanyCityText, $familyCompanyZip;
  public $familyCompanyCountry = NULL;
  public $familyCompanyCities = [];
  public $familyCompanyEmail, $familyCompanyPhoneNumber, $familyCompanyPhoneCountryCode, $familyCompanyFaxCountryCode, $familyCompanyFaxNumber, $familyWorkYear, $familyWorkMonth;
  public $familyIncomeYearly, $familyIncomeSource, $familyIncomeSourceIsOther, $familyIncomeSourceText;
  public $familyExtraIncomeYearly, $familyExtraIncomeSource, $familyExtraIncomeSourceIsOther, $familyExtraIncomeSourceText;

  // Step 4
  public $uploadKtp, $uploadPassport, $uploadNpwp, $uploadSignature;
  public $applicationTerm, $bcaTerm;

  public function mount()
  {
    $this->countries = Country::all();
    $this->provinces = Province::all();
    $this->cities = City::all();
    $this->nationality = 'INDONESIAN';
    $this->idType = 'KTP';
    $this->ktpExpiredDay = '';
    $this->ktpExpiredMonth = '';
    $this->ktpExpiredYear = '';
    $this->hasNPWP = "2";
    $this->npwpIssueDay = '';
    $this->npwpIssueMonth = '';
    $this->npwpIssueYear = '';
    $this->hasKitas = NULL;
    $this->kitasExpiredDay = '';
    $this->kitasExpiredMonth = '';
    $this->kitasExpiredYear = '';
    $this->birthCountry = 'ID';
    $this->birthPlaces = City::select('ksei_name')->whereNotIn('ksei_code', array(141, 142, 143, 144, 145))->distinct()->orderBy('ksei_name', 'asc')->get();
    $this->birthPlace = 'JAKARTA';
    $this->birthPlaceForeign = 'FOREIGN';
    $this->birthDay = '';
    $this->birthMonth = '';
    $this->birthYear = '';
    $this->gender = '';
    $this->maritalStatus = '2';
    $this->religion = '';
    $this->education = '';
    $this->motherName = '';
    $this->idCountry = 'INDONESIA';
    $this->homeCountry = 'INDONESIA';
    $this->homeIsId = false;
    $this->homeStatus = '';
    $this->homeMonth = '';
    $this->homeYear = '';
    $this->postalPreference = '';
    $this->confirmVia = '';
    $this->occupations = Occupation::all();
    $this->occupation = '';
    $this->occupationText = '';
    $this->jobPositionIsOther = false;
    $this->jobPosition = '';
    $this->jobPositionText = '';
    $this->jobPositionIsText = false;
    $this->jobPositionIsOther = false;
    $this->businessField = '';
    $this->businessFieldText = '';
    $this->businessFieldIsText = false;
    $this->businessFieldIsOther = false;
    $this->companyCountry = 'INDONESIA';
    $this->companyCities = City::select('ksei_name')->whereNotIn('ksei_code', array(141, 142, 143, 144, 145))->distinct()->orderBy('ksei_name', 'asc')->get();
    $this->companyCity = 'JAKARTA';
    $this->workYear = '';
    $this->workMonth = '';
    $this->incomeYearly = '';
    $this->incomeSource = '';
    $this->incomeSourceIsOther = false;
    $this->extraIncomeYearly = '';
    $this->extraIncomeSource = '';
    $this->extraIncomeSourceIsOther = false;
    $this->expensesMonthly = '';
    $this->heirCountry = 'INDONESIA';
    $this->heirCities = City::select('ksei_name')->whereNotIn('ksei_code', array(141, 142, 143, 144, 145))->distinct()->orderBy('ksei_name', 'asc')->get();
    $this->heirCity = 'JAKARTA';
    $this->bankNames = Bank::select('name')->whereNotIn('ksei_code', array(14))->orderBy('name', 'asc')->get();
    $this->bank2Name = 'BANK CENTRAL ASIA';
    $this->fatcaHolder = false;
    $this->otherTaxPayer = false;
    $this->familyRelation = '';
    $this->familyNationality = 'INDONESIAN';
    $this->familyIdType = 'KTP';
    $this->familyOccupations = Occupation::all();
    $this->familyOccupation = '';
    $this->familyOccupationText = '';
    $this->familyJobPositionIsOther = false;
    $this->familyJobPosition = '';
    $this->familyJobPositionText = '';
    $this->familyJobPositionIsText = false;
    $this->familyJobPositionIsOther = false;
    $this->familyBusinessField = '';
    $this->familyBusinessFieldText = '';
    $this->familyBusinessFieldIsText = false;
    $this->familyBusinessFieldIsOther = false;
    $this->familyCompanyCountry = 'INDONESIA';
    $this->familyCompanyCities = City::select('ksei_name')->whereNotIn('ksei_code', array(141, 142, 143, 144, 145))->distinct()->orderBy('ksei_name', 'asc')->get();
    $this->familyCompanyCity = 'JAKARTA';
    $this->familyWorkYear = '';
    $this->familyWorkMonth = '';
    $this->familyIncomeYearly = '';
    $this->familyIncomeSource = '';
    $this->familyIncomeSourceIsOther = false;
    $this->familyExtraIncomeYearly = '';
    $this->familyExtraIncomeSource = '';
    $this->familyExtraIncomeSourceIsOther = false;
    $this->applicationTerm = false;
    $this->bcaTerm = false;
  }

  public function render()
  {
    if (!empty($this->idProvince)) {
      $this->idCities = City::where('province_id', $this->idProvince)->whereNotIn('ksei_code', array(251))->orderBy('name', 'asc')->get();
    }
    if (!empty($this->idCity)) {
      $this->idDistricts = District::where('city_id', $this->idCity)->orderBy('name', 'asc')->get();
    }
    if (!empty($this->idDistrict)) {
      $this->idSubDistricts = SubDistrict::where('district_id', $this->idDistrict)->orderBy('name', 'asc')->get();
    }
    if (!empty($this->homeProvince)) {
      $this->homeCities = City::where('province_id', $this->homeProvince)->get();
    }
    if (!empty($this->homeCity)) {
      $this->homeDistricts = District::where('city_id', $this->homeCity)->get();
    }
    if (!empty($this->homeDistrict)) {
      $this->homeSubDistricts = SubDistrict::where('district_id', $this->homeDistrict)->get();
    }
    if (!empty($this->occupation)) {
      $occupation_id = Occupation::find($this->occupation);
      $jobPositionsArr = $this->jobPositions = $occupation_id->positions()->distinct()->get();
      if (count($jobPositionsArr) === 1) {
        $this->jobPositionIsText = false;
        $this->jobPosition = $jobPositionsArr[0]->id;
        $this->setBusinessField($this->jobPosition);
      } else if (count($jobPositionsArr) === 0) {
        $this->jobPositionIsText = true;
        $this->businessFieldIsText = true;
      } else {
        $this->jobPositionIsText = false;
        $this->businessFieldIsText = false;
      }
    }
    if (!empty($this->jobPosition)) {
      $this->setBusinessField($this->jobPosition);
      if ($this->jobPosition == 99) {
        $this->jobPositionIsOther = true;
      } else {
        $this->jobPositionIsOther = false;
      }
    }
    if (!empty($this->businessField)) {
      if ($this->businessField == 99) {
        $this->businessFieldIsOther = true;
      } else {
        $this->businessFieldIsOther = false;
      }
    }
    if (!empty($this->familyOccupation)) {
      $occupation_id = Occupation::find($this->familyOccupation);
      $familyJobPositionsArr = $this->familyJobPositions = $occupation_id->positions()->distinct()->get();
      if (count($familyJobPositionsArr) === 1) {
        $this->familyJobPositionIsText = false;
        $this->familyJobPosition = $familyJobPositionsArr[0]->id;
        $this->setFamilyBusinessField($this->familyJobPosition);
      } else if (count($familyJobPositionsArr) === 0) {
        $this->familyJobPositionIsText = true;
        $this->familyBusinessFieldIsText = true;
      } else {
        $this->familyJobPositionIsText = false;
        $this->familyBusinessFieldIsText = false;
      }
    }
    if (!empty($this->familyJobPosition)) {
      $this->setFamilyBusinessField($this->familyJobPosition);
      if ($this->familyJobPosition == 99) {
        $this->familyJobPositionIsOther = true;
      } else {
        $this->familyJobPositionIsOther = false;
      }
    }
    if (!empty($this->familyBusinessField)) {
      if ($this->familyBusinessField == 99) {
        $this->familyBusinessFieldIsOther = true;
      } else {
        $this->familyBusinessFieldIsOther = false;
      }
    }

    return view('livewire.open-account.open-account-form')
      ->layout('layouts.open-account');
  }

  public function setBusinessField($position)
  {
    $position_id = Position::find($position);
    $businessFieldsArr = $this->businessFields = $position_id->businesses()->where('occupation_id', $this->occupation)->distinct()->get();
    if (count($businessFieldsArr) === 1) {
      $this->businessFieldIsText = false;
      $this->businessField = $this->businessFields[0]->id;
    } else if (count($businessFieldsArr) === 0) {
      $this->businessFieldIsText = true;
    } else {
      $this->businessFieldIsText = false;
    }
  }

  public function setFamilyBusinessField($position)
  {
    $position_id = Position::find($position);
    $familyBusinessFieldsArr = $this->familyBusinessFields = $position_id->businesses()->where('occupation_id', $this->familyOccupation)->distinct()->get();
    if (count($familyBusinessFieldsArr) === 1) {
      $this->familyBusinessFieldIsText = false;
      $this->familyBusinessField = $this->familyBusinessFields[0]->id;
    } else if (count($familyBusinessFieldsArr) === 0) {
      $this->familyBusinessFieldIsText = true;
    } else {
      $this->familyBusinessFieldIsText = false;
    }
  }

  public function updated($property)
  {
    $this->validateOnly($property);
  }

  public function back($step)
  {
    $this->currentStep = $step;
  }

  public function clearForm()
  {
    $this->fullName = '';
    $this->nationality = '';
    $this->ktpNumber = '';
    $this->email = '';
    $this->motherName = '';
  }

  public function updatedKtpExpiredLifetime($ktpExpiredLifetime)
  {
    if ($ktpExpiredLifetime) {
      $this->ktpExpiredDay = '';
      $this->ktpExpiredMonth = '';
      $this->ktpExpiredYear = '';
    }
  }

  public function updatedFamilyKtpExpiredLifetime($familyKtpExpiredLifetime)
  {
    if ($familyKtpExpiredLifetime) {
      $this->familyKtpExpiredDay = '';
      $this->familyKtpExpiredMonth = '';
      $this->familyKtpExpiredYear = '';
    }
  }

  public function updatedHasKitas($hasKitas)
  {
    if ($hasKitas !== '1') {
      $this->kitasNumber = '';
      $this->kitasExpiredDay = '';
      $this->kitasExpiredMonth = '';
      $this->kitasExpiredYear = '';
    }
  }

  public function updatedOccupation()
  {
    $this->jobPosition = '';
    $this->businessField = '';
    $this->jobPositions = [];
    $this->businessFields = [];
    $this->jobPositionIsText = false;
    $this->jobPositionIsOther = false;
    $this->businessFieldIsText = false;
    $this->businessFieldIsOther = false;
    if ($this->occupation == 18) {
      $this->occupationIsOther = true;
    } else {
      $this->occupationIsOther = false;
    }
  }

  public function dehydrateOccupation()
  {
    $jobPositionsArr = $this->jobPositions;
    if (count($jobPositionsArr) === 1) {
      $this->jobPosition = $this->jobPositions[0]->id;
    } else if (count($jobPositionsArr) === 0) {
      $this->jobPosition = '';
    }
  }

  public function dehydrateJobPosition()
  {
    $businessFieldsArr = $this->businessFields;
    if (count($businessFieldsArr) === 1) {
      $this->businessField = $this->businessFields[0]->id;
    } else if (count($businessFieldsArr) === 0) {
      $this->businessField = '';
    }
  }

  public function updatedFamilyOccupation()
  {
    $this->familyJobPosition = '';
    $this->familyBusinessField = '';
    $this->familyJobPositions = [];
    $this->familyBusinessFields = [];
    $this->familyJobPositionIsText = false;
    $this->familyJobPositionIsOther = false;
    $this->familyBusinessFieldIsText = false;
    $this->familyBusinessFieldIsOther = false;
    if ($this->familyOccupation == 18) {
      $this->familyOccupationIsOther = true;
    } else {
      $this->familyOccupationIsOther = false;
    }
  }

  public function dehydrateFamilyOccupation()
  {
    $jobPositionsArr = $this->familyJobPositions;
    if (count($jobPositionsArr) === 1) {
      $this->familyJobPosition = $this->familyJobPositions[0]->id;
    } else if (count($jobPositionsArr) === 0) {
      $this->familyJobPosition = '';
    }
  }

  public function dehydrateFamilyJobPosition()
  {
    $familyBusinessFieldsArr = $this->familyBusinessFields;
    if (count($familyBusinessFieldsArr) === 1) {
      $this->familyBusinessField = $this->familyBusinessFields[0]->id;
    } else if (count($familyBusinessFieldsArr) === 0) {
      $this->familyBusinessField = '';
    }
  }

  public function updatedIncomeSource()
  {
    if ($this->incomeSource == 1) {
      $this->incomeSourceIsOther = true;
    } else {
      $this->incomeSourceIsOther = false;
    }
  }

  public function updatedExtraIncomeSource()
  {
    if ($this->extraIncomeSource == 1) {
      $this->extraIncomeSourceIsOther = true;
    } else {
      $this->extraIncomeSourceIsOther = false;
    }
  }

  protected $validationAttributes = [
    'fullName' => 'Nama lengkap',
    'nationality' => 'Kewarganegaraan',
    'idType' => 'Jenis Kartu Identitas',
    'ktpNumber' => 'Nomor KTP (NIK)',
    'ktpExpiredDay' => 'Tanggal Masa Berlaku',
    'ktpExpiredMonth' => 'Bulan Masa Berlaku',
    'ktpExpiredYear' => 'Tahun Masa Berlaku',
    'ktpExpiredLifetime' => 'Masa Berlaku',
    'passportNumber' => 'Nomor Paspor',
    'passportExpiredDay' => 'Tanggal Masa Berlaku',
    'passportExpiredMonth' => 'Bulan Masa Berlaku',
    'passportExpiredYear' => 'Tahun Masa Berlaku',
    'hasKitas' => 'KITAS/SKD',
    'kitasNumber' => 'Nomor KITAS/SKD',
    'kitasExpiredDay' => 'Tanggal Masa Berlaku',
    'kitasExpiredMonth' => 'Bulan Masa Berlaku',
    'kitasExpiredYear' => 'Tahun Masa Berlaku',
    'hasNPWP' => 'NPWP',
    'npwpNumber' => 'Nomor NPWP',
    'npwpIssueDay' => 'Tanggal Penerbitan',
    'npwpIssueMonth' => 'Bulan Penerbitan',
    'npwpIssueYear' => 'Tahun Penerbitan',
    'birthCountry' => 'Negara Lahir',
    'birthPlace' => 'Kota Lahir',
    'birthDay' => 'Tanggal Lahir',
    'birthMonth' => 'Bulan Lahir',
    'birthYear' => 'Tahun Lahir',
    'gender' => 'Jenis Kelamin',
    'maritalStatus' => 'Status Perkawinan',
    'religion' => 'Agama',
    'education' => 'Pendidikan',
    'motherName' => 'Nama Gadis Ibu Kandung',
    'email' => 'Email',
    'mobileNumber' => 'Nomor Handphone',
    'phoneNumber' => 'Nomor Telepon Rumah',
    'idCountry' => 'Negara',
    'idStreet1' => 'Nama Jalan',
    'idStreet2' => 'Nama Gedung/Apartemen/Kluster/Komplek',
    'idProvince' => 'Provinsi',
    'idProvinceText' => 'Province',
    'idCity' => 'Kota/Kabupaten',
    'idCityText' => 'City',
    'idDistrict' => 'Kecamatan',
    'idDistrictText' => 'District',
    'idSubDistrict' => 'Kelurahan',
    'idSubDistrictText' => 'Sub District',
    'idZip' => 'Kode Pos',
    'idRtRw' => 'RT/RW',
    'homeCountry' => 'Negara',
    'homeStreet1' => 'Nama Jalan',
    'homeStreet2' => 'Nama Gedung/Apartemen/Kluster/Komplek',
    'homeProvince' => 'Provinsi',
    'homeProvinceText' => 'Province',
    'homeCity' => 'Kota/Kabupaten',
    'homeCityText' => 'City',
    'homeDistrict' => 'Kecamatan',
    'homeDistrictText' => 'District',
    'homeSubDistrict' => 'Kelurahan',
    'homeSubDistrictText' => 'Sub District',
    'homeZip' => 'Kode Pos',
    'homeRtRw' => 'RT/RW',
    'homeStatus' => 'Status Tempat Tinggal',
    'homeMonth' => 'Bulan Menempati',
    'homeYear' => 'Tahun Menempati',
    'postalPreference' => 'Alamat Korespondensi',
    'confirmVia' => 'Pengiriman Konfirmasi',
    'infoQ1Text' => 'Informasi Tambahan',
    'infoQ2Text' => 'Informasi Tambahan',
    'infoQ3Text' => 'Informasi Tambahan',
    'occupation' => 'Pekerjaan',
    'occupationText' => 'Pekerjaan',
    'jobPosition' => 'Jabatan/Pangkat',
    'jobPositionText' => 'Jabatan/Pangkat',
    'businessField' => 'Bidang Usaha',
    'businessFieldText' => 'Bidang Usaha',
    'companyName' => 'Nama Perusahaan/Kantor',
    'companyAddress' => 'Alamat Perusahaan/Kantor',
    'companyCountry' => 'Negara',
    'companyCity' => 'Kota',
    'companyCityText' => 'Kota',
    'companyZip' => 'Kode Pos',
    'incomeYearly' => 'Penghasilan Utama Kotor/thn',
    'incomeSource' => 'Sumber Penghasilan Utama',
    'incomeSourceText' => 'Sumber Penghasilan Utama',
    'extraIncomeYearly' => 'Penghasilan Tambahan Kotor/thn',
    'extraIncomeSource' => 'Sumber Penghasilan Tambahan',
    'extraIncomeSourceText' => 'Sumber Penghasilan Tambahan',
    'objectives' => 'Tujuan Investasi',
    'heirName' => 'Nama Ahli Waris',
    'heirRelationship' => 'Hubungan',
    'heirAddress' => 'Alamat',
    'heirCountry' => 'Negara',
    'heirCity' => 'Kota',
    'heirCityText' => 'Kota',
    'heirZip' => 'Kode Pos',
    'heirMobileNumber' => 'Nomor Handphone',
    'heirEmail' => 'Alamat Email',
    'bank2Name' => 'Bank BCA',
    'bank2AccName' => 'Nama Rekening BCA',
    'bank2AccNumber' => 'Nomor Rekening BCA',
    'bank3Name' => 'Nama Bank',
    'bank3AccName' => 'Nama Rekening',
    'bank3AccNumber' => 'Nomor Rekening',
    'fatcaTinSsn' => 'TIN/SSN',
    'bank3AccNumber' => 'Nomor Rekening',
    'familyName' => 'Nama',
    'familyRelation' => 'Hubungan',
    'familyNationality' => 'Kewarganegaraan',
    'familyIdType' => 'Jenis Kartu Identitas',
    'familyKtpNumber' => 'Nomor KTP (NIK)',
    'familyKtpExpiredDay' => 'Tanggal Masa Berlaku',
    'familyKtpExpiredMonth' => 'Bulan Masa Berlaku',
    'familyKtpExpiredYear' => 'Tahun Masa Berlaku',
    'familyKtpExpiredLifetime' => 'Masa Berlaku',
    'familyPassportNumber' => 'Nomor Paspor',
    'familyPassportExpiredDay' => 'Tanggal Masa Berlaku',
    'familyPassportExpiredMonth' => 'Bulan Masa Berlaku',
    'familyPassportExpiredYear' => 'Tahun Masa Berlaku',
    'familyOccupation' => 'Pekerjaan',
    'familyOccupationText' => 'Pekerjaan',
    'familyJobPosition' => 'Jabatan/Pangkat',
    'familyJobPositionText' => 'Jabatan/Pangkat',
    'familyBusinessField' => 'Bidang Usaha',
    'familyBusinessFieldText' => 'Bidang Usaha',
    'familyCompanyName' => 'Nama Perusahaan/Kantor',
    'familyCompanyAddress' => 'Alamat Perusahaan/Kantor',
    'familyCompanyCountry' => 'Negara',
    'familyCompanyCity' => 'Kota',
    'familyCompanyCityText' => 'Kota',
    'familyCompanyZip' => 'Kode Pos',
    'familyIncomeYearly' => 'Penghasilan Utama Kotor/thn',
    'familyIncomeSource' => 'Sumber Penghasilan Utama',
    'familyIncomeSourceText' => 'Sumber Penghasilan Utama',
    'familyExtraIncomeYearly' => 'Penghasilan Tambahan Kotor/thn',
    'familyExtraIncomeSource' => 'Sumber Penghasilan Tambahan',
    'familyExtraIncomeSourceText' => 'Sumber Penghasilan Tambahan',
    'uploadKtp' => 'Upload KTP',
    'uploadPassport' => 'Upload Paspor',
    'uploadNpwp' => 'Upload NPWP',
    'applicationTerm' => 'Pernyataan Pembukaan Rekening Efek',
    'bcaTerm' => 'Pernyataan Nasabah RDN BCA',
    'uploadSignature' => 'Tanda Tangan'
  ];

  protected $rules = [
    'fullName' => 'required|min:4',
    'nationality' => 'required',
    'idType' => 'required',
    'ktpNumber' => 'required_if:idType,KTP|numeric|digits:16',
    'ktpExpiredDay' => 'required_unless:ktpExpiredLifetime,true',
    'ktpExpiredMonth' => 'required_unless:ktpExpiredLifetime,true',
    'ktpExpiredYear' => 'required_unless:ktpExpiredLifetime,true',
    'passportNumber' => 'required_if:idType,Paspor',
    'passportExpiredDay' => 'required_if:idType,Paspor',
    'passportExpiredMonth' => 'required_if:idType,Paspor',
    'passportExpiredYear' => 'required_if:idType,Paspor',
    'hasKitas' => 'required_unless:nationality,INDONESIA',
    'kitasNumber' => 'required_if:hasKitas,1',
    'kitasExpiredDay' => 'required_if:hasKitas,1',
    'kitasExpiredMonth' => 'required_if:hasKitas,1',
    'kitasExpiredYear' => 'required_if:hasKitas,1',
    'hasNPWP' => 'required',
    'npwpNumber' => 'required_unless:hasNPWP,1|numeric',
    'npwpIssueDay' => 'required_unless:hasNPWP,1',
    'npwpIssueMonth' => 'required_unless:hasNPWP,1',
    'npwpIssueYear' => 'required_unless:hasNPWP,1',
    'birthCountry' => 'required',
    'birthPlace' => 'required_if:birthCountry,ID',
    'birthDay' => 'required',
    'birthMonth' => 'required',
    'birthYear' => 'required',
    'gender' => 'required',
    'maritalStatus' => 'required',
    'religion' => 'required',
    'education' => 'required',
    'motherName' => 'required',
    'email' => 'required',
    'mobileNumber' => 'required',
    'idCountry' => 'required',
    'idStreet1' => 'required',
    'idRtRw' => 'required_if:idCountry,INDONESIA',
    'idProvince' => 'required_if:idCountry,INDONESIA',
    'idProvinceText' => 'required_if:idCountry,INDONESIA',
    'idCity' => 'required_if:idCountry,INDONESIA',
    'idCityText' => 'required_unless:idCountry,INDONESIA',
    'idDistrict' => 'required_if:idCountry,INDONESIA',
    'idDistrictText' => 'required_unless:idCountry,INDONESIA',
    'idSubDistrict' => 'required_if:idCountry,INDONESIA',
    'idSubDistrictText' => 'required_unless:idCountry,INDONESIA',
    'idZip' => 'required_if:idCountry,INDONESIA',
    'homeCountry' => 'required_if:homeIsId,false',
    'homeStreet1' => 'required_if:homeIsId,false',
    'homeRtRw' => 'required_if:homeCountry,INDONESIA',
    'homeProvince' => 'required_if:homeCountry,INDONESIA',
    'homeProvinceText' => 'required_unless:homeCountry,INDONESIA',
    'homeCity' => 'required_if:homeCountry,INDONESIA',
    'homeCityText' => 'required_unless:homeCountry,INDONESIA',
    'homeDistrict' => 'required_if:homeCountry,INDONESIA',
    'homeDistrictText' => 'required_unless:homeCountry,INDONESIA',
    'homeSubDistrict' => 'required_if:homeCountry,INDONESIA',
    'homeSubDistrictText' => 'required_unless:homeCountry,INDONESIA',
    'homeZip' => 'required_if:homeCountry,INDONESIA',
    'homeStatus' => 'required',
    'postalPreference' => 'required',
    'confirmVia' => 'required',
    'infoQ1Text' => 'required_if:infoQ1,true',
    'infoQ2Text' => 'required_if:infoQ2,true',
    'infoQ3Text' => 'required_if:infoQ3,true',
    'occupation' => 'required',
    'occupationText' => 'required_if:occupationIsOther,true',
    'jobPosition' => 'required',
    'jobPositionText' => 'required_if:jobPositionIsOther,true',
    'businessField' => 'required',
    'businessFieldText' => 'required_if:businessFieldIsOther,true',
    'companyName' => 'required',
    'companyAddress' => 'required',
    'companyCountry' => 'required',
    'companyCity' => 'required_if:companyCountry,INDONESIA',
    'companyCityText' => 'required_unless:companyCountry,INDONESIA',
    'companyZip' => 'required',
    'incomeYearly' => 'required',
    'incomeSource' => 'required',
    'incomeSourceText' => 'required_if:incomeSource,1',
    'objectives' => 'required',
    'heirName' => 'required',
    'heirRelationship' => 'required',
    'heirAddress' => 'required',
    'heirCountry' => 'required',
    'heirCity' => 'required',
    'heirCityText' => 'required_unless:heirCountry,INDONESIA',
    'heirZip' => 'required',
    'bank2Name' => 'required',
    'bank2AccName' => 'required_if:bank2Name,BANK CENTRAL ASIA',
    'bank2AccNumber' => 'required_if:bank2Name,BANK CENTRAL ASIA',
    'fatcaTinSsn' => 'required_if:fatcaHolder,true',
    'familyName' => 'required',
    'familyRelation' => 'required_with:familyName',
    'familyNationality' => 'required_with:familyName',
    'familyIdType' => 'required_with:familyName',
    'familyKtpNumber' => 'required_if:familyIdType,KTP|numeric|digits:16',
    'familyKtpExpiredDay' => 'required_unless:familyKtpExpiredLifetime,true',
    'familyKtpExpiredMonth' => 'required_unless:familyKtpExpiredLifetime,true',
    'familyKtpExpiredYear' => 'required_unless:familyKtpExpiredLifetime,true',
    'familyPassportNumber' => 'required_if:familyIdType,Paspor',
    'familyPassportExpiredDay' => 'required_if:familyIdType,Paspor',
    'familyPassportExpiredMonth' => 'required_if:familyIdType,Paspor',
    'familyPassportExpiredYear' => 'required_if:familyIdType,Paspor',
    'familyOccupation' => 'required',
    'familyOccupationText' => 'required_if:familyOccupationIsOther,true',
    'familyJobPosition' => 'required',
    'familyJobPositionText' => 'required_if:familyJobPositionIsOther,true',
    'familyBusinessField' => 'required',
    'familyBusinessFieldText' => 'required_if:familyBusinessFieldIsOther,true',
    'familyCompanyName' => 'required',
    'familyCompanyAddress' => 'required',
    'familyCompanyCountry' => 'required',
    'familyCompanyCity' => 'required_if:familyCompanyCountry,INDONESIA',
    'familyCompanyCityText' => 'required_unless:familyCompanyCountry,INDONESIA',
    'familyCompanyZip' => 'required',
    'familyIncomeYearly' => 'required',
    'familyIncomeSource' => 'required',
    'familyIncomeSourceText' => 'required_if:familyIncomeSource,1',
    'uploadKtp' => 'required_if:idType,KTP',
    'uploadPassport' => 'required_if:idType,Paspor',
    'uploadNpwp' => 'required_unless:hasNPWP,1',
    'applicationTerm' => 'accepted',
    'bcaTerm' => 'accepted',
    'uploadSignature' => 'required'
  ];

  public function submit($currentStep)
  {

    if ($this->ktpExpiredLifetime) {
      $ktp_expired_date = '99999999';
    } else {
      $ktp_expired_day = $this->ktpExpiredDay;
      if ($ktp_expired_day) {
        if ($ktp_expired_day < 10) {
          $ktp_expired_day = "0" . strval($ktp_expired_day);
        } else {
          $ktp_expired_day = strval($ktp_expired_day);
        }
      }

      $ktp_expired_month = $this->ktpExpiredMonth;
      if ($ktp_expired_month) {
        if ($ktp_expired_month < 10) {
          $ktp_expired_month = "0" . strval($ktp_expired_month);
        } else {
          $ktp_expired_month = strval($ktp_expired_month);
        }
      }

      $ktp_expired_year = strval($this->ktpExpiredYear);
      if ($ktp_expired_day && $ktp_expired_month && $ktp_expired_year) {
        $ktp_expired_date = $ktp_expired_year . $ktp_expired_month . $ktp_expired_day;
      } else {
        $ktp_expired_date = NULL;
      }
    }

    $passport_expired_day = $this->passportExpiredDay;
    if ($passport_expired_day) {
      if ($passport_expired_day < 10) {
        $passport_expired_day = "0" . strval($passport_expired_day);
      } else {
        $passport_expired_day = strval($passport_expired_day);
      }
    }
    $passport_expired_month = $this->passportExpiredMonth;
    if ($passport_expired_month) {
      if ($passport_expired_month < 10) {
        $passport_expired_month = "0" . strval($passport_expired_month);
      } else {
        $passport_expired_month = strval($passport_expired_month);
      }
    }
    $passport_expired_year = strval($this->passportExpiredYear);
    if ($passport_expired_day && $passport_expired_month && $passport_expired_year) {
      $passport_expired_date = $passport_expired_year . $passport_expired_month . $passport_expired_day;
    } else {
      $passport_expired_date = NULL;
    }

    $npwp_issue_day = $this->npwpIssueDay;
    if ($npwp_issue_day) {
      if ($npwp_issue_day < 10) {
        $npwp_issue_day = "0" . strval($npwp_issue_day);
      } else {
        $npwp_issue_day = strval($npwp_issue_day);
      }
    }
    $npwp_issue_month = $this->npwpIssueMonth;
    if ($npwp_issue_month) {
      if ($npwp_issue_month < 10) {
        $npwp_issue_month = "0" . strval($npwp_issue_month);
      } else {
        $npwp_issue_month = strval($npwp_issue_month);
      }
    }
    $npwp_issue_year = strval($this->npwpIssueYear);
    if ($npwp_issue_day && $npwp_issue_month && $npwp_issue_year) {
      $npwp_issue_date = $npwp_issue_year . $npwp_issue_month . $npwp_issue_day;
    } else {
      $npwp_issue_date = NULL;
    }

    $kitas_expired_day = $this->kitasExpiredDay;
    if ($kitas_expired_day) {
      if ($kitas_expired_day < 10) {
        $kitas_expired_day = "0" . strval($kitas_expired_day);
      } else {
        $kitas_expired_day = strval($kitas_expired_day);
      }
    }
    $kitas_expired_month = $this->kitasExpiredMonth;
    if ($kitas_expired_month) {
      if ($kitas_expired_month < 10) {
        $kitas_expired_month = "0" . strval($kitas_expired_month);
      } else {
        $kitas_expired_month = strval($kitas_expired_month);
      }
    }
    $kitas_expired_year = strval($this->kitasExpiredYear);
    if ($kitas_expired_day && $kitas_expired_month && $kitas_expired_year) {
      $kitas_expired_date = $kitas_expired_year . $kitas_expired_month . $kitas_expired_day;
    } else {
      $kitas_expired_date = NULL;
    }

    $birth_day = $this->birthDay;
    if ($birth_day) {
      if ($birth_day < 10) {
        $birth_day = "0" . strval($birth_day);
      } else {
        $birth_day = strval($birth_day);
      }
    }
    $birth_month = $this->birthMonth;
    if ($birth_month) {
      if ($birth_month < 10) {
        $birth_month = "0" . strval($birth_month);
      } else {
        $birth_month = strval($birth_month);
      }
    }
    $birth_year = strval($this->birthYear);
    if ($birth_day && $birth_month && $birth_year) {
      $birth_date = $birth_year . $birth_month . $birth_day;
    } else {
      $birth_date = NULL;
    }

    if ($this->nationality !== 'INDONESIAN') {
      $birth_place = $this->birthPlaceForeign;
    } else {
      $birth_place = $this->birthPlace;
    }

    $mobile_country_code = str_replace("+", "", $this->mobileCountryCode);
    $mobile_number = str_replace("+", "", $this->mobileNumber);

    $phone_country_code = str_replace("+", "", $this->phoneCountryCode);
    $phone_number = str_replace("+", "", $this->phoneNumber);

    if ($this->idCountry === 'INDONESIA') {
      $id_province = Province::where('id', $this->idProvince)->value('ksei_name');
      $id_city = City::where('id', $this->idCity)->value('ksei_name');
      $id_district = District::where('id', $this->idDistrict)->value('name');
      $id_subdistrict = SubDistrict::where('id', $this->idSubDistrict)->value('name');
    } else {
      $id_province = $this->idProvinceText;
      $id_city = $this->idCityText;
      $id_district = $this->idDistrictText;
      $id_subdistrict = $this->idSubDistrictText;
    }

    if ($this->homeCountry === 'INDONESIA') {
      $home_province = Province::where('id', $this->homeProvince)->value('ksei_name');
      $home_city = City::where('id', $this->homeCity)->value('ksei_name');
      $home_district = District::where('id', $this->homeDistrict)->value('name');
      $home_subdistrict = SubDistrict::where('id', $this->homeSubDistrict)->value('name');
    } else {
      $home_province = $this->homeProvinceText;
      $home_city = $this->homeCityText;
      $home_district = $this->homeDistrictText;
      $home_subdistrict = $this->homeSubDistrictText;
    }

    $home_month = $this->homeMonth;
    if ($home_month) {
      if ($home_month < 10) {
        $home_month = "0" . strval($home_month);
      } else {
        $home_month = strval($home_month);
      }
    }
    $home_year = strval($this->homeYear);

    if ($home_month && $home_year) {
      $home_since = $home_month . "-" . $home_year;
    }


    $occupation_id = $this->occupation;
    $occupation_id_bca = $occupation_id;
    $occupation_id_ksei = Occupation::where('id', $occupation_id)->value('ksei_code');
    $occupation_name = Occupation::where('id', $occupation_id)->value('name');
    if ($occupation_id == 18) {
      $occupation_name = $this->occupationText;
    } else {
      $occupation_name = Occupation::where('id', $occupation_id)->value('name');
    }

    $job_position_id = $this->jobPosition;
    $job_position_text = $this->jobPositionText;
    if ($job_position_text) {
      $job_position = $job_position_text;
    } else {
      $job_position = Position::where('id', $job_position_id)->value('name');
    }

    $business_field_id = $this->businessField;
    $business_field_text = $this->businessFieldText;
    if ($business_field_text) {
      $business_field = $business_field_text;
    } else {
      $business_field = Business::where('id', $business_field_id)->value('name');
    }

    $company_city_text = $this->companyCityText;
    if ($company_city_text) {
      $company_city = $company_city_text;
    } else {
      $company_city = $this->companyCity;
    }

    $company_fax_country_code = str_replace("+", "", $this->companyFaxCountryCode);
    $company_fax_number = str_replace("+", "", $this->companyFaxNumber);

    $company_phone_country_code = str_replace("+", "", $this->companyPhoneCountryCode);
    $company_phone_number = str_replace("+", "", $this->companyPhoneNumber);

    $objectives = implode(",", $this->objectives);

    $heir_city_text = $this->heirCityText;
    if ($heir_city_text) {
      $heir_city = $heir_city_text;
    } else {
      $heir_city = $this->heirCity;
    }

    $heir_mobile_number = str_replace("+", "", $this->heirMobileNumber);

    $bank_2_name = $this->bank2Name;
    $bca_existing_account = $this->bank2AccNumber;
    if ($bank_2_name !== 'BANK CENTRAL ASIA') {
      $bank_2_name = NULL;
      $bca_existing_account = NULL;
    }

    $fatca_holder = $this->fatcaHolder;
    if ($fatca_holder == true) {
      $fatca_holder = 1;
    } else {
      $fatca_holder = 2;
    }

    $other_tax_payer = $this->otherTaxPayer;
    if ($this->otherTaxPayer == true) {
      $other_tax_payer = 1;
    } else {
      $other_tax_payer = 2;
    }

    $spouse_name = '';
    if ($this->familyRelation == 'Suami' || $this->familyRelation == 'Istri') {
      $spouse_name = $this->familyName;
    }

    $parent_name = '';
    if ($this->familyRelation == 'Ayah' || $this->familyRelation == 'Ibu') {
      $parent_name = $this->familyName;
    }

    if ($this->familyKtpExpiredLifetime) {
      $family_ktp_expired_date = '99999999';
    } else {
      $family_ktp_expired_day = $this->familyKtpExpiredDay;
      if ($family_ktp_expired_day) {
        if ($family_ktp_expired_day < 10) {
          $family_ktp_expired_day = "0" . strval($family_ktp_expired_day);
        } else {
          $family_ktp_expired_day = strval($family_ktp_expired_day);
        }
      }

      $family_ktp_expired_month = $this->familyKtpExpiredMonth;
      if ($family_ktp_expired_month) {
        if ($family_ktp_expired_month < 10) {
          $family_ktp_expired_month = "0" . strval($family_ktp_expired_month);
        } else {
          $family_ktp_expired_month = strval($family_ktp_expired_month);
        }
      }

      $family_ktp_expired_year = strval($this->familyKtpExpiredYear);
      if ($family_ktp_expired_day && $family_ktp_expired_month && $family_ktp_expired_year) {
        $family_ktp_expired_date = $family_ktp_expired_year . $family_ktp_expired_month . $family_ktp_expired_day;
      } else {
        $family_ktp_expired_date = NULL;
      }
    }

    $family_passport_expired_day = $this->familyPassportExpiredDay;
    if ($family_passport_expired_day) {
      if ($family_passport_expired_day < 10) {
        $family_passport_expired_day = "0" . strval($family_passport_expired_day);
      } else {
        $family_passport_expired_day = strval($family_passport_expired_day);
      }
    }
    $family_passport_expired_month = $this->familyPassportExpiredMonth;
    if ($family_passport_expired_month) {
      if ($family_passport_expired_month < 10) {
        $family_passport_expired_month = "0" . strval($family_passport_expired_month);
      } else {
        $family_passport_expired_month = strval($family_passport_expired_month);
      }
    }
    $family_passport_expired_year = strval($this->familyPassportExpiredYear);
    if ($family_passport_expired_day && $family_passport_expired_month && $family_passport_expired_year) {
      $family_passport_expired_date = $family_passport_expired_year . $family_passport_expired_month . $family_passport_expired_day;
    } else {
      $family_passport_expired_date = NULL;
    }

    $family_occupation_id = $this->familyOccupation;
    $family_occupation_name = Occupation::where('id', $family_occupation_id)->value('name');
    if ($family_occupation_id == 18) {
      $family_occupation_name = $this->familyOccupationText;
    } else {
      $family_occupation_name = Occupation::where('id', $family_occupation_id)->value('name');
    }

    $family_job_position_id = $this->familyJobPosition;
    $family_job_position_text = $this->familyJobPositionText;
    if ($family_job_position_text) {
      $family_job_position = $family_job_position_text;
    } else {
      $family_job_position = Position::where('id', $family_job_position_id)->value('name');
    }

    $family_business_field_id = $this->familyBusinessField;
    $family_business_field_text = $this->familyBusinessFieldText;
    if ($family_business_field_text) {
      $family_business_field = $family_business_field_text;
    } else {
      $family_business_field = Business::where('id', $family_business_field_id)->value('name');
    }

    $family_company_city_text = $this->familyCompanyCityText;
    if ($family_company_city_text) {
      $family_company_city = $family_company_city_text;
    } else {
      $family_company_city = $this->familyCompanyCity;
    }

    $family_company_fax_number = str_replace("+", "", $this->familyCompanyFaxNumber);
    $family_company_phone_number = str_replace("+", "", $this->familyCompanyPhoneNumber);

    $application_term = $this->applicationTerm;
    if ($application_term) {
      $application_term = 1;
      $application_term_timestamp = date('Y-m-d H:i:s');
    } else {
      $application_term = 0;
      $application_term_timestamp = NULL;
    }

    $bca_term = $this->bcaTerm;
    if ($bca_term) {
      $bca_term = 1;
      $bca_term_timestamp = date('Y-m-d H:i:s');
    } else {
      $bca_term = 0;
      $bca_term_timestamp = NULL;
    }

    if ($currentStep === 1) {
      $this->validate([
        'fullName' => 'required|min:4',
        'nationality' => 'required',
        'idType' => 'required',
        'ktpNumber' => 'required_if:idType,KTP|numeric|digits:16',
        'ktpExpiredDay' => 'required_unless:ktpExpiredLifetime,true',
        'ktpExpiredMonth' => 'required_unless:ktpExpiredLifetime,true',
        'ktpExpiredYear' => 'required_unless:ktpExpiredLifetime,true',
        'passportNumber' => 'required_if:idType,Paspor',
        'passportExpiredDay' => 'required_if:idType,Paspor',
        'passportExpiredMonth' => 'required_if:idType,Paspor',
        'passportExpiredYear' => 'required_if:idType,Paspor',
        'hasKitas' => 'exclude_if:nationality,INDONESIAN|required',
        'kitasNumber' => 'exclude_if:nationality,INDONESIAN|required_if:hasKitas,1',
        'kitasExpiredDay' => 'exclude_if:nationality,INDONESIAN|required_if:hasKitas,1',
        'kitasExpiredMonth' => 'exclude_if:nationality,INDONESIAN|required_if:hasKitas,1',
        'kitasExpiredYear' => 'exclude_if:nationality,INDONESIAN|required_if:hasKitas,1',
        'hasNPWP' => 'required',
        'npwpNumber' => 'required_unless:hasNPWP,1|numeric',
        'npwpIssueDay' => 'required_unless:hasNPWP,1',
        'npwpIssueMonth' => 'required_unless:hasNPWP,1',
        'npwpIssueYear' => 'required_unless:hasNPWP,1',
        'birthCountry' => 'required',
        'birthPlace' => 'required_if:birthCountry,ID',
        'birthDay' => 'required',
        'birthMonth' => 'required',
        'birthYear' => 'required',
        'gender' => 'required',
        'maritalStatus' => 'required',
        'religion' => 'required',
        'education' => 'required',
        'motherName' => 'required',
        'email' => 'required',
        'mobileNumber' => 'required',
        'idCountry' => 'required',
        'idStreet1' => 'required',
        'idRtRw' => 'required_if:idCountry,INDONESIA',
        'idProvince' => 'required_if:idCountry,INDONESIA',
        'idProvinceText' => 'required_unless:idCountry,INDONESIA',
        'idCity' => 'required_if:idCountry,INDONESIA',
        'idCityText' => 'required_unless:idCountry,INDONESIA',
        'idDistrict' => 'required_if:idCountry,INDONESIA',
        'idDistrictText' => 'required_unless:idCountry,INDONESIA',
        'idSubDistrict' => 'required_if:idCountry,INDONESIA',
        'idSubDistrictText' => 'required_unless:idCountry,INDONESIA',
        'idZip' => 'required_if:idCountry,INDONESIA',
        'homeCountry' => 'required_if:homeIsId,false',
        'homeStreet1' => 'required_if:homeIsId,false',
        'homeRtRw' => 'required_if:homeIsId,false',
        'homeProvince' => 'required_if:homeIsId,false',
        'homeProvinceText' => 'required_unless:homeCountry,INDONESIA',
        'homeCity' => 'required_if:homeIsId,false',
        'homeCityText' => 'required_unless:homeCountry,INDONESIA',
        'homeDistrict' => 'required_if:homeIsId,false',
        'homeDistrictText' => 'required_unless:homeCountry,INDONESIA',
        'homeSubDistrict' => 'required_if:homeIsId,false',
        'homeSubDistrictText' => 'required_unless:homeCountry,INDONESIA',
        'homeZip' => 'required_if:homeIsId,false',
        'homeStatus' => 'required',
        'postalPreference' => 'required',
        'confirmVia' => 'required',
        'infoQ1Text' => 'required_if:infoQ1,true',
        'infoQ2Text' => 'required_if:infoQ2,true',
        'infoQ3Text' => 'required_if:infoQ3,true',
      ]);
      $this->currentStep++;
    } else if ($currentStep === 2) {
      $validatedData = $this->validate([
        'occupation' => 'required',
        'occupationText' => 'required_if:occupationIsOther,true',
        'jobPosition' => 'required_if:jobPositionIsText,false',
        'jobPositionText' => 'required_if:jobPositionIsText,true',
        'businessField' => 'required_if:businessFieldIsText,false',
        'businessFieldText' => 'required_if:businessFieldIsText,true',
        'companyName' => 'required',
        'companyAddress' => 'required',
        'companyCountry' => 'required',
        'companyCity' => 'required_if:companyCountry,INDONESIA',
        'companyCityText' => 'required_unless:companyCountry,INDONESIA',
        'companyZip' => 'required',
        'incomeYearly' => 'required',
        'incomeSource' => 'required',
        'incomeSourceText' => 'required_if:incomeSource,1',
        'objectives' => 'required',
        'heirName' => 'required',
        'heirRelationship' => 'required',
        'heirAddress' => 'required',
        'heirCountry' => 'required',
        'heirCity' => 'required',
        'heirCityText' => 'required_unless:heirCountry,INDONESIA',
        'heirZip' => 'required',
        'bank2Name' => 'required',
        'bank2AccName' => 'required_if:bank2Name,BANK CENTRAL ASIA',
        'bank2AccNumber' => 'required_if:bank2Name,BANK CENTRAL ASIA',
        'fatcaTinSsn' => 'required_if:fatcaHolder,true',
      ]);
      $this->currentStep++;
    } else if ($currentStep === 3) {
      $validatedData = $this->validate([
        'familyName' => 'required',
        'familyRelation' => 'required_with:familyName',
        'familyNationality' => 'required_with:familyName',
        'familyIdType' => 'required_with:familyName',
        'familyKtpNumber' => 'required_if:familyIdType,KTP|numeric|digits:16',
        'familyKtpExpiredDay' => 'required_unless:familyKtpExpiredLifetime,true',
        'familyKtpExpiredMonth' => 'required_unless:familyKtpExpiredLifetime,true',
        'familyKtpExpiredYear' => 'required_unless:familyKtpExpiredLifetime,true',
        'familyPassportNumber' => 'required_if:familyIdType,Paspor',
        'familyPassportExpiredDay' => 'required_if:familyIdType,Paspor',
        'familyPassportExpiredMonth' => 'required_if:familyIdType,Paspor',
        'familyPassportExpiredYear' => 'required_if:familyIdType,Paspor',
        'familyOccupation' => 'required',
        'familyOccupationText' => 'required_if:familyOccupationIsOther,true',
        'familyJobPosition' => 'required',
        'familyJobPositionText' => 'required_if:familyJobPositionIsOther,true',
        'familyBusinessField' => 'required',
        'familyBusinessFieldText' => 'required_if:familyBusinessFieldIsOther,true',
        'familyCompanyName' => 'required',
        'familyCompanyAddress' => 'required',
        'familyCompanyCountry' => 'required',
        'familyCompanyCity' => 'required_if:familyCompanyCountry,INDONESIA',
        'familyCompanyCityText' => 'required_unless:familyCompanyCountry,INDONESIA',
        'familyCompanyZip' => 'required',
        'familyIncomeYearly' => 'required',
        'familyIncomeSource' => 'required',
        'familyIncomeSourceText' => 'required_if:familyIncomeSource,1',
      ]);
      $this->currentStep++;
    } else {
      $validatedData = $this->validate([
        'uploadKtp' => 'required_if:idType,KTP',
        'uploadPassport' => 'required_if:idType,Paspor',
        'uploadNpwp' => 'required_unless:hasNPWP,1',
        'applicationTerm' => 'accepted',
        'bcaTerm' => 'accepted',
        'uploadSignature' => 'required'
      ]);
      $stored_data = OpenAccount::create([
        'full_name' => $this->fullName,
        'nationality' => $this->nationality,
        'id_type' => $this->idType,
        'ktp_number' => $this->ktpNumber,
        'ktp_expired_date' => $ktp_expired_date,
        'passport_number' => $this->passportNumber,
        'passport_expired_date' => $passport_expired_date,
        'has_kitas' => $this->hasKitas,
        'kitas_number' => $this->kitasNumber,
        'kitas_expired_date' => $kitas_expired_date,
        'has_npwp' => $this->hasNPWP,
        'npwp_number' => $this->npwpNumber,
        'npwp_issue_date' => $npwp_issue_date,
        'birth_country' => $this->birthCountry,
        'birth_place' => $birth_place,
        'birth_date' => $birth_date,
        'gender' => $this->gender,
        'marital_status' => $this->maritalStatus,
        'religion' => $this->religion,
        'education' => $this->education,
        'mother_name' => $this->motherName,
        'email' => $this->email,
        'mobile_country_code' => $mobile_country_code,
        'mobile_number' => $mobile_number,
        'phone_country_code' => $phone_country_code,
        'phone_number' => $phone_number,
        'id_country' => $this->idCountry,
        'id_street_1' => $this->idStreet1,
        'id_street_2' => $this->idStreet2,
        'id_rt_rw' => $this->idRtRw,
        'id_province' => $id_province,
        'id_city' => $id_city,
        'id_district' => $id_district,
        'id_subdistrict' => $id_subdistrict,
        'id_zip' => $this->idZip,
        'home_is_id' => $this->homeIsId,
        'home_country' => $this->homeCountry,
        'home_street_1' => $this->homeStreet1,
        'home_street_2' => $this->homeStreet2,
        'home_rt_rw' => $this->homeRtRw,
        'home_province' => $home_province,
        'home_city' => $home_city,
        'home_district' => $home_district,
        'home_subdistrict' => $home_subdistrict,
        'home_zip' => $this->homeZip,
        'home_status' => $this->homeStatus,
        'home_since' => $home_since,
        'postal_preference' => $this->postalPreference,
        'confirm_via' => $this->confirmVia,
        'info_q1' => $this->infoQ1,
        'info_q1_text' => $this->infoQ1Text,
        'info_q2' => $this->infoQ2,
        'info_q2_text' => $this->infoQ2Text,
        'info_q3' => $this->infoQ3,
        'info_q3_text' => $this->infoQ3Text,
        'occupation_id_ksei' => $occupation_id_ksei,
        'occupation_id_bca' => $occupation_id_bca,
        'occupation_name' => $occupation_name,
        'job_position' => $job_position,
        'business_field' => $business_field,
        'company_name' => $this->companyName,
        'company_address' => $this->companyAddress,
        'company_country' => $this->companyCountry,
        'company_city' => $company_city,
        'company_zip' => $this->companyZip,
        'company_phone_country_code' => $company_phone_country_code,
        'company_phone_number' => $company_phone_number,
        'company_fax_country_code' => $company_fax_country_code,
        'company_fax_number' => $company_fax_number,
        'company_email' => $this->companyEmail,
        'work_year' => $this->workYear,
        'work_month' => $this->workMonth,
        'income_yearly' => $this->incomeYearly,
        'income_source' => $this->incomeSource,
        'income_source_other' => $this->incomeSourceText,
        'extra_income_yearly' => $this->extraIncomeYearly,
        'extra_income_source' => $this->extraIncomeSource,
        'extra_income_source_other' => $this->extraIncomeSourceText,
        'objectives' => $objectives,
        'heir_name' => $this->heirName,
        'heir_relationship' => $this->heirRelationship,
        'heir_address' => $this->heirAddress,
        'heir_country' => $this->heirCountry,
        'heir_city' => $heir_city,
        'heir_zip' => $this->heirZip,
        'heir_mobile_mumber' => $heir_mobile_number,
        'heir_email' => $this->heirEmail,
        'bca_existing_account' => $bca_existing_account,
        'bank_2_name' => $bank_2_name,
        'bank_2_accname' => $this->bank2AccName,
        'bank_2_accnumber' => $this->bank2AccNumber,
        'bank_3_name' => $this->bank3Name,
        'bank_3_accname' => $this->bank3AccName,
        'bank_3_accnumber' => $this->bank3AccNumber,
        'fatca_holder' => $fatca_holder,
        'tin_ssn_number' => $this->fatcaTinSsn,
        'other_taxpayer' => $other_tax_payer,
        'spouse_name' => $spouse_name,
        'parent_name' => $parent_name,
        'family_nationality' => $this->familyNationality,
        'family_relation' => $this->familyRelation,
        'family_id_type' => $this->familyIdType,
        'family_ktp_number' => $this->familyKtpNumber,
        'family_ktp_expired_date' => $family_ktp_expired_date,
        'family_passport_number' => $this->familyPassportNumber,
        'family_passport_expired_date' => $family_passport_expired_date,
        'family_occupation' => $family_occupation_name,
        'family_job_position' => $family_job_position,
        'family_business_field' => $family_business_field,
        'family_company_name' => $this->familyCompanyName,
        'family_company_address' => $this->familyCompanyAddress,
        'family_company_country' => $this->familyCompanyCountry,
        'family_company_city' => $family_company_city,
        'family_company_zip' => $this->familyCompanyZip,
        'family_company_phone_number' => $family_company_phone_number,
        'family_company_fax_number' => $family_company_fax_number,
        'family_company_email' => $this->familyCompanyEmail,
        'family_work_year' => $this->familyWorkYear,
        'family_work_month' => $this->familyWorkMonth,
        'family_income_yearly' => $this->familyIncomeYearly,
        'family_income_source' => $this->familyIncomeSource,
        'family_income_source_other' => $this->familyIncomeSourceText,
        'family_extra_income_yearly' => $this->familyExtraIncomeYearly,
        'family_extra_income_source' => $this->familyExtraIncomeSource,
        'family_extra_income_source_other' => $this->familyExtraIncomeSourceText,
        'application_term' => $application_term,
        'application_term_timestamp' => $application_term_timestamp,
        'bca_term' => $bca_term,
        'bca_term_timestamp' => $bca_term_timestamp,
      ]);

      if ($this->uploadKtp) {
        $this->uploadKtp->storePubliclyAs('files/' . $stored_data->id, 'KTP.' . $this->uploadKtp->extension(), 'public');
      }

      if ($this->uploadPassport) {
        $this->uploadPassport->storePubliclyAs('files/' . $stored_data->id, 'Passport.' . $this->uploadPassport->extension(), 'public');
      }

      if ($this->uploadNpwp) {
        $this->uploadNpwp->storePubliclyAs('files/' . $stored_data->id, 'NPWP.' . $this->uploadNpwp->extension(), 'public');
      }

      if ($this->uploadSignature) {
        $data_uri = $this->uploadSignature;
        $encoded_image = explode(",", $data_uri)[1];
        $decoded_image = base64_decode($encoded_image);
        Storage::put('public/files/' . $stored_data->id . '/TandaTangan.png', $decoded_image, 'public');
      }

      //$this->clearForm();

      $this->currentStep = 5;
    }
  }
}
