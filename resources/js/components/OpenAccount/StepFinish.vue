<template>
  <div v-if="finalStep">
    <div class="bg-white shadow mb-8">
      <div
        class="flex flex-wrap px-4 py-6 lg:flex-nowrap lg:gap-6 lg:px-8 lg:py-11 border-b border-gray-200"
      >
        <div class="w-full lg:w-1/4">
          {{ theStep }}
          <h3 class="text-xl font-bold mb-4">{{ __("Thank You") }}</h3>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  computed: {
    theStep() {
      return this.$store.getters.step;
    },
    finalStep: function () {
      if (this.$store.getters.step === 5) {
        return true;
      }
      return false;
    },
  },
};
</script>