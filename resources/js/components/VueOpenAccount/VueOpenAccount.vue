<template>
  <div
    class="
      bg-gray-50
      min-h-screen
      border-t border-gray-200
      py-10
      md:px-4
      lg:px-6
      lg:py-16
      xl:py-24
    "
  >
    <div class="max-w-5xl mx-auto">
      <div class="px-4">
        <h1
          class="
            text-center text-3xl
            leading-tight
            font-display font-bold
            text-blue
            mb-2
            lg:text-4xl
          "
        >
          Form Pembukaan Rekening
        </h1>
        <h2
          class="
            text-center text-xl
            font-bold
            text-gray-500
            mb-8
            lg:text-2xl
            lg:mb-8
          "
        >
          PT Semesta Indovest Sekuritas
        </h2>
      </div>

      <div class="open-account flex flex-col flex-wrap">
        <router-view></router-view>
      </div>
    </div>
  </div>
</template>

<script>
export default {};
</script>