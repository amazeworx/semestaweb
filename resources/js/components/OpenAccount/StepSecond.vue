<template>
  <div v-if="secondStep">
    <div class="bg-white shadow mb-8">
      <div
        class="flex flex-wrap px-4 py-6 lg:flex-nowrap lg:gap-6 lg:px-8 lg:py-11 border-b border-gray-200"
      >
        <div class="w-full lg:w-1/4">
          {{ theStep }}
          <h3 class="text-xl font-bold mb-4">{{ __("Step 2") }}</h3>
        </div>

        <div class="w-full grid grid-cols-1 gap-6 lg:w-3/4">
          <div class="w-full">
            <ValidationProvider
              rules="required|min:16"
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
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { ValidationProvider } from "vee-validate";
export default {
  components: { ValidationProvider },
  computed: {
    theStep() {
      return this.$store.getters.step;
    },
    secondStep() {
      if (this.$store.getters.step === 2) {
        return true;
      }
      return false;
    },
    ktp_number: {
      get() {
        return this.$store.getters.fields.ktp_number;
      },
      set(value) {
        this.$store.commit("setKTPNumber", { ktp_number: value });
      },
    },
  },
  // watch: {
  //   valid: {
  //     immediate: true,
  //     handler() {
  //       this.$emit("change", this.valid);
  //     },
  //   },
  // },
};
</script>