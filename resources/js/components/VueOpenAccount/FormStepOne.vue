<template>
  <div>
    <form-progress></form-progress>
    <div id="top" class="bg-white shadow relative">
      <loading
        :active.sync="isLoading"
        :can-cancel="true"
        :is-full-page="true"
        color="#007BFF"
      />
      <!-- Data Identitas -->
      <div
        class="flex flex-wrap px-4 py-6 lg:flex-nowrap lg:gap-6 lg:px-8 lg:py-11 border-b border-gray-200"
      >
        <div class="w-full lg:w-1/4">
          <h3 class="text-xl font-bold mb-4">Data Identitas</h3>
        </div>

        <div class="w-full grid grid-cols-1 gap-6 lg:w-3/4">
          <!-- Name & Nationality -->
          <div class="flex flex-wrap gap-y-6 md:flex-nowrap md:gap-x-4">
            <div class="w-full md:w-3/5">
              <div class="form-label">
                Nama lengkap
                <span class="form-required">*</span>
              </div>
              <input
                type="text"
                name="full_name"
                placeholder="Isi nama lengkap Anda sesuai identitas"
                v-model="full_name"
                @change="$v.full_name.$touch()"
              />
              <div
                v-if="$v.full_name.$error && !$v.full_name.required"
                class="form-validation-error"
              >
                <small>Nama Lengkap wajib diisi.</small>
              </div>
            </div>
            <div class="w-full md:w-2/5">
              <div class="form-label">
                Kewarganegaraan <span class="form-required">*</span>
              </div>
              <v-select
                v-model="nationality"
                label="nationality"
                :placeholder="'-- Pilih --'"
                :options="country_options"
                :reduce="country => country.nationality"
                :clearable="false"
              >
              </v-select>
              <div
                v-if="$v.nationality.$error && !$v.nationality.required"
                class="form-validation-error"
              >
                <small>Kewarganegaraan wajib diisi.</small>
              </div>
            </div>
          </div>

          <!-- ID Type -->
          <div class="flex flex-wrap gap-y-2 md:flex-nowrap md:gap-x-4">
            <div class="w-full md:w-2/12">
              <div class="form-label">
                Jenis Kartu ID
                <span class="form-required">*</span>
              </div>

              <select
                v-model="id_type"
                name="id_type"
                @change="clearIdCardField($event)"
              >
                <option disabled value="">-- Pilih --</option>
                <option value="KTP">KTP</option>
                <option value="Paspor">Paspor</option>
              </select>

              <div
                v-if="$v.id_type.$error && !$v.id_type.required"
                class="form-validation-error"
              >
                <small>Jenis kartu identitas wajib diisi.</small>
              </div>
            </div>

            <div
              class="w-full flex flex-wrap gap-y-2 md:flex-nowrap md:w-10/12 md:gap-x-4"
            >
              <div
                v-show="idTypeIsKtp"
                class="w-full flex flex-wrap md:flex-nowrap md:gap-x-4"
              >
                <div class="w-full md:w-1/2">
                  <div class="form-label">
                    Nomor KTP (NIK) <span class="form-required">*</span>
                  </div>
                  <input
                    type="text"
                    name="ktp_number"
                    placeholder="Isi NIK KTP Anda"
                    v-model="ktp_number"
                    @change="$v.ktp_number.$touch()"
                  />
                  <div
                    v-if="$v.ktp_number.$error && !$v.ktp_number.required"
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
                      v-model="ktp_expired_day"
                      name="ktp_expired_day"
                      :disabled="ktpExpiredIsLifetime == 1"
                      class="mb-1"
                    >
                      <option value="">Tgl</option>
                      <option v-for="i in 31" :value="i" :key="i">
                        {{ i }}
                      </option>
                    </select>
                    <select
                      v-model="ktp_expired_month"
                      name="ktp_expired_month"
                      class="mb-1"
                      :disabled="ktpExpiredIsLifetime == 1"
                    >
                      <option value="">Bln</option>
                      <option v-for="i in 12" :value="i" :key="i">
                        {{ i }}
                      </option>
                    </select>
                    <select
                      v-model="ktp_expired_year"
                      name="ktp_expired_year"
                      class="mb-1"
                      :disabled="ktpExpiredIsLifetime == 1"
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
                        v-model="ktp_expired_lifetime"
                        type="checkbox"
                        name="ktp_expired_lifetime"
                        id="ktp_expired_lifetime"
                        class="form-check-input"
                      />
                      <label
                        class="form-check-label inline-block ml-2"
                        for="ktp_expired_lifetime"
                        >Seumur Hidup</label
                      >
                    </div>
                  </div>

                  <div
                    v-if="
                      $v.ktp_expired_day.$error && !$v.ktp_expired_day.required
                    "
                    class="form-validation-error"
                  >
                    <small>Tanggal Masa Berlaku wajib diisi.</small>
                  </div>
                  <div
                    v-if="
                      $v.ktp_expired_month.$error &&
                        !$v.ktp_expired_month.required
                    "
                    class="form-validation-error"
                  >
                    <small>Bulan Masa Berlaku wajib diisi.</small>
                  </div>
                  <div
                    v-if="
                      $v.ktp_expired_year.$error &&
                        !$v.ktp_expired_year.required
                    "
                    class="form-validation-error"
                  >
                    <small>Tahun Masa Berlaku wajib diisi.</small>
                  </div>
                </div>
              </div>

              <div
                v-show="idTypeIsPassport"
                class="w-full flex flex-wrap md:flex-nowrap md:gap-x-4"
              >
                <div class="w-full md:w-1/2">
                  <div class="form-label">
                    Nomor Paspor <span class="form-required">*</span>
                  </div>
                  <input
                    type="text"
                    name="passport_number"
                    placeholder="Isi nomor paspor Anda"
                    v-model="passport_number"
                    @change="$v.passport_number.$touch()"
                  />
                  <div
                    v-if="
                      $v.passport_number.$error && !$v.passport_number.required
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
                      v-model="passport_expired_day"
                      name="passport_expired_day"
                      class="mb-1"
                    >
                      <option value="">Tgl</option>
                      <option v-for="i in 31" :value="i" :key="i">
                        {{ i }}
                      </option>
                    </select>
                    <select
                      v-model="passport_expired_month"
                      name="passport_expired_month"
                      class="mb-1"
                    >
                      <option value="">Bln</option>
                      <option v-for="i in 12" :value="i" :key="i">
                        {{ i }}
                      </option>
                    </select>
                    <select
                      v-model="passport_expired_year"
                      name="passport_expired_year"
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
                      $v.passport_expired_day.$error &&
                        !$v.passport_expired_day.required
                    "
                    class="form-validation-error"
                  >
                    <small>Tanggal Masa Berlaku wajib diisi.</small>
                  </div>
                  <div
                    v-if="
                      $v.passport_expired_month.$error &&
                        !$v.passport_expired_month.required
                    "
                    class="form-validation-error"
                  >
                    <small>Bulan Masa Berlaku wajib diisi.</small>
                  </div>
                  <div
                    v-if="
                      $v.passport_expired_year.$error &&
                        !$v.passport_expired_year.required
                    "
                    class="form-validation-error"
                  >
                    <small>Tahun Masa Berlaku wajib diisi.</small>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- KITAS/SKD -->
          <div
            v-show="nationality != 'INDONESIAN'"
            class="flex flex-wrap gap-y-2 md:flex-nowrap md:gap-x-4"
          >
            <div class="w-full md:w-2/12">
              <div class="form-label">
                KITAS/SKD <span class="form-required">*</span>
              </div>

              <select
                v-model="has_kitas"
                name="has_kitas"
                class="mb-1"
                @change="clearKitasField($event)"
              >
                <option disabled value="">-- Pilih --</option>
                <option value="1">Ada</option>
                <option value="2">Tidak Ada</option>
              </select>
            </div>

            <div class="w-full md:w-5/12">
              <div class="form-label">
                Nomor KITAS/SKD
                <span v-show="has_kitas == 1" class="form-required">*</span>
              </div>
              <input
                type="text"
                name="kitas_number"
                placeholder="Isi Nomor KITAS/SKD Anda"
                v-model="kitas_number"
                :disabled="has_kitas != '1'"
                @change="$v.kitas_number.$touch()"
              />
              <div
                v-if="$v.kitas_number.$error && !$v.kitas_number.required"
                class="form-validation-error"
              >
                <small>Nomor KITAS/SKD wajib diisi.</small>
              </div>
            </div>

            <div class="w-full md:w-5/12">
              <div class="form-label">
                KITAS/SKD Berlaku S/D
                <span v-show="has_kitas == 1" class="form-required">*</span>
              </div>
              <div class="flex flex-nowrap gap-2">
                <select
                  v-model="kitas_expired_day"
                  name="kitas_expired_day"
                  class="mb-1 w-1/3"
                  :disabled="has_kitas != '1'"
                >
                  <option value="">Tgl</option>
                  <option v-for="i in 31" :value="i" :key="i">
                    {{ i }}
                  </option>
                </select>
                <select
                  v-model="kitas_expired_month"
                  name="kitas_expired_month"
                  class="mb-1 w-1/3"
                  :disabled="has_kitas != '1'"
                >
                  <option value="">Bln</option>
                  <option v-for="i in 12" :value="i" :key="i">
                    {{ i }}
                  </option>
                </select>
                <select
                  v-model="kitas_expired_year"
                  name="kitas_expired_year"
                  class="mb-1 w-1/3"
                  :disabled="has_kitas != '1'"
                >
                  <option value="">Thn</option>
                  <option v-for="year in idCardYears" :value="year" :key="year">
                    {{ year }}
                  </option>
                </select>
              </div>
              <div
                v-if="
                  $v.kitas_expired_day.$error && !$v.kitas_expired_day.required
                "
                class="form-validation-error"
              >
                <small>Tanggal Masa Berlaku wajib diisi.</small>
              </div>
              <div
                v-if="
                  $v.kitas_expired_month.$error &&
                    !$v.kitas_expired_month.required
                "
                class="form-validation-error"
              >
                <small>Bulan Masa Berlaku wajib diisi.</small>
              </div>
              <div
                v-if="
                  $v.kitas_expired_year.$error &&
                    !$v.kitas_expired_year.required
                "
                class="form-validation-error"
              >
                <small>Tahun Masa Berlaku wajib diisi.</small>
              </div>
            </div>
          </div>

          <!-- NPWP -->
          <div class="flex flex-wrap gap-y-2 md:flex-nowrap md:gap-x-4">
            <div class="w-full md:w-2/12">
              <div class="form-label">
                NPWP <span class="form-required">*</span>
              </div>
              <select
                v-model="has_npwp"
                name="has_npwp"
                @change="clearNpwpField($event)"
                class="mb-1"
              >
                <option disabled value="">-- Pilih --</option>
                <option value="1">Tidak Ada</option>
                <option value="2">Individu</option>
                <option value="3">Suami/Istri</option>
              </select>
            </div>

            <div
              class="w-full flex flex-wrap gap-y-2 md:flex-nowrap md:w-10/12 md:gap-x-4"
            >
              <div class="w-full md:w-1/2">
                <div class="form-label">
                  Nomor NPWP <span class="form-required">*</span>
                </div>

                <input
                  type="text"
                  name="npwp_number"
                  placeholder="Isi Nomor NPWP Anda"
                  v-model="npwp_number"
                  :disabled="has_npwp == 1"
                  @change="$v.npwp_number.$touch()"
                />
                <div
                  v-if="$v.npwp_number.$error && !$v.npwp_number.required"
                  class="form-validation-error"
                >
                  <small>Nomor NPWP wajib diisi.</small>
                </div>
              </div>
              <div class="w-full md:w-1/2">
                <div class="form-label">
                  Tanggal Penerbitan NPWP
                </div>
                <div class="flex flex-nowrap gap-2">
                  <select
                    v-model="npwp_issue_day"
                    name="npwp_issue_day"
                    class="mb-1"
                    :disabled="has_npwp == 1"
                  >
                    <option value="">Tgl</option>
                    <option v-for="i in 31" :value="i" :key="i">
                      {{ i }}
                    </option>
                  </select>

                  <select
                    v-model="npwp_issue_month"
                    name="npwp_issue_month"
                    class="mb-1"
                    :disabled="has_npwp == 1"
                  >
                    <option value="">Bln</option>
                    <option v-for="i in 12" :value="i" :key="i">
                      {{ i }}
                    </option>
                  </select>
                  <select
                    v-model="npwp_issue_year"
                    name="npwp_issue_year"
                    class="mb-1"
                    :disabled="has_npwp == 1"
                  >
                    <option value="">Thn</option>
                    <option v-for="year in npwpYears" :value="year" :key="year">
                      {{ year }}
                    </option>
                  </select>
                </div>
              </div>
            </div>
          </div>

          <!-- Birth Place, Birth Date -->
          <div class="flex flex-wrap gap-y-6 md:flex-nowrap md:gap-x-4">
            <div class="w-full md:w-3/12">
              <div class="form-label">
                Negara Lahir <span class="form-required">*</span>
              </div>
              <v-select
                v-model="birth_country"
                label="name"
                :placeholder="'-- Pilih --'"
                :options="country_options"
                :reduce="country => country.name"
                :clearable="false"
              >
              </v-select>
              <div
                v-if="$v.birth_country.$error && !$v.birth_country.required"
                class="form-validation-error"
              >
                <small>Negara Kelahiran wajib diisi.</small>
              </div>
            </div>
            <div class="w-full md:w-4/12">
              <label class="form-label"
                >Tempat Lahir <span class="form-required">*</span></label
              >
              <div v-show="birth_country == 'INDONESIA'">
                <v-select
                  v-model="birth_place"
                  label="ksei_name"
                  :placeholder="'-- Pilih --'"
                  :options="birth_places_options"
                  :reduce="city => city.ksei_name"
                  :clearable="false"
                >
                </v-select>
                <div
                  v-if="$v.birth_place.$error && !$v.birth_place.required"
                  class="form-validation-error"
                >
                  <small>Kota Kelahiran wajib diisi.</small>
                </div>
              </div>
              <div v-show="birth_country != 'INDONESIA'">
                <input
                  type="text"
                  v-model="birth_place_foreign"
                  name="birth_place_foreign"
                  value="FOREIGN"
                  disabled
                />
              </div>
            </div>
            <div class="w-full md:w-5/12">
              <div class="form-label">
                Tanggal lahir <span class="form-required">*</span>
              </div>
              <div class="flex flex-nowrap gap-2">
                <select v-model="birth_day" name="birth_day" class="mb-1">
                  <option value="">Tgl</option>
                  <option v-for="i in 31" :value="i" :key="i">
                    {{ i }}
                  </option>
                </select>
                <select v-model="birth_month" name="birth_month" class="mb-1">
                  <option value="">Bln</option>
                  <option v-for="i in 12" :value="i" :key="i">
                    {{ i }}
                  </option>
                </select>
                <select v-model="birth_year" name="birth_year" class="mb-1">
                  <option value="">Thn</option>
                  <option v-for="year in birthYears" :value="year" :key="year">
                    {{ year }}
                  </option>
                </select>
              </div>

              <div
                v-if="$v.birth_day.$error && !$v.birth_day.required"
                class="form-validation-error"
              >
                <small>Tanggal Lahir wajib diisi.</small>
              </div>
              <div
                v-if="$v.birth_month.$error && !$v.birth_month.required"
                class="form-validation-error"
              >
                <small>Bulan Lahir wajib diisi.</small>
              </div>
              <div
                v-if="$v.birth_year.$error && !$v.birth_year.required"
                class="form-validation-error"
              >
                <small>Tahun Lahir wajib diisi.</small>
              </div>
            </div>
          </div>

          <!-- Gender, Marital Status, Religion -->
          <div class="flex flex-wrap gap-y-6 md:flex-nowrap md:gap-x-4">
            <div class="w-full md:w-3/12">
              <div class="form-label">
                Jenis Kelamin <span class="form-required">*</span>
              </div>
              <select v-model="gender" name="gender" class="mb-1">
                <option disabled value="">-- Pilih --</option>
                <option value="1">Laki-laki</option>
                <option value="2">Perempuan</option>
              </select>
              <div
                v-if="$v.gender.$error && !$v.gender.required"
                class="form-validation-error"
              >
                <small>Jenis Kelamin wajib diisi.</small>
              </div>
            </div>
            <div class="w-full md:w-4/12">
              <div class="form-label">
                Status Perkawinan <span class="form-required">*</span>
              </div>
              <select
                v-model="marital_status"
                name="marital_status"
                class="mb-1"
              >
                <option disabled value="">-- Pilih --</option>
                <option value="1">Lajang</option>
                <option value="2">Menikah</option>
                <option value="3">Duda</option>
                <option value="4">Janda</option>
              </select>
              <div
                v-if="$v.marital_status.$error && !$v.marital_status.required"
                class="form-validation-error"
              >
                <small>Status Perkawinan wajib diisi.</small>
              </div>
            </div>
            <div class="w-full md:w-5/12">
              <div class="form-label">
                Agama <span class="form-required">*</span>
              </div>
              <select v-model="religion" name="religion" class="mb-1">
                <option disabled value="">-- Pilih --</option>
                <option value="Islam">Islam</option>
                <option value="Katolik">Katolik</option>
                <option value="Kristen">Kristen</option>
                <option value="Hindu">Hindu</option>
                <option value="Budha">Budha</option>
                <option value="Kepercayaan">Aliran Kepercayaan</option>
              </select>
              <div
                v-if="$v.religion.$error && !$v.religion.required"
                class="form-validation-error"
              >
                <small>Agama wajib diisi.</small>
              </div>
            </div>
          </div>

          <!-- Education, Mother Name -->
          <div class="flex flex-wrap gap-y-6 md:flex-nowrap md:gap-x-4">
            <div class="w-full md:w-1/4">
              <div class="form-label">
                Pendidikan <span class="form-required">*</span>
              </div>
              <select v-model="education" name="education" class="mb-1">
                <option disabled value="">-- Pilih --</option>
                <option value="6">S1</option>
                <option value="7">S2</option>
                <option value="8">S3</option>
                <option value="5">Akademi (D3)</option>
                <option value="4">SMA</option>
                <option value="3">SMP</option>
                <option value="2">SD</option>
                <option value="1">Lainnya</option>
              </select>
              <div
                v-if="$v.education.$error && !$v.education.required"
                class="form-validation-error"
              >
                <small>Pendidikan wajib diisi.</small>
              </div>
            </div>
            <div class="w-full md:w-3/4">
              <div class="form-label">
                Nama Gadis Ibu Kandung <span class="form-required">*</span>
              </div>
              <input
                type="text"
                name="mother_name"
                placeholder="Isi nama gadis Ibu Kandung Anda"
                v-model="mother_name"
                @change="$v.mother_name.$touch()"
              />
              <div
                v-if="$v.mother_name.$error && !$v.mother_name.required"
                class="form-validation-error"
              >
                <small>Nama Gadis Ibu Kandung wajib diisi.</small>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Data Kontak -->
      <div
        class="flex flex-wrap px-4 py-6 lg:flex-nowrap lg:gap-6 lg:px-8 lg:py-11 border-b border-gray-200"
      >
        <div class="w-full lg:w-1/4">
          <h3 class="text-xl font-bold mb-4">Data Kontak</h3>
        </div>

        <div class="w-full grid grid-cols-1 gap-6 lg:w-3/4">
          <div class="flex flex-wrap gap-y-6 md:flex-nowrap md:gap-x-4">
            <div class="w-full md:w-1/3">
              <div class="form-label">
                Email <span class="form-required">*</span>
              </div>
              <input
                type="text"
                name="email"
                placeholder="Isi alamat email Anda"
                v-model="email"
                @change="$v.email.$touch()"
              />
              <div
                v-if="$v.email.$error && !$v.email.required"
                class="form-validation-error"
              >
                <small>Email wajib diisi.</small>
              </div>
            </div>

            <div class="w-full md:w-1/3">
              <div class="form-label">
                Nomor Handphone <span class="form-required">*</span>
              </div>
              <div class="mt-1">
                <vue-tel-input
                  v-model="mobile_number_formatted"
                  v-bind="mobile_phone_props"
                  @country-changed="setCountryCode('mobile', $event)"
                ></vue-tel-input>
              </div>
              <div
                v-if="
                  $v.mobile_number_formatted.$error &&
                    !$v.mobile_number_formatted.required
                "
                class="form-validation-error"
              >
                <small>Nomor Handphone wajib diisi.</small>
              </div>
            </div>

            <div class="w-full md:w-1/3">
              <div class="form-label">
                Nomor Telepon Rumah <span class="form-required">*</span>
              </div>
              <div class="mt-1">
                <vue-tel-input
                  v-model="phone_number_formatted"
                  v-bind="phone_props"
                  @country-changed="setCountryCode('phone', $event)"
                ></vue-tel-input>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Data Alamat -->
      <div
        class="flex flex-wrap px-4 py-6 lg:flex-nowrap lg:gap-6 lg:px-8 lg:py-11 border-b border-gray-200"
      >
        <div class="w-full lg:w-1/4">
          <h3 class="text-xl font-bold mb-4">Data Alamat</h3>
        </div>

        <div class="w-full grid grid-cols-1 gap-6 lg:w-3/4">
          <div class="flex flex-wrap gap-2">
            <div class="w-full">
              <h4 class="font-bold text-lg">Alamat Sesuai Identitas</h4>
            </div>
            <div class="w-full flex flex-wrap gap-y-2">
              <div
                class="w-full grid grid-cols-1 md:grid-cols-3 gap-x-4 gap-y-2"
              >
                <div class="w-full md:col-span-full">
                  <div class="form-label">
                    Nama Jalan <span class="form-required">*</span>
                  </div>
                  <input
                    type="text"
                    v-model="id_street_1"
                    @change="$v.id_street_1.$touch()"
                    name="id_street_1"
                    placeholder="Cth: Jl Buncit Persada No 1"
                  />
                  <div
                    v-if="$v.id_street_1.$error && !$v.id_street_1.required"
                    class="form-validation-error"
                  >
                    <small>Nama jalan wajib diisi.</small>
                  </div>
                </div>
                <div
                  class="w-full"
                  :class="
                    idCountryIsIndonesia ? 'md:col-span-2' : 'md:col-span-full'
                  "
                >
                  <div class="form-label">
                    Nama Gedung/Apartemen/Kluster/Komplek (Optional)
                  </div>
                  <input
                    type="text"
                    v-model="id_street_2"
                    name="id_street_2"
                    placeholder="Cth: Alam Raya"
                  />
                </div>
                <div class="w-full" v-if="idCountryIsIndonesia">
                  <div class="form-label">
                    RT/RW
                  </div>
                  <input
                    type="text"
                    v-model="id_rt_rw"
                    name="id_rt_rw"
                    placeholder="Cth: 004/008"
                  />
                </div>
                <div class="w-full">
                  <div class="form-label">
                    Negara <span class="form-required">*</span>
                  </div>
                  <v-select
                    v-model="id_country"
                    label="name"
                    :placeholder="'-- Pilih --'"
                    :options="country_options"
                    :reduce="country => country.name"
                    :clearable="false"
                    @input="clearAddressRegions('id')"
                  >
                  </v-select>
                  <div
                    v-if="$v.id_country.$error && !$v.id_country.required"
                    class="form-validation-error"
                  >
                    <small>Negara wajib diisi.</small>
                  </div>
                </div>
                <div class="w-full">
                  <div v-if="idCountryIsIndonesia">
                    <div class="form-label">
                      Provinsi <span class="form-required">*</span>
                    </div>
                    <select
                      v-model="id_province"
                      name="id_province"
                      @change="setCityOptions($event, 'id')"
                      class="mb-1"
                    >
                      <option disabled value="">-- Pilih --</option>
                      <option
                        v-for="option in id_province_options"
                        :value="option.id"
                        :key="option.id"
                      >
                        {{ option.name }}
                      </option>
                    </select>
                    <div
                      v-if="$v.id_province.$error && !$v.id_province.required"
                      class="form-validation-error"
                    >
                      <small>Provinsi wajib diisi.</small>
                    </div>
                  </div>
                  <div v-if="!idCountryIsIndonesia">
                    <div class="form-label">
                      Province/State <span class="form-required">*</span>
                    </div>
                    <input
                      type="text"
                      v-model="id_province_text"
                      name="id_province_text"
                      @change="$v.id_province_text.$touch()"
                      placeholder="Province/State"
                    />
                    <div
                      v-if="
                        $v.id_province_text.$error &&
                          !$v.id_province_text.required
                      "
                      class="form-validation-error"
                    >
                      <small>Province/State is required.</small>
                    </div>
                  </div>
                </div>
                <div class="w-full">
                  <div v-if="idCountryIsIndonesia">
                    <div class="form-label">
                      Kota/Kabupaten <span class="form-required">*</span>
                    </div>
                    <select
                      v-model="id_city"
                      name="id_city"
                      @change="setDistrictOptions($event, 'id')"
                      class="mb-1"
                    >
                      <option disabled value="">-- Pilih --</option>
                      <option
                        v-for="option in id_city_options"
                        :value="option.id"
                        :key="option.id"
                      >
                        {{ option.name }}
                      </option>
                    </select>
                    <div
                      v-if="$v.id_city.$error && !$v.id_city.required"
                      class="form-validation-error"
                    >
                      <small>Kota/Kabupaten wajib diisi.</small>
                    </div>
                  </div>
                  <div v-if="!idCountryIsIndonesia">
                    <div class="form-label">
                      City <span class="form-required">*</span>
                    </div>
                    <input
                      type="text"
                      v-model="id_city_text"
                      name="id_city_text"
                      @change="$v.id_city_text.$touch()"
                      placeholder="City"
                    />
                    <div
                      v-if="$v.id_city_text.$error && !$v.id_city_text.required"
                      class="form-validation-error"
                    >
                      <small>City is required.</small>
                    </div>
                  </div>
                </div>
                <div class="w-full">
                  <div v-if="idCountryIsIndonesia">
                    <div class="form-label">
                      Kecamatan <span class="form-required">*</span>
                    </div>
                    <select
                      v-model="id_district"
                      name="id_district"
                      @change="setSubDistrictOptions($event, 'id')"
                      class="mb-1"
                    >
                      <option disabled value="">-- Pilih --</option>
                      <option
                        v-for="option in id_district_options"
                        :value="option.id"
                        :key="option.id"
                      >
                        {{ option.name }}
                      </option>
                    </select>
                    <div
                      v-if="$v.id_district.$error && !$v.id_district.required"
                      class="form-validation-error"
                    >
                      <small>Kecamatan wajib diisi.</small>
                    </div>
                  </div>
                  <div v-if="!idCountryIsIndonesia">
                    <div class="form-label">
                      District <span class="form-required">*</span>
                    </div>
                    <input
                      type="text"
                      v-model="id_district_text"
                      name="id_district_text"
                      @change="$v.id_district_text.$touch()"
                      placeholder="District"
                    />
                    <div
                      v-if="
                        $v.id_district_text.$error &&
                          !$v.id_district_text.required
                      "
                      class="form-validation-error"
                    >
                      <small>District is required.</small>
                    </div>
                  </div>
                </div>
                <div class="w-full">
                  <div v-if="idCountryIsIndonesia">
                    <div class="form-label">
                      Kelurahan <span class="form-required">*</span>
                    </div>
                    <select
                      v-model="id_subdistrict"
                      name="id_subdistrict"
                      class="mb-1"
                    >
                      <option disabled value="">-- Pilih --</option>
                      <option
                        v-for="option in id_subdistrict_options"
                        :value="option.id"
                        :key="option.id"
                      >
                        {{ option.name }}
                      </option>
                    </select>
                    <div
                      v-if="
                        $v.id_subdistrict.$error && !$v.id_subdistrict.required
                      "
                      class="form-validation-error"
                    >
                      <small>Kelurahan wajib diisi.</small>
                    </div>
                  </div>
                  <div v-if="!idCountryIsIndonesia">
                    <div class="form-label">
                      Sub District <span class="form-required">*</span>
                    </div>
                    <input
                      type="text"
                      v-model="id_subdistrict_text"
                      name="id_subdistrict_text"
                      @change="$v.id_subdistrict_text.$touch()"
                      placeholder="Sub District"
                    />
                    <div
                      v-if="
                        $v.id_subdistrict_text.$error &&
                          !$v.id_subdistrict_text.required
                      "
                      class="form-validation-error"
                    >
                      <small>Sub District is required.</small>
                    </div>
                  </div>
                </div>
                <div class="w-full">
                  <div class="form-label">
                    Kode Pos <span class="form-required">*</span>
                  </div>
                  <input
                    type="text"
                    v-model="id_zip"
                    @change="$v.id_zip.$touch()"
                    name="id_zip"
                    placeholder="Cth: 11250"
                  />
                  <div
                    v-if="$v.id_zip.$error && !$v.id_zip.required"
                    class="form-validation-error"
                  >
                    <small>Kode Pos wajib diisi.</small>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="flex flex-wrap gap-2">
            <div class="w-full">
              <h4 class="font-bold text-lg">Alamat Tempat Tinggal</h4>
            </div>
            <div class="w-full">
              <div class="form-check mt-1 inline-flex">
                <input
                  v-model="home_is_id"
                  type="checkbox"
                  name="home_is_id"
                  id="home_is_id"
                  class="form-check-input"
                />
                <label
                  class="form-check-label inline-block ml-2"
                  for="home_is_id"
                  >Sama dengan alamat identitas</label
                >
              </div>
            </div>
            <div v-show="home_is_id != 1" class="w-full flex flex-wrap gap-y-2">
              <div
                class="w-full grid grid-cols-1 md:grid-cols-3 gap-x-4 gap-y-2"
              >
                <div class="w-full md:col-span-full">
                  <div class="form-label">
                    Nama Jalan <span class="form-required">*</span>
                  </div>
                  <input
                    type="text"
                    v-model="home_street_1"
                    @change="$v.home_street_1.$touch()"
                    name="id_street_1"
                    placeholder="Cth: Jl Buncit Persada No 1"
                  />
                  <div
                    v-if="$v.home_street_1.$error && !$v.home_street_1.required"
                    class="form-validation-error"
                  >
                    <small>Nama jalan wajib diisi.</small>
                  </div>
                </div>
                <div
                  class="w-full"
                  :class="
                    homeCountryIsIndonesia
                      ? 'md:col-span-2'
                      : 'md:col-span-full'
                  "
                >
                  <div class="form-label">
                    Nama Gedung/Apartemen/Kluster/Komplek (Optional)
                  </div>
                  <input
                    type="text"
                    v-model="home_street_2"
                    name="home_street_2"
                    placeholder="Cth: Alam Raya"
                  />
                </div>
                <div class="w-full" v-if="homeCountryIsIndonesia">
                  <div class="form-label">
                    RT/RW
                  </div>
                  <input
                    type="text"
                    v-model="home_rt_rw"
                    name="home_rt_rw"
                    placeholder="Cth: 004/008"
                  />
                </div>
                <div class="w-full">
                  <div class="form-label">
                    Negara <span class="form-required">*</span>
                  </div>
                  <v-select
                    v-model="home_country"
                    label="name"
                    :placeholder="'-- Pilih --'"
                    :options="country_options"
                    :reduce="country => country.name"
                    :clearable="false"
                    @input="clearAddressRegions('home')"
                  >
                  </v-select>
                  <div
                    v-if="$v.home_country.$error && !$v.home_country.required"
                    class="form-validation-error"
                  >
                    <small>Negara wajib diisi.</small>
                  </div>
                </div>
                <div class="w-full">
                  <div v-if="homeCountryIsIndonesia">
                    <div class="form-label">
                      Provinsi <span class="form-required">*</span>
                    </div>
                    <select
                      v-model="home_province"
                      name="home_province"
                      @change="setCityOptions($event, 'home')"
                      class="mb-1"
                    >
                      <option disabled value="">-- Pilih --</option>
                      <option
                        v-for="option in home_province_options"
                        :value="option.id"
                        :key="option.id"
                      >
                        {{ option.name }}
                      </option>
                    </select>
                    <div
                      v-if="
                        $v.home_province.$error && !$v.home_province.required
                      "
                      class="form-validation-error"
                    >
                      <small>Provinsi wajib diisi.</small>
                    </div>
                  </div>
                  <div v-if="!homeCountryIsIndonesia">
                    <div class="form-label">
                      Province/State <span class="form-required">*</span>
                    </div>
                    <input
                      type="text"
                      v-model="home_province_text"
                      name="home_province_text"
                      @change="$v.home_province_text.$touch()"
                      placeholder="Province/State"
                    />
                    <div
                      v-if="
                        $v.home_province_text.$error &&
                          !$v.home_province_text.required
                      "
                      class="form-validation-error"
                    >
                      <small>Province/State is required.</small>
                    </div>
                  </div>
                </div>
                <div class="w-full">
                  <div v-if="homeCountryIsIndonesia">
                    <div class="form-label">
                      Kota/Kabupaten <span class="form-required">*</span>
                    </div>
                    <select
                      v-model="home_city"
                      name="home_city"
                      @change="setDistrictOptions($event, 'home')"
                      class="mb-1"
                    >
                      <option disabled value="">-- Pilih --</option>
                      <option
                        v-for="option in home_city_options"
                        :value="option.id"
                        :key="option.id"
                      >
                        {{ option.name }}
                      </option>
                    </select>
                    <div
                      v-if="$v.home_city.$error && !$v.home_city.required"
                      class="form-validation-error"
                    >
                      <small>Kota/Kabupaten wajib diisi.</small>
                    </div>
                  </div>
                  <div v-if="!homeCountryIsIndonesia">
                    <div class="form-label">
                      City <span class="form-required">*</span>
                    </div>
                    <input
                      type="text"
                      v-model="home_city_text"
                      name="home_city_text"
                      @change="$v.home_city_text.$touch()"
                      placeholder="City"
                    />
                    <div
                      v-if="
                        $v.home_city_text.$error && !$v.home_city_text.required
                      "
                      class="form-validation-error"
                    >
                      <small>City is required.</small>
                    </div>
                  </div>
                </div>
                <div class="w-full">
                  <div v-if="homeCountryIsIndonesia">
                    <div class="form-label">
                      Kecamatan <span class="form-required">*</span>
                    </div>
                    <select
                      v-model="home_district"
                      name="home_district"
                      @change="setSubDistrictOptions($event, 'home')"
                      class="mb-1"
                    >
                      <option disabled value="">-- Pilih --</option>
                      <option
                        v-for="option in home_district_options"
                        :value="option.id"
                        :key="option.id"
                      >
                        {{ option.name }}
                      </option>
                    </select>
                    <div
                      v-if="
                        $v.home_district.$error && !$v.home_district.required
                      "
                      class="form-validation-error"
                    >
                      <small>Kecamatan wajib diisi.</small>
                    </div>
                  </div>
                  <div v-if="!homeCountryIsIndonesia">
                    <div class="form-label">
                      District <span class="form-required">*</span>
                    </div>
                    <input
                      type="text"
                      v-model="home_district_text"
                      name="home_district_text"
                      @change="$v.home_district_text.$touch()"
                      placeholder="District"
                    />
                    <div
                      v-if="
                        $v.home_district_text.$error &&
                          !$v.home_district_text.required
                      "
                      class="form-validation-error"
                    >
                      <small>District is required.</small>
                    </div>
                  </div>
                </div>
                <div class="w-full">
                  <div v-if="homeCountryIsIndonesia">
                    <div class="form-label">
                      Kelurahan <span class="form-required">*</span>
                    </div>
                    <select
                      v-model="home_subdistrict"
                      name="home_subdistrict"
                      class="mb-1"
                    >
                      <option disabled value="">-- Pilih --</option>
                      <option
                        v-for="option in home_subdistrict_options"
                        :value="option.id"
                        :key="option.id"
                      >
                        {{ option.name }}
                      </option>
                    </select>
                    <div
                      v-if="
                        $v.home_subdistrict.$error &&
                          !$v.home_subdistrict.required
                      "
                      class="form-validation-error"
                    >
                      <small>Kelurahan wajib diisi.</small>
                    </div>
                  </div>
                  <div v-if="!homeCountryIsIndonesia">
                    <div class="form-label">
                      Sub District <span class="form-required">*</span>
                    </div>
                    <input
                      type="text"
                      v-model="home_subdistrict_text"
                      name="home_subdistrict_text"
                      @change="$v.home_subdistrict_text.$touch()"
                      placeholder="Sub District"
                    />
                    <div
                      v-if="
                        $v.home_subdistrict_text.$error &&
                          !$v.home_subdistrict_text.required
                      "
                      class="form-validation-error"
                    >
                      <small>Sub District is required.</small>
                    </div>
                  </div>
                </div>
                <div class="w-full">
                  <div class="form-label">
                    Kode Pos <span class="form-required">*</span>
                  </div>
                  <input
                    type="text"
                    v-model="home_zip"
                    @change="$v.home_zip.$touch()"
                    name="home_zip"
                    placeholder="Cth: 11250"
                  />
                  <div
                    v-if="$v.home_zip.$error && !$v.home_zip.required"
                    class="form-validation-error"
                  >
                    <small>Kode Pos wajib diisi.</small>
                  </div>
                </div>
              </div>
            </div>

            <div class="w-full flex flex-wrap gap-y-2 mt-4">
              <div
                class="w-full grid grid-cols-1 md:grid-cols-2 gap-x-4 gap-y-2"
              >
                <div class="w-full">
                  <div class="form-label">
                    Status Tempat Tinggal <span class="form-required">*</span>
                  </div>
                  <select v-model="home_status" name="home_status" class="mb-1">
                    <option disabled value="">-- Pilih --</option>
                    <option value="Milik Keluarga">Milik Keluarga</option>
                    <option value="Milik Sendiri">Milik Sendiri</option>
                    <option value="Milik Suami/Istri">Milik Suami/Istri</option>
                    <option value="Rumah Dinas">Rumah Dinas</option>
                    <option value="Sewa/Kontrak">Sewa/Kontrak</option>
                  </select>
                  <div
                    v-if="$v.home_status.$error && !$v.home_status.required"
                    class="form-validation-error"
                  >
                    <small>Status Tempat Tinggal wajib diisi.</small>
                  </div>
                </div>

                <div class="w-full">
                  <div class="form-label">Menempati Sejak</div>
                  <div class="flex flex-nowrap gap-2">
                    <select v-model="home_month" name="home_month" class="mb-1">
                      <option value="">Bln</option>
                      <option v-for="i in 12" :value="i" :key="i">
                        {{ i }}
                      </option>
                    </select>
                    <select v-model="home_year" name="home_year" class="mb-1">
                      <option value="">Thn</option>
                      <option
                        v-for="year in homeYears"
                        :value="year"
                        :key="year"
                      >
                        {{ year }}
                      </option>
                    </select>
                  </div>
                </div>
              </div>
            </div>

            <div class="w-full flex flex-wrap gap-y-2">
              <div class="w-full grid grid-cols-1 gap-x-4 gap-y-2">
                <div class="w-full">
                  <div class="form-label">
                    Alamat Korespondensi <span class="form-required">*</span>
                  </div>
                  <select
                    v-model="postal_preference"
                    name="postal_preference"
                    class="mb-1"
                  >
                    <option disabled value="">-- Pilih --</option>
                    <option value="Alamat Identitas"
                      >Sesuai Alamat Identitas</option
                    >
                    <option value="Alamat Tempat Tinggal"
                      >Alamat Tempat Tinggal</option
                    >
                    <option value="Alamat Kantor">Alamat Kantor</option>
                  </select>
                  <div
                    v-if="
                      $v.postal_preference.$error &&
                        !$v.postal_preference.required
                    "
                    class="form-validation-error"
                  >
                    <small>Status Tempat Tinggal wajib diisi.</small>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Additional Information -->
      <div
        class="flex flex-wrap px-4 py-6 lg:flex-nowrap lg:gap-6 lg:px-8 lg:py-11"
      >
        <div class="w-full lg:w-1/4">
          <h3 class="text-xl font-bold">Informasi Tambahan</h3>
          <p class="mt-1 mb-4 text-sm text-gray-600">
            <em>Centang informasi yang sesuai dengan Anda</em>
          </p>
        </div>

        <div class="w-full grid grid-cols-1 gap-3 lg:w-3/4">
          <div class="w-full">
            <div class="form-check mt-1 inline-flex">
              <input
                v-model="info_q1"
                type="checkbox"
                name="info_q1"
                id="info_q1"
                class="form-check-input"
              />
              <label class="form-check-label inline-block ml-2" for="info_q1"
                >Saya atau anggota keluarga Saya bekerja pada Perusahaan Efek,
                Bursa Efek, perusahaan yang diatur oleh Bursa Efek/BAPEPAM dan
                LK, Bank, Asuransi atau Lembaga Keuangan sejenis.</label
              >
            </div>
            <div v-show="info_q1" class="w-full mt-2 mb-2 pl-6">
              <input
                type="text"
                name="info_q1_text"
                placeholder="Sebutkan nama Perusahaan/Lembaga tersebut *"
                v-model="info_q1_text"
                @change="$v.info_q1_text.$touch()"
              />
              <div
                v-if="$v.info_q1_text.$error && !$v.info_q1_text.required"
                class="form-validation-error"
              >
                <small>Informasi Tambahan wajib diisi.</small>
              </div>
            </div>
          </div>

          <div class="w-full">
            <div class="form-check mt-1 inline-flex">
              <input
                v-model="info_q2"
                type="checkbox"
                name="info_q2"
                id="info_q2"
                class="form-check-input"
              />
              <label class="form-check-label inline-block ml-2" for="info_q2"
                >Saya sudah memiliki Rekening Efek pada Perusahaan Efek
                lain.</label
              >
            </div>
            <div v-show="info_q2" class="w-full mt-2 mb-2 pl-6">
              <input
                type="text"
                name="info_q2_text"
                placeholder="Sebutkan nama Perusahaan Efek tersebut *"
                v-model="info_q2_text"
                @change="$v.info_q2_text.$touch()"
              />
              <div
                v-if="$v.info_q2_text.$error && !$v.info_q2_text.required"
                class="form-validation-error"
              >
                <small>Informasi Tambahan wajib diisi.</small>
              </div>
            </div>
          </div>

          <div class="w-full">
            <div class="form-check mt-1 inline-flex">
              <input
                v-model="info_q3"
                type="checkbox"
                name="info_q3"
                id="info_q3"
                class="form-check-input"
              />
              <label class="form-check-label inline-block ml-2" for="info_q3"
                >Saya memiliki 5% atau lebih saham suatu perusahaan
                publik.</label
              >
            </div>
            <div v-show="info_q3" class="w-full mt-2 pl-6">
              <input
                type="text"
                name="info_q3_text"
                placeholder="Sebutkan nama saham publik tersebut *"
                v-model="info_q3_text"
                @change="$v.info_q3_text.$touch()"
              />
              <div
                v-if="$v.info_q3_text.$error && !$v.info_q3_text.required"
                class="form-validation-error"
              >
                <small>Informasi Tambahan wajib diisi.</small>
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
        class="
          px-4
          py-2
          border
          rounded
          text-sm
          font-bold
          uppercase
          bg-orange
          border-orange
          text-white
          hover:bg-orange-light
          hover:border-orange-light
          focus:outline-none
          transition
          ease-in-out
          duration-150
        "
      >
        Berikutnya ⟶
      </button>
    </div>
  </div>
