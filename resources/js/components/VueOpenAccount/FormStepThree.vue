<template>
  <div>
    <form-progress></form-progress>
    <div class="bg-white shadow relative">
      <loading
        :active.sync="isLoading"
        :can-cancel="true"
        :is-full-page="true"
        color="#007BFF"
      />
      <div class="px-4 py-4 border-b border-gray-200">
        <p class="text-sm text-gray-500 italic text-center font-bold">
          Wajib diisi jika telah menikah atau masih sebagai mahasiswa/i
        </p>
      </div>

      <!-- Identity -->
      <div
        class="flex flex-wrap px-4 py-6 lg:flex-nowrap lg:gap-6 lg:px-8 lg:py-11 border-b border-gray-200"
      >
        <div class="w-full lg:w-1/4">
          <h3 class="text-xl font-bold mb-2 tracking-tight">
            Identitas
            <span
              v-if="family_relation === 'Suami' || family_relation === 'Istri'"
              >Pasangan</span
            ><span
              v-if="family_relation === 'Ayah' || family_relation === 'Ibu'"
              >Orang Tua</span
            ><span v-if="!family_relation">Pasangan / Orang Tua</span>
          </h3>
        </div>

        <div class="w-full grid grid-cols-1 gap-6 lg:w-3/4">
          <div class="flex flex-wrap gap-y-6 md:flex-nowrap md:gap-x-4">
            <div class="w-full md:w-1/2">
              <div class="form-label">
                Nama sesuai identitas <span class="form-required">*</span>
              </div>
              <input
                type="text"
                name="family_name"
                placeholder="Isi nama lengkap sesuai identitas"
                v-model="family_name"
                @change="$v.family_name.$touch()"
              />
              <div
                v-if="$v.family_name.$error && !$v.family_name.required"
                class="form-validation-error"
              >
                <small>Nama Pasangan/Orang Tua wajib diisi.</small>
              </div>
            </div>
            <div class="w-full md:w-1/4">
              <div class="form-label">
                Hubungan <span class="form-required">*</span>
              </div>
              <select v-model="family_relation" name="family_relation">
                <option disabled value="">-- Pilih --</option>
                <option value="Suami">Suami</option>
                <option value="Istri">Istri</option>
                <option value="Ayah">Ayah</option>
                <option value="Ibu">Ibu</option>
              </select>
              <div
                v-if="$v.family_relation.$error && !$v.family_relation.required"
                class="form-validation-error"
              >
                <small>Hubungan keluarga wajib diisi.</small>
              </div>
            </div>
            <div class="w-full md:w-1/4">
              <div class="form-label">
                Kewarganegaraan <span class="form-required">*</span>
              </div>
              <v-select
                v-model="family_nationality"
                label="nationality"
                :placeholder="'-- Pilih --'"
                :options="country_options"
                :reduce="country => country.nationality"
                :clearable="false"
              >
              </v-select>
              <div
                v-if="
                  $v.family_nationality.$error &&
                    !$v.family_nationality.required
                "
                class="form-validation-error"
              >
                <small>Kewarganegaraan wajib diisi.</small>
              </div>
            </div>
          </div>
          <div class="flex flex-wrap gap-y-2 md:flex-nowrap md:gap-x-4">
            <div class="w-full md:w-2/12">
              <div class="form-label">
                Jenis Kartu ID
                <span class="form-required">*</span>
              </div>

              <select
                v-model="family_id_type"
                name="family_id_type"
                @change="clearIdCardField($event)"
              >
                <option disabled value="">-- Pilih --</option>
                <option value="KTP">KTP</option>
                <option value="Paspor">Paspor</option>
              </select>

              <div
                v-if="$v.family_id_type.$error && !$v.family_id_type.required"
                class="form-validation-error"
              >
                <small>Jenis kartu identitas wajib diisi.</small>
              </div>
            </div>

            <div
              class="w-full flex flex-wrap gap-y-2 md:flex-nowrap md:w-10/12 md:gap-x-4"
            >
              <div
                v-show="familyIdTypeIsKtp"
                class="w-full flex flex-wrap md:flex-nowrap md:gap-x-4"
              >
                <div class="w-full md:w-1/2">
                  <div class="form-label">
                    Nomor KTP (NIK) <span class="form-required">*</span>
                  </div>
                  <input
                    type="text"
                    name="family_ktp_number"
                    placeholder="Isi NIK KTP"
                    v-model="family_ktp_number"
                    @change="$v.family_ktp_number.$touch()"
                  />
                  <div
                    v-if="
                      $v.family_ktp_number.$error &&
                        !$v.family_ktp_number.required
                    "
                    class="form-validation-error"
                  >
                    <small>Nomor KTP wajib diisi.</small>
                  </div>
                </div>
                <div class="w-full md:w-1/2">
                  <div class="form-label">
                    Berlaku s/d <span class="form-required">*</span>
                  </div>
                  <div class="flex flex-nowrap gap-2">
                    <select
                      v-model="family_ktp_expired_day"
                      name="family_ktp_expired_day"
                      :disabled="familyKtpExpiredIsLifetime == 1"
                      class="mb-1"
                    >
                      <option value="">Tgl</option>
                      <option v-for="i in 31" :value="i" :key="i">
                        {{ i }}
                      </option>
                    </select>
                    <select
                      v-model="family_ktp_expired_month"
                      name="family_ktp_expired_month"
                      class="mb-1"
                      :disabled="familyKtpExpiredIsLifetime == 1"
                    >
                      <option value="">Bln</option>
                      <option v-for="i in 12" :value="i" :key="i">
                        {{ i }}
                      </option>
                    </select>
                    <select
                      v-model="family_ktp_expired_year"
                      name="family_ktp_expired_year"
                      class="mb-1"
                      :disabled="familyKtpExpiredIsLifetime == 1"
                    >
                      <option value="">Thn</option>
                      <option
                        v-for="year in idCardYears"
                        :value="year"
                        :key="year"
                      >
                        {{ year }}
                      </option>
                    </select>
                  </div>

                  <div>
                    <div class="form-check mt-1 inline-flex">
                      <input
                        v-model="family_ktp_expired_lifetime"
                        type="checkbox"
                        name="family_ktp_expired_lifetime"
                        id="family_ktp_expired_lifetime"
                        class="form-check-input"
                      />
                      <label
                        class="form-check-label inline-block ml-2"
                        for="family_ktp_expired_lifetime"
                        >Seumur Hidup</label
                      >
                    </div>
                  </div>

                  <div
                    v-if="
                      $v.family_ktp_expired_day.$error &&
                        !$v.family_ktp_expired_day.required
                    "
                    class="form-validation-error"
                  >
                    <small>Tanggal Masa Berlaku wajib diisi.</small>
                  </div>
                  <div
                    v-if="
                      $v.family_ktp_expired_month.$error &&
                        !$v.family_ktp_expired_month.required
                    "
                    class="form-validation-error"
                  >
                    <small>Bulan Masa Berlaku wajib diisi.</small>
                  </div>
                  <div
                    v-if="
                      $v.family_ktp_expired_year.$error &&
                        !$v.family_ktp_expired_year.required
                    "
                    class="form-validation-error"
                  >
                    <small>Tahun Masa Berlaku wajib diisi.</small>
                  </div>
                </div>
              </div>

              <div
                v-show="familyIdTypeIsPassport"
                class="w-full flex flex-wrap md:flex-nowrap md:gap-x-4"
              >
                <div class="w-full md:w-1/2">
                  <div class="form-label">
                    Nomor Paspor <span class="form-required">*</span>
                  </div>
                  <input
                    type="text"
                    name="family_passport_number"
                    placeholder="Isi nomor paspor"
                    v-model="family_passport_number"
                    @change="$v.family_passport_number.$touch()"
                  />
                  <div
                    v-if="
                      $v.family_passport_number.$error &&
                        !$v.family_passport_number.required
                    "
                    class="form-validation-error"
                  >
                    <small>Nomor Paspor wajib diisi.</small>
                  </div>
                </div>
                <div class="w-full md:w-1/2">
                  <div class="form-label">
                    Berlaku s/d <span class="form-required">*</span>
                  </div>
                  <div class="flex flex-nowrap gap-2">
                    <select
                      v-model="family_passport_expired_day"
                      name="family_passport_expired_day"
                      class="mb-1"
                    >
                      <option value="">Tgl</option>
                      <option v-for="i in 31" :value="i" :key="i">
                        {{ i }}
                      </option>
                    </select>
                    <select
                      v-model="family_passport_expired_month"
                      name="family_passport_expired_month"
                      class="mb-1"
                    >
                      <option value="">Bln</option>
                      <option v-for="i in 12" :value="i" :key="i">
                        {{ i }}
                      </option>
                    </select>
                    <select
                      v-model="family_passport_expired_year"
                      name="family_passport_expired_year"
                      class="mb-1"
                    >
                      <option value="">Thn</option>
                      <option
                        v-for="year in idCardYears"
                        :value="year"
                        :key="year"
                      >
                        {{ year }}
                      </option>
                    </select>
                  </div>

                  <div
                    v-if="
                      $v.family_passport_expired_day.$error &&
                        !$v.family_passport_expired_day.required
                    "
                    class="form-validation-error"
                  >
                    <small>Tanggal Masa Berlaku wajib diisi.</small>
                  </div>
                  <div
                    v-if="
                      $v.family_passport_expired_month.$error &&
                        !$v.family_passport_expired_month.required
                    "
                    class="form-validation-error"
                  >
                    <small>Bulan Masa Berlaku wajib diisi.</small>
                  </div>
                  <div
                    v-if="
                      $v.family_passport_expired_year.$error &&
                        !$v.family_passport_expired_year.required
                    "
                    class="form-validation-error"
                  >
                    <small>Tahun Masa Berlaku wajib diisi.</small>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Occupation -->
      <div
        class="flex flex-wrap px-4 py-6 lg:flex-nowrap lg:gap-6 lg:px-8 lg:py-11 border-b border-gray-200"
      >
        <div class="w-full lg:w-1/4">
          <h3 class="text-xl font-bold mb-4">
            Data Pekerjaan
            <span
              v-if="family_relation === 'Suami' || family_relation === 'Istri'"
              >Pasangan</span
            ><span
              v-if="family_relation === 'Ayah' || family_relation === 'Ibu'"
              >Orang Tua</span
            ><span v-if="!family_relation">Pasangan / Orang Tua</span>
          </h3>
        </div>

        <div class="w-full grid grid-cols-1 gap-6 lg:w-3/4">
          <!-- Occupation -->
          <div class="flex flex-wrap gap-y-6 md:flex-nowrap md:gap-x-4">
            <div class="w-full md:w-1/3">
              <div class="form-label">
                Pekerjaan <span class="form-required">*</span>
              </div>
              <select
                v-model="family_occupation_id_bca"
                name="family_occupation_id_bca"
                @change="setOccupation($event)"
              >
                <option disabled value="">-- Pilih --</option>
                <option
                  v-for="option in family_occupation_options"
                  :value="option.id"
                  :key="option.id"
                >
                  {{ option.name }}
                </option>
              </select>
              <div v-show="familyOccupationIsOther" class="mt-2">
                <input
                  type="text"
                  v-model="family_occupation_text"
                  @change="$v.family_occupation_text.$touch()"
                  name="family_occupation_text"
                  placeholder="Isi Pekerjaan"
                />
              </div>
              <div
                v-if="
                  ($v.family_occupation_id_bca.$error &&
                    !$v.family_occupation_id_bca.required) ||
                    ($v.family_occupation_text.$error &&
                      !$v.family_occupation_text.required)
                "
                class="form-validation-error"
              >
                <small>Pekerjaan wajib diisi.</small>
              </div>
            </div>
            <div class="w-full md:w-1/3">
              <div class="form-label">
                Jabatan/Pangkat <span class="form-required">*</span>
              </div>
              <div v-show="!familyJobPositionIsText">
                <select
                  v-model="family_job_position"
                  name="family_job_position"
                  @change="setBusinessField(null, $event.target.value)"
                >
                  <option disabled value="">-- Pilih --</option>
                  <option
                    v-for="option in family_position_options"
                    :value="option.id"
                    :key="option.id"
                  >
                    {{ option.name }}
                  </option>
                </select>
              </div>
              <div
                v-show="familyJobPositionIsOther || familyJobPositionIsText"
                v-bind:class="{ 'mt-2': familyJobPositionIsOther }"
              >
                <input
                  type="text"
                  v-model="family_job_position_text"
                  @change="$v.family_job_position_text.$touch()"
                  name="family_job_position_text"
                  placeholder="Isi Jabatan/Pangkat"
                />
              </div>
              <div
                v-if="
                  ($v.family_job_position.$error &&
                    !$v.family_job_position.required) ||
                    ($v.family_job_position_text.$error &&
                      !$v.family_job_position_text.required)
                "
                class="form-validation-error"
              >
                <small>Jabatan/Pangkat wajib diisi.</small>
              </div>
            </div>
            <div class="w-full md:w-1/3">
              <div class="form-label">
                Bidang Usaha <span class="form-required">*</span>
              </div>
              <div v-show="!familyBusinessFieldIsText">
                <select
                  v-model="family_business_field"
                  name="family_business_field"
                >
                  <option disabled value="">-- Pilih --</option>
                  <option
                    v-for="option in family_business_options"
                    :value="option.id"
                    :key="option.id"
                  >
                    {{ option.name }}
                  </option>
                </select>
              </div>
              <div
                v-show="familyBusinessFieldIsOther || familyBusinessFieldIsText"
                v-bind:class="{ 'mt-2': familyBusinessFieldIsOther }"
              >
                <input
                  type="text"
                  v-model="family_business_field_text"
                  @change="$v.family_business_field_text.$touch()"
                  name="family_business_field_text"
                  placeholder="Isi Bidang Usaha Pekerjaan"
                />
              </div>
              <div
                v-if="
                  ($v.family_business_field.$error &&
                    !$v.family_business_field.required) ||
                    ($v.family_business_field_text.$error &&
                      !$v.family_business_field_text.required)
                "
                class="form-validation-error"
              >
                <small>Bidang Usaha wajib diisi.</small>
              </div>
            </div>
          </div>

          <!-- Office Information -->
          <div class="flex flex-wrap gap-y-2">
            <div class="w-full">
              <div class="form-label">
                Nama Perusahaan/Kantor <span class="form-required">*</span>
              </div>
              <input
                type="text"
                v-model="family_company_name"
                @change="$v.family_company_name.$touch()"
                name="family_company_name"
                placeholder="Isi Nama Perusahaan/Kantor"
              />
              <div
                v-if="
                  $v.family_company_name.$error &&
                    !$v.family_company_name.required
                "
                class="form-validation-error"
              >
                <small>Nama Perusahaan wajib diisi.</small>
              </div>
            </div>
            <div class="w-full flex flex-wrap gap-y-2">
              <div
                class="w-full grid grid-cols-1 md:grid-cols-3 gap-x-4 gap-y-2"
              >
                <div class="w-full md:col-span-full">
                  <div class="form-label">
                    Alamat Kantor <span class="form-required">*</span>
                  </div>
                  <input
                    type="text"
                    v-model="family_company_address"
                    @change="$v.family_company_address.$touch()"
                    name="family_company_address"
                    placeholder="Cth: Jl Buncit Persada No 1"
                  />
                  <div
                    v-if="
                      $v.family_company_address.$error &&
                        !$v.family_company_address.required
                    "
                    class="form-validation-error"
                  >
                    <small>Alamat Kantor wajib diisi.</small>
                  </div>
                </div>
                <div class="w-full">
                  <div class="form-label">
                    Negara <span class="form-required">*</span>
                  </div>
                  <v-select
                    v-model="family_company_country"
                    label="name"
                    :placeholder="'-- Pilih --'"
                    :options="country_options"
                    :reduce="country => country.name"
                    :clearable="false"
                    @input="clearCityText('company')"
                  >
                  </v-select>
                  <div
                    v-if="
                      $v.family_company_country.$error &&
                        !$v.family_company_country.required
                    "
                    class="form-validation-error"
                  >
                    <small>Negara wajib diisi.</small>
                  </div>
                </div>
                <div class="w-full">
                  <div v-if="family_company_country === 'INDONESIA'">
                    <div class="form-label">
                      Kota/Kabupaten <span class="form-required">*</span>
                    </div>
                    <v-select
                      v-model="family_company_city"
                      label="ksei_name"
                      :placeholder="'-- Pilih --'"
                      :options="family_company_city_options"
                      :reduce="city => city.ksei_name"
                      :clearable="false"
                    >
                    </v-select>
                    <div
                      v-if="
                        $v.family_company_city.$error &&
                          !$v.family_company_city.required
                      "
                      class="form-validation-error"
                    >
                      <small>Kota/Kabupaten wajib diisi.</small>
                    </div>
                  </div>
                  <div v-if="family_company_country !== 'INDONESIA'">
                    <div class="form-label">
                      City <span class="form-required">*</span>
                    </div>
                    <input
                      type="text"
                      v-model="family_company_city_text"
                      name="family_company_city_text"
                      @change="$v.family_company_city_text.$touch()"
                      placeholder="City"
                    />
                    <div
                      v-if="
                        $v.family_company_city_text.$error &&
                          !$v.family_company_city_text.required
                      "
                      class="form-validation-error"
                    >
                      <small>City is required.</small>
                    </div>
                  </div>
                </div>
                <div class="w-full">
                  <div class="form-label">
                    Kode Pos <span class="form-required">*</span>
                  </div>
                  <input
                    type="text"
                    v-model="family_company_zip"
                    @change="$v.family_company_zip.$touch()"
                    name="family_company_zip"
                    placeholder="Cth: 11250"
                  />
                  <div
                    v-if="
                      $v.family_company_zip.$error &&
                        !$v.family_company_zip.required
                    "
                    class="form-validation-error"
                  >
                    <small>Kode Pos wajib diisi.</small>
                  </div>
                </div>
              </div>
              <div
                class="w-full grid grid-cols-1 md:grid-cols-2 gap-x-4 gap-y-2"
              >
                <div class="w-full">
                  <div class="form-label">Nomor Telepon Kantor</div>
                  <div class="mt-1">
                    <vue-tel-input
                      v-model="family_company_phone_number_formatted"
                      v-bind="family_company_phone_props"
                      @country-changed="
                        setCountryCode('family_company_phone', $event)
                      "
                    ></vue-tel-input>
                  </div>
                </div>
                <div class="w-full">
                  <div class="form-label">Nomor Faksimili</div>
                  <div class="mt-1">
                    <vue-tel-input
                      v-model="family_company_fax_number_formatted"
                      v-bind="family_company_fax_props"
                      @country-changed="
                        setCountryCode('family_company_fax', $event)
                      "
                    ></vue-tel-input>
                  </div>
                </div>
              </div>
              <div
                class="w-full grid grid-cols-1 md:grid-cols-3 gap-x-4 gap-y-2"
              >
                <div class="w-full col-span-2">
                  <div class="form-label">Email Kantor</div>
                  <input
                    type="text"
                    name="family_company_email"
                    placeholder="Isi alamat email kantor"
                    v-model="family_company_email"
                  />
                </div>
                <div class="w-full">
                  <div class="form-label">
                    Lama Bekerja/Usaha <span class="form-required">*</span>
                  </div>
                  <div class="flex flex-nowrap gap-2">
                    <select
                      v-model="family_work_year"
                      name="home_status"
                      class="mb-1"
                    >
                      <option disabled value="">Thn</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                      <option value="5">5</option>
                      <option value="6">6</option>
                      <option value="7">7</option>
                      <option value="8">8</option>
                      <option value="9">9</option>
                      <option value="10">10</option>
                      <option value="11">11</option>
                      <option value="12">12</option>
                      <option value="13">13</option>
                      <option value="14">14</option>
                      <option value="15">15</option>
                      <option value=">15">>15</option>
                    </select>
                    <select
                      v-model="family_work_month"
                      name="family_work_month"
                      class="mb-1"
                    >
                      <option disabled value="">Bln</option>
                      <option v-for="i in 12" :value="i" :key="i">
                        {{ i }}
                      </option>
                    </select>
                  </div>
                  <div
                    v-if="
                      $v.family_work_year.$error &&
                        !$v.family_work_year.required
                    "
                    class="form-validation-error"
                  >
                    <small>Lama Bekerja/Usaha wajib diisi.</small>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Financial Data -->
      <div
        class="flex flex-wrap px-4 py-6 lg:flex-nowrap lg:gap-6 lg:px-8 lg:py-11 border-b border-gray-200"
      >
        <div class="w-full lg:w-1/4">
          <h3 class="text-xl font-bold mb-4">
            Data Keuangan
            <span
              v-if="family_relation === 'Suami' || family_relation === 'Istri'"
              >Pasangan</span
            ><span
              v-if="family_relation === 'Ayah' || family_relation === 'Ibu'"
              >Orang Tua</span
            ><span v-if="!family_relation">Pasangan / Orang Tua</span>
          </h3>
        </div>
        <div class="w-full grid grid-cols-1 gap-6 lg:w-3/4">
          <div class="grid grid-cols-1 gap-y-6 md:grid-cols-2 md:gap-x-4">
            <div class="w-full">
              <div class="form-label">
                Penghasilan Utama/Kotor/thn <span class="form-required">*</span>
              </div>
              <select
                v-model="family_income_yearly"
                name="family_income_yearly"
                class="mb-1"
              >
                <option disabled value="">-- Pilih --</option>
                <option value="1">&lt; 10 Juta</option>
                <option value="2">10-50 Juta </option>
                <option value="3">50 - 100 Juta</option>
                <option value="4">100 - 500 Juta</option>
                <option value="5">500 Juta - 1 Miliar</option>
                <option value="6">&gt; 1 Miliar</option>
              </select>
              <div
                v-if="
                  $v.family_income_yearly.$error &&
                    !$v.family_income_yearly.required
                "
                class="form-validation-error"
              >
                <small>Penghasilan Utama wajib diisi.</small>
              </div>
            </div>
            <div class="w-full">
              <div class="form-label">
                Sumber Penghasilan Utama <span class="form-required">*</span>
              </div>
              <select
                v-model="family_income_source"
                name="family_income_source"
                class="mb-1"
              >
                <option disabled value="">-- Pilih --</option>
                <option value="2">Gaji</option>
                <option value="3">Hasil Usaha</option>
                <option value="4">Bunga</option>
                <option value="5">Warisan</option>
                <option value="6">Orang Tua/Anak</option>
                <option value="7">Suami/Istri</option>
                <option value="8">Dana Pensiun</option>
                <option value="9">Lotere</option>
                <option value="10">Hasil Investasi</option>
                <option value="11">Deposito</option>
                <option value="12">Capital</option>
                <option value="13">Pinjaman</option>
                <option value="1">Lainnya</option>
              </select>
              <div
                v-if="
                  $v.family_income_source.$error &&
                    !$v.family_income_source.required
                "
                class="form-validation-error"
              >
                <small>Sumber Penghasilan Utama wajib diisi.</small>
              </div>
              <div v-if="family_income_source === '1'">
                <input
                  type="text"
                  v-model="family_income_source_other"
                  @change="$v.family_income_source_other.$touch()"
                  name="family_income_source_other"
                  placeholder="Isi Sumber Penghasilan Utama *"
                />
                <div
                  v-if="
                    $v.family_income_source_other.$error &&
                      !$v.family_income_source_other.required
                  "
                  class="form-validation-error"
                >
                  <small>Sumber Penghasilan Utama wajib diisi.</small>
                </div>
              </div>
            </div>
            <div class="w-full">
              <div class="form-label">
                Penghasilan Tambahan/Kotor/thn
              </div>
              <select
                v-model="family_extra_income_yearly"
                name="family_extra_income_yearly"
                class="mb-1"
              >
                <option disabled value="">-- Pilih --</option>
                <option value="1">&lt; 10 Juta</option>
                <option value="2">10-50 Juta </option>
                <option value="3">50 - 100 Juta</option>
                <option value="4">100 - 500 Juta</option>
                <option value="5">500 Juta - 1 Miliar</option>
                <option value="6">&gt; 1 Miliar</option>
              </select>
            </div>
            <div class="w-full">
              <div class="form-label">
                Sumber Penghasilan Tambahan
              </div>
              <select
                v-model="family_extra_income_source"
                name="family_extra_income_source"
                class="mb-1"
              >
                <option disabled value="">-- Pilih --</option>
                <option value="2">Gaji</option>
                <option value="3">Hasil Usaha</option>
                <option value="4">Bunga</option>
                <option value="5">Warisan</option>
                <option value="6">Orang Tua/Anak</option>
                <option value="7">Suami/Istri</option>
                <option value="8">Dana Pensiun</option>
                <option value="9">Lotere</option>
                <option value="10">Hasil Investasi</option>
                <option value="11">Deposito</option>
                <option value="12">Capital</option>
                <option value="13">Pinjaman</option>
                <option value="1">Lainnya</option>
              </select>
              <div v-if="family_extra_income_source === '1'">
                <input
                  type="text"
                  v-model="family_extra_income_source_other"
                  @change="$v.family_extra_income_source_other.$touch()"
                  name="family_income_source_other"
                  placeholder="Isi Sumber Penghasilan Tambahan *"
                />
                <div
                  v-if="
                    $v.family_extra_income_source_other.$error &&
                      !$v.family_extra_income_source_other.required
                  "
                  class="form-validation-error"
                >
                  <small>Sumber Penghasilan Utama wajib diisi.</small>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Buttons -->
    <div class="flex gap-4 mt-8 justify-center">
      <button
        @click="navigatePrev()"
        type="button"
        class="px-4 py-2 border rounded text-sm font-bold uppercase bg-orange border-orange text-white hover:bg-orange-light hover:border-orange-light focus:outline-none transition ease-in-out duration-150"
      >
        ⟵ Kembali
      </button>
      <button
        @click="navigateNext()"
        type="button"
        class="px-4 py-2 border rounded text-sm font-bold uppercase bg-orange border-orange text-white hover:bg-orange-light hover:border-orange-light focus:outline-none transition ease-in-out duration-150"
      >
        Berikutnya ⟶
      </button>
    </div>
  </div>
