<template>
  <div class="flex gap-4 mt-8 justify-center" v-if="isNotLast">
    <button
      type="button"
      class="button-contained button-orange"
      @click="navPrevious"
      v-show="isNotFirst"
    >
      ⟵ Kembali
    </button>

    <button
      type="button"
      class="button-contained button-orange"
      @click="navNext"
      :disabled="invalid"
    >
      {{ nextButtonText }} ⟶
    </button>
  </div>
</template>
<script>
export default {
  props: ["invalid"],
  computed: {
    theStep() {
      return this.$store.getters.step;
    },
    isNotLast() {
      return this.$store.getters.step !== 5;
    },
    isNotFirst() {
      return this.$store.getters.step !== 1;
    },
    nextButtonText() {
      if (this.$store.getters.step === 4) {
        return "Submit";
      }
      return "Berikutnya";
    },
  },
  methods: {
    navPrevious() {
      this.$store.commit("decreaseStep", 1);
    },
    navNext() {
      if (this.$store.getters.step === 4) {
        this.submit();
      } else {
        this.$store.commit("increaseStep", 1);
      }
    },
    submit() {
      //alert("Submit");
      axios
        .post("/api/form-open-account", this.$store.getters.fields)
        .then((response) => {
          this.$store.commit("setSuccess", true);
          this.$store.commit("setErrors", {});
          this.$store.commit("setNationality", "INDONESIAN");
          // this.success = true;
          // this.errors = {};
        })
        .catch((error) => {
          if (error.response.status == 422) {
            //this.errors = error.response.data.errors;
            this.$store.commit("setErrors", error.response.data.errors);
          }
          console.log("Error");
        });
      this.$store.commit("increaseStep", 1);
    },
  },
};
</script>