<template>
  <div class="bg-white shadow mb-8">
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
            v-model="full_name"
            :placeholder="__('Nama lengkap Anda sesuai identitas')"
          />
        </div>

        <div class="w-full">
          <label class="form-label"
            >Email <span class="form-required">*</span></label
          >
          <input
            type="email"
            name="email"
            v-model="email"
            placeholder="Isi alamat email Anda"
          />
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
</template>
<script>
export default {
  computed: {
    full_name: {
      get() {
        return this.$store.state.full_name;
      },
      set(value) {
        this.$store.commit("setFullName", { full_name: value });
      },
    },
    email: {
      get() {
        return this.$store.state.email;
      },
      set(value) {
        this.$store.commit("setFullName", { email: value });
      },
    },
  },
};
</script>