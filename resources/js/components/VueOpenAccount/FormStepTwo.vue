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
      <!-- Occupation -->
      <div
        class="flex flex-wrap px-4 py-6 lg:flex-nowrap lg:gap-6 lg:px-8 lg:py-11 border-b border-gray-200"
      >
        <div class="w-full lg:w-1/4">
          <h3 class="text-xl font-bold mb-4">Data Pekerjaan</h3>
        </div>

        <div class="w-full grid grid-cols-1 gap-6 lg:w-3/4">
          <!-- Occupation -->
          <div class="flex flex-wrap gap-y-6 md:flex-nowrap md:gap-x-4">
            <div class="w-full md:w-1/3">
              <div class="form-label">
                Pekerjaan <span class="form-required">*</span>
              </div>
              <select
                v-model="occupation_id_bca"
                name="occupation_id_bca"
                @change="setOccupation($event)"
              >
                <option disabled value="">-- Pilih --</option>
                <option
                  v-for="option in occupation_options"
                  :value="option.id"
                  :key="option.id"
                >
                  {{ option.name }}
                </option>
              </select>
              <div v-show="occupationIsOther" class="mt-2">
                <input
                  type="text"
                  v-model="occupation_text"
                  @change="$v.occupation_text.$touch()"
                  name="occupation_text"
                  placeholder="Isi Pekerjaan Anda"
                />
              </div>
              <div
                v-if="
                  ($v.occupation_id_bca.$error &&
                    !$v.occupation_id_bca.required) ||
                    ($v.occupation_text.$error && !$v.occupation_text.required)
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
              <div v-show="!jobPositionIsText">
                <select
                  v-model="job_position"
                  name="job_position"
                  @change="setBusinessField(null, $event.target.value)"
                >
                  <option disabled value="">-- Pilih --</option>
                  <option
                    v-for="option in position_options"
                    :value="option.id"
                    :key="option.id"
                  >
                    {{ option.name }}
                  </option>
                </select>
              </div>
              <div
                v-show="jobPositionIsOther || jobPositionIsText"
                v-bind:class="{ 'mt-2': jobPositionIsOther }"
              >
                <input
                  type="text"
                  v-model="job_position_text"
                  @change="$v.job_position_text.$touch()"
                  name="job_position_text"
                  placeholder="Isi Jabatan/Pangkat Anda"
                />
              </div>
              <div
                v-if="
                  ($v.job_position.$error && !$v.job_position.required) ||
                    ($v.job_position_text.$error &&
                      !$v.job_position_text.required)
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
              <div v-show="!businessFieldIsText">
                <select v-model="business_field" name="business_field">
                  <option disabled value="">-- Pilih --</option>
                  <option
                    v-for="option in business_options"
                    :value="option.id"
                    :key="option.id"
                  >
                    {{ option.name }}
                  </option>
                </select>
              </div>
              <div
                v-show="businessFieldIsOther || businessFieldIsText"
                v-bind:class="{ 'mt-2': businessFieldIsOther }"
              >
                <input
                  type="text"
                  v-model="business_field_text"
                  @change="$v.business_field_text.$touch()"
                  name="business_field_text"
                  placeholder="Isi Bidang Usaha Pekerjaan Anda"
                />
              </div>
              <div
                v-if="
                  ($v.business_field.$error && !$v.business_field.required) ||
                    ($v.business_field_text.$error &&
                      !$v.business_field_text.required)
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
                v-model="company_name"
                @change="$v.company_name.$touch()"
                name="company_name"
                placeholder="Isi Nama Perusahaan/Kantor Anda"
              />
              <div
                v-if="$v.company_name.$error && !$v.company_name.required"
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
                    v-model="company_address"
                    @change="$v.company_address.$touch()"
                    name="company_address"
                    placeholder="Cth: Jl Buncit Persada No 1"
                  />
                  <div
                    v-if="
                      $v.company_address.$error && !$v.company_address.required
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
                    v-model="company_country"
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
                      $v.company_country.$error && !$v.company_country.required
                    "
                    class="form-validation-error"
                  >
                    <small>Negara wajib diisi.</small>
                  </div>
                </div>
                <div class="w-full">
                  <div v-if="company_country == 'INDONESIA'">
                    <div class="form-label">
                      Kota/Kabupaten <span class="form-required">*</span>
                    </div>
                    <v-select
                      v-model="company_city"
                      label="ksei_name"
                      :placeholder="'-- Pilih --'"
                      :options="company_city_options"
                      :reduce="city => city.ksei_name"
                      :clearable="false"
                    >
                    </v-select>
                    <div
                      v-if="$v.company_city.$error && !$v.company_city.required"
                      class="form-validation-error"
                    >
                      <small>Kota/Kabupaten wajib diisi.</small>
                    </div>
                  </div>
                  <div v-if="company_country !== 'INDONESIA'">
                    <div class="form-label">
                      City <span class="form-required">*</span>
                    </div>
                    <input
                      type="text"
                      v-model="company_city_text"
                      name="company_city_text"
                      @change="$v.company_city_text.$touch()"
                      placeholder="City"
                    />
                    <div
                      v-if="
                        $v.company_city_text.$error &&
                          !$v.company_city_text.required
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
                    v-model="company_zip"
                    @change="$v.company_zip.$touch()"
                    name="company_zip"
                    placeholder="Cth: 11250"
                  />
                  <div
                    v-if="$v.company_zip.$error && !$v.company_zip.required"
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
                      v-model="company_phone_number_formatted"
                      v-bind="company_phone_props"
                      @country-changed="setCountryCode('company_phone', $event)"
                    ></vue-tel-input>
                  </div>
                </div>
                <div class="w-full">
                  <div class="form-label">Nomor Faksimili</div>
                  <div class="mt-1">
                    <vue-tel-input
                      v-model="company_fax_number_formatted"
                      v-bind="company_fax_props"
                      @country-changed="setCountryCode('company_fax', $event)"
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
                    name="company_email"
                    placeholder="Isi alamat email kantor Anda"
                    v-model="company_email"
                  />
                </div>
                <div class="w-full">
                  <div class="form-label">
                    Lama Bekerja/Usaha <span class="form-required">*</span>
                  </div>
                  <div class="flex flex-nowrap gap-2">
                    <select v-model="work_year" name="home_status" class="mb-1">
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
                    <select v-model="work_month" name="work_month" class="mb-1">
                      <option disabled value="">Bln</option>
                      <option v-for="i in 12" :value="i" :key="i">
                        {{ i }}
                      </option>
                    </select>
                  </div>
                  <div
                    v-if="$v.work_year.$error && !$v.work_year.required"
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
          <h3 class="text-xl font-bold mb-4">Data Keuangan</h3>
        </div>
        <div class="w-full grid grid-cols-1 gap-6 lg:w-3/4">
          <div class="grid grid-cols-1 gap-y-6 md:grid-cols-2 md:gap-x-4">
            <div class="w-full">
              <div class="form-label">
                Penghasilan Utama/Kotor/thn <span class="form-required">*</span>
              </div>
              <select v-model="income_yearly" name="income_yearly" class="mb-1">
                <option disabled value="">-- Pilih --</option>
                <option value="1">&lt; 10 Juta</option>
                <option value="2">10-50 Juta </option>
                <option value="3">50 - 100 Juta</option>
                <option value="4">100 - 500 Juta</option>
                <option value="5">500 Juta - 1 Miliar</option>
                <option value="6">&gt; 1 Miliar</option>
              </select>
              <div
                v-if="$v.income_yearly.$error && !$v.income_yearly.required"
                class="form-validation-error"
              >
                <small>Penghasilan Utama wajib diisi.</small>
              </div>
            </div>
            <div class="w-full">
              <div class="form-label">
                Sumber Penghasilan Utama <span class="form-required">*</span>
              </div>
              <select v-model="income_source" name="income_source" class="mb-1">
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
                v-if="$v.income_source.$error && !$v.income_source.required"
                class="form-validation-error"
              >
                <small>Sumber Penghasilan Utama wajib diisi.</small>
              </div>
              <div v-if="income_source == '1'">
                <input
                  type="text"
                  v-model="income_source_other"
                  @change="$v.income_source_other.$touch()"
                  name="income_source_other"
                  placeholder="Isi Sumber Penghasilan Utama Anda *"
                />
                <div
                  v-if="
                    $v.income_source_other.$error &&
                      !$v.income_source_other.required
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
                <span class="form-required">*</span>
              </div>
              <select
                v-model="extra_income_yearly"
                name="extra_income_yearly"
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
                  $v.extra_income_yearly.$error &&
                    !$v.extra_income_yearly.required
                "
                class="form-validation-error"
              >
                <small>Penghasilan Tambahan wajib diisi.</small>
              </div>
            </div>
            <div class="w-full">
              <div class="form-label">
                Sumber Penghasilan Tambahan <span class="form-required">*</span>
              </div>
              <select
                v-model="extra_income_source"
                name="extra_income_source"
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
                  $v.extra_income_source.$error &&
                    !$v.extra_income_source.required
                "
                class="form-validation-error"
              >
                <small>Sumber Penghasilan Tambahan wajib diisi.</small>
              </div>
              <div v-if="extra_income_source == '1'">
                <input
                  type="text"
                  v-model="extra_income_source_other"
                  @change="$v.extra_income_source_other.$touch()"
                  name="income_source_other"
                  placeholder="Isi Sumber Penghasilan Tambahan Anda *"
                />
                <div
                  v-if="
                    $v.extra_income_source_other.$error &&
                      !$v.extra_income_source_other.required
                  "
                  class="form-validation-error"
                >
                  <small>Sumber Penghasilan Tambahan wajib diisi.</small>
                </div>
              </div>
            </div>
          </div>
          <div class="grid grid-cols-1 gap-y-6 md:grid-cols-3 md:gap-x-8">
            <div class="w-full">
              <div class="form-label">Pengeluaran per Bulan</div>
              <select
                v-model="expenses_monthly"
                name="expenses_monthly"
                class="mb-1"
              >
                <option value="">-- Pilih --</option>
                <option value="1"> &lt; 5 Juta</option>
                <option value="2">5-10 Juta </option>
                <option value="3">10 - 25 Juta</option>
                <option value="4">25 - 50 Juta</option>
                <option value="5">50 - 100 Juta</option>
                <option value="6">&gt; 100 Juta</option>
              </select>
            </div>
            <div class="w-full md:col-span-2">
              <div class="form-label">
                Tujuan Investasi <span class="form-required">*</span>
              </div>

              <div
                class="w-full grid grid-cols-1 gap-y-1 gap-x-2 md:grid-cols-2"
              >
                <div class="form-check mt-1 inline-flex">
                  <input
                    v-model="objectives"
                    type="checkbox"
                    name="objectives"
                    id="objective2"
                    value="2"
                    class="form-check-input"
                  />
                  <label
                    class="form-check-label inline-block ml-2"
                    for="objective2"
                    >Apresiasi Harga</label
                  >
                </div>
                <div class="form-check mt-1 inline-flex">
                  <input
                    v-model="objectives"
                    type="checkbox"
                    name="objectives"
                    id="objective3"
                    value="3"
                    class="form-check-input"
                  />
                  <label
                    class="form-check-label inline-block ml-2"
                    for="objective3"
                    >Investasi Jangka Panjang</label
                  >
                </div>
                <div class="form-check mt-1 inline-flex">
                  <input
                    v-model="objectives"
                    type="checkbox"
                    name="objectives"
                    id="objective4"
                    value="4"
                    class="form-check-input"
                  />
                  <label
                    class="form-check-label inline-block ml-2"
                    for="objective4"
                    >Spekulasi</label
                  >
                </div>
                <div class="form-check mt-1 inline-flex">
                  <input
                    v-model="objectives"
                    type="checkbox"
                    name="objectives"
                    id="objective5"
                    value="5"
                    class="form-check-input"
                  />
                  <label
                    class="form-check-label inline-block ml-2"
                    for="objective5"
                    >Sumber Pendapatan</label
                  >
                </div>
                <div class="form-check mt-1 inline-flex">
                  <input
                    v-model="objectives"
                    type="checkbox"
                    name="objectives"
                    id="objective1"
                    value="1"
                    class="form-check-input"
                  />
                  <label
                    class="form-check-label inline-block ml-2"
                    for="objective1"
                    >Lainnya</label
                  >
                </div>
              </div>
              <div
                v-if="$v.objectives.$error && !$v.objectives.required"
                class="form-validation-error"
              >
                <small>Tujuan Investasi wajib diisi.</small>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Heir Data -->
      <div
        class="flex flex-wrap px-4 py-6 lg:flex-nowrap lg:gap-6 lg:px-8 lg:py-11 border-b border-gray-200"
      >
        <div class="w-full lg:w-1/4">
          <h3 class="text-xl font-bold mb-4">Data Ahli Waris</h3>
        </div>
        <div class="w-full grid grid-cols-1 gap-6 lg:w-3/4">
          <div class="w-full grid grid-cols-1 md:grid-cols-2 gap-x-4 gap-y-2">
            <div class="w-full">
              <div class="form-label">
                Nama Ahli Waris <span class="form-required">*</span>
              </div>
              <input
                type="text"
                v-model="heir_name"
                name="heir_name"
                @change="$v.heir_name.$touch()"
                placeholder="Isi Nama Ahli Waris Anda"
              />
              <div
                v-if="$v.heir_name.$error && !$v.heir_name.required"
                class="form-validation-error"
              >
                <small>Nama Ahli Waris wajib diisi.</small>
              </div>
            </div>
            <div class="w-full">
              <div class="form-label">
                Hubungan <span class="form-required">*</span>
              </div>
              <input
                type="text"
                v-model="heir_relationship"
                name="heir_relationship"
                @change="$v.heir_relationship.$touch()"
                placeholder="Isi Hubungan dengan Ahli Waris Anda"
              />
              <div
                v-if="
                  $v.heir_relationship.$error && !$v.heir_relationship.required
                "
                class="form-validation-error"
              >
                <small>Hubungan Ahli Waris wajib diisi.</small>
              </div>
            </div>
          </div>
          <div class="w-full grid grid-cols-1 md:grid-cols-3 gap-x-4 gap-y-2">
            <div class="w-full md:col-span-full">
              <div class="form-label">
                Alamat <span class="form-required">*</span>
              </div>
              <input
                type="text"
                v-model="heir_address"
                @change="$v.heir_address.$touch()"
                name="heir_address"
                placeholder="Cth: Jl Buncit Persada No 1"
              />
              <div
                v-if="$v.heir_address.$error && !$v.heir_address.required"
                class="form-validation-error"
              >
                <small>Alamat wajib diisi.</small>
              </div>
            </div>
            <div class="w-full">
              <div class="form-label">
                Negara <span class="form-required">*</span>
              </div>
              <v-select
                v-model="heir_country"
                label="name"
                :placeholder="'-- Pilih --'"
                :options="country_options"
                :reduce="country => country.name"
                :clearable="false"
                @input="clearCityText('heir')"
              >
              </v-select>
              <div
                v-if="$v.heir_country.$error && !$v.heir_country.required"
                class="form-validation-error"
              >
                <small>Negara wajib diisi.</small>
              </div>
            </div>
            <div class="w-full">
              <div v-if="heir_country == 'INDONESIA'">
                <div class="form-label">
                  Kota/Kabupaten <span class="form-required">*</span>
                </div>
                <v-select
                  v-model="heir_city"
                  label="ksei_name"
                  :placeholder="'-- Pilih --'"
                  :options="heir_city_options"
                  :reduce="city => city.ksei_name"
                  :clearable="false"
                >
                </v-select>
                <div
                  v-if="$v.heir_city.$error && !$v.heir_city.required"
                  class="form-validation-error"
                >
                  <small>Kota/Kabupaten wajib diisi.</small>
                </div>
              </div>
              <div v-if="heir_country !== 'INDONESIA'">
                <div class="form-label">
                  City <span class="form-required">*</span>
                </div>
                <input
                  type="text"
                  v-model="heir_city_text"
                  name="heir_city_text"
                  @change="$v.heir_city_text.$touch()"
                  placeholder="City"
                />
                <div
                  v-if="$v.heir_city_text.$error && !$v.heir_city_text.required"
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
                v-model="heir_zip"
                @change="$v.heir_zip.$touch()"
                name="heir_zip"
                placeholder="Cth: 11250"
              />
              <div
                v-if="$v.heir_zip.$error && !$v.heir_zip.required"
                class="form-validation-error"
              >
                <small>Kode Pos wajib diisi.</small>
              </div>
            </div>
          </div>
          <div class="w-full grid grid-cols-1 md:grid-cols-2 gap-x-4 gap-y-2">
            <div class="w-full">
              <div class="form-label">Nomor Handphone</div>
              <div class="mt-1">
                <vue-tel-input
                  v-model="heir_mobile_number_formatted"
                  v-bind="heir_mobile_number_props"
                  @country-changed="setCountryCode('heir_mobile', $event)"
                ></vue-tel-input>
              </div>
            </div>
            <div class="w-full">
              <div class="form-label">Email</div>
              <input
                type="text"
                name="heir_email"
                placeholder="Isi email ahli waris Anda"
                v-model="heir_email"
              />
            </div>
          </div>
        </div>
      </div>

      <!-- Bank Data -->
      <div
        class="flex flex-wrap px-4 py-6 lg:flex-nowrap lg:gap-6 lg:px-8 lg:py-11 border-b border-gray-200"
      >
        <div class="w-full lg:w-1/4">
          <h3 class="text-xl font-bold mb-4">Referensi Bank</h3>
        </div>
        <div class="w-full grid grid-cols-1 gap-6 lg:w-3/4">
          <div class="w-full">
            <div class="w-full">
              <h4 class="font-bold text-base mb-2">
                Referensi Rekening Selain Bank BCA
              </h4>
            </div>
            <div class="w-full grid grid-cols-1 md:grid-cols-3 gap-x-4 gap-y-2">
              <div class="w-full">
                <div class="form-label">Nama Bank & Cabang</div>
                <v-select
                  v-model="bank_3_name"
                  label="name"
                  :placeholder="'-- Pilih --'"
                  :options="bank_name_options"
                  :reduce="bank => bank.name"
                  :clearable="true"
                >
                </v-select>
              </div>
              <div class="w-full">
                <div class="form-label">
                  Nama Pemilik Rekening
                </div>
                <input
                  type="text"
                  v-model="bank_3_accname"
                  name="bank_3_accname"
                  placeholder="Isi nama pemilik rekening"
                />
              </div>
              <div class="w-full">
                <div class="form-label">
                  Nama Pemilik Rekening
                </div>
                <input
                  type="text"
                  v-model="bank_3_accnumber"
                  name="bank_3_accnumber"
                  placeholder="Isi nomor rekening"
                />
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- FATCA Declaration -->
      <div
        class="flex flex-wrap px-4 py-6 lg:flex-nowrap lg:gap-6 lg:px-8 lg:py-11 border-b border-gray-200"
      >
        <div class="w-full lg:w-1/4">
          <h3 class="text-xl font-bold mb-4">Deklarasi FATCA</h3>
        </div>
        <div class="w-full grid grid-cols-1 gap-3 lg:w-3/4">
          <div class="w-full">
            <div class="form-check mt-1 inline-flex">
              <input
                v-model="fatca_holder"
                type="checkbox"
                name="fatca_holder"
                id="fatca_holder"
                class="form-check-input"
              />
              <label
                class="form-check-label inline-block ml-2"
                for="fatca_holder"
                >Saya memiliki kewajiban FATCA (Foreign Account Tax Compliance
                Act)</label
              >
            </div>
            <div v-show="fatca_holder" class="w-full mt-2 mb-2 pl-6">
              <input
                type="text"
                name="tin_ssn_number"
                placeholder="Isi TIN/SSN Anda *"
                v-model="tin_ssn_number"
                @change="$v.tin_ssn_number.$touch()"
              />
              <div
                v-if="$v.tin_ssn_number.$error && !$v.tin_ssn_number.required"
                class="form-validation-error"
              >
                <small>TIN/SSN wajib diisi.</small>
              </div>
            </div>
          </div>
          <div class="w-full">
            <div class="form-check mt-1 inline-flex">
              <input
                v-model="other_taxpayer"
                type="checkbox"
                name="other_taxpayer"
                id="other_taxpayer"
                class="form-check-input"
              />
              <label
                class="form-check-label inline-block ml-2"
                for="other_taxpayer"
                >Saya memiliki kewajiban pajak di negara lain selain Indonesia
                dan Amerika Serikat</label
              >
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
import { required, requiredUnless, requiredIf } from "vuelidate/lib/validators";
import vSelect from "vue-select";
import { VueTelInput } from "vue-tel-input";
import { mutateFields } from "../../helpers/helpers.js";
import FormProgress from "./FormProgress.vue";
import Loading from "vue-loading-overlay";
import "vue-loading-overlay/dist/vue-loading.css";

