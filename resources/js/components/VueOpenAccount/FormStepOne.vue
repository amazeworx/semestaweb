<template>
  <div>
    <div class="bg-white shadow">
      <!-- <div class="text-left text-xs">
      <pre>gender: {{ $store.state.gender }}</pre>
      <pre>v: {{ v$ }}</pre>
    </div> -->

      <div
        class="
          flex flex-wrap
          px-4
          py-6
          lg:flex-nowrap
          lg:gap-6
          lg:px-8
          lg:py-11
          border-b border-gray-200
        "
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
                v-model="post.fullName"
                @change="$v.post.fullName.$touch()"
              />
              <div
                v-if="$v.post.fullName.$error && !$v.post.fullName.required"
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
                v-model="post.nationality"
                label="nationality"
                :placeholder="'-- Pilih --'"
                :options="country_options"
                :reduce="country => country.nationality"
                :clearable="false"
              >
              </v-select>
              <div
                v-if="
                  $v.post.nationality.$error && !$v.post.nationality.required
                "
                class="form-validation-error"
              >
                <small>Kewarganegaraan wajib diisi.</small>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="flex gap-4 mt-8 justify-center">
      <button
        @click="navigateNext(post)"
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
import { mapGetters } from "vuex";
import { required, minLength, requiredIf } from "vuelidate/lib/validators";
import vSelect from "vue-select";

export default {
  components: { vSelect },
  data() {
    return {
      countries: null,
      country_options: [],
      id_valid_dates: [],
      id_valid_years: [],
      post: {
        fullName: "",
        nationality: ""
      }
    };
  },
  computed: {
    ...mapGetters(["posts"])
  },
  mounted() {
    axios.get("/api/countries").then(response => {
      this.countries = response.data.data;
      this.country_options = response.data.data;
    });
    this.post.nationality = "INDONESIAN";
    // const date = new Date();
    // const year = date.getFullYear();
    // for (let i = year; i <= year + 10; i++) {
    //   this.id_valid_years.push(i);
    // }
  },
  validations: {
    post: {
      fullName: {
        required
      },
      nationality: {
        required
      }
    }
  },
  methods: {
    navigateNext(post) {
      this.$v.$touch();
      if (this.$v.$error) return;
      this.$store.dispatch("createPost", post);
      //this.$router.push("/second-step/");
    }
  },
  watch: {
    "post.fullName": function(newVal, oldVal) {
      console.log(newVal);
      this.$store.dispatch("setField", { fullName: newVal });
    },
    "post.nationality": function(newVal, oldVal) {
      console.log(newVal);
      this.$store.dispatch("setField", { nationality: newVal });
    }
  }
};
</script>
