<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOpenAccountsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('open_accounts', function (Blueprint $table) {
      $table->id();
      $table->bigInteger('bca_existing_account')->nullable(); // 3. NO REKENING EXISTING
      $table->text('sid_number')->nullable(); // 5. NO SID INVESTOR
      $table->text('securities_number')->nullable(); // 6. NO SUB REK EFEK
      $table->text('full_name')->nullable(); // 4. NAMA NASABAH
      $table->text('nationality')->nullable(); // 10. KEWARGANEGARAAN
      $table->text('id_type')->nullable(); // KTP/PASPOR
      $table->text('ktp_number')->nullable(); // 7. NIK
      $table->text('ktp_expired_date', 8)->nullable(); // 9. BERLAKU S/D
      $table->text('passport_number')->nullable(); // 8. NIL
      $table->text('passport_expired_date', 8)->nullable(); // 9. BERLAKU S/D
      $table->smallInteger('has_kitas')->nullable(); // 11. KITAS/KITAP (KHUSUS WNA)
      $table->text('kitas_number')->nullable(); // 12. NOMOR KITAS/KITAP
      $table->text('kitas_expired_date', 8)->nullable(); // 13. BERLAKU S.D
      $table->smallInteger('has_npwp')->nullable(); // 41. NPWP
      $table->text('npwp_number')->nullable(); // 42. NOMOR NPWP
      $table->text('npwp_issue_date', 8)->nullable();
      $table->text('birth_country')->nullable(); // 48. NEGARA LAHIR FATCA
      $table->text('birth_place')->nullable(); // 31. TEMPAT LAHIR
      $table->text('birth_date', 8)->nullable(); // 32. TANGGAL LAHIR
      $table->smallInteger('gender')->nullable(); // 29. JENIS KELAMIN
      $table->smallInteger('marital_status')->nullable(); // 33. STATUS PERKAWINAN
      $table->text('religion')->nullable(); // 34. AGAMA
      $table->smallInteger('education')->nullable(); //
      $table->text('mother_name')->nullable(); // 14. NAMA GADIS IBU KANDUNG
      $table->text('email')->nullable(); // 28. ALAMAT EMAIL
      $table->text('phone_country_code', 6)->nullable(); // 23. KODE NEGARA NOMOR TELEPON
      $table->text('phone_number', 20)->nullable(); // 25. NOMOR TELEPON
      $table->text('mobile_country_code', 6)->nullable(); // 26. KODE NEGARA NOMOR HANDPHONE
      $table->text('mobile_number', 20)->nullable(); // 27. NOMOR HANDPHONE
      $table->text('id_country')->nullable();
      $table->text('id_street_1')->nullable(); // 15. NAMA JALAN
      $table->text('id_street_2')->nullable(); // 16. NAMA GEDUNG/APARTEMEN/KLUSTER/KOMPLEK
      $table->text('id_rt_rw')->nullable(); // 17. RT/RW
      $table->text('id_province')->nullable(); // 21. PROVINSI
      $table->text('id_city')->nullable(); // 20. KOTA
      $table->text('id_district')->nullable(); // 19. KECAMATAN
      $table->text('id_subdistrict')->nullable(); // 18. KELURAHAN
      $table->text('id_zip')->nullable(); // 22. KODE POS
      $table->boolean('home_is_id')->nullable();
      $table->text('home_country')->nullable();
      $table->text('home_street_1')->nullable();
      $table->text('home_street_2')->nullable();
      $table->text('home_rt_rw')->nullable();
      $table->text('home_province')->nullable();
      $table->text('home_city')->nullable();
      $table->text('home_district')->nullable();
      $table->text('home_subdistrict')->nullable();
      $table->text('home_zip')->nullable();
      $table->text('home_status')->nullable();
      $table->text('home_since')->nullable();
      $table->text('postal_preference')->nullable();
      $table->text('confirm_via')->nullable();
      $table->boolean('info_q1')->nullable();
      $table->text('info_q1_text')->nullable();
      $table->boolean('info_q2')->nullable();
      $table->text('info_q2_text')->nullable();
      $table->boolean('info_q3')->nullable();
      $table->text('info_q3_text')->nullable();
      $table->smallInteger('occupation_id_ksei')->nullable(); // 35. PEKERJAAN
      $table->smallInteger('occupation_id_bca')->nullable(); // 35. PEKERJAAN
      $table->text('occupation_name')->nullable(); // 35. PEKERJAAN
      $table->text('job_position')->nullable(); // 36. JABATAN/PANGKAT
      $table->text('business_field')->nullable(); // 37. BIDANG USAHA
      $table->text('company_name')->nullable(); // 43. NAMA TEMPAT BEKERJA/USAHA/SEKOLAH
      $table->text('company_address')->nullable(); // 44. ALAMAT TEMPAT BEKERJA/USAHA/SEKOLAH
      $table->text('company_country')->nullable();
      $table->text('company_city')->nullable();
      $table->text('company_zip')->nullable();
      $table->text('company_phone_country_code', 6)->nullable(); // 45. KODE NEGARA NOMOR TELEPON
      $table->text('company_phone_number', 20)->nullable(); // 47. NOMOR TELEPON
      $table->text('company_fax_country_code', 6)->nullable();
      $table->text('company_fax_number', 20)->nullable();
      $table->text('company_email')->nullable();
      $table->text('work_year', 6)->nullable();
      $table->text('work_month', 6)->nullable();
      $table->smallInteger('income_yearly')->nullable(); // 40. TOTAL PENGHASILAN PER TAHUN (DALAM RUPIAH)
      $table->smallInteger('income_source')->nullable(); // 38. SUMBER PENGHASILAN
      $table->text('income_source_other')->nullable(); // 39. SUMBER PENGHASILAN LAINNYA
      $table->smallInteger('extra_income_yearly')->nullable();
      $table->smallInteger('extra_income_source')->nullable();
      $table->text('extra_income_source_other')->nullable();
      $table->text('objectives')->nullable();
      $table->text('heir_name')->nullable();
      $table->text('heir_relationship')->nullable();
      $table->text('heir_address')->nullable();
      $table->text('heir_country')->nullable();
      $table->text('heir_city')->nullable();
      $table->text('heir_zip')->nullable();
      $table->text('heir_mobile_mumber')->nullable();
      $table->text('heir_email')->nullable();
      $table->text('bank_2_name')->nullable();
      $table->text('bank_2_accname')->nullable();
      $table->text('bank_2_accnumber')->nullable();
      $table->text('bank_3_name')->nullable();
      $table->text('bank_3_accname')->nullable();
      $table->text('bank_3_accnumber')->nullable();
      $table->text('spouse_name')->nullable();
      $table->text('parent_name')->nullable();
      $table->text('family_relation')->nullable();
      $table->text('family_nationality')->nullable();
      $table->text('family_id_type')->nullable();
      $table->text('family_ktp_number')->nullable();
      $table->text('family_ktp_expired_date', 8)->nullable();
      $table->text('family_passport_number')->nullable();
      $table->text('family_passport_expired_date', 8)->nullable();
      $table->text('family_occupation')->nullable();
      $table->text('family_job_position')->nullable();
      $table->text('family_business_field')->nullable();
      $table->text('family_company_name')->nullable();
      $table->text('family_company_address')->nullable();
      $table->text('family_company_country')->nullable();
      $table->text('family_company_city')->nullable();
      $table->text('family_company_zip')->nullable();
      $table->text('family_company_phone_number', 20)->nullable();
      $table->text('family_company_fax_number', 20)->nullable();
      $table->text('family_company_email')->nullable();
      $table->text('family_work_year', 6)->nullable();
      $table->text('family_work_month', 6)->nullable();
      $table->smallInteger('family_income_yearly')->nullable();
      $table->smallInteger('family_income_source')->nullable();
      $table->text('family_income_source_other')->nullable();
      $table->smallInteger('family_extra_income_yearly')->nullable();
      $table->smallInteger('family_extra_income_source')->nullable();
      $table->text('family_extra_income_source_other')->nullable();
      $table->smallInteger('fatca_holder')->nullable(); // 49. WAJIB FATCA
      $table->bigInteger('tin_ssn_number')->nullable(); // 50. TIN/SSN
      $table->smallInteger('other_taxpayer')->nullable(); // 51. WAJIB PAJAK NEGARA LAIN (SELAIN INDONESIA & AMERIKA SERIKAT)
      $table->smallInteger('application_term')->nullable();
      $table->dateTime('application_term_timestamp')->nullable();
      $table->smallInteger('bca_term')->nullable(); // 52. Pernyataan setuju ketentuan pemrek
      $table->dateTime('bca_term_timestamp')->nullable(); // 53. Pernyataan setuju ketentuan pemrek detail
      $table->timestamps();
      $table->softDeletes();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('open_accounts');
  }
}
