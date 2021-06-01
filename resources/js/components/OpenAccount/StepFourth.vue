<template>
  <div v-if="fourthStep">
    <div class="bg-white shadow mb-8">
      <div
        class="flex flex-wrap px-4 py-6 lg:flex-nowrap lg:gap-6 lg:px-8 lg:py-11 border-b border-gray-200"
      >
        <div class="w-full lg:w-1/4">
          {{ theStep }}
          <h3 class="text-xl font-bold mb-4">{{ __("Step 4") }}</h3>
        </div>

        <div class="w-full grid grid-cols-1 gap-6 lg:w-3/4">
          <div class="w-full">
            <ValidationProvider
              rules="required"
              name="mother_name"
              v-slot="{ errors }"
            >
              <label class="form-label"
                >Nama Ibu Kandung <span class="form-required">*</span></label
              >
              <input
                type="text"
                name="mother_name"
                v-model="mother_name"
                placeholder="Isi nama Ibu kandung Anda"
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
    fourthStep() {
      if (this.$store.getters.step == 4) {
        return true;
      }
      return false;
    },
    mother_name: {
      get() {
        return this.$store.getters.fields.mother_name;
      },
      set(value) {
        this.$store.commit("setMotherName", { mother_name: value });
      },
    },
  },
};
</script>