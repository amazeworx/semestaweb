<x-web-layout>

  <section class="about-hero">
    <div class="hero-overlay"></div>
    <div
      class="relative flex w-full max-w-screen-xl justify-center mx-auto z-10 px-4 xl:px-12 pt-36 xl:pt-48 pb-16 xl:pb-12">
      <div class="w-full max-w-prose text-white text-center">
        <h1 class="font-display text-3xl font-bold xl:text-5xl mb-4">{{ __('about.pageTitle') }}</h1>
        <p class="text-base xl:text-lg">
          {{ __('about.pageIntro') }}
        </p>
      </div>
    </div>
  </section>

  <section class="about-vision-mission">
    <div class="w-full max-w-4xl mx-auto px-4 xl:px-12 py-10 xl:py-16">
      <div class="flex flex-wrap md:flex-nowrap gap-6 xl:gap-8 mb-8 xl:mb-10">
        <div class="w-full md:w-1/5">
          <h2 class="font-display text-3xl font-bold text-blue xl:text-4xl xl:mb-4">{{ __('about.vision') }}</h2>
        </div>
        <div class="w-full md:w-4/5">
          <p class="text-base lg:text-xl">{{ __('about.visionText') }}</p>
        </div>
      </div>
      <div class="flex flex-wrap md:flex-nowrap gap-6 xl:gap-8 mb-8 xl:mb-10">
        <div class="w-full md:w-1/5">
          <h2 class="font-display text-3xl font-bold text-blue xl:text-4xl xl:mb-4">{{ __('about.mission') }}</h2>
        </div>
        <div class="w-full md:w-4/5">
          <p class="text-base lg:text-xl mb-4 xl:mb-5">{{ __('about.missionText1') }}</p>
          <p class="text-base lg:text-xl">{{ __('about.missionText2') }}</p>
        </div>
      </div>
    </div>
  </section>

  <section class="about-management">
    <div class="w-full max-w-5xl mx-auto px-4 xl:px-12 py-4 xl:py-16">
      <div class="w-full">
        <h2 class="font-display text-3xl text-center font-bold text-blue mb-8 lg:text-4xl xl:mb-12">
          {{ __('about.management') }}</h2>
      </div>
      <div class="grid grid-cols-2 lg:grid-cols-4 gap-8 xl:gap-16">
        <livewire:web.management-person :personId="1" />
        <livewire:web.management-person :personId="2" />
        <livewire:web.management-person :personId="3" />
        <livewire:web.management-person :personId="4" />
      </div>
    </div>
  </section>

  <section class="about-credentials">
    <div class="w-full max-w-5xl mx-auto px-4 xl:px-12 py-10 lg:py-16">
      <div class="shadow rounded-lg py-8 lg:py-12 px-6 lg:px-16">
        <h2 class="font-display text-3xl text-center font-bold text-blue mb-6 xl:text-4xl xl:mb-8">Credentials</h2>
        <ul class="list-border-b text-base lg:text-lg text-gray-600">
          <li>Rajawali Group - Shares buy back project of PT Bentoel Investama Tbk (RMBA) shares in 2002.</li>
          <li>PT Surya Citra Media Tbk - Local advisor for IPO PT Surya Citra Media Tbk (SCMA) in 2002 and appointed as
            settlement broker for Employee Stock Option (ESOP) SCMA in 2003.</li>
          <li>PT Gozco Plantation Tbk - Lead underwriter of IPO GZCO in 2008.</li>
          <li>PT Elang Mahkota Teknologi Tbk - As settlement broker for Employee Stock Allocation (ESA) EMTK in 2010.
          </li>
          <li>PT Etertainment International Tbk - As arranger for Tender offer of SMMT in 2010.</li>
          <li>PT Fortune Mate Indonesia Tbk - As advisor for debt to equity swap of FMII in 2010.</li>
          <li>PT Delta Dunia Makmur Tbk - Crossing.</li>
          <li>PT Excel Axiata Tbk - Crossing.</li>
        </ul>
      </div>
    </div>
  </section>

  <section class="about-organization-structure">
    <div class="w-full max-w-5xl mx-auto px-4 xl:px-12 py-10 lg:py-16">
      <div class="w-full">
        <h2 class="font-display text-3xl text-center font-bold text-blue mb-8 lg:text-4xl xl:mb-12">
          {{ __('about.organizationStructure') }}
        </h2>
      </div>
      <div class="w-full rounded-lg shadow overflow-hidden mb-4"><a href="/images/organization_structure.png"
          target="_blank"><img src="/images/organization_structure.png" alt="Organization Structure" width="1400"
            height="720"></a></div>
      <div class="w-full text-center text-gray-600">
        <p class="font-bold">Izin Perorangan PT Semesta Indovest Sekuritas</p>
        <p><span class="inline-block mr-3">WPPE: 77</span><span class="inline-block mr-3">WPEE : 7</span><span
            class="inline-block mr-3">WMI : 6</span></p>
      </div>
    </div>
  </section>

  <section class="about-corporate-governance mb-4 md:mb-8">
    <div class="w-full max-w-5xl mx-auto px-4 xl:px-12 py-10 lg:py-16">
      <div class="w-full">
        <h2 class="font-display text-3xl text-center font-bold text-blue mb-8 lg:text-4xl xl:mb-12">Corporate Governance
        </h2>
      </div>

      <div class="w-full">

        <div class="bg-white max-w-2xl mx-auto" x-data="{selected:1}">

          <ul>

            <li class="relative rounded-md" :class="selected == 1 ? 'bg-indigo-50' : ''">
              <button type="button" class="w-full px-4 py-4 md:px-8 md:py-6 text-left focus:outline-none"
                @click="selected !== 1 ? selected = 1 : selected = null">
                <div class="flex items-center justify-between">
                  <span class="font-bold text-base lg:text-lg">Code of Ethics</span>
                  <span class="material-icons transition transform"
                    :class="selected == 1 ? 'rotate-180' : ''">expand_more</span>
                </div>
              </button>
              <div class="relative overflow-hidden transition-all max-h-0 duration-700" x-ref="container1"
                x-bind:style="selected == 1 ? 'max-height: ' + $refs.container1.scrollHeight + 'px' : ''">
                <div class="px-4 pt-2 pb-4 md:px-8">
                  <ul>
                    <li class="flex mb-4">
                      <x-svg-icon-pdf />
                      <a href="/storage/downloads/Kode Etik PT Semesta Indovest Sekuritas.pdf" target="_blank"
                        class="text-blue hover:underline"><span>Kode Etik PT Semesta Indovest
                          Sekuritas.pdf</span>&nbsp;&nbsp;<span
                          class="material-icons text-sm text-gray-500">open_in_new</span></a>
                    </li>
                  </ul>
                </div>
              </div>
            </li>

            <li class="relative rounded-md" :class="selected == 2 ? 'bg-indigo-50' : ''">
              <button type="button" class="w-full px-4 py-4 md:px-8 md:py-6 text-left focus:outline-none"
                @click="selected !== 2 ? selected = 2 : selected = null">
                <div class="flex items-center justify-between">
                  <span class="font-bold text-base lg:text-lg">Management Guidelines</span>
                  <span class="material-icons transition transform"
                    :class="selected == 2 ? 'rotate-180' : ''">expand_more</span>
                </div>
              </button>
              <div class="relative overflow-hidden transition-all max-h-0 duration-700" x-ref="container2"
                x-bind:style="selected == 2 ? 'max-height: ' + $refs.container2.scrollHeight + 'px' : ''">
                <div class="px-4 pt-2 pb-4 md:px-8">
                  <ul>
                    <li class="flex mb-4">
                      <x-svg-icon-pdf />
                      <a href="/storage/downloads/Pedoman Kerja dan Kode Etik Direksi dan Dewan Komisaris.pdf"
                        target="_blank" class="text-blue hover:underline"><span>Pedoman Kerja dan Kode Etik Direksi dan
                          Dewan Komisaris.pdf</span>&nbsp;&nbsp;<span
                          class="material-icons text-sm text-gray-500">open_in_new</span></a>
                    </li>
                  </ul>
                </div>
              </div>
            </li>

            <li class="relative rounded-md" :class="selected == 3 ? 'bg-indigo-50' : ''">
              <button type="button" class="w-full px-4 py-4 md:px-8 md:py-6 text-left focus:outline-none"
                @click="selected !== 3 ? selected = 3 : selected = null">
                <div class="flex items-center justify-between">
                  <span class="font-bold text-base lg:text-lg">Risk Management</span>
                  <span class="material-icons transition transform"
                    :class="selected == 3 ? 'rotate-180' : ''">expand_more</span>
                </div>
              </button>
              <div class="relative overflow-hidden transition-all max-h-0 duration-700" x-ref="container3"
                x-bind:style="selected == 3 ? 'max-height: ' + $refs.container3.scrollHeight + 'px' : ''">
                <div class="px-4 pt-2 pb-4 md:px-8">
                  <ul>
                    <li class="flex mb-4">
                      <x-svg-icon-pdf />
                      <a href="/storage/downloads/Fungsi & Kebijakan Manajemen Risiko.pdf" target="_blank"
                        class="text-blue hover:underline"><span>Fungsi & Kebijakan Manajemen
                          Risiko.pdf</span>&nbsp;&nbsp;<span
                          class="material-icons text-sm text-gray-500">open_in_new</span></a>
                    </li>
                  </ul>
                </div>
              </div>
            </li>

            <li class="relative rounded-md" :class="selected == 4 ? 'bg-indigo-50' : ''">
              <button type="button" class="w-full px-4 py-4 md:px-8 md:py-6 text-left focus:outline-none"
                @click="selected !== 4 ? selected = 4 : selected = null">
                <div class="flex items-center justify-between">
                  <span class="font-bold text-base lg:text-lg">Compliance & Audit</span>
                  <span class="material-icons transition transform"
                    :class="selected == 4 ? 'rotate-180' : ''">expand_more</span>
                </div>
              </button>
              <div class="relative overflow-hidden transition-all max-h-0 duration-700" x-ref="container4"
                x-bind:style="selected == 4 ? 'max-height: ' + $refs.container4.scrollHeight + 'px' : ''">
                <div class="px-4 pt-2 pb-4 md:px-8">
                  <ul>
                    <li class="flex mb-4">
                      <x-svg-icon-pdf />
                      <a href="/storage/downloads/Fungsi & Kebijakan Kepatuhan & Audit Internal.pdf" target="_blank"
                        class="text-blue hover:underline"><span>Fungsi & Kebijakan Kepatuhan & Audit
                          Internal.pdf</span>&nbsp;&nbsp;<span
                          class="material-icons text-sm text-gray-500">open_in_new</span></a>
                    </li>
                  </ul>
                </div>
              </div>
            </li>

            <li class="relative rounded-md" :class="selected == 5 ? 'bg-indigo-50' : ''">
              <button type="button" class="w-full px-4 py-4 md:px-8 md:py-6 text-left focus:outline-none"
                @click="selected !== 5 ? selected = 5 : selected = null">
                <div class="flex items-center justify-between">
                  <span class="font-bold text-base lg:text-lg">Whistleblowing System</span>
                  <span class="material-icons transition transform"
                    :class="selected == 5 ? 'rotate-180' : ''">expand_more</span>
                </div>
              </button>
              <div class="relative overflow-hidden transition-all max-h-0 duration-700" x-ref="container5"
                x-bind:style="selected == 5 ? 'max-height: ' + $refs.container5.scrollHeight + 'px' : ''">
                <div class="px-4 pt-2 pb-4 md:px-8">
                  <ul>
                    <li class="flex mb-4">
                      <x-svg-icon-pdf />
                      <a href="/storage/downloads/Sistem Pelaporan Pelanggaran - WHISTLEBLOWING.pdf" target="_blank"
                        class="text-blue hover:underline"><span>Sistem Pelaporan Pelanggaran -
                          WHISTLEBLOWING.pdf</span>&nbsp;&nbsp;<span
                          class="material-icons text-sm text-gray-500">open_in_new</span></a>
                    </li>
                  </ul>
                </div>
              </div>
            </li>

            <li class="relative rounded-md" :class="selected == 6 ? 'bg-indigo-50' : ''">
              <button type="button" class="w-full px-4 py-4 md:px-8 md:py-6 text-left focus:outline-none"
                @click="selected !== 6 ? selected = 6 : selected = null">
                <div class="flex items-center justify-between">
                  <span class="font-bold text-base lg:text-lg">Financial Statements</span>
                  <span class="material-icons transition transform"
                    :class="selected == 6 ? 'rotate-180' : ''">expand_more</span>
                </div>
              </button>
              <div class="relative overflow-hidden transition-all max-h-0 duration-700" x-ref="container6"
                x-bind:style="selected == 6 ? 'max-height: ' + $refs.container6.scrollHeight + 'px' : ''">
                <div class="px-4 pt-2 pb-4 md:px-8">
                  <ul>
                    <li class="flex mb-4">
                      <x-svg-icon-pdf />
                      <a href="/storage/downloads/Laporan Keuangan Tengah Tahunan - Induk 2019.pdf" target="_blank"
                        class="text-blue hover:underline"><span>Laporan Keuangan Tengah Tahunan - Induk
                          2019.pdf</span>&nbsp;&nbsp;<span
                          class="material-icons text-sm text-gray-500">open_in_new</span></a>
                    </li>
                    <li class="flex mb-4">
                      <x-svg-icon-pdf />
                      <a href="/storage/downloads/Laporan Keuangan Audited 2018.pdf" target="_blank"
                        class="text-blue hover:underline"><span>Laporan Keuangan Audited
                          2018.pdf</span>&nbsp;&nbsp;<span
                          class="material-icons text-sm text-gray-500">open_in_new</span></a>
                    </li>
                    <li class="flex mb-4">
                      <x-svg-icon-pdf />
                      <a href="/storage/downloads/Laporan Keuangan Audited 2017.pdf" target="_blank"
                        class="text-blue hover:underline"><span>Laporan Keuangan Audited
                          2017.pdf</span>&nbsp;&nbsp;<span
                          class="material-icons text-sm text-gray-500">open_in_new</span></a>
                    </li>
                  </ul>
                </div>
              </div>
            </li>

            <li class="relative rounded-md" :class="selected == 7 ? 'bg-indigo-50' : ''">
              <button type="button" class="w-full px-4 py-4 md:px-8 md:py-6 text-left focus:outline-none"
                @click="selected !== 7 ? selected = 7 : selected = null">
                <div class="flex items-center justify-between">
                  <span class="font-bold text-base lg:text-lg">RUPS Decision</span>
                  <span class="material-icons transition transform"
                    :class="selected == 7 ? 'rotate-180' : ''">expand_more</span>
                </div>
              </button>
              <div class="relative overflow-hidden transition-all max-h-0 duration-700" x-ref="container7"
                x-bind:style="selected == 7 ? 'max-height: ' + $refs.container7.scrollHeight + 'px' : ''">
                <div class="px-4 pt-2 pb-4 md:px-8">
                  <ul>
                    <li class="flex mb-4">
                      <x-svg-icon-pdf />
                      <a href="/storage/downloads/Hasil RUPS 2019.pdf" target="_blank"
                        class="text-blue hover:underline"><span>Hasil RUPS 2019.pdf</span>&nbsp;&nbsp;<span
                          class="material-icons text-sm text-gray-500">open_in_new</span></a>
                    </li>
                  </ul>
                </div>
              </div>
            </li>

          </ul>
        </div>

      </div>


    </div>
  </section>

</x-web-layout>