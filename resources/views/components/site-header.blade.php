<div id="site-header">
  <div class="flex w-full max-w-screen-xl mx-auto items-center px-4 xl:px-12 py-2 xl:py-4">

    <div class="mr-auto xl:mr-12">
      <a href="/"><img class="h-16 w-auto xl:h-20" src="/images/logo_semesta_indovest_sekuritas.png"
          alt="Semesta Indovest Sekuritas" width="86" height="82" /></a>
    </div>

    <div class="header-nav">
      <nav class="nav-main">
        <ul>
          <li><a class="{{ (request()->is('/')) ? 'active' : '' }}" href="/">Home</a></li>
          <li><a class="{{ (request()->is('about-us*')) ? 'active' : '' }}" href="/about-us">About Us</a></li>
          <li><a class="{{ (request()->is('our-services*')) ? 'active' : '' }}" href="/our-services">Our Services</a>
          </li>
          <li><a class="{{ (request()->is('market-news*')) ? 'active' : '' }}" href="/market-news">Market News</a></li>
          <li><a class="{{ (request()->is('download*')) ? 'active' : '' }}" href="/download">Download</a></li>
          <li><a href="https://www.e-ipo.co.id/" target="_blank">e-IPO</a></li>
          <li><a class="{{ (request()->is('contact-us*')) ? 'active' : '' }}" href="/contact-us">Contact</a></li>
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
          <a href="/download#opening-account" class="button button-contained button-orange button-md">Open Account</a>
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
      <li><a class="{{ (request()->is('/')) ? 'active' : '' }}" href="/">Home</a></li>
      <li><a class="{{ (request()->is('about-us*')) ? 'active' : '' }}" href="/about-us">About Us</a></li>
      <li><a class="{{ (request()->is('our-services*')) ? 'active' : '' }}" href="/our-services">Our Services</a>
      </li>
      <li><a class="{{ (request()->is('market-news*')) ? 'active' : '' }}" href="/market-news">Market News</a></li>
      <li><a class="{{ (request()->is('download*')) ? 'active' : '' }}" href="/download">Download</a></li>
      <li><a href="https://www.e-ipo.co.id/" target="_blank">e-IPO</a></li>
      <li><a class="{{ (request()->is('contact-us*')) ? 'active' : '' }}" href="/contact-us">Contact Us</a></li>
    </ul>
  </nav>
  <div class="mt-8">
    <a href="/download#opening-account"
      class="w-full justify-center button button-contained button-orange button-md">Open
      Account</a>
    <a href="https://wa.me/6281211372872" target="_blank"
      class="mt-4 w-full justify-center button button-outline button-md">
      <span class="material-icons mr-1">
        support_agent
      </span>
      <span>081211372872</span></a>
  </div>
</div>

<div @click="menuopen = false" class="menuoverlay" x-bind:class="{ 'menuopen': menuopen }"></div>