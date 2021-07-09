<x-web-layout>

  <section class="about-hero">
    <div class="hero-overlay"></div>
    <div
      class="relative flex w-full max-w-screen-xl justify-center mx-auto z-10 px-4 xl:px-12 pt-36 xl:pt-48 pb-16 xl:pb-12">
      <div class="w-full max-w-prose text-white text-center">
        <h1 class="font-display text-4xl font-bold xl:text-5xl mb-4">
          Download
        </h1>
      </div>
    </div>
  </section>

  <section class="mb-4">
    <div class="w-full max-w-4xl mx-auto px-4 xl:px-12 py-4 lg:pt-16 lg:pb-16">
      <div
        class="flex flex-wrap md:flex-nowrap border border-gray-100 shadow rounded px-4 pt-4 pb-8 md:pb-4 items-center text-center md:text-left lg:pt-4 lg:pb-4 lg:px-8">
        <div class="w-full md:w-1/3">
          <img src="/images/semestaindovest_online_trading.jpg" class="h-52 object-contain">
        </div>
        <div class="w-full md:w-2/3 md:pl-12">
          <h2 class="font-display text-2xl font-bold text-blue mb-4 lg:text-3xl">
            Semesta Online Trading
          </h2>
          <p><a href="/storage/downloads/sonline/SOL.exe" download class="button button-contained button-orange">
              <x-svg-icon-windows /> Download for Windows
            </a></p>
          <p class="mt-2">
            <a href="https://play.google.com/store/apps/details?id=com.mobile.mg&hl=en&gl=US" class="inline-flex">
              <img src="/images/download_google_play.png" />
            </a>
            <a href="https://apps.apple.com/us/app/semesta-online/id1352865274" class="inline-flex">
              <img src="/images/download_app_store.png" />
            </a>
          </p>
        </div>
      </div>
    </div>
  </section>

  <section id="opening-account" class="mb-4 md:mb-8">
    <div class="w-full max-w-4xl mx-auto px-4 xl:px-12 py-8 lg:pt-0 lg:pb-16">
      <div class="border border-gray-100 shadow rounded p-4 lg:p-8">
        <h2
          class="font-display text-2xl text-center border-b-2 border-gray-100 pb-8 font-bold text-blue mb-4 lg:text-3xl">
          {{ __('download.openingAccount') }}
        </h2>
        <div class="flex flex-wrap md:flex-nowrap py-4 lg:py-4">
          <div class="w-full md:w-1/4">
            <h3 class="font-display text-2xl text-left font-semibold text-blue mb-4 lg:text-2xl">
              {{ __('download.forIndividual') }}
            </h3>
          </div>
          <div class="w-full md:w-3/4 md:pl-10">
            <div class="pt-2">
              <ul>
                <li class="flex mb-4">
                  <x-svg-icon-pdf />
                  <a href="/storage/downloads/individual/fpreindividuuk.pdf" download
                    class="text-blue hover:underline"><span>Opening Account Individual Form</span>&nbsp;&nbsp;<span
                      class="material-icons text-sm text-gray-500">open_in_new</span></a>
                </li>
                <li class="flex mb-4">
                  <x-svg-icon-pdf />
                  <a href="/storage/downloads/individual/fprdnid.pdf" download
                    class="text-blue hover:underline"><span>Account Opening Application CIMB
                      Niaga</span>&nbsp;&nbsp;<span class="material-icons text-sm text-gray-500">open_in_new</span></a>
                </li>
                <li class="flex mb-4">
                  <x-svg-icon-pdf />
                  <a href="/storage/downloads/individual/spnonpwp.pdf" download
                    class="text-blue hover:underline"><span>Declaration of Non NPWP Letter</span>&nbsp;&nbsp;<span
                      class="material-icons text-sm text-gray-500">open_in_new</span></a>
                </li>
                <li class="flex mb-4">
                  <x-svg-icon-doc />
                  <a href="/storage/downloads/individual/ifdf.doc" download
                    class="text-blue hover:underline"><span>Individual FATCA Declaration Form</span>&nbsp;&nbsp;<span
                      class="material-icons text-sm text-gray-500">open_in_new</span></a>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <div class="flex flex-wrap md:flex-nowrap py-4 lg:py-4">
          <div class="w-full md:w-1/4">
            <h3 class="font-display text-2xl text-left font-semibold text-blue mb-4 lg:text-2xl">
              {{ __('download.forInstitution') }}
            </h3>
          </div>
          <div class="w-full md:w-3/4 md:pl-10">
            <div class="pt-2">
              <ul>
                <li class="flex mb-4">
                  <x-svg-icon-pdf />
                  <a href="/storage/downloads/institution/fpreinstitusiuk.pdf" download
                    class="text-blue hover:underline"><span>Opening Account Institution Form</span>&nbsp;&nbsp;<span
                      class="material-icons text-sm text-gray-500">open_in_new</span></a>
                </li>
                <li class="flex mb-4">
                  <x-svg-icon-doc />
                  <a href="/storage/downloads/institution/powerofattorney.doc" download
                    class="text-blue hover:underline"><span>Power of Attorney</span>&nbsp;&nbsp;<span
                      class="material-icons text-sm text-gray-500">open_in_new</span></a>
                </li>
                <li class="flex mb-4">
                  <x-svg-icon-doc />
                  <a href="/storage/downloads/institution/skdinstitusiuk.doc" download
                    class="text-blue hover:underline"><span>Statements of Fund and Securities Adequacy for
                      Institution</span>&nbsp;&nbsp;<span
                      class="material-icons text-sm text-gray-500">open_in_new</span></a>
                </li>
                <li class="flex mb-4">
                  <x-svg-icon-pdf />
                  <a href="/storage/downloads/institution/fprdninstitusi.pdf" download
                    class="text-blue hover:underline"><span>Account Opening Application CIMB Niaga for
                      Institution</span>&nbsp;&nbsp;<span
                      class="material-icons text-sm text-gray-500">open_in_new</span></a>
                </li>
                <li class="flex mb-4">
                  <x-svg-icon-doc />
                  <a href="/storage/downloads/institution/nifdf.doc" download
                    class="text-blue hover:underline"><span>Non - Individual FATCA Declaration
                      Form</span>&nbsp;&nbsp;<span class="material-icons text-sm text-gray-500">open_in_new</span></a>
                </li>
                <li class="flex mb-4">
                  <x-svg-icon-pdf />
                  <a href="/storage/downloads/institution/fw8.pdf" download
                    class="text-blue hover:underline"><span>FATCA W-8</span>&nbsp;&nbsp;<span
                      class="material-icons text-sm text-gray-500">open_in_new</span></a>
                </li>
                <li class="flex mb-4">
                  <x-svg-icon-pdf />
                  <a href="/storage/downloads/institution/fw9.pdf" download
                    class="text-blue hover:underline"><span>FATCA W-9</span>&nbsp;&nbsp;<span
                      class="material-icons text-sm text-gray-500">open_in_new</span></a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>


</x-web-layout>