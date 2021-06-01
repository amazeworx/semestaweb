<div class="bg-white shadow">
  <div class="px-4 py-4 border-b border-gray-200">
    <p class="text-sm text-gray-500 italic text-center font-bold">Wajib diisi jika telah menikah atau masih sebagai
      mahasiswa/i
    </p>
  </div>
  {{-- Identitas --}}
  <div class="flex flex-wrap px-4 py-6 lg:flex-nowrap lg:gap-6 lg:px-8 lg:py-11 border-b border-gray-200">

    <div class="w-full lg:w-1/4">
      <h3 class="text-xl font-bold mb-2 tracking-tight">
        Identitas
        @if ($familyRelation == 'Suami' || $familyRelation == 'Istri')
        Pasangan
        @elseif ($familyRelation == 'Ayah' || $familyRelation == 'Ibu')
        Orang Tua
        @else
        Pasangan / Orang Tua
        @endif
      </h3>
    </div>

    <div class="w-full grid grid-cols-1 gap-6 lg:w-3/4">
      <div class="flex flex-wrap gap-y-6 md:flex-nowrap md:gap-x-4">
        <div class="w-full md:w-1/2">
          <label class="form-label">Nama sesuai identitas <span class="form-required">*</span></label>
          <input type="text" wire:model.lazy="familyName" placeholder="Isi nama lengkap sesuai identitas">
          @error('familyName')
          <div class="form-validation-error"><small>{{ $message }}</small></div>
          @enderror
        </div>
        <div class="w-full md:w-1/4">
          <label class="form-label">Hubungan <span class="form-required">*</span></label>
          <select wire:model="familyRelation">
            <option value="" disabled>-- Pilih --</option>
            <option value="Suami">Suami</option>
            <option value="Istri">Istri</option>
            <option value="Ayah">Ayah</option>
            <option value="Ibu">Ibu</option>
          </select>
          @error('familyRelation')
          <div class="form-validation-error"><small>{{ $message }}</small></div>
          @enderror
        </div>
        <div class="w-full md:w-1/4">
          <label class="form-label">Kewarganegaraan <span class="form-required">*</span></label>
          <div wire:ignore>
            <select id="familyNationality">
              <option></option>
              @foreach ($countries as $country)
              <option value="{{ $country->nationality }}"
                {{ $country->nationality === 'INDONESIAN' ? 'selected' : '' }}>
                {{ $country->nationality }}</option>
              @endforeach
            </select>
          </div>
          @error('familyNationality')
          <div class="form-validation-error"><small>{{ $message }}</small></div>
          @enderror
        </div>
      </div>

      <div class="flex flex-wrap gap-y-2 md:flex-nowrap md:gap-x-4">
        <div class="w-full md:w-2/12">
          <label class="form-label">Jenis Kartu ID <span class="form-required">*</span></label>
          <select wire:model="familyIdType" class="mb-1">
            <option value="" disabled>-- Pilih Identitas --</option>
            <option value="KTP">KTP</option>
            <option value="Paspor">Paspor</option>
          </select>
          @error('familyIdType')
          <div class="form-validation-error"><small>{{ $message }}</small></div>
          @enderror
        </div>

        <div class="w-full flex flex-wrap gap-y-2 md:flex-nowrap md:w-10/12 md:gap-x-4">
          @if ($familyIdType === 'KTP')
          <div class="w-full md:w-1/2">
            <label class="form-label">Nomor KTP (NIK) <span class="form-required">*</span></label>
            <input type="text" wire:model.lazy="familyKtpNumber" placeholder="Isi NIK KTP">
            @error('familyKtpNumber')
            <div class="form-validation-error"><small>{{ $message }}</small></div>
            @enderror
          </div>
          <div class="w-full md:w-1/2">
            <label class="form-label">Berlaku s/d <span class="form-required">*</span></label>
            <div class="flex flex-nowrap gap-2">
              <select wire:model="familyKtpExpiredDay" class="mb-1" {{ $familyKtpExpiredLifetime ? 'disabled' : '' }}>
                <option value="">Tgl</option>
                @for ($i = 1; $i <= 31; $i++) <option value="{{ $i }}">{{ $i }}</option>
                  @endfor
              </select>
              <select wire:model="familyKtpExpiredMonth" class="mb-1" {{ $familyKtpExpiredLifetime ? 'disabled' : '' }}>
                <option value="">Bln</option>
                @for ($i = 1; $i <= 12; $i++) <option value="{{ $i }}">{{ $i }}</option>
                  @endfor
              </select>
              <select wire:model="familyKtpExpiredYear" class="mb-1" {{ $familyKtpExpiredLifetime ? 'disabled' : '' }}>
                <option value="">Thn</option>
                @for ($i = date("Y"); $i <= (date("Y") + 10); $i++) <option value="{{ $i }}">{{ $i }}</option>
                  @endfor
              </select>
            </div>

            <div>
              <div class="form-check mt-1 inline-flex">
                <input id="familyKtpExpiredLifetime" wire:model="familyKtpExpiredLifetime" type="checkbox"
                  class="form-check-input">
                <label class="form-check-label inline-block ml-2" for="familyKtpExpiredLifetime">Seumur Hidup</label>
              </div>
            </div>
            @error('familyKtpExpiredDay')
            <div class="form-validation-error"><small>{{ $message }}</small></div>
            @enderror
            @error('familyKtpExpiredMonth')
            <div class="form-validation-error"><small>{{ $message }}</small></div>
            @enderror
            @error('familyKtpExpiredYear')
            <div class="form-validation-error"><small>{{ $message }}</small></div>
            @enderror
          </div>
          @endif

          @if ($familyIdType === 'Paspor')
          <div class="w-full md:w-1/2">
            <label class="form-label">Nomor Paspor <span class="form-required">*</span></label>
            <input type="text" wire:model.lazy="familyPassportNumber" placeholder="Isi nomor paspor">
            @error('familyPassportNumber')
            <div class="form-validation-error"><small>{{ $message }}</small></div>
            @enderror
          </div>
          <div class="w-full md:w-1/2">
            <label class="form-label">Berlaku s/d <span class="form-required">*</span></label>
            <div class="flex flex-nowrap gap-2">
              <select wire:model="familyPassportExpiredDay" class="mb-1">
                <option value="">Tgl</option>
                @for ($i = 1; $i <= 31; $i++) <option value="{{ $i }}">{{ $i }}</option>
                  @endfor
              </select>
              <select wire:model="familyPassportExpiredMonth" class="mb-1">
                <option value="">Bln</option>
                @for ($i = 1; $i <= 12; $i++) <option value="{{ $i }}">{{ $i }}</option>
                  @endfor
              </select>
              <select wire:model="familyPassportExpiredYear" class="mb-1">
                <option value="">Thn</option>
                @for ($i = date("Y"); $i <= (date("Y") + 10); $i++) <option value="{{ $i }}">{{ $i }}</option>
                  @endfor
              </select>
            </div>
            @error('familyPassportExpiredDay')
            <div class="form-validation-error"><small>{{ $message }}</small></div>
            @enderror
            @error('familyPassportExpiredMonth')
            <div class="form-validation-error"><small>{{ $message }}</small></div>
            @enderror
            @error('familyPassportExpiredYear')
            <div class="form-validation-error"><small>{{ $message }}</small></div>
            @enderror
          </div>
          @endif
        </div>
      </div>

    </div>

  </div>

  {{-- Data Pekerjaan --}}
  <div class="flex flex-wrap px-4 py-6 lg:flex-nowrap lg:gap-6 lg:px-8 lg:py-11 border-b border-gray-200">

    <div class="w-full lg:w-1/4">
      <h3 class="text-xl font-bold mb-4">
        Pekerjaan
        @if ($familyRelation == 'Suami' || $familyRelation == 'Istri')
        Pasangan
        @elseif ($familyRelation == 'Ayah' || $familyRelation == 'Ibu')
        Orang Tua
        @else
        Pasangan / Orang Tua
        @endif
      </h3>
    </div>

    <div class="w-full grid grid-cols-1 gap-6 lg:w-3/4">
      <div class="flex flex-wrap gap-y-6 md:flex-nowrap md:gap-x-4">
        <div class="w-full md:w-1/3">
          <label class="form-label">Pekerjaan <span class="form-required">*</span></label>
          <select wire:model="familyOccupation" class="mb-1">
            <option value="" disabled>-- Pilih --</option>
            @foreach ($familyOccupations as $occupation)
            <option value="{{ $occupation->id }}">
              {{ $occupation->name }}</option>
            @endforeach
          </select>

          @error('familyOccupation')
          <div class="form-validation-error"><small>{{ $message }}</small></div>
          @enderror

          @if ($familyOccupationIsOther)
          <input type="text" wire:model.lazy="familyOccupationText" placeholder="Isi Pekerjaan Anda">
          @endif

          @error('familyOccupationText')
          <div class="form-validation-error"><small>{{ $message }}</small></div>
          @enderror
        </div>
        <div class="w-full md:w-1/3">
          <label class="form-label">Jabatan/Pangkat <span class="form-required">*</span></label>

          @if (!$familyJobPositionIsText)
          <select wire:model="familyJobPosition" class="mb-1">
            <option value="" disabled>-- Pilih --</option>
            @foreach ($familyJobPositions as $position)
            <option value="{{ $position->id }}">{{ $position->name }}
            </option>
            @endforeach
          </select>
          @endif

          @error('familyJobPosition')
          <div class="form-validation-error"><small>{{ $message }}</small></div>
          @enderror

          @if ($familyJobPositionIsText || $familyJobPositionIsOther)
          <input type="text" wire:model.lazy="familyJobPositionText" placeholder="Isi Jabatan/Pangkat Anda">
          @endif

          @error('familyJobPositionText')
          <div class="form-validation-error"><small>{{ $message }}</small></div>
          @enderror
        </div>
        <div class="w-full md:w-1/3">
          <label class="form-label">Bidang Usaha <span class="form-required">*</span></label>
          @if (!$familyBusinessFieldIsText)
          <select wire:model="familyBusinessField" class="mb-1">
            <option value="" disabled>-- Pilih --</option>
            @foreach ($familyBusinessFields as $business)
            <option value="{{ $business->id }}">{{ $business->name }}</option>
            @endforeach
          </select>
          @endif
          @error('familyBusinessFieldIsText')
          <div class="form-validation-error"><small>{{ $message }}</small></div>
          @enderror
          @if ($familyBusinessFieldIsText || $familyBusinessFieldIsOther)
          <input type="text" wire:model.lazy="familyBusinessFieldText" placeholder="Isi Bidang Usaha Pekerjaan Anda">
          @endif
          @error('familyBusinessFieldText')
          <div class="form-validation-error"><small>{{ $message }}</small></div>
          @enderror
        </div>
      </div>

      <div class="flex flex-wrap gap-y-2">
        <div class="w-full">
          <label class="form-label">Nama Perusahaan/Kantor <span class="form-required">*</span></label>
          <input type="text" wire:model.lazy="familyCompanyName"
            placeholder="Isi Nama Perusahaan/Kantor Pasangan/Orang Tua">
          @error('familyCompanyName')
          <div class="form-validation-error"><small>{{ $message }}</small></div>
          @enderror
        </div>

        <div class="w-full flex flex-wrap gap-y-2">
          <div class="w-full grid grid-cols-1 md:grid-cols-3 gap-x-4 gap-y-2">
            <div class="w-full md:col-span-full">
              <label class="form-label">Alamat Kantor <span class="form-required">*</span></label>
              <input type="text" wire:model.lazy="familyCompanyAddress" placeholder="Cth: Jl Buncit Persada No 1">
              @error('familyCompanyAddress')
              <div class="form-validation-error"><small>{{ $message }}</small></div>
              @enderror
            </div>
            <div class="w-full">
              <label class="form-label">Negara <span class="form-required">*</span></label>
              <div wire:ignore>
                <select id="familyCompanyCountry">
                  <option></option>
                  @foreach ($countries as $country)
                  <option value="{{ $country->name }}" {{ $country->name === 'INDONESIA' ? 'selected' : '' }}>
                    {{ $country->name }}</option>
                  @endforeach
                </select>
              </div>
              @error('familyCompanyCountry')
              <div class="form-validation-error"><small>{{ $message }}</small></div>
              @enderror
            </div>
            <div class="w-full">
              <label class="form-label">Kota <span class="form-required">*</span></label>
              @if ($familyCompanyCountry === 'INDONESIA')
              <div wire:ignore>
                <select id="familyCompanyCity" class="mb-1">
                  <option></option>
                  @foreach ($familyCompanyCities as $city)
                  <option value="{{ $city->ksei_name }}" {{ $city->ksei_name === 'JAKARTA' ? 'selected' : '' }}>
                    {{ $city->ksei_name }}</option>
                  @endforeach
                </select>
              </div>
              @error('familyCompanyCity')
              <div class="form-validation-error"><small>{{ $message }}</small></div>
              @enderror
              @else
              <input type="text" wire:model.lazy="familyCompanyCityText" placeholder="Nama Kota">
              @error('familyCompanyCityText')
              <div class="form-validation-error"><small>{{ $message }}</small></div>
              @enderror
              @endif
            </div>
            <div class="w-full">
              <label class="form-label">Kode Pos <span class="form-required">*</span></label>
              <input type="text" wire:model.lazy="familyCompanyZip" placeholder="Cth: 11250">
              @error('familyCompanyZip')
              <div class="form-validation-error"><small>{{ $message }}</small></div>
              @enderror
            </div>
          </div>
          <div class="w-full grid grid-cols-1 md:grid-cols-2 gap-x-4 gap-y-2">

            <div class="w-full">
              <div>
                <label class="form-label">Nomor Telepon Kantor</label>
                <div wire:ignore>
                  <input id="familyCompanyPhoneNumber" type="tel" placeholder="21567890" class="mt-1">
                  @error('familyCompanyPhoneNumber')
                  <div class="form-validation-error"><small>{{ $message }}</small></div>
                  @enderror
                </div>
              </div>
            </div>

            <div class="w-full">
              <div>
                <label class="form-label">Nomor Faksimili</label>

                <div wire:ignore>
                  <input id="familyCompanyFaxNumber" type="tel" placeholder="21567890" class="mt-1">
                  @error('familyCompanyFaxNumber')
                  <div class="form-validation-error"><small>{{ $message }}</small></div>
                  @enderror
                </div>
              </div>
            </div>

          </div>
          <div class="w-full grid grid-cols-1 md:grid-cols-3 gap-x-4 gap-y-2">
            <div class="w-full col-span-2">
              <label class="form-label">Email Kantor</label>
              <input type="text" wire:model.lazy="familyCompanyEmail" placeholder="Isi alamat email kantor Anda">
              @error('familyCompanyEmail')
              <div class="form-validation-error"><small>{{ $message }}</small></div>
              @enderror
            </div>
            <div class="w-full">
              <label class="form-label">Lama Bekerja/Usaha</label>
              <div class="flex flex-nowrap gap-2">
                <select wire:model="familyWorkYear" class="mb-1">
                  <option value="" disabled>Tahun</option>
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                  <option value="5">5</option>
                  <option value="6">6</option>
                  <option value="7">7</option>
                  <option value="8">8</option>
                  <option value="9">9</option>
                  <option value="10">10</option>
                  <option value="11">11</option>
                  <option value="12">12</option>
                  <option value="13">13</option>
                  <option value="14">14</option>
                  <option value="15">15</option>
                  <option value=">15">>15</option>
                </select>
                <select wire:model="familyWorkMonth" class="mb-1">
                  <option value="" disabled>Bulan</option>
                  @for ($i = 1; $i <= 11; $i++) <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                </select>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>

  </div>

  {{-- Data Keuangan --}}
  <div class="flex flex-wrap px-4 py-6 lg:flex-nowrap lg:gap-6 lg:px-8 lg:py-11 border-b border-gray-200">
    <div class="w-full lg:w-1/4">
      <h3 class="text-xl font-bold mb-4">
        Data Keuangan
        @if ($familyRelation == 'Suami' || $familyRelation == 'Istri')
        Pasangan
        @elseif ($familyRelation == 'Ayah' || $familyRelation == 'Ibu')
        Orang Tua
        @else
        Pasangan / Orang Tua
        @endif
      </h3>
    </div>
    <div class="w-full grid grid-cols-1 gap-6 lg:w-3/4">
      <div class="grid grid-cols-1 gap-y-6 md:grid-cols-2 md:gap-x-4">
        <div class="w-full">
          <label class="form-label">Penghasilan Utama/Kotor/thn <span class="form-required">*</span></label>
          <select wire:model="familyIncomeYearly" class="mb-1">
            <option value="" disabled>-- Pilih --</option>
            <option value="1">
              < 10 Juta</option> <option value="2">10-50 Juta
            </option>
            <option value="3">50 - 100 Juta</option>
            <option value="4">100 - 500 Juta</option>
            <option value="5">500 Juta - 1 Miliar</option>
            <option value="6">> 1 Miliar</option>
          </select>
          @error('familyIncomeYearly')
          <div class="form-validation-error"><small>{{ $message }}</small></div>
          @enderror
        </div>
        <div class="w-full">
          <label class="form-label">Sumber Penghasilan Utama <span class="form-required">*</span></label>

          <select wire:model="familyIncomeSource" class="mb-1">
            <option value="" disabled>-- Pilih --</option>
            <option value="2">Gaji</option>
            <option value="3">Hasil Usaha</option>
            <option value="4">Bunga</option>
            <option value="5">Warisan</option>
            <option value="6">Orang Tua/Anak</option>
            <option value="7">Suami/Istri</option>
            <option value="8">Dana Pensiun</option>
            <option value="9">Lotere</option>
            <option value="10">Hasil Investasi</option>
            <option value="11">Deposito</option>
            <option value="12">Capital</option>
            <option value="13">Pinjaman</option>
            <option value="1">Lainnya</option>
          </select>

          @error('familyIncomeSource')
          <div class="form-validation-error"><small>{{ $message }}</small></div>
          @enderror

          @if ($familyIncomeSource == 1)
          <input type="text" wire:model.lazy="familyIncomeSourceText" placeholder="Isi Sumber Penghasilan Utama Anda *">
          @endif
          @error('familyIncomeSourceText')
          <div class="form-validation-error"><small>{{ $message }}</small></div>
          @enderror
        </div>
        <div class="w-full">
          <label class="form-label">Penghasilan Tambahan/Kotor/thn</label>
          <select wire:model="familyExtraIncomeYearly" class="mb-1">
            <option value="" disabled>-- Pilih --</option>
            <option value="1">
              < 10 Juta</option> <option value="2">10-50 Juta
            </option>
            <option value="3">50 - 100 Juta</option>
            <option value="4">100 - 500 Juta</option>
            <option value="5">500 Juta - 1 Miliar</option>
            <option value="6">> 1 Miliar</option>
          </select>
          @error('familyExtraIncomeYearly')
          <div class="form-validation-error"><small>{{ $message }}</small></div>
          @enderror
        </div>
        <div class="w-full">
          <label class="form-label">Sumber Penghasilan Tambahan</label>
          <select wire:model="familyExtraIncomeSource" class="mb-1">
            <option value="" disabled>-- Pilih --</option>
            <option value="2">Gaji</option>
            <option value="3">Hasil Usaha</option>
            <option value="4">Bunga</option>
            <option value="5">Warisan</option>
            <option value="6">Orang Tua/Anak</option>
            <option value="7">Suami/Istri</option>
            <option value="8">Dana Pensiun</option>
            <option value="9">Lotere</option>
            <option value="10">Hasil Investasi</option>
            <option value="11">Deposito</option>
            <option value="12">Capital</option>
            <option value="13">Pinjaman</option>
            <option value="1">Lainnya</option>
          </select>

          @error('familyExtraIncomeSource')
          <div class="form-validation-error"><small>{{ $message }}</small></div>
          @enderror

          @if ($familyExtraIncomeSource == 1)
          <input type="text" wire:model.lazy="familyExtraIncomeSourceText"
            placeholder="Isi Sumber Penghasilan Tambahan Anda">
          @endif
          @error('familyExtraIncomeSourceText')
          <div class="form-validation-error"><small>{{ $message }}</small></div>
          @enderror
        </div>
      </div>
    </div>
  </div>

