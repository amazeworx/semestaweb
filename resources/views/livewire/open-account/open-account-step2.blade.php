<div class="bg-white shadow">

  {{-- Data Pekerjaan --}}
  <div class="flex flex-wrap px-4 py-6 lg:flex-nowrap lg:gap-6 lg:px-8 lg:py-11 border-b border-gray-200">

    <div class="w-full lg:w-1/4">
      <h3 class="text-xl font-bold mb-4">Data Pekerjaan</h3>
    </div>

    <div class="w-full grid grid-cols-1 gap-6 lg:w-3/4">
      <div class="flex flex-wrap gap-y-6 md:flex-nowrap md:gap-x-4">
        <div class="w-full md:w-1/3">
          <label class="form-label">Pekerjaan <span class="form-required">*</span></label>
          <select id="occupation" wire:model="occupation" name="occupation" class="mb-1">
            <option value="" disabled>-- Pilih --</option>
            @foreach ($occupations as $occupation)
            <option value="{{ $occupation->id }}">
              {{ $occupation->name }}</option>
            @endforeach
          </select>

          @error('occupation')
          <div class="form-validation-error"><small>{{ $message }}</small></div>
          @enderror

          @if ($occupationIsOther)
          <input type="text" wire:model.lazy="occupationText" name="occupationText" placeholder="Isi Pekerjaan Anda">
          @endif

          @error('occupationText')
          <div class="form-validation-error"><small>{{ $message }}</small></div>
          @enderror
        </div>
        <div class="w-full md:w-1/3">
          <label class="form-label">Jabatan/Pangkat <span class="form-required">*</span></label>

          @if (!$jobPositionIsText)
          <select wire:model="jobPosition" name="jobPosition" class="mb-1">
            <option value="" disabled>-- Pilih --</option>
            @foreach ($jobPositions as $position)
            <option value="{{ $position->id }}">{{ $position->name }}
            </option>
            @endforeach
          </select>
          @endif

          @error('jobPosition')
          <div class="form-validation-error"><small>{{ $message }}</small></div>
          @enderror

          @if ($jobPositionIsText || $jobPositionIsOther)
          <input type="text" wire:model.lazy="jobPositionText" name="jobPositionText"
            placeholder="Isi Jabatan/Pangkat Anda">
          @endif

          @error('jobPositionText')
          <div class="form-validation-error"><small>{{ $message }}</small></div>
          @enderror
        </div>
        <div class="w-full md:w-1/3">
          <label class="form-label">Bidang Usaha <span class="form-required">*</span></label>
          @if (!$businessFieldIsText)
          <select wire:model="businessField" name="businessField" class="mb-1">
            <option value="" disabled>-- Pilih --</option>
            @foreach ($businessFields as $business)
            <option value="{{ $business->id }}">{{ $business->name }}</option>
            @endforeach
          </select>
          @endif
          @error('businessField')
          <div class="form-validation-error"><small>{{ $message }}</small></div>
          @enderror
          @if ($businessFieldIsText || $businessFieldIsOther)
          <input type="text" wire:model.lazy="businessFieldText" name="businessFieldText"
            placeholder="Isi Bidang Usaha Pekerjaan Anda">
          @endif
          @error('businessFieldText')
          <div class="form-validation-error"><small>{{ $message }}</small></div>
          @enderror
        </div>
      </div>

      <div class="flex flex-wrap gap-y-2">
        <div class="w-full">
          <label class="form-label">Nama Perusahaan/Kantor <span class="form-required">*</span></label>
          <input type="text" wire:model.lazy="companyName" name="companyName"
            placeholder="Isi Nama Perusahaan/Kantor Anda">
          @error('companyName')
          <div class="form-validation-error"><small>{{ $message }}</small></div>
          @enderror
        </div>

        <div class="w-full flex flex-wrap gap-y-2">
          <div class="w-full grid grid-cols-1 md:grid-cols-3 gap-x-4 gap-y-2">
            <div class="w-full md:col-span-full">
              <label class="form-label">Alamat Kantor <span class="form-required">*</span></label>
              <input type="text" wire:model.lazy="companyAddress" name="companyAddress"
                placeholder="Cth: Jl Buncit Persada No 1">
              @error('companyAddress')
              <div class="form-validation-error"><small>{{ $message }}</small></div>
              @enderror
            </div>
            <div class="w-full">
              <label class="form-label">Negara <span class="form-required">*</span></label>
              <div wire:ignore>
                <select id="companyCountry" name="companyCountry">
                  <option></option>
                  @foreach ($countries as $country)
                  <option value="{{ $country->name }}" {{ $country->name === 'INDONESIA' ? 'selected' : '' }}>
                    {{ $country->name }}</option>
                  @endforeach
                </select>
              </div>
              @error('companyCountry')
              <div class="form-validation-error"><small>{{ $message }}</small></div>
              @enderror
            </div>
            <div class="w-full">
              <label class="form-label">Kota <span class="form-required">*</span></label>
              @if ($companyCountry === 'INDONESIA')
              <div wire:ignore>
                <select id="companyCity" name="companyCity" class="mb-1">
                  <option></option>
                  @foreach ($companyCities as $city)
                  <option value="{{ $city->ksei_name }}" {{ $city->ksei_name === 'JAKARTA' ? 'selected' : '' }}>
                    {{ $city->ksei_name }}</option>
                  @endforeach
                </select>
              </div>
              @error('companyCity')
              <div class="form-validation-error"><small>{{ $message }}</small></div>
              @enderror
              @else
              <input type="text" wire:model.lazy="companyCityText" name="companyCityText" placeholder="Nama Kota">
              @error('companyCityText')
              <div class="form-validation-error"><small>{{ $message }}</small></div>
              @enderror
              @endif
            </div>
            <div class="w-full">
              <label class="form-label">Kode Pos <span class="form-required">*</span></label>
              <input type="text" wire:model.lazy="companyZip" name="companyZip" placeholder="Cth: 11250">
              @error('companyZip')
              <div class="form-validation-error"><small>{{ $message }}</small></div>
              @enderror
            </div>
          </div>
          <div class="w-full grid grid-cols-1 md:grid-cols-2 gap-x-4 gap-y-2">

            <div class="w-full">
              <div>
                <label class="form-label">Nomor Telepon Kantor</label>
                <div wire:ignore>
                  <input id="companyPhoneNumber" type="tel" name="companyPhoneNumber" placeholder="21567890"
                    class="mt-1">
                  @error('companyPhoneNumber')
                  <div class="form-validation-error"><small>{{ $message }}</small></div>
                  @enderror
                </div>
              </div>
            </div>

            <div class="w-full">
              <div>
                <label class="form-label">Nomor Faksimili</label>

                <div wire:ignore>
                  <input id="companyFaxNumber" type="tel" name="companyFaxNumber" placeholder="21567890" class="mt-1">
                  @error('companyFaxNumber')
                  <div class="form-validation-error"><small>{{ $message }}</small></div>
                  @enderror
                </div>
              </div>
            </div>

          </div>
          <div class="w-full grid grid-cols-1 md:grid-cols-3 gap-x-4 gap-y-2">
            <div class="w-full col-span-2">
              <label class="form-label">Email Kantor</label>
              <input type="text" wire:model.lazy="companyEmail" name="companyEmail"
                placeholder="Isi alamat email kantor Anda">
              @error('companyEmail')
              <div class="form-validation-error"><small>{{ $message }}</small></div>
              @enderror
            </div>
            <div class="w-full">
              <label class="form-label">Lama Bekerja/Usaha</label>
              <div class="flex flex-nowrap gap-2">
                <select wire:model="workYear" name="workYear" class="mb-1">
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
                <select wire:model="workMonth" name="workMonth" class="mb-1">
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
      <h3 class="text-xl font-bold mb-4">Data Keuangan</h3>
    </div>
    <div class="w-full grid grid-cols-1 gap-6 lg:w-3/4">
      <div class="grid grid-cols-1 gap-y-6 md:grid-cols-2 md:gap-x-4">
        <div class="w-full">
          <label class="form-label">Penghasilan Utama/Kotor/thn <span class="form-required">*</span></label>
          <select wire:model="incomeYearly" name="incomeYearly" class="mb-1">
            <option value="" disabled>-- Pilih --</option>
            <option value="1">
              < 10 Juta</option> <option value="2">10-50 Juta
            </option>
            <option value="3">50 - 100 Juta</option>
            <option value="4">100 - 500 Juta</option>
            <option value="5">500 Juta - 1 Miliar</option>
            <option value="6">> 1 Miliar</option>
          </select>
          @error('incomeYearly')
          <div class="form-validation-error"><small>{{ $message }}</small></div>
          @enderror
        </div>
        <div class="w-full">
          <label class="form-label">Sumber Penghasilan Utama <span class="form-required">*</span></label>

          <select wire:model="incomeSource" name="incomeSource" class="mb-1">
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

          @error('incomeSource')
          <div class="form-validation-error"><small>{{ $message }}</small></div>
          @enderror

          @if ($incomeSourceIsOther)
          <input type="text" wire:model.lazy="incomeSourceText" name="incomeSourceText"
            placeholder="Isi Sumber Penghasilan Utama Anda *">
          @endif
          @error('incomeSourceText')
          <div class="form-validation-error"><small>{{ $message }}</small></div>
          @enderror
        </div>
        <div class="w-full">
          <label class="form-label">Penghasilan Tambahan/Kotor/thn</label>
          <select wire:model="extraIncomeYearly" name="extraIncomeYearly" class="mb-1">
            <option value="" disabled>-- Pilih --</option>
            <option value="1">
              < 10 Juta</option> <option value="2">10-50 Juta
            </option>
            <option value="3">50 - 100 Juta</option>
            <option value="4">100 - 500 Juta</option>
            <option value="5">500 Juta - 1 Miliar</option>
            <option value="6">> 1 Miliar</option>
          </select>
          @error('extraIncomeYearly')
          <div class="form-validation-error"><small>{{ $message }}</small></div>
          @enderror
        </div>
        <div class="w-full">
          <label class="form-label">Sumber Penghasilan Tambahan</label>
          <select wire:model="extraIncomeSource" name="extraIncomeSource" class="mb-1">
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

          @error('extraIncomeSource')
          <div class="form-validation-error"><small>{{ $message }}</small></div>
          @enderror

          @if ($extraIncomeSourceIsOther)
          <input type="text" wire:model.lazy="extraIncomeSourceText" name="extraIncomeSourceText"
            placeholder="Isi Sumber Penghasilan Tambahan Anda">
          @endif
          @error('extraIncomeSourceText')
          <div class="form-validation-error"><small>{{ $message }}</small></div>
          @enderror
        </div>
      </div>
      <div class="grid grid-cols-1 gap-y-6 md:grid-cols-3 md:gap-x-8">
        <div class="w-full">
          <label class="form-label">Pengeluaran per Bulan</label>
          <select wire:model="expensesMonthly" name="expensesMonthly" class="mb-1">
            <option value="" disabled>-- Pilih --</option>
            <option value="1">
              < 5 Juta</option> <option value="2">5-10 Juta
            </option>
            <option value="3">10 - 25 Juta</option>
            <option value="4">25 - 50 Juta</option>
            <option value="5">50 - 100 Juta</option>
            <option value="6">> 100 Juta</option>
          </select>
          @error('expensesMonthly')
          <div class="form-validation-error"><small>{{ $message }}</small></div>
          @enderror
        </div>
        <div class="w-full md:col-span-2">
          <label class="form-label">Tujuan Investasi <span class="form-required">*</span></label>

          <div class="w-full grid grid-cols-1 gap-y-1 gap-x-2 md:grid-cols-2">
            <div class="form-check mt-1 inline-flex">
              <input wire:model="objectives" type="checkbox" name="objectives" id="objective2" class="form-check-input"
                value="2">
              <label class="form-check-label inline-block ml-2" for="objective2">
                Apresiasi Harga
              </label>
            </div>
            <div class="form-check mt-1 inline-flex">
              <input wire:model="objectives" type="checkbox" name="objectives" id="objective3" class="form-check-input"
                value="3">
              <label class="form-check-label inline-block ml-2" for="objective3">
                Investasi Jangka Panjang
              </label>
            </div>
            <div class="form-check mt-1 inline-flex">
              <input wire:model="objectives" type="checkbox" name="objectives" id="objective4" class="form-check-input"
                value="4">
              <label class="form-check-label inline-block ml-2" for="objective4">
                Spekulasi
              </label>
            </div>
            <div class="form-check mt-1 inline-flex">
              <input wire:model="objectives" type="checkbox" name="objectives" id="objective5" class="form-check-input"
                value="5">
              <label class="form-check-label inline-block ml-2" for="objective5">
                Sumber Pendapatan
              </label>
            </div>
            <div class="form-check mt-1 inline-flex">
              <input wire:model="objectives" type="checkbox" name="objectives" id="objective1" class="form-check-input"
                value="1">
              <label class="form-check-label inline-block ml-2" for="objective1">
                Lainnya
              </label>
            </div>
          </div>
          @error('objectives')
          <div class="form-validation-error"><small>{{ $message }}</small></div>
          @enderror

        </div>
      </div>
    </div>
  </div>

  {{-- Data Ahli Waris --}}
  <div class="flex flex-wrap px-4 py-6 lg:flex-nowrap lg:gap-6 lg:px-8 lg:py-11 border-b border-gray-200">
    <div class="w-full lg:w-1/4">
      <h3 class="text-xl font-bold mb-4">Data Ahli Waris</h3>
    </div>
    <div class="w-full grid grid-cols-1 gap-6 lg:w-3/4">
      <div class="w-full grid grid-cols-1 md:grid-cols-2 gap-x-4 gap-y-2">
        <div class="w-full">
          <label class="form-label">Nama Ahli Waris <span class="form-required">*</span></label>
          <input type="text" wire:model.lazy="heirName" placeholder="Isi Nama Ahli Waris Anda">
          @error('heirName')
          <div class="form-validation-error"><small>{{ $message }}</small></div>
          @enderror
        </div>
        <div class="w-full">
          <label class="form-label">Hubungan <span class="form-required">*</span></label>
          <input type="text" wire:model.lazy="heirRelationship" placeholder="Isi Hubungan dengan Ahli Waris Anda">
          @error('heirRelationship')
          <div class="form-validation-error"><small>{{ $message }}</small></div>
          @enderror
        </div>
      </div>

      <div class="flex flex-wrap gap-y-2">
        <div class="w-full flex flex-wrap gap-y-2">
          <div class="w-full grid grid-cols-1 md:grid-cols-3 gap-x-4 gap-y-2">
            <div class="w-full md:col-span-full">
              <label class="form-label">Alamat <span class="form-required">*</span></label>
              <input type="text" wire:model.lazy="heirAddress" placeholder="Cth: Jl Buncit Persada No 1">
              @error('heirAddress')
              <div class="form-validation-error"><small>{{ $message }}</small></div>
              @enderror
            </div>
            <div class="w-full">
              <label class="form-label">Negara <span class="form-required">*</span></label>
              <div wire:ignore>
                <select id="heirCountry">
                  <option></option>
                  @foreach ($countries as $country)
                  <option value="{{ $country->name }}" {{ $country->name === 'INDONESIA' ? 'selected' : '' }}>
                    {{ $country->name }}</option>
                  @endforeach
                </select>
              </div>
              @error('heirCountry')
              <div class="form-validation-error"><small>{{ $message }}</small></div>
              @enderror
            </div>
            <div class="w-full">
              <label class="form-label">Kota <span class="form-required">*</span></label>
              @if ($heirCountry === 'INDONESIA')
              <div wire:ignore>
                <select id="heirCity" class="mb-1">
                  <option></option>
                  @foreach ($heirCities as $city)
                  <option value="{{ $city->ksei_name }}" {{ $city->ksei_name === 'JAKARTA' ? 'selected' : '' }}>
                    {{ $city->ksei_name }}</option>
                  @endforeach
                </select>
              </div>
              @error('heirCity')
              <div class="form-validation-error"><small>{{ $message }}</small></div>
              @enderror
              @else
              <input type="text" wire:model.lazy="heirCityText" placeholder="Nama Kota">
              @error('heirCityText')
              <div class="form-validation-error"><small>{{ $message }}</small></div>
              @enderror
              @endif
            </div>
            <div class="w-full">
              <label class="form-label">Kode Pos <span class="form-required">*</span></label>
              <input type="text" wire:model.lazy="heirZip" placeholder="Cth: 11250">
              @error('heirZip')
              <div class="form-validation-error"><small>{{ $message }}</small></div>
              @enderror
            </div>
          </div>
          <div class="w-full grid grid-cols-1 md:grid-cols-2 gap-x-4 gap-y-2">

            <div class="w-full">
              <div>
                <label class="form-label">Nomor Handphone</label>
                <div wire:ignore>
                  <input id="heirMobileNumber" type="tel" name="heirMobileNumber" placeholder="81233445566"
                    class="mt-1">
                  @error('heirMobileNumber')
                  <div class="form-validation-error"><small>{{ $message }}</small></div>
                  @enderror
                </div>
              </div>
            </div>

            <div class="w-full">
              <label class="form-label">Email</label>
              <input type="text" wire:model.lazy="heirEmail" placeholder="Isi email ahli waris Anda">
              @error('heirEmail')
              <div class="form-validation-error"><small>{{ $message }}</small></div>
              @enderror
            </div>

          </div>
        </div>

      </div>
    </div>
  </div>

  {{-- Data Bank --}}
  <div class="flex flex-wrap px-4 py-6 lg:flex-nowrap lg:gap-6 lg:px-8 lg:py-11 border-b border-gray-200">
    <div class="w-full lg:w-1/4">
      <h3 class="text-xl font-bold mb-4">Referensi Bank</h3>
    </div>
    <div class="w-full grid grid-cols-1 gap-6 lg:w-3/4">

      <div class="w-full mb-6">
        <div class="w-full">
          <h4 class="font-bold text-base">Referensi Rekening Bank BCA</h4>
          <p class="text-xs italic mb-3 text-gray-500">Wajib diisi jika Anda sudah memiliki rekening di Bank BCA</p>
        </div>
        <div class="w-full grid grid-cols-1 md:grid-cols-5 gap-x-4 gap-y-2">
          <div class="w-full">
            <label class="form-label">Bank BCA <span class="form-required">*</span></label>
            <select wire:model="bank2Name">
              <option value="" disabled>-- Pilih --</option>
              <option value="BANK CENTRAL ASIA">Ada</option>
              <option value="0">Tidak Ada</option>
            </select>
            @error('bank2Name')
            <div class="form-validation-error"><small>{{ $message }}</small></div>
            @enderror
          </div>
          <div class="w-full md:col-span-2">
            <label class="form-label">Nama Pemilik Rekening <span
                class="form-required {{ $bank2Name == 2 ? 'hidden' : '' }}">*</span></label>
            <input type="text" wire:model.lazy="bank2AccName" placeholder="Isi nama rekening BCA Anda"
              {{ $bank2Name == 2 ? 'disabled' : '' }}>
            @error('bank2AccName')
            <div class="form-validation-error"><small>{{ $message }}</small></div>
            @enderror
          </div>
          <div class="w-full md:col-span-2">
            <label class="form-label">Nomor Rekening <span
                class="form-required {{ $bank2Name == 2 ? 'hidden' : '' }}">*</span></label>
            <input type="text" wire:model.lazy="bank2AccNumber" placeholder="Isi nomor rekening BCA Anda"
              {{ $bank2Name == 2 ? 'disabled' : '' }}>
            @error('bank2AccNumber')
            <div class="form-validation-error"><small>{{ $message }}</small></div>
            @enderror
          </div>
        </div>
      </div>

      <div class="w-full">
        <div class="w-full">
          <h4 class="font-bold text-base mb-2">Referensi Rekening Selain Bank BCA</h4>
        </div>
        <div class="w-full grid grid-cols-1 md:grid-cols-3 gap-x-4 gap-y-2">
          <div class="w-full">
            <label class="form-label">Nama Bank & Cabang</label>
            <div wire:ignore>
              <select id="bank3Name">
                <option></option>
                @foreach ($bankNames as $bank)
                <option value="{{ $bank->name }}">
                  {{ $bank->name }}</option>
                @endforeach
              </select>
            </div>
            @error('bank3Name')
            <div class="form-validation-error"><small>{{ $message }}</small></div>
            @enderror
          </div>
          <div class="w-full">
            <label class="form-label">Nama Pemilik Rekening</label>
            <input type="text" wire:model.lazy="bank3AccName" placeholder="Isi nama pemilik rekening">
            @error('bank3AccName')
            <div class="form-validation-error"><small>{{ $message }}</small></div>
            @enderror
          </div>
          <div class="w-full">
            <label class="form-label">Nomor Rekening</label>
            <input type="text" wire:model.lazy="bank3AccNumber" placeholder="Isi nomor rekening Anda">
            @error('bank3AccNumber')
            <div class="form-validation-error"><small>{{ $message }}</small></div>
            @enderror
          </div>
        </div>
      </div>

    </div>
  </div>

  {{-- Deklarasi FATCA --}}
  <div class="flex flex-wrap px-4 py-6 lg:flex-nowrap lg:gap-6 lg:px-8 lg:py-11 border-b border-gray-200">
    <div class="w-full lg:w-1/4">
      <h3 class="text-xl font-bold mb-4">Deklarasi FATCA</h3>
    </div>
    <div class="w-full grid grid-cols-1 gap-3 lg:w-3/4">
      <div class="w-full">
        <div class="form-check mt-1 inline-flex">
          <input wire:model="fatcaHolder" type="checkbox" id="fatcaHolder" class="form-check-input">
          <label class="form-check-label inline-block ml-2" for="fatcaHolder">
            Saya memiliki kewajiban FATCA (Foreign Account Tax Compliance Act)
          </label>
        </div>
        @if ($fatcaHolder)
        <div class="w-full mt-2 mb-2 pl-6">
          <input type="text" wire:model.lazy="fatcaTinSsn" placeholder="Isi TIN/SSN Anda *">
          @error('fatcaTinSsn')
          <div class="form-validation-error"><small>{{ $message }}</small></div>
          @enderror
        </div>
        @endif
      </div>
      <div class="w-full">
        <div class="form-check mt-1 inline-flex">
          <input wire:model="otherTaxPayer" type="checkbox" id="otherTaxPayer" class="form-check-input">
          <label class="form-check-label inline-block ml-2" for="otherTaxPayer">
            Saya memiliki kewajiban pajak di negara lain selain Indonesia dan Amerika Serikat
          </label>
        </div>
      </div>
    </div>
  </div>

