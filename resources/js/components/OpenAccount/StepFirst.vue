<template>
  <div v-if="firstStep">
    <div class="bg-white shadow mb-8">
      <div
        class="flex flex-wrap px-4 py-6 lg:flex-nowrap lg:gap-6 lg:px-8 lg:py-11 border-b border-gray-200"
      >
        <div class="w-full lg:w-1/4">
          <h3 class="text-xl font-bold mb-4">{{ __("Data Identitas") }}</h3>
        </div>

        <!-- Form Container -->
        <div class="w-full grid grid-cols-1 gap-6 lg:w-3/4">
          <div class="flex flex-wrap gap-y-6 md:flex-nowrap md:gap-x-4">
            <div class="w-full md:w-3/5">
              <ValidationProvider
                rules="required"
                name="full_name"
                v-slot="{ errors }"
              >
                <label class="form-label"
                  >{{ __("Nama lengkap") }}
                  <span class="form-required">*</span></label
                >
                <input
                  type="text"
                  v-model="full_name"
                  :placeholder="__('Nama lengkap Anda sesuai identitas')"
                />
                <div class="form-validation-error" v-if="errors">
                  <small>{{ errors[0] }}</small>
                </div>
              </ValidationProvider>
            </div>

            <div class="w-full md:w-2/5">
              <ValidationProvider
                rules="required"
                name="nationality"
                v-slot="{ errors }"
              >
                <label class="form-label"
                  >Kewarganegaraan <span class="form-required">*</span></label
                >
                <v-select
                  v-model="nationality"
                  label="nationality"
                  :placeholder="__('-- Pilih --')"
                  :options="country_options"
                  :reduce="(country) => country.nationality"
                  :clearable="false"
                >
                </v-select>

                <div class="form-validation-error" v-if="errors">
                  <small>{{ errors[0] }}</small>
                </div>
              </ValidationProvider>
            </div>
          </div>

          <div class="flex flex-wrap gap-y-2 md:flex-nowrap md:gap-x-4">
            <div class="w-full md:w-3/12">
              <ValidationProvider
                rules="required"
                name="id_type"
                v-slot="{ errors }"
              >
                <label class="form-label"
                  >Jenis Kartu ID <span class="form-required">*</span></label
                >
                <select id="id_type" v-model="id_type" class="mb-1">
                  <option value="" disabled>-- Pilih Identitas--</option>
                  <option value="KTP">KTP</option>
                  <option value="Paspor">Paspor</option>
                </select>
                <div class="form-validation-error" v-if="errors">
                  <small>{{ errors[0] }}</small>
                </div>
              </ValidationProvider>
            </div>

            <div class="w-full md:w-4/12">
              <div v-show="isKTP">
                <ValidationProvider
                  rules="required_if:idType,KTP|numeric|digits:16"
                  name="ktp_number"
                  v-slot="{ errors }"
                >
                  <label class="form-label"
                    >Nomor KTP (NIK) <span class="form-required">*</span></label
                  >
                  <input
                    type="text"
                    name="ktp_number"
                    v-model="ktp_number"
                    placeholder="Isi NIK KTP Anda"
                  />
                  <div class="form-validation-error" v-if="errors">
                    <small>{{ errors[0] }}</small>
                  </div>
                </ValidationProvider>
              </div>
              <div v-show="isPassport">
                <ValidationProvider
                  rules="required_if:idType,Paspor"
                  name="passport_number"
                  v-slot="{ errors }"
                >
                  <label class="form-label"
                    >Nomor Paspor <span class="form-required">*</span></label
                  >
                  <input
                    type="text"
                    v-model="passport_number"
                    placeholder="Isi nomor paspor Anda"
                  />
                  <div class="form-validation-error" v-if="errors">
                    <small>{{ errors[0] }}</small>
                  </div>
                </ValidationProvider>
              </div>
            </div>

            <div class="w-full md:w-5/12">
              <ValidationObserver v-slot="{ errors, touched, invalid }">
                <div>
                  <label class="form-label"
                    >Berlaku s/d <span class="form-required">*</span></label
                  >
                  <div class="flex flex-nowrap gap-2">
                    <ValidationProvider
                      rules="required_if|id_valid_lifetime,false"
                      name="id_valid_date"
                    >
                      <select
                        id="id_valid_date"
                        v-model="id_valid_date"
                        class="mb-1"
                        :disabled="isIdValidLifetime"
                      >
                        <option value="" disabled>Tgl</option>
                        <option v-for="index in 31" :key="index" :value="index">
                          {{ index }}
                        </option>
                      </select>
                    </ValidationProvider>
                    <ValidationProvider
                      rules="required_if|id_valid_lifetime,false"
                      name="id_valid_month"
                    >
                      <select
                        id="id_valid_month"
                        v-model="id_valid_month"
                        class="mb-1"
                        :disabled="isIdValidLifetime"
                      >
                        <option value="" selected disabled>Bln</option>
                        <option v-for="index in 12" :key="index" :value="index">
                          {{ index }}
                        </option>
                      </select>
                    </ValidationProvider>
                    <ValidationProvider
                      rules="required_if|id_valid_lifetime,false"
                      name="id_valid_year"
                    >
                      <select
                        id="id_valid_year"
                        v-model="id_valid_year"
                        class="mb-1"
                        :disabled="isIdValidLifetime"
                      >
                        <option value="">Thn</option>
                        <option
                          v-for="year in id_valid_years"
                          :key="year"
                          :value="year"
                        >
                          {{ year }}
                        </option>
                      </select>
                    </ValidationProvider>
                  </div>

                  <div v-show="isKTP">
                    <div class="form-check mt-1 inline-flex">
                      <ValidationProvider rules="" vid="id_valid_lifetime">
                        <input
                          v-model="id_valid_lifetime"
                          type="checkbox"
                          value="9999-12-31"
                          id="id_valid_lifetime"
                          class="form-check-input"
                        />
                        <label
                          class="form-check-label inline-block ml-2"
                          for="id_valid_lifetime"
                          >Seumur Hidup</label
                        >
                      </ValidationProvider>
                    </div>
                  </div>
                </div>

                <div v-if="touched && invalid">
                  <div class="form-validation-error" v-if="errors">
                    <small>Berlaku s/d wajib diisi</small>
                  </div>
                </div>
              </ValidationObserver>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { ValidationObserver, ValidationProvider } from "vee-validate";
