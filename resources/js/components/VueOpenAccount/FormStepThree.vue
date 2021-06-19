<template>
  <div class="text-center border border-light p-5">
    <p class="h4 mb-4">Social Links</p>

    <input
      type="text"
      id="facebook"
      name="facebook"
      class="form-control mb-4"
      v-model="facebook"
      placeholder="Facebook"
    />

    <input
      type="text"
      id="google"
      name="google"
      class="form-control mb-4"
      v-model="google"
      placeholder="Google"
    />

    <input
      type="text"
      id="twitter"
      name="twitter"
      class="form-control mb-4"
      v-model="twitter"
      placeholder="Twitter"
    />

    <input
      type="text"
      id="linkedin"
      name="linkedin"
      class="form-control mb-4"
      v-model="linkedin"
      placeholder="Linkedin"
    />

    <input
      type="text"
      id="instagram"
      name="instagram"
      class="form-control mb-4"
      v-model="instagram"
      placeholder="Instagram"
    />

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
    facebook: {
      get() {
        return this.$store.state.facebook;
      },
      set(value) {
        this.$store.commit("setFacebook", value);
      },
    },
    google: {
      get() {
        return this.$store.state.google;
      },
      set(value) {
        this.$store.commit("setGoogle", value);
      },
    },
    twitter: {
      get() {
        return this.$store.state.twitter;
      },
      set(value) {
        this.$store.commit("setTwitter", value);
      },
    },
    linkedin: {
      get() {
        return this.$store.state.linkedin;
      },
      set(value) {
        this.$store.commit("setLinkedin", value);
      },
    },
    instagram: {
      get() {
        return this.$store.state.instagram;
      },
      set(value) {
        this.$store.commit("setInstagram", value);
      },
    },
  },
};
</script>