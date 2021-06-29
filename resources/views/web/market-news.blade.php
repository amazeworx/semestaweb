<x-web-layout>

  <div class="flex flex-wrap lg:flex-nowrap w-full max-w-screen-xl mx-auto px-4 xl:px-12 pt-36 xl:pt-48 pb-16 xl:pb-12">
    <div class="flex flex-col w-full lg:pr-4 lg:w-3/5 xl:pr-10">

      <div class="w-full mb-8">
        <h1 class="text-2xl lg:text-3xl text-blue font-display font-bold mb-4">Daily Market</h1>
        <div class="w-full border border-gray-200 py-6 px-4 md:p-8">
          <livewire:web.featured-daily-market :trimwords="320" />
        </div>
      </div>

      <div class="w-full flex flex-col mb-8">
        <h3 class="uppercase text-gray-600 font-bold mb-4">ALL DAILY MARKET POSTS</h3>
        <livewire:web.previous-daily-market />
      </div>

    </div>

    <div id="market-news" class="flex flex-col w-full lg:pl-4 lg:w-2/5 xl:pl-16">
      <h2 class="text-3xl text-blue font-display font-bold mb-4">Market News</h2>
      <div class="flex-1 w-full">
        <x-market-news per-page="10" text-size="text-sm" />
      </div>
    </div>
  </div>

</x-web-layout>