export default {
  components: { vSelect, VueTelInput, FormProgress, Loading },
  data() {
    return {
      isLoading: false,
      occupation_options: [],
      position_options: [],
      business_options: [],
      countries: null,
      country_options: [],
      company_city_options: [],
      company_phone_props: {
        inputId: "company_phone_number_formatted",
        name: "company_phone_number_formatted",
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
      company_fax_props: {
        inputId: "company_fax_number_formatted",
        name: "company_fax_number_formatted",
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
      heir_city_options: [],
      heir_mobile_number_props: {
        inputId: "heir_mobile_number_formatted",
        name: "heir_mobile_number_formatted",
        mode: "international",
        defaultCountry: "ID",
        preferredCountries: ["ID", "SG", "MY"],
        placeholder: "81234567890",
        enabledCountryCode: false,
        autocomplete: "off",
        inputOptions: {
          showDialCode: true
        }
      },
      bank_name_options: []
    };
  },
  mounted() {
    this.$store.commit("SET_STEP", "2");
    const step_validated = this.$store.getters.step_validated;
    if (step_validated < 1) {
      this.$router.push("/step-1/");
    }
    axios.get("/api/countries").then(response => {
      this.countries = response.data;
      this.country_options = response.data;
    });
    axios.get("/api/city/ksei_cities").then(response => {
      this.company_city_options = response.data;
      this.heir_city_options = response.data;
    });
    axios.get("/api/occupation").then(response => {
      this.occupation_options = response.data;
    });
    if (this.occupation_id_bca) {
      axios.get("/api/position/" + this.occupation_id_bca).then(response => {
        let jobPositions = response.data;
        this.position_options = jobPositions;
      });
    }
    if (this.occupation_id_bca && this.job_position) {
      axios
        .get(
          "/api/business/" + this.occupation_id_bca + "/" + this.job_position
        )
        .then(response => {
          let businessFields = response.data;
          this.business_options = businessFields;
        });
    }
    axios.get("/api/bank").then(response => {
      this.bank_name_options = response.data;
    });
  },
  computed: {
    ...mutateFields({
      fields: [
        "occupation_id_bca",
        "occupation_id_ksei",
        "occupation_name",
        "occupation_text",
        "job_position",
        "job_position_text",
        "business_field",
        "business_field_text",
        "company_name",
        "company_address",
        "company_country",
        "company_city",
        "company_city_text",
        "company_zip",
        "company_phone_country_code",
        "company_phone_number_formatted",
        "company_fax_country_code",
        "company_fax_number_formatted",
        "company_email",
        "work_year",
        "work_month",
        "income_yearly",
        "income_source",
        "income_source_other",
        "extra_income_yearly",
        "extra_income_source",
        "extra_income_source_other",
        "expenses_monthly",
        "objectives",
        "heir_name",
        "heir_relationship",
        "heir_address",
        "heir_country",
        "heir_city",
        "heir_city_text",
        "heir_zip",
        "heir_mobile_country_code",
        "heir_mobile_number_formatted",
        "heir_email",
        "bank_3_name",
        "bank_3_accname",
        "bank_3_accnumber",
        "fatca_holder",
        "tin_ssn_number",
        "other_taxpayer"
      ],
      base: "fields",
      mutation: "UPDATE_FIELD"
    }),
    occupationIsOther() {
      if (this.$store.getters.fields.occupation_id_bca == 18) return true;
      return false;
    },
    jobPositionIsOther() {
      if (this.$store.getters.fields.job_position == 99) return true;
      return false;
    },
    jobPositionIsText() {
      if (this.$store.getters.fields.occupation_id_bca == 3) return true;
      return false;
    },
    businessFieldIsOther() {
      if (this.$store.getters.fields.business_field == 99) return true;
      return false;
    },
    businessFieldIsText() {
      if (this.$store.getters.fields.occupation_id_bca == 3) return true;
      return false;
    }
  },
  validations: {
    occupation_id_bca: {
      required
    },
    occupation_text: {
      required: requiredIf("occupationIsOther")
    },
    job_position: {
      required: requiredUnless("jobPositionIsText")
    },
    job_position_text: {
      required: requiredIf(function() {
        return this.jobPositionIsOther || this.jobPositionIsText;
      })
    },
    business_field: {
      required: requiredUnless("businessFieldIsText")
    },
    business_field_text: {
      required: requiredIf(function() {
        return this.businessFieldIsOther || this.businessFieldIsText;
      })
    },
    company_name: {
      required
    },
    company_address: {
      required
    },
    company_country: {
      required
    },
    company_city: {
      required: requiredIf(function() {
        return this.company_country == "INDONESIA";
      })
    },
    company_city_text: {
      required: requiredIf(function() {
        return this.company_country != "INDONESIA";
      })
    },
    company_zip: {
      required
    },
    work_year: {
      required
    },
    work_month: {
      required
    },
    income_yearly: {
      required
    },
    income_source: {
      required
    },
    income_source_other: {
      required: requiredIf(function() {
        return this.income_source == "1";
      })
    },
    extra_income_yearly: {
      required
    },
    extra_income_source: {
      required
    },
    extra_income_source_other: {
      required: requiredIf(function() {
        return this.extra_income_source == "1";
      })
    },
    objectives: {
      required
    },
    heir_name: {
      required
    },
    heir_relationship: {
      required
    },
    heir_address: {
      required
    },
    heir_country: {
      required
    },
    heir_city: {
      required: requiredIf(function() {
        return this.heir_country == "INDONESIA";
      })
    },
    heir_city_text: {
      required: requiredIf(function() {
        return this.heir_country != "INDONESIA";
      })
    },
    heir_zip: {
      required
    },
    tin_ssn_number: {
      required: requiredIf(function() {
        return this.fatca_holder;
      })
    }
  },
  methods: {
    clearCityText(prefix) {
      this[prefix + "_city_text"] = "";
    },
    setOccupation(e) {
      this.occupation_id_bca = "";
      this.occupation_id_ksei = "";
      this.occupation_name = "";
      this.occupation_text = "";
      let occupation_id = e.target.value;
      axios.get("/api/occupation/" + occupation_id).then(response => {
        let occupation = response.data;
        this.occupation_id_bca = occupation[0].id;
        this.occupation_id_ksei = occupation[0].ksei_code;
        this.occupation_name = occupation[0].name;
      });
      this.setJobPosition(occupation_id);
    },
    setJobPosition(occupation_id) {
      this.position_options = [];
      this.job_position = "";
      this.job_position_text = "";
      this.business_options = [];
      this.business_field = "";
      this.business_field_text = "";
      axios.get("/api/position/" + occupation_id).then(response => {
        let jobPositions = response.data;
        this.position_options = jobPositions;
        let countPositions = Object.keys(jobPositions).length;
        if (countPositions == 1) {
          this.job_position = jobPositions[0].id;
          let position_id = jobPositions[0].id;
          this.setBusinessField(occupation_id, position_id);
        }
      });
    },
    setBusinessField(occupation_id, position_id) {
      this.business_options = [];
      this.business_field = "";
      this.business_field_text = "";
      if (occupation_id == null) {
        occupation_id = this.occupation_id_bca;
      }
      axios
        .get("/api/business/" + occupation_id + "/" + position_id)
        .then(response => {
          let businessFields = response.data;
          this.business_options = businessFields;
          let countBusiness = Object.keys(businessFields).length;
          if (countBusiness == 1) {
            this.business_field = businessFields[0].id;
          }
        });
    },
    setCountryCode(prefix, e) {
      this[prefix + "_country_code"] = e.dialCode;
    },
    navigatePrev() {
      this.$router.push("/step-1/");
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
          console.log(response);
          this.$store.commit("SET_VALIDATED_STEP", 2);
          this.$router.push("/step-3/");
        });
    }
  }
};
</script>
