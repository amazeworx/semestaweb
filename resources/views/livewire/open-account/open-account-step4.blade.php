<div class="bg-white shadow">

  <div class="flex flex-wrap px-4 py-6 lg:flex-nowrap lg:gap-6 lg:px-8 lg:py-11 border-b border-gray-200">

    <div class="w-full lg:w-1/4">
      <h3 class="text-xl font-bold mb-4">Uploads</h3>
    </div>

    <div class="w-full grid grid-cols-1 gap-6 lg:w-3/4">
      <div class="flex flex-wrap gap-y-6 md:flex-nowrap md:gap-x-6">
        <div class="w-full md:w-1/2">
          @if ($idType == 'KTP')
          <label class="form-label">Upload KTP <span class="form-required">*</span></label>
          <x-filepond wire:model="uploadKtp" />

          @error('uploadKtp')
          <div class="form-validation-error"><small>{{ $message }}</small></div>
          @enderror

          @elseif ($idType == 'Paspor')
          <label class="form-label">Upload Paspor <span class="form-required">*</span></label>
          <x-filepond wire:model="uploadPassport" />

          @error('uploadPassport')
          <div class="form-validation-error"><small>{{ $message }}</small></div>
          @enderror
          @endif
        </div>

        @if ($hasNPWP != '1')
        <div class="w-full md:w-1/2">
          <label class="form-label">Upload NPWP <span class="form-required">*</span></label>
          <x-filepond wire:model="uploadNpwp" />

          @error('uploadNpwp')
          <div class="form-validation-error"><small>{{ $message }}</small></div>
          @enderror
        </div>
        @endif

      </div>
    </div>

  </div>

  <div class="flex flex-wrap px-4 py-6 lg:flex-nowrap lg:gap-6 lg:px-8 lg:py-11 border-b border-gray-200">

    <div class="w-full lg:w-1/4">
      <h3 class="text-xl font-bold mb-4">Persyaratan & Ketentuan</h3>
    </div>

    <div class="w-full grid grid-cols-1 gap-6 lg:w-3/4">

      <div class="w-full">
        <label class="form-label">Pernyataan Pembukaan Rekening Efek <span class="form-required">*</span></label>
        <x-statement.securities />
        <div class="form-check mt-2 inline-flex">
          <input wire:model="applicationTerm" type="checkbox" id="applicationTerm" class="form-check-input">
          <label class="form-check-label inline-block ml-2" for="applicationTerm">
            Saya dengan ini menyatakan telah membaca, memahami, dan menyetujui isi Pernyataan tersebut di atas.
          </label>
        </div>
        @error('applicationTerm')
        <div class="form-validation-error"><small>{{ $message }}</small></div>
        @enderror
      </div>

      <div class="w-full">
        <label class="form-label">Pernyataan Nasabah RDN BCA <span class="form-required">*</span></label>
        <x-statement.bca />
        <div class="form-check mt-2 inline-flex">
          <input wire:model="bcaTerm" type="checkbox" id="bcaTerm" class="form-check-input">
          <label class="form-check-label inline-block ml-2" for="bcaTerm">
            Saya dengan ini menyatakan telah membaca, memahami, dan menyetujui isi Pernyataan tersebut di atas.
          </label>
        </div>
        @error('bcaTerm')
        <div class="form-validation-error"><small>{{ $message }}</small></div>
        @enderror
      </div>

    </div>

  </div>

  {{-- <div class="flex flex-wrap px-4 py-6 lg:flex-nowrap lg:gap-6 lg:px-8 lg:py-11 border-b border-gray-200">

    <div class="w-full lg:w-1/4">
      <h3 class="text-xl font-bold mb-4">Tanda Tangan Anda</h3>
    </div>

    <div class="w-full grid grid-cols-1 gap-6 lg:w-3/4">
      <div class="flex flex-wrap gap-y-6 md:flex-nowrap md:gap-x-4">
        <div class="w-full">
          <label class="form-label">Tanda Tangan <span class="form-required">*</span></label>
          <div class="text-sm text-gray-500 italic leading-tight mt-1 mb-2">Harap tanda tangan formulir registrasi di
            tengah kotak dan
            jangan melewati garis lalu
            tekan tombol simpan.</div>
          <x-signature wire:model="uploadSignature" />
          @error('uploadSignature')
          <div class="form-validation-error"><small>{{ $message }}</small>
</div>
@enderror
</div>
</div>
</div>

</div> --}}

</div>