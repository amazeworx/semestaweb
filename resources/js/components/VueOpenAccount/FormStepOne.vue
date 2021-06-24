<template>
  <div>
    <div class="bg-white shadow">
      <!-- Data Identitas -->
      <div
        class="flex flex-wrap px-4 py-6 lg:flex-nowrap lg:gap-6 lg:px-8 lg:py-11 border-b border-gray-200"
      >
        <div class="w-full lg:w-1/4">
          <h3 class="text-xl font-bold mb-4">Data Identitas</h3>
        </div>

        <div class="w-full grid grid-cols-1 gap-6 lg:w-3/4">
          <div class="flex flex-wrap gap-y-6 md:flex-nowrap md:gap-x-4">
            <div class="w-full md:w-3/5">
              <div class="form-label">
                Nama lengkap
                <span class="form-required">*</span>
              </div>
              <input
                type="text"
                id="fullName"
                name="fullName"
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
                    RT/RW <span class="form-required">*</span>
                  </div>
                  <input
                    type="text"
                    v-model="id_rt_rw"
                    @change="$v.id_rt_rw.$touch()"
                    name="id_rt_rw"
                    placeholder="Cth: 004/008"
                  />
                  <div
                    v-if="$v.id_rt_rw.$error && !$v.id_rt_rw.required"
                    class="form-validation-error"
                  >
                    <small>RT/RW wajib diisi.</small>
                  </div>
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
                    @input="clearIdAddressRegions"
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
                      @change="setCityOptions($event)"
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
                      @change="setDistrictOptions($event)"
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
                      @change="setSubDistrictOptions($event)"
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
        </div>
      </div>
    </div>

    <!-- Buttons -->
    <div class="flex gap-4 mt-8 justify-center">
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
import { mutateFields } from "../../helpers/helpers.js";

export default {
  components: { vSelect },
  data() {
    return {
      countries: null,
      country_options: [],
      id_valid_dates: [],
      id_valid_years: [],
      id_province_options: [],
      id_city_options: [],
      id_district_options: [],
      id_subdistrict_options: []
    };
  },
  mounted() {
    axios.get("/api/countries").then(response => {
      this.countries = response.data;
      this.country_options = response.data;
    });
    axios.get("/api/province").then(response => {
      this.id_province_options = response.data;
    });
    if (this.id_province) {
      axios.get("/api/city/" + this.id_province).then(response => {
        this.id_city_options = response.data;
      });
    }
    if (this.id_city) {
      axios.get("/api/district/" + this.id_city).then(response => {
        this.id_district_options = response.data;
      });
    }
    if (this.id_district) {
      axios.get("/api/subdistrict/" + this.id_district).then(response => {
        this.id_subdistrict_options = response.data;
      });
    }
  },
  computed: {
    ...mutateFields({
      fields: [
        "full_name",
        "nationality",
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
        "id_zip"
      ],
      base: "fields",
      mutation: "UPDATE_FIELD"
    }),
    idCountryIsIndonesia() {
      if (this.$store.getters.fields.id_country === "INDONESIA") return true;
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
    id_country: {
      required
    },
    id_street_1: {
      required
    },
    id_rt_rw: {
      required: requiredIf("idCountryIsIndonesia")
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
    }
  },
  methods: {
    clearIdAddressText() {
      this.id_city_text = "";
      this.id_province_text = "";
      this.id_district_text = "";
      this.id_subdistrict_text = "";
    },
    clearIdAddressSelects() {
      this.id_province = "";
      this.id_city_options = [];
      this.id_city = "";
      this.id_district_options = [];
      this.id_district = "";
      this.id_subdistrict_options = [];
      this.id_subdistrict = "";
    },
    clearIdAddressRegions() {
      this.clearIdAddressText();
      this.clearIdAddressSelects();
    },
    setCityOptions(e) {
      this.id_city_options = [];
      this.id_city = "";
      this.id_district_options = [];
      this.id_district = "";
      this.id_subdistrict_options = [];
      this.id_subdistrict = "";

      this.clearIdAddressText();

      let province_id = e.target.value;

      // Set cities options
      axios.get("/api/city/" + province_id).then(response => {
        this.id_city_options = response.data;
      });
    },
    setDistrictOptions(e) {
      this.id_district_options = [];
      this.id_district = "";
      this.id_subdistrict_options = [];
      this.id_subdistrict = "";

      this.clearIdAddressText();

      let city_id = e.target.value;

      // Set district options
      axios.get("/api/district/" + city_id).then(response => {
        this.id_district_options = response.data;
      });
    },
    setSubDistrictOptions(e) {
      this.id_subdistrict_options = [];
      this.id_subdistrict = "";

      this.clearIdAddressText();

      let district_id = e.target.value;

      // Set subdistrict options
      axios.get("/api/subdistrict/" + district_id).then(response => {
        this.id_subdistrict_options = response.data;
      });
    },
    navigateNext() {
      this.$v.$touch();
      if (this.$v.$error) return;
      //this.$store.dispatch("createPost", this.$store.getters.fields);
      //console.log("Ok");
      //console.log(this.$store.getters.fields);
      this.$router.push("/second-step/");
    }
  }
};
</script>
