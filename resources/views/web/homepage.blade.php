<x-web-layout>

  <!-- Slider main container -->
  <section class="home-slider">
    <div class="swiper-container">

      <div class="swiper-wrapper">

        <div class="swiper-slide">
          <div class="slide relative h-full w-full">
            <div class="w-full h-full absolute inset-0 z-10">
              <img src="/images/home_hero_3.jpg" class="w-full h-full object-cover" />
            </div>
            <div class="w-full h-full absolute inset-0 bg-black bg-opacity-60 z-20 xl:bg-opacity-25"></div>
            <div class="flex h-full w-full items-center max-w-screen-xl mx-auto z-30 px-4 xl:px-20 py-4">
              <div class="relative w-full md:w-2/3 lg:w-1/2 text-white">
                <h1 class="font-display font-bold text-4xl md:text-5xl xl:text-6xl mb-3 md:mb-4">Make Your Money Work
                  For
                  You
                </h1>
                <p class="text-lg md:text-xl xl:text-2xl mb-4 xl:mb-6">We provide solutions to meet your specific
                  financial
                  needs while
                  maximizing returns</p>
                <div><a href="/download#opening-account" class="button button-contained button-orange button-xl">Open
                    New
                    Account</a></div>
              </div>
            </div>
          </div>
        </div>

        <div class="swiper-slide">
          <div class="slide relative h-full w-full">
            <div class="w-full h-full absolute inset-0 z-10">
              <img src="/images/home_hero_2.jpg" class="w-full h-full object-cover" />
            </div>
            <div class="w-full h-full absolute inset-0 bg-black bg-opacity-60 z-20 xl:bg-opacity-25"></div>
            <div class="flex h-full w-full items-center max-w-screen-xl mx-auto z-30 px-4 xl:px-20 py-4">
              <div class="relative w-full md:w-2/3 lg:w-7/12 text-white">
                <h1 class="font-display font-bold leading-tight text-4xl md:text-5xl xl:text-6xl mb-3 md:mb-4">Member of the Indonesia
                  Stock Exchange
                </h1>
                <p class="text-lg md:text-xl xl:text-2xl mb-4 xl:mb-6">With license to engage in Broker-Dealer and
                  Underwriters from the Financial Services Authority (OJK)</p>
                <div><a href="/about-us" class="button button-contained button-orange button-xl">About
                    Us</a></div>
              </div>
            </div>
          </div>
        </div>

        <div class="swiper-slide">
          <div class="slide relative h-full w-full">
            <div class="w-full h-full absolute inset-0 z-10">
              <img src="/images/home_hero_1.jpg" class="w-full h-full object-cover" />
            </div>
            <div class="w-full h-full absolute inset-0 bg-black bg-opacity-60 z-20 xl:bg-opacity-25"></div>
            <div class="flex h-full w-full items-center max-w-screen-xl mx-auto z-30 px-4 xl:px-20 py-4">
              <div class="relative w-full md:w-2/3 lg:w-7/12 text-white">
                <h1 class="font-display font-bold text-4xl md:text-5xl xl:text-6xl mb-3 md:mb-4">Providing You an Integrated Financial Services
                </h1>
                <p class="text-lg md:text-xl xl:text-2xl mb-4 xl:mb-6">Our integrated services ranging from Brokerage, Investment Management and Corporate Finance.</p>
                <div><a href="/our-services" class="button button-contained button-orange button-xl">Our Services</a></div>
              </div>
            </div>
          </div>
        </div>

      </div>

      <div class="swiper-pagination"></div>

      <div class="swiper-button-prev"></div>
      <div class="swiper-button-next"></div>

    </div>
  </section>

  {{-- <section class="home-hero relative">
    <div class="w-full h-full absolute inset-0 bg-black bg-opacity-50 z-0 xl:bg-opacity-25"></div>
    <div class="flex w-full max-w-screen-xl mx-auto px-4 xl:px-12 py-4">
      <div class="relative w-full md:w-2/3 lg:w-1/2 text-white">
        <h1 class="font-display font-bold text-4xl md:text-5xl xl:text-6xl mb-3 md:mb-4">Make Your Money Work For You
        </h1>
        <p class="text-lg md:text-xl xl:text-2xl mb-4 xl:mb-6">We provide solutions to meet your specific financial
          needs while
          maximizing returns</p>
        <div><a href="/download#opening-account" class="button button-contained button-orange button-xl">Open New
            Account</a></div>
      </div>
    </div>
  </section> --}}

  <section class="home-about">
    <div class="flex flex-wrap md:flex-nowrap items-center w-full max-w-screen-xl mx-auto px-4 xl:px-12 pt-12 pb-0 md:py-12 xl:py-24 md:gap-8 xl:gap-16">
      <div class="w-full lg:w-1/2">
        <h2 class="font-display text-3xl font-bold text-blue xl:text-4xl mb-4">Welcome to Semesta Indovest Securities
        </h2>
        <p class="text-base mb-4 xl:mb-5">Semesta Indovest Securities is a leading financial services company in
          Indonesia, providing integrated services ranging from Brokerage, Investment Management and Corporate
          Finance.
        <p class="text-base mb-4 xl:mb-5">We are a member of Indonesia Stock Exchange and are listed on Financial
          Services Authority (OJK). We provide personalized solutions to meet specific financial needs of our
          clients
          while maximizing return for our investors.</p>
        <div class="mb-4 lg:mb-0"><a href="/about-us" class="button button-outline button-md"><span class="mr-1">About
              Us</span> <span class="material-icons">arrow_right_alt</span></a></div>
      </div>
      <div class="-mx-4 md:mx-0 lg:w-1/2">
        <img class="md:object-cover md:h-96" src="images/home_about.jpg" alt="about" width="600" height="600">
      </div>
    </div>
  </section>

  <section class="home-services bg-gray-100">
    <div class="flex flex-col w-full max-w-screen-xl mx-auto px-4 xl:px-12 py-12 xl:py-24">

      <div class="text-center mb-8 xl:mb-10">
        <h2 class="text-3xl md:text-4xl text-blue font-display font-bold">Our Services</h2>
      </div>

      <div class="grid grid-cols-1 gap-4 md:grid-cols-3 xl:gap-x-8">

        <div class="flex flex-col bg-white shadow rounded overflow-hidden">
          <div>
            <a href="/our-services/#brokerage" class="block relative">
              <img class="h-44 md:h-40 lg:h-56 object-cover" src="/images/card_brokerage.jpg" alt="brokerage" width="480" height="300">
              <div class="absolute bottom-4 left-4 right-4 text-white">
                <h3 class="text-2xl font-bold">Brokerage</h3>
              </div>
            </a>
          </div>
          <div class="p-4">
            <p class="text-gray-600">We offers corporate and individual investors direct access to a wide range of
              stocks that listed on Indonesia Stock Exchage.</p>
            <div class="mt-2"><a href="/our-services/#brokerage" class="button button-text"><span>Learn
                  More</span></a>
            </div>
          </div>
        </div>

        <div class="flex flex-col bg-white shadow rounded overflow-hidden">
          <div>
            <a href="/our-services/#investment-management" class="block relative">
              <img class="h-44 md:h-40 lg:h-56 object-cover" src="/images/card_investment_management.jpg" alt="brokerage" width="480" height="300">
              <div class="absolute bottom-4 left-4 right-4 text-white">
                <h3 class="text-2xl font-bold">Investment Management</h3>
              </div>
            </a>
          </div>
          <div class="p-4">
            <p class="text-gray-600">The professional management of various securities and assets to meet specified
              investment goals for the benefits of our investors.</p>
            <div class="mt-2"><a href="/our-services/#investment-management" class="button button-text"><span>Learn
                  More</span></a></div>
          </div>
        </div>

        <div class="flex flex-col bg-white shadow rounded overflow-hidden">
          <div>
            <a href="/our-services/#corporate-finance" class="block relative">
              <img class="h-44 md:h-40 lg:h-56 object-cover" src="/images/card_corporate_finance.jpg" alt="brokerage" width="480" height="300">
              <div class="absolute bottom-4 left-4 right-4 text-white">
                <h3 class="text-2xl font-bold">Corporate Finance</h3>
              </div>
            </a>
          </div>
          <div class="p-4">
            <p class="text-gray-600">Our team of professionals is devoted to providing clients with the most effective
              range of services to raise capital.</p>
            <div class="mt-2"><a href="/our-services/#corporate-finance" class="button button-text"><span>Learn
                  More</span></a></div>
          </div>
        </div>

      </div>
    </div>
  </section>

  <section class="home-market pb-10">
    <div class="flex flex-col w-full max-w-screen-xl mx-auto px-4 xl:px-12 pt-12 pb-10 xl:pt-24 xl:pb-12">
      <h2 class="text-2xl lg:text-4xl text-blue font-display font-bold mb-4">Market Overview</h2>
      <x-tradingview />
    </div>
    <div class="flex flex-wrap md:flex-nowrap w-full max-w-screen-xl mx-auto px-4 xl:px-12 py-4 xl:pt-12 xl:pb-24 md:gap-6 xl:gap-16">
      <div class="flex flex-col w-full md:w-1/2 lg:w-1/3">
        <h2 class="text-2xl lg:text-3xl text-blue font-display font-bold mb-4">Daily Market</h2>
        <div class="flex-1 w-full border border-gray-200 p-4 lg:p-8 mb-8 md:mb-0">
          <livewire:web.featured-daily-market :trimwords="420" />
        </div>
      </div>
      <div class="flex flex-col w-full md:w-1/2 lg:w-2/3">
        <h2 class="text-2xl lg:text-3xl text-blue font-display font-bold mb-4">Market News</h2>
        <div class="flex-1 w-full border border-gray-200 px-4 py-4 md:px-8">
          <x-market-news per-page="5" text-size="text-base lg:text-lg" />
          <div class="mt-4"><a href="/market-news" class="button button-text button-lg"><span class="mr-1">View
                More</span> <span class="material-icons">arrow_right_alt</span></a></div>
        </div>
      </div>
    </div>
  </section>

</x-web-layout>