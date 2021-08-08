<template>
  <div class="form-progress sticky top-0 w-full shadow bg-white z-30">
    <div class="flex justify-center">
      <div class="tab active">
        <div class="tab-label">
          <span v-if="step != 1" class="tab-number">✓</span>
          <span v-else class="tab-number">1</span>
          <span class="tab-text">Identitas</span>
        </div>
      </div>
      <div class="tab" :class="{ active: step != 1 }">
        <div class="tab-label">
          <span v-if="step == 1 || step == 2" class="tab-number">2</span>
          <span v-else class="tab-number">✓</span>
          <span class="tab-text">Pekerjaan &amp; Keuangan</span>
        </div>
      </div>
      <div class="tab" :class="{ active: step != 1 && step != 2 }">
        <div class="tab-label">
          <span v-if="step == 1 || step == 2 || step == 3" class="tab-number"
            >3</span
          >
          <span v-else class="tab-number">✓</span>
          <span class="tab-text">Pasangan/Orang Tua</span>
        </div>
      </div>
      <div class="tab" :class="{ active: step != 1 && step != 2 && step != 3 }">
        <div class="tab-label">
          <span v-if="step != 5" class="tab-number">4</span>
          <span v-else class="tab-number">✓</span>
          <span class="tab-text">Syarat &amp; Ketentuan</span>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  computed: {
    step: {
      get() {
        return this.$store.state.step;
      }
    }
  },
  mounted() {
    //console.log(this.step);
  }
};
</script>
