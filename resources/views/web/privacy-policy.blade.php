<x-web-layout>

  <section class="privacypolicy-hero relative">
    <div class="hero-overlay"></div>
    <div
      class="relative flex w-full max-w-screen-xl justify-center mx-auto z-10 px-4 xl:px-12 pt-36 xl:pt-48 pb-16 xl:pb-12">
      <div class="w-full max-w-prose text-white text-center">
        <h1 class="font-display text-4xl font-bold xl:text-5xl xl:mb-4">{{ __('privacypolicy.pageTitle') }}</h1>
      </div>
    </div>
  </section>

  <section class="section-text">
    <div class="w-full max-w-screen-md mx-auto px-4 xl:px-12 py-12 xl:py-16">
      <div class="prose prose-sm max-w-none">
        {!! __('privacypolicy.pageContent') !!}
      </div>

    </div>
  </section>

</x-web-layout>