</div>

<script>
  $(document).ready(function() {
    $('#companyCountry').select2({
      placeholder: "-- Pilih --",
    });
    $('#companyCountry').on('change', function (e) {
      @this.set('companyCountry', e.target.value);
    });
    $('#companyCity').select2({
      placeholder: "-- Pilih --",
    });
    $('#companyCity').on('change', function (e) {
      @this.set('companyCity', e.target.value);
    });
    $('#heirCountry').select2({
      placeholder: "-- Pilih --",
    });
    $('#heirCountry').on('change', function (e) {
      @this.set('heirCountry', e.target.value);
    });
    $('#heirCity').select2({
      placeholder: "-- Pilih --",
    });
    $('#heirCity').on('change', function (e) {
      @this.set('heirCity', e.target.value);
    });

    $('#bank3Name').select2({
      placeholder: "-- Pilih --",
    });
    $('#bank3Name').on('change', function (e) {
      @this.set('bank3Name', e.target.value);
    });

    const companyPhoneInput = window.intlTelInput(document.querySelector("#companyPhoneNumber"), {
      initialCountry: "id",
      separateDialCode: true,
      preferredCountries: ["id", "sg", "au", "my"],
      utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.min.js",
    });
    $('#companyPhoneNumber').on('change', function (e) {
      let companyPhoneNumber = companyPhoneInput.getNumber();
      let countryData = companyPhoneInput.getSelectedCountryData();
      @this.set('companyPhoneCountryCode', countryData.dialCode);
      @this.set('companyPhoneNumber', companyPhoneNumber);
    });

    const companyFaxInput = window.intlTelInput(document.querySelector("#companyFaxNumber"), {
      initialCountry: "id",
      separateDialCode: true,
      preferredCountries: ["id", "sg", "au", "my"],
      utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.min.js",
    });
    $('#companyFaxNumber').on('change', function (e) {
      let companyFaxNumber = companyFaxInput.getNumber();
      let countryData = companyFaxInput.getSelectedCountryData();
      @this.set('companyFaxCountryCode', countryData.dialCode);
      @this.set('companyFaxNumber', companyFaxNumber);
    });

    const heirMobileInput = window.intlTelInput(document.querySelector("#heirMobileNumber"), {
      initialCountry: "id",
      separateDialCode: true,
      preferredCountries: ["id", "sg", "au", "my"],
      utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.min.js",
    });
    $('#heirMobileNumber').on('change', function (e) {
      let heirMobileNumber = heirMobileInput.getNumber();
      let countryData = heirMobileInput.getSelectedCountryData();
      @this.set('heirMobileNumber', heirMobileNumber);
    });
});
</script>