<template>
  <div>
    <form method="POST" @submit.prevent="submit">
      <div class="" v-show="success">Success</div>
      <div class="bg-white shadow">
        <div
          class="flex flex-wrap px-4 py-6 lg:flex-nowrap lg:gap-6 lg:px-8 lg:py-11 border-b border-gray-200"
        >
          <div class="w-full lg:w-1/4">
            <h3 class="text-xl font-bold mb-4">{{ __("Data Identitas") }}</h3>
          </div>

          <div class="w-full grid grid-cols-1 gap-6 lg:w-3/4">
            <div class="w-full">
              <label class="form-label"
                >{{ __("Nama lengkap") }}
                <span class="form-required">*</span></label
              >
              <input
                type="text"
                name="full_name"
                v-model="fields.full_name"
                :placeholder="__('Nama lengkap Anda sesuai identitas')"
              />
              <div
                class="form-validation-error"
                v-if="errors && errors.full_name"
              >
                <small>{{ errors.full_name[0] }}</small>
              </div>
            </div>

            <div class="w-full">
              <label class="form-label"
                >Kewarganegaraan <span class="form-required">*</span></label
              >
              <v-select
                v-model="fields.nationality"
                label="nationality"
                placeholder="-- Pilih --"
                :options="country_options"
                :reduce="(country) => country.nationality"
                :clearable="false"
              >
              </v-select>

              <div
                class="form-validation-error"
                v-if="errors && errors.nationality"
              >
                <small>{{ errors.nationality[0] }}</small>
              </div>
            </div>

            <!-- <div class="w-full">
            <label class="form-label"
              >Kewarganegaraan <span class="form-required">*</span></label
            >
            <select
              v-model="fields.nationality"
              id="nationality"
              name="nationality"
            >
              <option>-- Pilih --</option>
              <option
                v-for="country in countries"
                :value="country.nationality"
                :key="country.code"
              >
                {{ country.nationality }}
              </option>
            </select>
            <div
              class="form-validation-error"
              v-if="errors && errors.nationality"
            >
              <small>{{ errors.nationality[0] }}</small>
            </div>
          </div> -->

            <div class="w-full">
              <label class="form-label"
                >Nomor KTP (NIK) <span class="form-required">*</span></label
              >
              <input
                type="text"
                name="ktp_number"
                v-model="fields.ktp_number"
                placeholder="Isi NIK KTP Anda"
              />
              <div
                class="form-validation-error"
                v-if="errors && errors.ktp_number"
              >
                <small>{{ errors.ktp_number[0] }}</small>
              </div>
            </div>

            <div class="w-full">
              <label class="form-label"
                >Email <span class="form-required">*</span></label
              >
              <input
                type="email"
                name="email"
                v-model="fields.email"
                placeholder="Isi alamat email Anda"
              />
              <div class="form-validation-error" v-if="errors && errors.email">
                <small>{{ errors.email[0] }}</small>
              </div>
            </div>
          </div>
        </div>

        <div class="flex w-full gap-4 pt-8 pb-8 justify-center">
          <button
            type="submit"
            class="px-4 py-2 border rounded text-sm font-bold uppercase bg-orange border-orange text-white hover:bg-orange-light hover:border-orange-light focus:outline-none transition ease-in-out duration-150"
          >
            Submit ⟶
          </button>
        </div>
      </div>
    </form>
  </div>
</template>
<script>
export default {
  data() {
    return {
      countries: null,
      fields: {
        nationality: "INDONESIAN",
      },
      success: false,
      errors: {},
      country_options: [],
    };
  },
  mounted() {
    axios.get("/api/countries").then((response) => {
      this.countries = response.data.data;
      this.country_options = response.data.data;
    });
  },
  methods: {
    submit() {
      axios
        .post("/api/form-open-account", this.fields)
        .then((response) => {
          this.fields = {
            nationality: "INDONESIAN",
          };
          this.success = true;
          this.errors = {};
        })
        .catch((error) => {
          if (error.response.status == 422) {
            this.errors = error.response.data.errors;
          }
          console.log("Error");
        });
    },
  },
};
</script>