</template>

<script>
import { mutateFields } from "../../helpers/helpers.js";
import { required, requiredUnless, requiredIf } from "vuelidate/lib/validators";
import vSelect from "vue-select";
import { VueTelInput } from "vue-tel-input";
import FormProgress from "./FormProgress.vue";
import Loading from "vue-loading-overlay";
import "vue-loading-overlay/dist/vue-loading.css";

export default {
  components: { vSelect, VueTelInput, FormProgress, Loading },
  data() {
    return {
      isLoading: false,
      countries: null,
      country_options: [],
      family_occupation_options: [],
      family_position_options: [],
      family_business_options: [],
      family_company_city_options: [],
      family_company_phone_props: {
        inputId: "family_company_phone_number_formatted",
        name: "family_company_phone_number_formatted",
        mode: "international",
        defaultCountry: "ID",
        preferredCountries: ["ID", "SG", "MY"],
        placeholder: "213456789",
        enabledCountryCode: false,
        autocomplete: "off",
        inputOptions: {
          showDialCode: true
        }
      },
      family_company_fax_props: {
        inputId: "family_company_fax_number_formatted",
        name: "family_company_fax_number_formatted",
        mode: "international",
        defaultCountry: "ID",
        preferredCountries: ["ID", "SG", "MY"],
        placeholder: "213456789",
        enabledCountryCode: false,
        autocomplete: "off",
        inputOptions: {
          showDialCode: true
        }
      }
    };
  },
  mounted() {
    this.$store.commit("SET_STEP", "3");
    const step_validated = this.$store.getters.step_validated;
    if (step_validated < 2) {
      this.$router.push("/step-2/");
    }
    axios.get("/api/countries").then(response => {
      this.countries = response.data;
      this.country_options = response.data;
    });
    axios.get("/api/city/ksei_cities").then(response => {
      this.family_company_city_options = response.data;
    });
    axios.get("/api/occupation").then(response => {
      this.family_occupation_options = response.data;
    });
    if (this.family_occupation_id_bca) {
      axios
        .get("/api/position/" + this.family_occupation_id_bca)
        .then(response => {
          let jobPositions = response.data;
          this.family_position_options = jobPositions;
        });
    }
    if (this.family_occupation_id_bca && this.family_job_position) {
      axios
        .get(
          "/api/business/" +
            this.family_occupation_id_bca +
            "/" +
            this.family_job_position
        )
        .then(response => {
          let businessFields = response.data;
          this.family_business_options = businessFields;
        });
    }
  },
  computed: {
    ...mutateFields({
      fields: [
        "family_name",
        "family_relation",
        "family_nationality",
        "family_id_type",
        "family_ktp_number",
        "family_ktp_expired_day",
        "family_ktp_expired_month",
        "family_ktp_expired_year",
        "family_ktp_expired_lifetime",
        "family_passport_number",
        "family_passport_expired_day",
        "family_passport_expired_month",
        "family_passport_expired_year",
        "family_occupation_id_bca",
        "family_occupation_name",
        "family_occupation_text",
        "family_job_position",
        "family_job_position_text",
        "family_business_field",
        "family_business_field_text",
        "family_company_name",
        "family_company_address",
        "family_company_country",
        "family_company_city",
        "family_company_city_text",
        "family_company_zip",
        "family_company_phone_country_code",
        "family_company_phone_number_formatted",
        "family_company_fax_country_code",
        "family_company_fax_number_formatted",
        "family_company_email",
        "family_work_year",
        "family_work_month",
        "family_income_yearly",
        "family_income_source",
        "family_income_source_other",
        "family_extra_income_yearly",
        "family_extra_income_source",
        "family_extra_income_source_other"
      ],
      base: "fields",
      mutation: "UPDATE_FIELD"
    }),
    idCardYears() {
      const year = new Date().getFullYear();
      return Array.from({ length: 10 }, (value, index) => year + index);
    },
    familyIdTypeIsKtp() {
      if (this.$store.getters.fields.family_id_type === "KTP") return true;
      return false;
    },
    familyIdTypeIsPassport() {
      if (this.$store.getters.fields.family_id_type === "Paspor") return true;
      return false;
    },
    familyKtpExpiredIsLifetime() {
      if (this.$store.getters.fields.family_ktp_expired_lifetime === true)
        return true;
      return false;
    },
    familyOccupationIsOther() {
      if (this.$store.getters.fields.family_occupation_id_bca === 18)
        return true;
      return false;
    },
    familyJobPositionIsOther() {
      if (this.$store.getters.fields.family_job_position === 99) return true;
      return false;
    },
    familyJobPositionIsText() {
      if (this.$store.getters.fields.family_occupation_id_bca === 3)
        return true;
      return false;
    },
    familyBusinessFieldIsOther() {
      if (this.$store.getters.fields.family_business_field === 99) return true;
      return false;
    },
    familyBusinessFieldIsText() {
      if (this.$store.getters.fields.family_occupation_id_bca === 3)
        return true;
      return false;
    }
  },
  validations: {
    family_name: {
      required
    },
    family_relation: {
      required
    },
    family_nationality: {
      required
    },
    family_id_type: {
      required
    },
    family_ktp_number: {
      required: requiredIf("familyIdTypeIsKtp")
    },
    family_ktp_expired_day: {
      required: requiredIf(function() {
        return this.familyIdTypeIsKtp && !this.familyKtpExpiredIsLifetime;
      })
    },
    family_ktp_expired_month: {
      required: requiredIf(function() {
        return this.familyIdTypeIsKtp && !this.familyKtpExpiredIsLifetime;
      })
    },
    family_ktp_expired_year: {
      required: requiredIf(function() {
        return this.familyIdTypeIsKtp && !this.familyKtpExpiredIsLifetime;
      })
    },
    family_passport_number: {
      required: requiredIf("familyIdTypeIsPassport")
    },
    family_passport_expired_day: {
      required: requiredIf("familyIdTypeIsPassport")
    },
    family_passport_expired_month: {
      required: requiredIf("familyIdTypeIsPassport")
    },
    family_passport_expired_year: {
      required: requiredIf("familyIdTypeIsPassport")
    },
    family_occupation_id_bca: {
      required
    },
    family_occupation_text: {
      required: requiredIf("familyOccupationIsOther")
    },
    family_job_position: {
      required: requiredUnless("familyJobPositionIsText")
    },
    family_job_position_text: {
      required: requiredIf(function() {
        return this.familyJobPositionIsOther || this.familyJobPositionIsText;
      })
    },
    family_business_field: {
      required: requiredUnless("familyBusinessFieldIsText")
    },
    family_business_field_text: {
      required: requiredIf(function() {
        return (
          this.familyBusinessFieldIsOther || this.familyBusinessFieldIsText
        );
      })
    },
    family_company_name: {
      required
    },
    family_company_address: {
      required
    },
    family_company_country: {
      required
    },
    family_company_city: {
      required: requiredIf(function() {
        return this.family_company_country === "INDONESIA";
      })
    },
    family_company_city_text: {
      required: requiredIf(function() {
        return this.family_company_country !== "INDONESIA";
      })
    },
    family_company_zip: {
      required
    },
    family_work_year: {
      required
    },
    family_work_month: {
      required
    },
    family_income_yearly: {
      required
    },
    family_income_source: {
      required
    },
    family_income_source_other: {
      required: requiredIf(function() {
        return this.family_income_source === "1";
      })
    },
    family_extra_income_source_other: {
      required: requiredIf(function() {
        return this.family_extra_income_source === "1";
      })
    }
  },
  methods: {
    clearIdCardField() {
      this.family_ktp_number = "";
      this.family_ktp_expired_day = "";
      this.family_ktp_expired_month = "";
      this.family_ktp_expired_year = "";
      this.family_ktp_expired_lifetime = false;
      this.family_passport_number = "";
      this.family_passport_expired_day = "";
      this.family_passport_expired_month = "";
      this.family_passport_expired_year = "";
    },
    clearCityText(prefix) {
      this[prefix + "_city_text"] = "";
    },
    setOccupation(e) {
      this.family_occupation_id_bca = "";
      this.family_occupation_id_ksei = "";
      this.family_occupation_name = "";
      this.family_occupation_text = "";
      let occupation_id = e.target.value;
      axios.get("/api/occupation/" + occupation_id).then(response => {
        let occupation = response.data;
        this.family_occupation_id_bca = occupation[0].id;
        this.family_occupation_id_ksei = occupation[0].ksei_code;
        this.family_occupation_name = occupation[0].name;
      });
      this.setJobPosition(occupation_id);
    },
    setJobPosition(occupation_id) {
      this.family_position_options = [];
      this.family_job_position = "";
      this.family_job_position_text = "";
      this.family_business_options = [];
      this.family_business_field = "";
      this.family_business_field_text = "";
      axios.get("/api/position/" + occupation_id).then(response => {
        let jobPositions = response.data;
        this.family_position_options = jobPositions;
        let countPositions = Object.keys(jobPositions).length;
        if (countPositions === 1) {
          this.family_job_position = jobPositions[0].id;
          let position_id = jobPositions[0].id;
          this.setBusinessField(occupation_id, position_id);
        }
      });
    },
    setBusinessField(occupation_id, position_id) {
      this.family_business_options = [];
      this.family_business_field = "";
      this.family_business_field_text = "";
      if (occupation_id == null) {
        occupation_id = this.family_occupation_id_bca;
      }
      axios
        .get("/api/business/" + occupation_id + "/" + position_id)
        .then(response => {
          let businessFields = response.data;
          this.family_business_options = businessFields;
          let countBusiness = Object.keys(businessFields).length;
          if (countBusiness === 1) {
            this.family_business_field = businessFields[0].id;
          }
        });
    },
    setCountryCode(prefix, e) {
      this[prefix + "_country_code"] = e.dialCode;
    },
    navigatePrev() {
      this.$router.push("/step-2/");
    },
    navigateNext() {
      this.$v.$touch();
      if (this.$v.$error) return;
      this.storeData();
    },
    async storeData() {
      await this.$store
        .dispatch("updateDraftAccount", this.$store.getters.fields)
        .then(response => {
          //console.log(response);
          this.$store.commit("SET_VALIDATED_STEP", 3);
          this.$router.push("/step-4/");
        });
    }
  }
};
</script>
