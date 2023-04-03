<x-web-layout>

  <!-- Slider main container -->
  <section class="home-slider">
    <div class="swiper-container">

      <div class="swiper-wrapper">

        <div class="swiper-slide">
          <div class="slide relative h-full w-full">
            <div class="w-full h-full absolute inset-0 z-10">
              <img src="/images/home_hero_4.jpg" class="w-full h-full object-cover" />
            </div>
            <div class="w-full h-full absolute inset-0 bg-black bg-opacity-60 z-20 xl:bg-opacity-10"></div>
            <div class="flex h-full w-full items-center max-w-screen-xl mx-auto z-30 px-4 xl:px-12 pt-20 pb-4 xl:pt-36">
              <div class="relative w-full md:w-2/3 lg:w-1/2 text-white">
                <h1 class="font-display font-bold text-3xl md:text-5xl xl:text-6xl mb-3 md:mb-4">
                  {{ __('homepage.slide1Title') }}
                </h1>
                <p class="text-base md:text-xl xl:text-xl mb-4 xl:mb-6">
                  {{ __('homepage.slide1Description') }}
                </p>
                <div><a href="https://join.semestaindovest.co.id/"
                    class="button button-contained button-orange button-xl text-center">{!!
                    __('homepage.slide1ButtonText') !!}</a>
                </div>
              </div>
            </div>
            <div
              class="absolute left-4 bottom-4 text-xs text-left text-white z-30 md:text-right md:right-4 lg:text-sm lg:right-6">
              T&C : WNI, Individu, Rekening BCA dan min. deposit 100jt.
            </div>
          </div>
        </div>

        <div class="swiper-slide">
          <div class="slide relative h-full w-full">
            <div class="w-full h-full absolute inset-0 z-10">
              <img src="/images/home_hero_2.jpg" class="w-full h-full object-cover" />
            </div>
            <div class="w-full h-full absolute inset-0 bg-black bg-opacity-60 z-20 xl:bg-opacity-25"></div>
            <div class="flex h-full w-full items-center max-w-screen-xl mx-auto z-30 px-4 xl:px-12 pt-20 pb-4 xl:pt-36">
              <div class="relative w-full md:w-2/3 lg:w-7/12 text-white">
                <h1 class="font-display font-bold leading-tight text-4xl md:text-5xl xl:text-6xl mb-3 md:mb-4">
                  {{ __('homepage.slide2Title') }}
                </h1>
                <p class="text-lg md:text-xl xl:text-2xl mb-4 xl:mb-6">
                  {{ __('homepage.slide2Description') }}
                </p>
                <div><a href="/about-us" class="button button-contained button-orange button-xl">{{
                    __('homepage.slide2ButtonText') }}</a>
                </div>
              </div>
            </div>
          </div>
        </div>

        {{-- <div class="swiper-slide">
          <div class="slide relative h-full w-full">
            <div class="w-full h-full absolute inset-0 z-10">
              <img src="/images/hero-bdkr.jpg" class="w-full h-full object-cover object-right-top" />
            </div>
            <div
              class="w-full h-full absolute inset-0 bg-black bg-opacity-60 z-20 xl:bg-transparent xl:opacity-90 xl:bg-gradient-to-br xl:from-black xl:to-transparent">
            </div>
            <div
              class="flex h-full w-full items-center justify-start max-w-screen-xl mx-auto z-30 px-4 xl:px-12 pt-20 pb-4 xl:pt-36">
              <div class="relative w-full md:w-2/3 lg:w-1/2 text-white">
                <h1 class="font-display font-bold text-4xl md:text-4xl xl:text-5xl mb-3 md:mb-4">
                  BDKR<br>
                  PT. Berdikari Pondasi Perkasa Tbk
                </h1>
                <p class="text-lg md:text-xl xl:text-xl mb-4 xl:mb-6">
                  Book Building<br>
                  6 Feb - 10 Feb 2023<br>
                  Price Range IDR 188 - IDR 200<br>
                </p>
                <div><a href="https://www.e-ipo.co.id/id/ipo/217/bdkr-pt-berdikari-pondasi-perkasa-tbk" target="_blank"
                    class="button button-contained button-orange button-xl">Place Order</a>
                </div>
              </div>
            </div>
          </div>
        </div> --}}

        <div class="swiper-slide">
          <div class="slide relative h-full w-full">
            <div class="w-full h-full absolute inset-0 z-10">
              <img src="/images/home_hero_5.jpg" class="w-full h-full object-cover" />
            </div>
            <div class="w-full h-full absolute inset-0 bg-black bg-opacity-60 z-20 xl:bg-opacity-40"></div>
            <div class="flex h-full w-full items-center max-w-screen-xl mx-auto z-30 px-4 xl:px-12 pt-20 pb-4 xl:pt-36">
              <div class="relative w-full md:w-2/3 lg:w-7/12 text-white">
                <h1 class="font-display font-bold text-4xl md:text-5xl xl:text-6xl mb-3 md:mb-4">
                  {{ __('homepage.slide3Title') }}
                </h1>
                <p class="text-lg md:text-xl xl:text-2xl mb-4 xl:mb-6">{{ __('homepage.slide3Description') }}</p>
                <p class="text-lg md:text-xl xl:text-2xl mb-4 xl:mb-6">
                  <strong>{{ __('homepage.slide3Description2') }}</strong><br>
                  Website: <a class="hover:underline"
                    href="https://www.semestaindovest.co.id">www.semestaindovest.co.id</a><br>
                  Instagram: <a class="hover:underline" href="https://www.instagram.com/semesta_mg/"
                    target="_blank">@semesta_mg</a><br>
                  Twitter: <a class="hover:underline" href="https://twitter.com/semesta_mg"
                    target="_blank">@semesta_mg</a>
                </p>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

    <div class="swiper-pagination"></div>

    <div class="swiper-button-prev"></div>
    <div class="swiper-button-next"></div>
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

  {{-- <section class="home-about">
    <div
      class="flex flex-wrap md:flex-nowrap items-center w-full max-w-screen-xl mx-auto px-4 xl:px-12 pt-12 pb-0 md:py-12 xl:py-24 md:gap-8 xl:gap-16">
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
  </section> --}}

  <section class="home-services bg-gray-100">
    <div class="flex flex-col w-full max-w-screen-xl mx-auto px-4 xl:px-12 py-12 xl:py-24">

      <div class="text-center mb-8 xl:mb-10">
        <h2 class="text-3xl md:text-4xl text-blue font-display font-bold">{{ __('homepage.ourServices') }}</h2>
      </div>

      <div class="grid grid-cols-1 gap-4 md:grid-cols-3 xl:gap-x-8">

        <div class="flex flex-col bg-white shadow rounded overflow-hidden">
          <div>
            <a href="/our-services/#brokerage" class="block relative">
              <img class="h-44 md:h-40 lg:h-56 object-cover" src="/images/card_brokerage.jpg" alt="brokerage"
                width="480" height="300">
              <div class="absolute bottom-4 left-4 right-4 text-white">
                <h3 class="text-2xl font-bold">{{ __('homepage.brokerage') }}</h3>
              </div>
            </a>
          </div>
          <div class="p-4">
            <p class="text-gray-600">{{ __('homepage.brokerageDescription') }}</p>
            <div class="mt-2"><a href="/our-services/#brokerage" class="button button-text"><span>{{
                  __('homepage.learnMore') }}</span></a>
            </div>
          </div>
        </div>

        <div class="flex flex-col bg-white shadow rounded overflow-hidden">
          <div>
            <a href="/our-services/#investment-management" class="block relative">
              <img class="h-44 md:h-40 lg:h-56 object-cover" src="/images/card_investment_management.jpg"
                alt="brokerage" width="480" height="300">
              <div class="absolute bottom-4 left-4 right-4 text-white">
                <h3 class="text-2xl font-bold">{{ __('homepage.investmentManagement') }}</h3>
              </div>
            </a>
          </div>
          <div class="p-4">
            <p class="text-gray-600">{{ __('homepage.investmentManagementDescription') }}</p>
            <div class="mt-2"><a href="/our-services/#investment-management" class="button button-text"><span>{{
                  __('homepage.learnMore') }}</span></a></div>
          </div>
        </div>

        <div class="flex flex-col bg-white shadow rounded overflow-hidden">
          <div>
            <a href="/our-services/#corporate-finance" class="block relative">
              <img class="h-44 md:h-40 lg:h-56 object-cover" src="/images/card_corporate_finance.jpg" alt="brokerage"
                width="480" height="300">
              <div class="absolute bottom-4 left-4 right-4 text-white">
                <h3 class="text-2xl font-bold">{{ __('homepage.corporateFinance') }}</h3>
              </div>
            </a>
          </div>
          <div class="p-4">
            <p class="text-gray-600">{{ __('homepage.corporateFinanceDescription') }}</p>
            <div class="mt-2"><a href="/our-services/#corporate-finance" class="button button-text"><span>{{
                  __('homepage.learnMore') }}</span></a></div>
          </div>
        </div>

      </div>
    </div>
  </section>

  <section class="home-market pb-10">
    <div class="flex flex-col w-full max-w-screen-xl mx-auto px-4 xl:px-12 pt-12 pb-10 xl:pt-24 xl:pb-12">
      <h2 class="text-2xl lg:text-4xl text-blue font-display font-bold mb-4">{{ __('homepage.marketOverview') }}</h2>
      <x-tradingview />
    </div>
    <div
      class="flex flex-wrap md:flex-nowrap w-full max-w-screen-xl mx-auto px-4 xl:px-12 py-4 xl:pt-12 xl:pb-24 md:gap-6 xl:gap-16">
      <div class="flex flex-col w-full md:w-1/2 lg:w-1/3">
        <h2 class="text-2xl lg:text-3xl text-blue font-display font-bold mb-4">{{ __('homepage.dailyMarket') }}</h2>
        <div class="flex-1 w-full border border-gray-200 p-4 lg:p-8 mb-8 md:mb-0">
          <livewire:web.featured-daily-market :trimwords="420" />
        </div>
      </div>
      <div class="flex flex-col w-full md:w-1/2 lg:w-2/3">
        <h2 class="text-2xl lg:text-3xl text-blue font-display font-bold mb-4">{{ __('homepage.marketNews') }}</h2>
        <div class="flex-1 w-full border border-gray-200 px-4 py-4 md:px-8">
          <x-market-news per-page="5" text-size="text-base lg:text-lg" />
          <div class="mt-4"><a href="/market-news" class="button button-text button-lg"><span class="mr-1">{{
                __('homepage.viewMore') }}</span> <span class="material-icons">arrow_right_alt</span></a></div>
        </div>
      </div>
    </div>
  </section>

</x-web-layout>