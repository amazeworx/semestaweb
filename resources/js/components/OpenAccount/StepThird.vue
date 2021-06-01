<template>
  <div v-if="thirdStep">
    <div class="bg-white shadow mb-8">
      <div
        class="flex flex-wrap px-4 py-6 lg:flex-nowrap lg:gap-6 lg:px-8 lg:py-11 border-b border-gray-200"
      >
        <div class="w-full lg:w-1/4">
          {{ theStep }}
          <h3 class="text-xl font-bold mb-4">{{ __("Step 3") }}</h3>
        </div>

        <div class="w-full grid grid-cols-1 gap-6 lg:w-3/4">
          <div class="w-full">
            <ValidationProvider
              rules="required|email"
              name="email"
              v-slot="{ errors }"
            >
              <label class="form-label"
                >Email <span class="form-required">*</span></label
              >
              <input
                type="email"
                name="email"
                v-model="email"
                placeholder="Isi alamat email Anda"
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
    thirdStep() {
      if (this.$store.getters.step === 3) {
        return true;
      }
      return false;
    },
    email: {
      get() {
        return this.$store.getters.fields.email;
      },
      set(value) {
        this.$store.commit("setEmail", { email: value });
      },
    },
  },
};
</script>