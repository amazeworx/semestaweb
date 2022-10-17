<div id="site-header">
  <div class="flex w-full max-w-screen-xl mx-auto items-center px-4 xl:px-12 pt-0 pb-2 xl:pb-4">

    <div class="mr-auto pt-2 xl:pt-4 xl:mr-12">
      <a href="/"><img class="h-16 w-auto xl:h-20" src="/images/logo_semesta_indovest_sekuritas.png"
          alt="Semesta Indovest Sekuritas" width="86" height="82" /></a>
    </div>

    <div class="flex flex-wrap">
      <div class="w-full pt-2 pb-3 hidden xl:flex">
        <div class="ml-auto text-xs text-gray-400 lang-switcher"><a href="{{ route('localization.switch', 'id') }}"
            class="text-gray-400 hover:text-orange hover:underline {{ app()->getLocale() == 'id' ? 'active' : '' }}">Bahasa
            Indonesia</a> | <a href="{{ route('localization.switch', 'en') }}"
            class="text-gray-400 hover:text-orange hover:underline {{ app()->getLocale() == 'en' ? 'active' : '' }}">English</a>
        </div>
      </div>
      <div class="w-full flex items-center">
        <div class="header-nav">
          <nav class="nav-main">
            <ul>
              <li><a class="{{ (request()->is('/')) ? 'active' : '' }}" href="/">{{ __('header.navHome') }}</a></li>
              <li><a class="{{ (request()->is('about-us*')) ? 'active' : '' }}" href="/about-us">{{
                  __('header.navAboutUs') }}</a></li>
              <li><a class="{{ (request()->is('our-services*')) ? 'active' : '' }}" href="/our-services">{{
                  __('header.navServices') }}</a>
              </li>
              <li><a class="{{ (request()->is('market-news*')) ? 'active' : '' }}" href="/market-news">{{
                  __('header.navMarketNews') }}</a>
              </li>
              <li><a class="{{ (request()->is('download*')) ? 'active' : '' }}" href="/download">{{
                  __('header.navDownload') }}</a></li>
              <li><a href="https://www.e-ipo.co.id/en/ipo/93/trgu-pt-cerestar-indonesia-tbk" target="_blank">{{
                  __('header.navEIPO') }}</a></li>
              <li><a class="{{ (request()->is('contact-us*')) ? 'active' : '' }}" href="/contact-us">{{
                  __('header.navContact') }}</a></li>
            </ul>
          </nav>
        </div>

        <div class="ml-auto hidden xl:block">
          <div class="flex">
            <div class="mr-2">
              <a href="https://wa.me/6281211372872" target="_blank" class="button button-outline button-md">
                <span class="material-icons mr-1">
                  support_agent
                </span>
                <span>081211372872</span></a>
            </div>
            <div>
              <a href="/download#opening-account" class="button button-contained button-orange button-md">{{
                __('header.buttonOpenAccount') }}</a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <button @click="menuopen = true" type="button" class="inline-flex p-2 -mr-2 ml-auto xl:hidden"><span
        class="material-icons">menu</span></button>

  </div>

</div>

<div class="mobile-nav" x-bind:class="{ 'menuopen': menuopen }">
  <button @click="menuopen = false" class="absolute right-2 top-2 inline-flex p-2 xl:hidden"><span
      class="material-icons">close</span></button>
  <nav class="nav-main">
    <ul>
      <li><a class="{{ (request()->is('/')) ? 'active' : '' }}" href="/">{{ __('header.navHome') }}</a></li>
      <li><a class="{{ (request()->is('about-us*')) ? 'active' : '' }}" href="/about-us">{{ __('header.navAboutUs')
          }}</a></li>
      <li><a class="{{ (request()->is('our-services*')) ? 'active' : '' }}" href="/our-services">{{
          __('header.navServices') }}</a>
      </li>
      <li><a class="{{ (request()->is('market-news*')) ? 'active' : '' }}" href="/market-news">{{
          __('header.navMarketNews') }}</a></li>
      <li><a class="{{ (request()->is('download*')) ? 'active' : '' }}" href="/download">{{ __('header.navDownload')
          }}</a></li>
      <li><a href="https://www.e-ipo.co.id/id/ipo/150/pdpp-pt-primadaya-plastisindo-tbk" target="_blank">{{
          __('header.navEIPO') }}</a></li>
      <li><a class="{{ (request()->is('contact-us*')) ? 'active' : '' }}" href="/contact-us">{{ __('header.navContact')
          }}</a></li>
    </ul>
  </nav>
  <div class="mt-8">
    <a href="/download#opening-account" class="w-full justify-center button button-contained button-orange button-md">{{
      __('header.buttonOpenAccount') }}</a>
    <a href="https://wa.me/6281211372872" target="_blank"
      class="mt-4 w-full justify-center button button-outline button-md">
      <span class="material-icons mr-1">
        support_agent
      </span>
      <span>081211372872</span></a>
  </div>
  <div class="w-full pt-2 pb-3 mt-8">
    <div class="text-xs text-center text-gray-400 lang-switcher"><a href="{{ route('localization.switch', 'id') }}"
        class="text-gray-400 hover:text-orange hover:underline {{ app()->getLocale() == 'id' ? 'active' : '' }}">Bahasa
        Indonesia</a> | <a href="{{ route('localization.switch', 'en') }}"
        class="text-gray-400 hover:text-orange hover:underline {{ app()->getLocale() == 'en' ? 'active' : '' }}">English</a>
    </div>
  </div>
</div>

<div @click="menuopen = false" class="menuoverlay" x-bind:class="{ 'menuopen': menuopen }"></div>