</template>

<script>
import { required, requiredIf, requiredUnless } from "vuelidate/lib/validators";
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
      countries: null,
      country_options: [],
      birth_places_options: [],
      id_valid_dates: [],
      id_valid_years: [],
      id_province_options: [],
      id_city_options: [],
      id_district_options: [],
      id_subdistrict_options: [],
      home_province_options: [],
      home_city_options: [],
      home_district_options: [],
      home_subdistrict_options: [],
      mobile_phone_props: {
        inputId: "mobile_number_formatted",
        name: "mobile_number_formatted",
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
      phone_props: {
        inputId: "phone_number_formatted",
        name: "phone_number_formatted",
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
    this.$store.commit("SET_STEP", "1");
    //console.log(this.$store.getters.fields.account_id);
    //const account_id = this.$store.getters.fields.account_id;
    axios.get("/api/countries").then(response => {
      this.countries = response.data;
      this.country_options = response.data;
    });
    axios.get("/api/province").then(response => {
      this.id_province_options = response.data;
      this.home_province_options = response.data;
    });
    //const account_id = 149;
    //const account_id = 150;
    const account_id = this.account_id;
    //console.log(this.$store.getters.fields.account_id);
    //console.log(this.account_id);
    if (account_id) {
      this.isLoading = true;
      axios
        .get("/api/vue-open-account/" + account_id)
        .then(response => {
          //console.log(response.data);
          //console.log(response.data.account_id);
          this.$store.commit("SET_DB_LOADED", true);
          this.setFieldsData(response.data);
        })
        .then(() => {
          if (this.id_province) {
            this.getCityOptions("id");
          }
          if (this.id_city) {
            this.getDistrictOptions("id");
          }
          if (this.id_district) {
            this.getSubDistrictOptions("id");
          }
          if (this.home_province) {
            this.getCityOptions("home");
          }
          if (this.home_city) {
            this.getDistrictOptions("home");
          }
          if (this.home_district) {
            this.getSubDistrictOptions("home");
          }
        })
        .then(() => {
          this.isLoading = false;
          //console.log(this.status);
        });
    } else {
      this.$store.commit("SET_DB_LOADED", false);
      this.$router.push("/");
    }
    axios.get("/api/city/ksei_cities").then(response => {
      this.birth_places_options = response.data;
    });
  },
  computed: {
    ...mutateFields({
      fields: [
        "lead_id",
        "account_id",
        "status",
        "has_bca",
        "bca_account_name",
        "bca_account_number",
        "full_name",
        "nationality",
        "id_type",
        "ktp_number",
        "ktp_expired_day",
        "ktp_expired_month",
        "ktp_expired_year",
        "ktp_expired_lifetime",
        "passport_number",
        "passport_expired_day",
        "passport_expired_month",
        "passport_expired_year",
        "has_npwp",
        "npwp_number",
        "npwp_issue_day",
        "npwp_issue_month",
        "npwp_issue_year",
        "has_kitas",
        "kitas_number",
        "kitas_expired_day",
        "kitas_expired_month",
        "kitas_expired_year",
        "birth_country",
        "birth_place",
        "birth_place_foreign",
        "birth_day",
        "birth_month",
        "birth_year",
        "gender",
        "marital_status",
        "religion",
        "education",
        "mother_name",
        "email",
        "mobile_country_code",
        "mobile_number_formatted",
        "phone_country_code",
        "phone_number_formatted",
        "id_country",
        "id_street_1",
        "id_street_2",
        "id_rt_rw",
        "id_province",
        "id_province_text",
        "id_city",
        "id_city_text",
        "id_district",
        "id_district_text",
        "id_subdistrict",
        "id_subdistrict_text",
        "id_zip",
        "home_is_id",
        "home_country",
        "home_street_1",
        "home_street_2",
        "home_rt_rw",
        "home_province",
        "home_province_text",
        "home_city",
        "home_city_text",
        "home_district",
        "home_district_text",
        "home_subdistrict",
        "home_subdistrict_text",
        "home_zip",
        "home_status",
        "home_month",
        "home_year",
        "postal_preference",
        "info_q1",
        "info_q1_text",
        "info_q2",
        "info_q2_text",
        "info_q3",
        "info_q3_text",
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
        "other_taxpayer",
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
        "family_extra_income_source_other",
        "application_term",
        "bca_term",
        "upload_ktp",
        "upload_passport",
        "upload_npwp",
        "upload_signature"
      ],
      base: "fields",
      mutation: "UPDATE_FIELD"
    }),
    step: {
      get() {
        return this.$store.state.step;
      },
      set(value) {
        this.$store.commit("SET_STEP", value);
      }
    },
    db_loaded: {
      get() {
        return this.$store.state.db_loaded;
      },
      set(value) {
        this.$store.commit("SET_DB_LOADED", value);
      }
    },
    idCardYears() {
      const year = new Date().getFullYear();
      return Array.from({ length: 10 }, (value, index) => year + index);
    },
    npwpYears() {
      const year = new Date().getFullYear();
      return Array.from({ length: 20 }, (value, index) => year - index);
    },
    birthYears() {
      const year = new Date().getFullYear() - 17;
      return Array.from({ length: 100 }, (value, index) => year - index);
    },
    homeYears() {
      const year = new Date().getFullYear();
      return Array.from({ length: 100 }, (value, index) => year - index);
    },
    idTypeIsKtp() {
      if (this.$store.getters.fields.id_type === "KTP") return true;
      return false;
    },
    idTypeIsPassport() {
      if (this.$store.getters.fields.id_type === "Paspor") return true;
      return false;
    },
    ktpExpiredIsLifetime() {
      if (this.$store.getters.fields.ktp_expired_lifetime === true) return true;
      return false;
    },
    idCountryIsIndonesia() {
      if (this.$store.getters.fields.id_country === "INDONESIA") return true;
      return false;
    },
    homeCountryIsIndonesia() {
      if (this.$store.getters.fields.home_country === "INDONESIA") return true;
      return false;
    },
    homeIsId() {
      if (this.$store.getters.fields.home_is_id === true) return true;
      return false;
    }
  },
  validations: {
    full_name: {
      required
    },
    nationality: {
      required
    },
    id_type: {
      required
    },
    ktp_number: {
      required: requiredIf("idTypeIsKtp")
    },
    ktp_expired_day: {
      required: requiredIf(function() {
        return this.idTypeIsKtp && !this.ktpExpiredIsLifetime;
      })
    },
    ktp_expired_month: {
      required: requiredIf(function() {
        return this.idTypeIsKtp && !this.ktpExpiredIsLifetime;
      })
    },
    ktp_expired_year: {
      required: requiredIf(function() {
        return this.idTypeIsKtp && !this.ktpExpiredIsLifetime;
      })
    },
    passport_number: {
      required: requiredIf("idTypeIsPassport")
    },
    passport_expired_day: {
      required: requiredIf("idTypeIsPassport")
    },
    passport_expired_month: {
      required: requiredIf("idTypeIsPassport")
    },
    passport_expired_year: {
      required: requiredIf("idTypeIsPassport")
    },
    has_npwp: {
      required
    },
    npwp_number: {
      required: requiredIf(function() {
        return this.has_npwp != "1";
      })
    },
    kitas_expired_day: {
      required: requiredIf(function() {
        return this.has_kitas == "1";
      })
    },
    kitas_expired_month: {
      required: requiredIf(function() {
        return this.has_kitas == "1";
      })
    },
    kitas_expired_year: {
      required: requiredIf(function() {
        return this.has_kitas == "1";
      })
    },
    kitas_number: {
      required: requiredIf(function() {
        return this.has_kitas == "1";
      })
    },
    birth_country: {
      required
    },
    birth_place: {
      required: requiredIf(function() {
        return this.birth_country == "INDONESIA";
      })
    },
    birth_day: {
      required
    },
    birth_month: {
      required
    },
    birth_year: {
      required
    },
    gender: {
      required
    },
    marital_status: {
      required
    },
    religion: {
      required
    },
    education: {
      required
    },
    mother_name: {
      required
    },
    email: {
      required
    },
    mobile_country_code: {
      required
    },
    mobile_number_formatted: {
      required
    },
    id_country: {
      required
    },
    id_street_1: {
      required
    },
    id_province: {
      required: requiredIf("idCountryIsIndonesia")
    },
    id_city: {
      required: requiredIf("idCountryIsIndonesia")
    },
    id_district: {
      required: requiredIf("idCountryIsIndonesia")
    },
    id_subdistrict: {
      required: requiredIf("idCountryIsIndonesia")
    },
    id_province_text: {
      required: requiredUnless("idCountryIsIndonesia")
    },
    id_city_text: {
      required: requiredUnless("idCountryIsIndonesia")
    },
    id_district_text: {
      required: requiredUnless("idCountryIsIndonesia")
    },
    id_subdistrict_text: {
      required: requiredUnless("idCountryIsIndonesia")
    },
    id_zip: {
      required
    },
    home_country: {
      required: requiredUnless("homeIsId")
    },
    home_street_1: {
      required: requiredUnless("homeIsId")
    },
    home_province: {
      required: requiredIf(function() {
        return !this.homeIsId && this.homeCountryIsIndonesia;
      })
    },
    home_city: {
      required: requiredIf(function() {
        return !this.homeIsId && this.homeCountryIsIndonesia;
      })
    },
    home_district: {
      required: requiredIf(function() {
        return !this.homeIsId && this.homeCountryIsIndonesia;
      })
    },
    home_subdistrict: {
      required: requiredIf(function() {
        return !this.homeIsId && this.homeCountryIsIndonesia;
      })
    },
    home_province_text: {
      required: requiredIf(function() {
        return !this.homeIsId && !this.homeCountryIsIndonesia;
      })
    },
    home_city_text: {
      required: requiredIf(function() {
        return !this.homeIsId && !this.homeCountryIsIndonesia;
      })
    },
    home_district_text: {
      required: requiredIf(function() {
        return !this.homeIsId && !this.homeCountryIsIndonesia;
      })
    },
    home_subdistrict_text: {
      required: requiredIf(function() {
        return !this.homeIsId && !this.homeCountryIsIndonesia;
      })
    },
    home_zip: {
      required: requiredUnless("homeIsId")
    },
    home_status: {
      required
    },
    postal_preference: {
      required
    },
    info_q1_text: {
      required: requiredIf(function() {
        return this.info_q1;
      })
    },
    info_q2_text: {
      required: requiredIf(function() {
        return this.info_q2;
      })
    },
    info_q3_text: {
      required: requiredIf(function() {
        return this.info_q3;
      })
    }
  },
  methods: {
    setFieldsData(data) {
      const fields = [
        "account_id",
        "lead_id",
        "status",
        "has_bca",
        "bca_account_name",
        "bca_account_number",
        "full_name",
        "nationality",
        "id_type",
        "ktp_number",
        "ktp_expired_day",
        "ktp_expired_month",
        "ktp_expired_year",
        "ktp_expired_lifetime",
        "passport_number",
        "passport_expired_day",
        "passport_expired_month",
        "passport_expired_year",
        "has_kitas",
        "kitas_number",
        "kitas_expired_day",
        "kitas_expired_month",
        "kitas_expired_year",
        "has_npwp",
        "npwp_number",
        "npwp_issue_day",
        "npwp_issue_month",
        "npwp_issue_year",
        "birth_country",
        "birth_place",
        "birth_place_foreign",
        "birth_day",
        "birth_month",
        "birth_year",
        "gender",
        "marital_status",
        "religion",
        "education",
        "mother_name",
        "email",
        "mobile_country_code",
        "mobile_number_formatted",
        "phone_country_code",
        "phone_number_formatted",
        "id_country",
        "id_street_1",
        "id_street_2",
        "id_rt_rw",
        "id_province",
        "id_province_text",
        "id_city",
        "id_city_text",
        "id_district",
        "id_district_text",
        "id_subdistrict",
        "id_subdistrict_text",
        "id_zip",
        "home_is_id",
        "home_country",
        "home_street_1",
        "home_street_2",
        "home_rt_rw",
        "home_province",
        "home_province_text",
        "home_city",
        "home_city_text",
        "home_district",
        "home_district_text",
        "home_subdistrict",
        "home_subdistrict_text",
        "home_zip",
        "home_status",
        "home_month",
        "home_year",
        "postal_preference",
        "info_q1",
        "info_q1_text",
        "info_q2",
        "info_q2_text",
        "info_q3",
        "info_q3_text",
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
        "other_taxpayer",
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
        "family_extra_income_source_other",
        "application_term",
        "bca_term",
        "upload_ktp",
        "upload_passport",
        "upload_npwp",
        "upload_signature"
      ];
      for (let x = 0; x < fields.length; x++) {
        const field = fields[x];
        const value = data[field];
        if (value) this[field] = value;
      }
    },
    clearIdCardField() {
      this.ktp_number = "";
      this.ktp_expired_day = "";
      this.ktp_expired_month = "";
      this.ktp_expired_year = "";
      this.ktp_expired_lifetime = false;
      this.passport_number = "";
      this.passport_expired_day = "";
      this.passport_expired_month = "";
      this.passport_expired_year = "";
    },
    clearNpwpField() {
      this.npwp_number = "";
      this.npwp_issue_day = "";
      this.npwp_issue_month = "";
      this.npwp_issue_year = "";
    },
    clearKitasField() {
      this.kitas_number = "";
      this.kitas_expired_day = "";
      this.kitas_expired_month = "";
      this.kitas_expired_year = "";
    },
    setMobileCountryCode(country) {
      this.mobile_country_code = country.dialCode;
    },
    setPhoneCountryCode(country) {
      this.phone_country_code = country.dialCode;
    },
    setCountryCode(prefix, e) {
      this[prefix + "_country_code"] = e.dialCode;
    },
    clearAddressText(prefix) {
      this[prefix + "_city_text"] = "";
      this[prefix + "_province_text"] = "";
      this[prefix + "_district_text"] = "";
      this[prefix + "_subdistrict_text"] = "";
    },
    clearAddressSelects(prefix) {
      this[prefix + "_province"] = "";
      this[prefix + "_city_options"] = [];
      this[prefix + "_city"] = "";
      this[prefix + "_district_options"] = [];
      this[prefix + "_district"] = "";
      this[prefix + "_subdistrict_options"] = [];
      this[prefix + "_subdistrict"] = "";
    },
    clearAddressRegions(prefix) {
      this.clearAddressText(prefix);
      this.clearAddressSelects(prefix);
    },
    getCityOptions(prefix) {
      axios.get("/api/city/" + this[prefix + "_province"]).then(response => {
        this[prefix + "_city_options"] = response.data;
      });
    },
    setCityOptions(e, prefix) {
      this[prefix + "_city_options"] = [];
      this[prefix + "_city"] = "";
      this[prefix + "_district_options"] = [];
      this[prefix + "_district"] = "";
      this[prefix + "_subdistrict_options"] = [];
      this[prefix + "_subdistrict"] = "";

      this.clearAddressText(prefix);

      axios.get("/api/city/" + e.target.value).then(response => {
        this[prefix + "_city_options"] = response.data;
      });
    },
    getDistrictOptions(prefix) {
      axios.get("/api/district/" + this[prefix + "_city"]).then(response => {
        this[prefix + "_district_options"] = response.data;
      });
    },
    setDistrictOptions(e, prefix) {
      this[prefix + "_district_options"] = [];
      this[prefix + "_district"] = "";
      this[prefix + "_subdistrict_options"] = [];
      this[prefix + "_subdistrict"] = "";

      this.clearAddressText(prefix);

      axios.get("/api/district/" + e.target.value).then(response => {
        this[prefix + "_district_options"] = response.data;
      });
    },
    getSubDistrictOptions(prefix) {
      axios
        .get("/api/subdistrict/" + this[prefix + "_district"])
        .then(response => {
          this[prefix + "_subdistrict_options"] = response.data;
        });
    },
    setSubDistrictOptions(e, prefix) {
      this[prefix + "_subdistrict_options"] = [];
      this[prefix + "_subdistrict"] = "";

      this.clearAddressText(prefix);

      axios.get("/api/subdistrict/" + e.target.value).then(response => {
        this[prefix + "_subdistrict_options"] = response.data;
      });
    },
    navigatePrev() {
      this.$router.push("/");
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
          this.$store.commit("SET_VALIDATED_STEP", "1");
          this.$router.push("/step-2/");
        });
    }
  }
};
</script>
