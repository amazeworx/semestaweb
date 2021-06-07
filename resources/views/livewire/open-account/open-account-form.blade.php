<div class="bg-gray-50 min-h-screen border-t border-gray-200 py-10 md:px-4 lg:px-6 lg:py-16 xl:py-24">
  <div class="max-w-5xl mx-auto">
    <div class="px-4">
      <h1 class="text-center text-3xl leading-tight font-display font-bold text-blue mb-2 lg:text-4xl">Form Pembukaan
        Rekening</h1>
      <h2 class="text-center text-xl font-bold text-gray-500 mb-8 lg:text-2xl lg:mb-8">PT Semesta Indovest Sekuritas
      </h2>
    </div>

    <div class="open-account flex flex-col flex-wrap">
      <div class="form-progress sticky top-0 w-full shadow bg-white z-30">
        <div class="flex justify-center">
          <div class="tab active">
            <div class="tab-label"><span class="tab-number">{{ ($currentStep !== 1) ? '✓' : '1' }}</span>
              <span class="tab-text">Identitas</span></div>
          </div>
          <div class="tab {{ $currentStep !== 1 ? 'active' : '' }}">
            <div class="tab-label"><span
                class="tab-number">{{ ($currentStep === 1 || $currentStep === 2) ? '2' : '✓' }}</span>
              <span class="tab-text">Pekerjaan & Keuangan</span></div>
          </div>
          <div class="tab {{ ($currentStep !== 1 && $currentStep !== 2) ? 'active' : '' }}">
            <div class="tab-label"><span
                class="tab-number">{{ ($currentStep === 1 || $currentStep === 2 || $currentStep === 3) ? '3' : '✓' }}</span>
              <span class="tab-text">Pasangan/Orang Tua</span></div>
          </div>
          <div class="tab {{ ($currentStep !== 1 && $currentStep !== 2 && $currentStep !== 3) ? 'active' : '' }}">
            <div class="tab-label"><span class="tab-number">{{ ($currentStep !== 5) ? '4' : '✓' }}</span>
              <span class="tab-text">Syarat & Ketentuan</span></div>
          </div>
        </div>
        <div wire:loading.delay.class.remove="opacity-0" class="progress opacity-0 -mt-1 transition-opacity">
          <div class="indeterminate"></div>
        </div>
      </div>
      <form wire:submit.prevent="submit" class="relative">
        {{-- <div wire:loading.delay.class.remove="hidden" class="hidden absolute inset-0 bg-white bg-opacity-50 z-10"></div> --}}

        <div id="step-1" class="{{ $currentStep !== 1 ? 'hidden' : '' }}">
          @include("livewire.open-account.open-account-step1")
        </div>

        <div id="step-2" class="{{ $currentStep !== 2 ? 'hidden' : '' }}">
          @include("livewire.open-account.open-account-step2")
        </div>

        <div id="step-3" class="{{ $currentStep !== 3 ? 'hidden' : '' }}">
          @include("livewire.open-account.open-account-step3")
        </div>

        <div id="step-4" class="{{ $currentStep !== 4 ? 'hidden' : '' }}">
          @include("livewire.open-account.open-account-step4")
        </div>

        <div id="step-5" class="{{ $currentStep !== 5 ? 'hidden' : '' }}">
          <div class="grid grid-cols-1 gap-6 bg-white p-10 border">
            <div class="flex flex-col justify-center text-center mx-auto max-w-md">
              <h3 class="text-3xl font-bold">Congratulations!</h3>
              <lottie-player class="mx-auto my-6 w-40 h-40" src="/images/lottie-success.json" background="transparent"
                speed="1" loop autoplay>
              </lottie-player>
              <p>Selamat! Aplikasi pembukaan rekening Anda sudah lengkap dan akan segera diproses. Terima kasih!</p>
            </div>
          </div>
        </div>

        @if($currentStep != 5)
        <div class="flex gap-4 mt-8 justify-center">

          {{-- <button type="button"
            class="flex items-center px-4 py-2 border rounded text-sm font-bold uppercase bg-white border-orange text-orange focus:outline-none transition ease-in-out duration-150">
            <svg class="fill-current text-orange mr-2" height="14px" width="14px" viewBox="0 0 512 512"
              xmlns="http://www.w3.org/2000/svg">
              <path
                d="m453.332031 512h-394.664062c-32.363281 0-58.667969-26.304688-58.667969-58.667969v-394.664062c0-32.363281 26.304688-58.667969 58.667969-58.667969h330.835937c21.054688 0 41.683594 8.535156 56.554688 23.445312l42.496094 42.496094c15.125 15.125 23.445312 35.222656 23.445312 56.574219v330.816406c0 32.363281-26.304688 58.667969-58.667969 58.667969zm-394.664062-480c-14.699219 0-26.667969 11.96875-26.667969 26.667969v394.664062c0 14.699219 11.96875 26.667969 26.667969 26.667969h394.664062c14.699219 0 26.667969-11.96875 26.667969-26.667969v-330.816406c0-12.820313-4.992188-24.871094-14.058594-33.941406l-42.496094-42.496094c-8.9375-8.957031-21.289062-14.078125-33.941406-14.078125zm0 0" />
              <path
                d="m325.332031 149.332031h-224c-8.832031 0-16-7.167969-16-16v-117.332031c0-8.832031 7.167969-16 16-16s16 7.167969 16 16v101.332031h192v-101.332031c0-8.832031 7.167969-16 16-16s16 7.167969 16 16v117.332031c0 8.832031-7.167969 16-16 16zm0 0" />
              <path
                d="m256 416c-52.929688 0-96-43.070312-96-96s43.070312-96 96-96 96 43.070312 96 96-43.070312 96-96 96zm0-160c-35.285156 0-64 28.714844-64 64s28.714844 64 64 64 64-28.714844 64-64-28.714844-64-64-64zm0 0" />
            </svg>
            <span class="">Simpan Draft</span>
          </button> --}}

          @if($currentStep > 1)
          <button type="button" wire:click="back({{ $currentStep - 1 }})" wire:loading.attr="disabled" x-data
            x-on:click="window.scrollTo(0, 0)"
            class="px-4 py-2 border rounded text-sm font-bold uppercase bg-orange border-orange text-white hover:bg-orange-light hover:border-orange-light focus:outline-none transition ease-in-out duration-150">⟵
            Kembali</button>
          @endif

          <button type="button" wire:click="submit({{ $currentStep }})" wire:loading.attr="disabled" x-data
            x-on:click="window.scrollTo(0, 0)"
            class="px-4 py-2 border rounded text-sm font-bold uppercase bg-orange border-orange text-white hover:bg-orange-light hover:border-orange-light focus:outline-none transition ease-in-out duration-150">{{ $currentStep !== 4 ? 'Berikutnya' : 'Submit' }}
            ⟶</button>

        </div>
        @endif

      </form>
    </div>

  </div>
</div>