</div>

<script>
  $(document).ready(function() {
    $('#familyNationality').select2({
      placeholder: "-- Pilih --",
    });
    $('#familyNationality').on('change', function (e) {
      @this.set('familyNationality', e.target.value);
    });
    $('#familyCompanyCountry').select2({
      placeholder: "-- Pilih --",
    });
    $('#familyCompanyCountry').on('change', function (e) {
      @this.set('familyCompanyCountry', e.target.value);
    });
    $('#familyCompanyCity').select2({
      placeholder: "-- Pilih --",
    });
    $('#familyCompanyCity').on('change', function (e) {
      @this.set('familyCompanyCity', e.target.value);
    });

    const familyCompanyPhoneInput = window.intlTelInput(document.querySelector("#familyCompanyPhoneNumber"), {
      initialCountry: "id",
      separateDialCode: true,
      preferredCountries: ["id", "sg", "au", "my"],
      utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.min.js",
    });
    $('#familyCompanyPhoneNumber').on('change', function (e) {
      let familyCompanyPhoneNumber = familyCompanyPhoneInput.getNumber();
      @this.set('familyCompanyPhoneNumber', familyCompanyPhoneNumber);
    });

    const familyCompanyFaxInput = window.intlTelInput(document.querySelector("#familyCompanyFaxNumber"), {
      initialCountry: "id",
      separateDialCode: true,
      preferredCountries: ["id", "sg", "au", "my"],
      utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.min.js",
    });
    $('#familyCompanyFaxNumber').on('change', function (e) {
      let familyCompanyFaxNumber = familyCompanyFaxInput.getNumber();
      @this.set('familyCompanyFaxNumber', familyCompanyFaxNumber);
    });
  });
</script>