<template>
  <div>
    <div class="grid grid-cols-1 gap-6 bg-white p-10 border">
      <div class="flex flex-col justify-center text-center mx-auto max-w-md">
        <h3 class="text-3xl font-bold">Congratulations!</h3>
        <!-- <lottie-player
          class="mx-auto my-6 w-40 h-40"
          src="/images/lottie-success.json"
          background="transparent"
          speed="1"
          loop
          autoplay
        >
        </lottie-player> -->
        <v-lottie-player
          name="successAnim"
          loop
          path="/images/lottie-success.json"
          class="mx-auto my-6 w-40 h-40"
        />
        <p>
          Selamat! Aplikasi pembukaan rekening Anda sudah lengkap dan akan
          segera diproses. Terima kasih!
        </p>
      </div>
    </div>
  </div>
</template>

<script>
import VueLottiePlayer from "vue-lottie-player";

export default {
  components: {
    vLottiePlayer: VueLottiePlayer
  },
  mounted() {
    this.$store.dispatch("resetFormState");
    localStorage.removeItem("open-account");
    window.onload = function() {
      localStorage.removeItem("open-account");
    };
  }
};
</script>
