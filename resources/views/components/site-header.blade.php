<div id="site-header">
  <div class="flex w-full max-w-screen-xl mx-auto items-center px-4 xl:px-12 py-2 lg:py-4">

    <div class="mr-auto lg:mr-12">
      <a href="/"><img class="h-16 w-auto lg:h-20" src="/images/logo_semesta_indovest_sekuritas.png"
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
          <li><a class="{{ (request()->is('contact-us*')) ? 'active' : '' }}" href="/contact-us">Contact Us</a></li>
        </ul>
      </nav>
    </div>

    <div class="ml-auto hidden lg:block">
      <div class="flex">
        <div class="hidden mr-2">
          <a href="#" class="button button-outline button-md">Online Trading</a>
        </div>
        <div>
          <a href="/open-account" class="button button-contained button-orange button-md">Open Account</a>
        </div>
      </div>
    </div>

    <button @click="menuopen = true" type="button" class="inline-flex p-2 -mr-2 lg:hidden"><span
        class="material-icons">menu</span></button>

  </div>

</div>

<div class="mobile-nav" x-bind:class="{ 'menuopen': menuopen }">
  <button @click="menuopen = false" class="absolute right-2 top-2 inline-flex p-2 lg:hidden"><span
      class="material-icons">close</span></button>
  <nav class="nav-main">
    <ul>
      <li><a class="{{ (request()->is('/')) ? 'active' : '' }}" href="/">Home</a></li>
      <li><a class="{{ (request()->is('about-us*')) ? 'active' : '' }}" href="/about-us">About Us</a></li>
      <li><a class="{{ (request()->is('our-services*')) ? 'active' : '' }}" href="/our-services">Our Services</a>
      </li>
      <li><a class="{{ (request()->is('market-news*')) ? 'active' : '' }}" href="/market-news">Market News</a></li>
      <li><a class="{{ (request()->is('contact-us*')) ? 'active' : '' }}" href="/contact-us">Contact Us</a></li>
    </ul>
  </nav>
  <div class="mt-8">
    <a href="/open-account" class="w-full justify-center button button-contained button-orange button-md">Open
      Account</a>
  </div>
</div>

<div @click="menuopen = false" class="menuoverlay" x-bind:class="{ 'menuopen': menuopen }"></div>