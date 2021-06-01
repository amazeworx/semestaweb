<template>
  <div
    class="form-progress sticky top-0 w-full shadow bg-white z-30"
    v-if="notFinalStep"
  >
    <div class="flex justify-center">
      <div class="tab active">
        <div class="tab-label">
          <span class="tab-number">1</span>
          <span>Identitas</span>
        </div>
      </div>
      <div class="tab" :class="secondStep">
        <div class="tab-label">
          <span class="tab-number">2</span>
          <span>Pekerjaan</span>
        </div>
      </div>
      <div class="tab" :class="thirdStep">
        <div class="tab-label">
          <span class="tab-number">3</span>
          <span>Keuangan</span>
        </div>
      </div>
      <div class="tab" :class="fourthStep">
        <div class="tab-label">
          <span class="tab-number">4</span> <span>Syarat &amp; Ketentuan</span>
        </div>
      </div>
    </div>
    <div class="progress opacity-0 -mt-1 transition-opacity">
      <div class="indeterminate"></div>
    </div>
  </div>
</template>
<script>
export default {
  computed: {
    theStep() {
      return this.$store.getters.step;
    },
    secondStep() {
      if (this.$store.getters.step !== 1) {
        return "active";
      }
    },
    thirdStep() {
      if (this.$store.getters.step !== 1 && this.$store.getters.step !== 2) {
        return "active";
      }
    },
    fourthStep() {
      if (this.$store.getters.step === 4) {
        return "active";
      }
    },
    notFinalStep: function () {
      if (this.$store.getters.step !== 5) {
        return true;
      }
      return false;
    },
  },
};
</script>