import vSelect from "vue-select";
import { mutateFields } from "../../helpers/helpers.js";
export default {
  components: { ValidationObserver, ValidationProvider, vSelect },
  data() {
    return {
      countries: null,
      country_options: [],
      id_valid_dates: [],
      id_valid_years: [],
    };
  },
  mounted() {
    axios.get("/api/countries").then((response) => {
      this.countries = response.data.data;
      this.country_options = response.data.data;
    });
    const date = new Date();
    const year = date.getFullYear();
    for (let i = year; i <= year + 10; i++) {
      this.id_valid_years.push(i);
    }
  },
  computed: {
    showError() {
      //this.$refs.oc.validate()
    },
    theStep() {
      return this.$store.getters.step;
    },
    firstStep() {
      if (this.$store.getters.step === 1) {
        return true;
      }
      return false;
    },
    isKTP() {
      if (this.$store.getters.fields.id_type === "KTP") {
        return true;
      }
      return false;
    },
    isPassport() {
      if (this.$store.getters.fields.id_type === "Paspor") {
        return true;
      }
      return false;
    },
    isIdValidLifetime() {
      return this.$store.getters.fields.id_valid_lifetime;
    },
    ...mutateFields({
      fields: [
        "full_name",
        "nationality",
        "id_type",
        "ktp_number",
        "passport_number",
        "id_valid_date",
        "id_valid_month",
        "id_valid_year",
        "id_valid_lifetime",
      ],
      base: "fields",
      mutation: "UPDATE_FIELD",
    }),
  },
  methods: {
    getErrors(scope) {
      try {
        const errors = this.$refs[scope].errors;

        let parsed = [];

        Object.keys(errors).map((key) => {
          parsed.push(errors[key][0]);
        });

        return parsed;
      } catch {
        return false;
      }
    },
  },
};
</script>