<template>
  <div class="text-center border border-light p-5">
    <p class="h4 mb-4">Address Details</p>

    <input
      type="text"
      id="country"
      name="country"
      class="form-control mb-4"
      placeholder="Country"
      v-model="country"
    />

    <input
      type="text"
      id="state"
      name="state"
      class="form-control mb-4"
      placeholder="State"
      v-model="state"
    />

    <input
      type="text"
      id="city"
      name="city"
      class="form-control mb-4"
      placeholder="City"
      v-model="city"
    />

    <div class="form-row mb-4">
      <div class="col">
        <input
          type="text"
          id="street"
          name="street"
          class="form-control"
          placeholder="Street Address"
          v-model="street"
        />
      </div>
      <div class="col">
        <input
          type="text"
          id="zipcode"
          name="zipcode"
          class="form-control"
          placeholder="ZipCode"
          v-model="zipcode"
        />
      </div>
    </div>

    <buttons></buttons>
  </div>
</template>

<script>
import Buttons from "./Buttons.vue";

export default {
  components: {
    Buttons,
  },
  computed: {
    country: {
      get() {
        return this.$store.state.country;
      },
      set(value) {
        this.$store.commit("setCountry", value);
      },
    },
    state: {
      get() {
        return this.$store.state.state;
      },
      set(value) {
        this.$store.commit("setState", value);
      },
    },
    city: {
      get() {
        return this.$store.state.city;
      },
      set(value) {
        this.$store.commit("setCity", value);
      },
    },
    street: {
      get() {
        return this.$store.state.street;
      },
      set(value) {
        this.$store.commit("setStreet", value);
      },
    },
    zipcode: {
      get() {
        return this.$store.state.zipcode;
      },
      set(value) {
        this.$store.commit("setZipcode", value);
      },
    },
  },
};
</script>