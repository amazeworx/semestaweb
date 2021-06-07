<div class="bg-white shadow">

  {{-- Data Identitas --}}
  <div class="flex flex-wrap px-4 py-6 lg:flex-nowrap lg:gap-6 lg:px-8 lg:py-11 border-b border-gray-200">
    <div class="w-full lg:w-1/4">
      <h3 class="text-xl font-bold mb-4">Data Identitas</h3>
    </div>

    <div class="w-full grid grid-cols-1 gap-6 lg:w-3/4">

      <div class="flex flex-wrap gap-y-6 md:flex-nowrap md:gap-x-4">
        <div class="w-full md:w-3/5">
          <label class="form-label">Nama lengkap <span class="form-required">*</span></label>
          <input type="text" wire:model.lazy="fullName" x-model="fullName"
            placeholder="Isi nama lengkap Anda sesuai identitas">
          @error('fullName')
          <div class="form-validation-error"><small>{{ $message }}</small></div>
          @enderror
        </div>
        <div class="w-full md:w-2/5">
          <label class="form-label">Kewarganegaraan <span class="form-required">*</span></label>
          <div wire:ignore>
            <select id="nationality" name="nationality">
              <option></option>
              @foreach ($countries as $country)
              <option value="{{ $country->nationality }}"
                {{ $country->nationality === 'INDONESIAN' ? 'selected' : '' }}>
                {{ $country->nationality }}
              </option>
              @endforeach
            </select>
          </div>
          @error('nationality')
          <div class="form-validation-error"><small>{{ $message }}</small></div>
          @enderror
        </div>
      </div>

      <div class="flex flex-wrap gap-y-2 md:flex-nowrap md:gap-x-4">
        {{-- Jenis Identitas --}}
        <div class="w-full md:w-2/12">
          <label class="form-label">Jenis Kartu ID <span class="form-required">*</span></label>
          <select id="idType" wire:model="idType" name="idType" class="mb-1">
            <option value="" disabled>-- Pilih Identitas --</option>
            <option value="KTP">KTP</option>
            <option value="Paspor">Paspor</option>
          </select>
          @error('idType')
          <div class="form-validation-error"><small>{{ $message }}</small></div>
          @enderror
        </div>

        {{-- No KTP/Paspor --}}
        <div class="w-full flex flex-wrap gap-y-2 md:flex-nowrap md:w-10/12 md:gap-x-4">
          @if ($idType === 'KTP')
          <div class="w-full md:w-1/2">
            <label class="form-label">Nomor KTP (NIK) <span class="form-required">*</span></label>
            <input type="text" wire:model.lazy="ktpNumber" name="ktpNumber" placeholder="Isi NIK KTP Anda">
            @error('ktpNumber')
            <div class="form-validation-error"><small>{{ $message }}</small></div>
            @enderror
          </div>
          <div class="w-full md:w-1/2">
            <label class="form-label">Berlaku s/d <span class="form-required">*</span></label>
            <div class="flex flex-nowrap gap-2">
              <select id="ktpExpiredDay" wire:model="ktpExpiredDay" name="ktpExpiredDay" class="mb-1"
                {{ $ktpExpiredLifetime ? 'disabled' : '' }}>
                <option value="">Tgl</option>
                @for ($i = 1; $i <= 31; $i++) <option value="{{ $i }}">{{ $i }}</option>
                  @endfor
              </select>
              <select id="ktpExpiredMonth" wire:model="ktpExpiredMonth" name="ktpExpiredMonth" class="mb-1"
                {{ $ktpExpiredLifetime ? 'disabled' : '' }}>
                <option value="">Bln</option>
                @for ($i = 1; $i <= 12; $i++) <option value="{{ $i }}">{{ $i }}</option>
                  @endfor
              </select>
              <select id="ktpExpiredYear" wire:model="ktpExpiredYear" name="ktpExpiredYear" class="mb-1"
                {{ $ktpExpiredLifetime ? 'disabled' : '' }}>
                <option value="">Thn</option>
                @for ($i = date("Y"); $i <= (date("Y") + 10); $i++) <option value="{{ $i }}">{{ $i }}</option>
                  @endfor
              </select>
            </div>

            <div>
              <div class="form-check mt-1 inline-flex">
                <input wire:model="ktpExpiredLifetime" type="checkbox" name="ktpExpiredLifetime" id="ktpExpiredLifetime"
                  class="form-check-input">
                <label class="form-check-label inline-block ml-2" for="ktpExpiredLifetime">Seumur Hidup</label>
              </div>
            </div>
            @error('ktpExpiredDay')
            <div class="form-validation-error"><small>{{ $message }}</small></div>
            @enderror
            @error('ktpExpiredMonth')
            <div class="form-validation-error"><small>{{ $message }}</small></div>
            @enderror
            @error('ktpExpiredYear')
            <div class="form-validation-error"><small>{{ $message }}</small></div>
            @enderror
          </div>
          @endif

          @if ($idType === 'Paspor')
          <div class="w-full md:w-1/2">
            <label class="form-label">Nomor Paspor <span class="form-required">*</span></label>
            <input type="text" wire:model.lazy="passportNumber" name="passportNumber"
              placeholder="Isi nomor paspor Anda">
            @error('passportNumber')
            <div class="form-validation-error"><small>{{ $message }}</small></div>
            @enderror
          </div>
          <div class="w-full md:w-1/2">
            <label class="form-label">Berlaku s/d <span class="form-required">*</span></label>
            <div class="flex flex-nowrap gap-2">
              <select id="passportExpiredDay" wire:model="passportExpiredDay" name="passportExpiredDay" class="mb-1">
                <option value="">Tgl</option>
                @for ($i = 1; $i <= 31; $i++) <option value="{{ $i }}">{{ $i }}</option>
                  @endfor
              </select>
              <select id="passportExpiredMonth" wire:model="passportExpiredMonth" name="passportExpiredMonth"
                class="mb-1">
                <option value="">Bln</option>
                @for ($i = 1; $i <= 12; $i++) <option value="{{ $i }}">{{ $i }}</option>
                  @endfor
              </select>
              <select id="passportExpiredYear" wire:model="passportExpiredYear" name="passportExpiredYear" class="mb-1">
                <option value="">Thn</option>
                @for ($i = date("Y"); $i <= (date("Y") + 10); $i++) <option value="{{ $i }}">{{ $i }}</option>
                  @endfor
              </select>
            </div>
            @error('passportExpiredDay')
            <div class="form-validation-error"><small>{{ $message }}</small></div>
            @enderror
            @error('passportExpiredMonth')
            <div class="form-validation-error"><small>{{ $message }}</small></div>
            @enderror
            @error('passportExpiredYear')
            <div class="form-validation-error"><small>{{ $message }}</small></div>
            @enderror
          </div>
          @endif
        </div>

      </div>

      @if ($nationality !== 'INDONESIAN')
      <div class="flex flex-wrap gap-y-2 md:flex-nowrap md:gap-x-4">
        {{-- KITAS/SKD --}}
        <div class="w-full md:w-2/12">
          <label class="form-label">KITAS/SKD <span class="form-required">*</span></label>
          <select id="hasKitas" wire:model="hasKitas" name="hasKitas" class="mb-1">
            <option value="" disabled>-- Pilih--</option>
            <option value="1">Ada</option>
            <option value="2">Tidak Ada</option>
          </select>
          @error('hasKitas')
          <div class="form-validation-error"><small>{{ $message }}</small></div>
          @enderror
        </div>

        {{-- No KITAS/SKD --}}
        <div class="w-full md:w-5/12">
          <label class="form-label">Nomor KITAS/SKD @if ($hasKitas === '1') <span class="form-required">*</span>
            @endif</label>
          <input type="text" wire:model.lazy="kitasNumber" name="kitasNumber" placeholder="Isi Nomor KITAS/SKD Anda"
            {{ $hasKitas !== '1' ? 'disabled' : '' }}>
          @error('kitasNumber')
          <div class="form-validation-error"><small>{{ $message }}</small></div>
          @enderror
        </div>

        {{-- Masa berlaku KITAS/SKD s/d --}}
        <div class="w-full md:w-5/12">
          <label class="form-label">KITAS/SKD Berlaku S/D @if ($hasKitas === '1') <span class="form-required">*</span>
            @endif</label>
          <div class="flex flex-nowrap gap-2">
            <select id="kitasExpiredDay" wire:model="kitasExpiredDay" name="kitasExpiredDay" class="mb-1 w-1/3"
              {{ $hasKitas !== '1' ? 'disabled' : '' }}>
              <option value="">Tgl</option>
              @for ($i = 1; $i <= 31; $i++) <option value="{{ $i }}">{{ $i }}</option>
                @endfor
            </select>
            <select id="kitasExpiredMonth" wire:model="kitasExpiredMonth" name="kitasExpiredMonth" class="mb-1 w-1/3"
              {{ $hasKitas !== '1' ? 'disabled' : '' }}>
              <option value="">Bln</option>
              @for ($i = 1; $i <= 12; $i++) <option value="{{ $i }}">{{ $i }}</option>
                @endfor
            </select>
            <select id="kitasExpiredYear" wire:model="kitasExpiredYear" name="kitasExpiredYear" class="mb-1 w-1/3"
              {{ $hasKitas !== '1' ? 'disabled' : '' }}>
              <option value="">Thn</option>
              @for ($i = date("Y"); $i <= (date("Y") + 10); $i++) <option value="{{ $i }}">{{ $i }}</option>
                @endfor
            </select>
          </div>
          @error('kitasExpiredDay')
          <div class="form-validation-error"><small>{{ $message }}</small></div>
          @enderror
          @error('kitasExpiredMonth')
          <div class="form-validation-error"><small>{{ $message }}</small></div>
          @enderror
          @error('kitasExpiredYear')
          <div class="form-validation-error"><small>{{ $message }}</small></div>
          @enderror
        </div>

      </div>
      @endif

      <div class="flex flex-wrap gap-y-2 md:flex-nowrap md:gap-x-4">
        {{-- NPWP --}}
        <div class="w-full md:w-2/12">
          <label class="form-label">NPWP <span class="form-required">*</span></label>
          <select id="hasNPWP" wire:model="hasNPWP" name="hasNPWP" class="mb-1">
            <option value="" disabled>-- Pilih --</option>
            <option value="1">Tidak Ada</option>
            <option value="2">Individu</option>
            <option value="3">Suami/Istri</option>
          </select>
          @error('hasNPWP')
          <div class="form-validation-error"><small>{{ $message }}</small></div>
          @enderror
        </div>

        <div class="w-full flex flex-wrap gap-y-2 md:flex-nowrap md:w-10/12 md:gap-x-4">
          <div class="w-full md:w-1/2">
            <label class="form-label">Nomor NPWP <span class="form-required">*</span></label>
            <input type="text" wire:model.lazy="npwpNumber" name="npwpNumber" placeholder="Isi Nomor NPWP Anda"
              {{ $hasNPWP == '1' ? 'disabled' : '' }}>
            @error('npwpNumber')
            <div class="form-validation-error"><small>{{ $message }}</small></div>
            @enderror
          </div>
          <div class="w-full md:w-1/2">
            <label class="form-label">Tanggal Penerbitan NPWP <span class="form-required">*</span></label>
            <div class="flex flex-nowrap gap-2">
              <select wire:model="npwpIssueDay" name="npwpIssueDay" class="mb-1"
                {{ $hasNPWP == '1' ? 'disabled' : '' }}>
                <option value="">Tgl</option>
                @for ($i = 1; $i <= 31; $i++) <option value="{{ $i }}">{{ $i }}</option>
                  @endfor
              </select>
              <select wire:model="npwpIssueMonth" name="npwpIssueMonth" class="mb-1"
                {{ $hasNPWP == '1' ? 'disabled' : '' }}>
                <option value="">Bln</option>
                @for ($i = 1; $i <= 12; $i++) <option value="{{ $i }}">{{ $i }}</option>
                  @endfor
              </select>
              <select wire:model="npwpIssueYear" name="npwpIssueYear" class="mb-1"
                {{ $hasNPWP == '1' ? 'disabled' : '' }}>
                <option value="">Thn</option>
                @for ($i = date("Y"); $i >= (date("Y") - 20); $i--) <option value="{{ $i }}">{{ $i }}</option>
                @endfor
              </select>
            </div>
            @error('npwpIssueDay')
            <div class="form-validation-error"><small>{{ $message }}</small></div>
            @enderror
            @error('npwpIssueMonth')
            <div class="form-validation-error"><small>{{ $message }}</small></div>
            @enderror
            @error('npwpIssueYear')
            <div class="form-validation-error"><small>{{ $message }}</small></div>
            @enderror
          </div>
        </div>

      </div>

      <div class="flex flex-wrap gap-y-6 md:flex-nowrap md:gap-x-4">
        <div class="w-full md:w-3/12">
          <label class="form-label">Negara Lahir <span class="form-required">*</span></label>
          <div wire:ignore>
            <select id="birthCountry">
              <option></option>
              @foreach ($countries as $country)
              <option value="{{ $country->code }}" {{ $country->code === 'ID' ? 'selected' : '' }}>
                {{ $country->name }}
              </option>
              @endforeach
            </select>
          </div>
          @error('birthCountry')
          <div class="form-validation-error"><small>{{ $message }}</small></div>
          @enderror
        </div>
        <div class="w-full md:w-4/12">
          <label class="form-label">Tempat Lahir <span class="form-required">*</span></label>
          @if ($birthCountry === 'ID')
          <div wire:ignore>
            <select id="birthPlace" name="birthPlace">
              <option></option>
              @foreach ($birthPlaces as $city)
              <option value="{{ $city->ksei_name }}" {{ $city->ksei_name === 'JAKARTA' ? 'selected' : '' }}>
                {{ $city->ksei_name }}
              </option>
              @endforeach
            </select>
          </div>
          @else
          <input type="text" wire:model.lazy="birthPlaceForeign" name="birthPlaceForeign" value="FOREIGN" disabled>
          @endif
          @error('birthPlace')
          <div class="form-validation-error"><small>{{ $message }}</small></div>
          @enderror
        </div>
        <div class="w-full md:w-5/12">
          <label class="form-label">Tanggal lahir <span class="form-required">*</span></label>
          <div class="flex flex-nowrap gap-2">
            <select id="birthDay" wire:model="birthDay" name="birthDay" class="mb-1">
              <option value="" disabled>Tgl</option>
              @for ($i = 1; $i <= 31; $i++) <option value="{{ $i }}">{{ $i }}</option>
                @endfor
            </select>
            <select id="birthMonth" wire:model="birthMonth" name="birthMonth" class="mb-1">
              <option value="" disabled>Bln</option>
              @for ($i = 1; $i <= 12; $i++) <option value="{{ $i }}">{{ $i }}</option>
                @endfor
            </select>
            <select id="birthYear" wire:model="birthYear" name="birthYear" class="mb-1">
              <option value="" disabled>Thn</option>
              @for ($i = date("Y"); $i >= (date("Y") - 100); $i--)
              <option value="{{ $i }}">{{ $i }}</option>
              @endfor
            </select>
          </div>

          @error('birthDay')
          <div class="form-validation-error"><small>{{ $message }}</small></div>
          @enderror
          @error('birthMonth')
          <div class="form-validation-error"><small>{{ $message }}</small></div>
          @enderror
          @error('birthYear')
          <div class="form-validation-error"><small>{{ $message }}</small></div>
          @enderror

        </div>
      </div>

      <div class="flex flex-wrap gap-y-6 md:flex-nowrap md:gap-x-4">
        <div class="w-full md:w-3/12">
          <label class="form-label">Jenis Kelamin <span class="form-required">*</span></label>
          <select id="gender" wire:model="gender" name="gender" class="mb-1">
            <option value="" disabled>-- Pilih--</option>
            <option value="1">Laki-laki</option>
            <option value="2">Perempuan</option>
          </select>
          @error('gender')
          <div class="form-validation-error"><small>{{ $message }}</small></div>
          @enderror
        </div>
        <div class="w-full md:w-4/12">
          <label class="form-label">Status Perkawinan <span class="form-required">*</span></label>
          <select id="maritalStatus" wire:model="maritalStatus" name="maritalStatus" class="mb-1">
            <option value="" disabled>-- Pilih--</option>
            <option value="1">Lajang</option>
            <option value="2">Menikah</option>
            <option value="3">Duda</option>
            <option value="4">Janda</option>
          </select>
          @error('maritalStatus')
          <div class="form-validation-error"><small>{{ $message }}</small></div>
          @enderror
        </div>
        <div class="w-full md:w-5/12">
          <label class="form-label">Agama <span class="form-required">*</span></label>
          <select id="religion" wire:model="religion" name="religion" class="mb-1">
            <option value="" disabled>-- Pilih --</option>
            <option value="Islam">Islam</option>
            <option value="Katolik">Katolik</option>
            <option value="Kristen">Kristen</option>
            <option value="Hindu">Hindu</option>
            <option value="Budha">Budha</option>
            <option value="Kepercayaan">Aliran Kepercayaan</option>
          </select>
          @error('religion')
          <div class="form-validation-error"><small>{{ $message }}</small></div>
          @enderror
        </div>
      </div>

      <div class="flex flex-wrap gap-y-6 md:flex-nowrap md:gap-x-4">
        <div class="w-full md:w-1/4">
          <label class="form-label">Pendidikan <span class="form-required">*</span></label>
          <select id="education" wire:model="education" name="education" class="mb-1">
            <option value="" disabled>-- Pilih--</option>
            <option value="6">S1</option>
            <option value="7">S2</option>
            <option value="8">S3</option>
            <option value="5">Akademi (D3)</option>
            <option value="4">SMA</option>
            <option value="3">SMP</option>
            <option value="2">SD</option>
            <option value="1">Lainnya</option>
          </select>
          @error('education')
          <div class="form-validation-error"><small>{{ $message }}</small></div>
          @enderror
        </div>
        <div class="w-full md:w-3/4">
          <label class="form-label">Nama Gadis Ibu Kandung <span class="form-required">*</span></label>
          <input type="text" wire:model.lazy="motherName" name="motherName"
            placeholder="Isi nama gadis Ibu Kandung Anda">
          @error('motherName')
          <div class="form-validation-error"><small>{{ $message }}</small></div>
          @enderror
        </div>
      </div>
    </div>
  </div>

  {{-- Data Kontak --}}
  <div class="flex flex-wrap px-4 py-6 lg:flex-nowrap lg:gap-6 lg:px-8 lg:py-11 border-b border-gray-200">
    <div class="w-full lg:w-1/4">
      <h3 class="text-xl font-bold mb-4">Data Kontak</h3>
    </div>

    <div class="w-full grid grid-cols-1 gap-6 lg:w-3/4">
      <div class="flex flex-wrap gap-y-6 md:flex-nowrap md:gap-x-4">

        <div class="w-full md:w-1/3">
          <label class="form-label">Email <span class="form-required">*</span></label>
          <input type="email" wire:model.lazy="email" name="email" placeholder="Isi alamat email Anda">
          @error('email')
          <div class="form-validation-error"><small>{{ $message }}</small></div>
          @enderror
        </div>

        <div class="w-full md:w-1/3">
          <div>
            <label class="form-label">Nomor Handphone <span class="form-required">*</span></label>

            <div wire:ignore>
              <input id="mobileNumber" type="tel" name="mobileNumber" placeholder="81234567890" class="mt-1">
              @error('mobileNumber')
              <div class="form-validation-error"><small>{{ $message }}</small></div>
              @enderror
            </div>
          </div>
        </div>

        <div class="w-full md:w-1/3">
          <div>
            <label class="form-label">Nomor Telepon Rumah</label>
            <div wire:ignore>
              <input id="phoneNumber" type="tel" name="phoneNumber" placeholder="21567890" class="mt-1">
              @error('phoneNumber')
              <div class="form-validation-error"><small>{{ $message }}</small></div>
              @enderror
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  {{-- Data Alamat --}}
  <div class="flex flex-wrap px-4 py-6 lg:flex-nowrap lg:gap-6 lg:px-8 lg:py-11 border-b border-gray-200">
    <div class="w-full lg:w-1/4">
      <h3 class="text-xl font-bold mb-4">Data Alamat</h3>
    </div>

    <div class="w-full grid grid-cols-1 gap-6 lg:w-3/4">

      <div class="flex flex-wrap gap-2">
        <div class="w-full">
          <h4 class="font-bold text-lg">Alamat Sesuai Identitas</h4>
        </div>
        <div class="w-full flex flex-wrap gap-y-2">
          <div class="w-full grid grid-cols-1 md:grid-cols-3 gap-x-4 gap-y-2">
            <div class="w-full md:col-span-full">
              <label class="form-label">Nama Jalan <span class="form-required">*</span></label>
              <input type="text" wire:model.lazy="idStreet1" name="idStreet1" placeholder="Cth: Jl Buncit Persada No 1">
              @error('idStreet1')
              <div class="form-validation-error"><small>{{ $message }}</small></div>
              @enderror
            </div>
            <div class="w-full md:col-span-2">
              <label class="form-label">Nama Gedung/Apartemen/Kluster/Komplek (Optional)</label>
              <input type="text" wire:model.lazy="idStreet2" name="idStreet2" placeholder="Cth: Alam Raya">
              @error('idStreet2')
              <div class="form-validation-error"><small>{{ $message }}</small></div>
              @enderror
            </div>
            <div class="w-full">
              <label class="form-label">RT/RW <span class="form-required">*</span></label>
              <input type="text" wire:model.lazy="idRtRw" name="idRtRw" placeholder="Cth: 004/008">
              @error('idRtRw')
              <div class="form-validation-error"><small>{{ $message }}</small></div>
              @enderror
            </div>
            <div class="w-full">
              <label class="form-label">Negara <span class="form-required">*</span></label>
              <div wire:ignore>
                <select id="idCountry" name="idCountry">
                  <option></option>
                  @foreach ($countries as $country)
                  <option value="{{ $country->name }}" {{ $country->name === 'INDONESIA' ? 'selected' : '' }}>
                    {{ $country->name }}
                  </option>
                  @endforeach
                </select>
              </div>
              @error('idCountry')
              <div class="form-validation-error"><small>{{ $message }}</small></div>
              @enderror
            </div>
            <div class="w-full">
              <label class="form-label">Provinsi <span class="form-required">*</span></label>
              @if ($idCountry === 'INDONESIA')
              <select wire:model="idProvince" name="idProvince" class="mb-1">
                <option value="">-- Pilih --</option>
                @foreach ($provinces as $province)
                <option value="{{ $province->id }}">{{ $province->name }}</option>
                @endforeach
              </select>
              @error('idProvince')
              <div class="form-validation-error"><small>{{ $message }}</small></div>
              @enderror
              @else
              <input type="text" wire:model.lazy="idProvinceText" name="idProvinceText" placeholder="Nama Provinsi">
              @error('idProvinceText')
              <div class="form-validation-error"><small>{{ $message }}</small></div>
              @enderror
              @endif
            </div>
            <div class="w-full">
              <label class="form-label">Kota <span class="form-required">*</span></label>
              @if ($idCountry === 'INDONESIA')
              <select wire:model="idCity" name="idCity" class="mb-1">
                <option value="">-- Pilih --</option>
                @foreach ($idCities as $city)
                <option value="{{ $city->id }}">{{ $city->name }}</option>
                @endforeach
              </select>
              @error('idCity')
              <div class="form-validation-error"><small>{{ $message }}</small></div>
              @enderror
              @else
              <input type="text" wire:model.lazy="idCityText" name="idCityText" placeholder="Nama Kota">
              @error('idCityText')
              <div class="form-validation-error"><small>{{ $message }}</small></div>
              @enderror
              @endif
            </div>
            <div class="w-full">
              <label class="form-label">Kode Pos <span class="form-required">*</span></label>
              <input type="text" wire:model.lazy="idZip" name="idZip" placeholder="Cth: 11250">
              @error('idZip')
              <div class="form-validation-error"><small>{{ $message }}</small></div>
              @enderror
            </div>
            <div class="w-full">
              <label class="form-label">Kecamatan <span class="form-required">*</span></label>
              @if ($idCountry === 'INDONESIA')
              <select wire:model="idDistrict" name="idDistrict" class="mb-1">
                <option value="">-- Pilih --</option>
                @foreach ($idDistricts as $district)
                <option value="{{ $district->id }}">{{ $district->name }}</option>
                @endforeach
              </select>
              @error('idDistrict')
              <div class="form-validation-error"><small>{{ $message }}</small></div>
              @enderror
              @else
              <input type="text" wire:model.lazy="idDistrictText" name="idDistrictText" placeholder="Nama Kecamatan">
              @error('idDistrictText')
              <div class="form-validation-error"><small>{{ $message }}</small></div>
              @enderror
              @endif
            </div>
            <div class="w-full">
              <label class="form-label">Kelurahan <span class="form-required">*</span></label>
              @if ($idCountry === 'INDONESIA')
              <select wire:model="idSubDistrict" name="idSubDistrict" class="mb-1">
                <option value="">-- Pilih --</option>
                @foreach ($idSubDistricts as $subDistrict)
                <option value="{{ $subDistrict->id }}">{{ $subDistrict->name }}</option>
                @endforeach
              </select>
              @error('idSubDistrict')
              <div class="form-validation-error"><small>{{ $message }}</small></div>
              @enderror
              @else
              <input type="text" wire:model.lazy="idSubDistrictText" name="idSubDistrictText"
                placeholder="Nama Kelurahan">
              @error('idSubDistrictText')
              <div class="form-validation-error"><small>{{ $message }}</small></div>
              @enderror
              @endif
            </div>
          </div>
        </div>
      </div>

      <div class="flex flex-wrap gap-2">
        <div class="w-full mt-4">
          <h4 class="font-bold text-lg">Alamat Tempat Tinggal</h4>
        </div>
        <div class="w-full">
          <div class="form-check mt-1 inline-flex">
            <input wire:model="homeIsId" type="checkbox" name="homeIsId" value="1" id="homeIsId"
              class="form-check-input">
            <label class="form-check-label inline-block ml-2" for="homeIsId">
              Sama dengan alamat identitas
            </label>
          </div>
        </div>
        @if (!$homeIsId)
        <div class="w-full flex flex-wrap gap-y-2">
          <div class="w-full grid grid-cols-1 md:grid-cols-3 gap-x-4 gap-y-2">
            <div class="w-full md:col-span-full">
              <label class="form-label">Nama Jalan <span class="form-required">*</span></label>
              <input type="text" wire:model.lazy="homeStreet1" name="homeStreet1"
                placeholder="Cth: Jl Buncit Persada No 1">
              @error('homeStreet1')
              <div class="form-validation-error"><small>{{ $message }}</small></div>
              @enderror
            </div>
            <div class="w-full md:col-span-2">
              <label class="form-label">Nama Gedung/Apartemen/Kluster/Komplek (Optional)</label>
              <input type="text" wire:model.lazy="homeStreet2" name="homeStreet2" placeholder="Cth: Alam Raya">
              @error('homeStreet2')
              <div class="form-validation-error"><small>{{ $message }}</small></div>
              @enderror
            </div>
            <div class="w-full">
              <label class="form-label">RT/RW <span class="form-required">*</span></label>
              <input type="text" wire:model.lazy="homeRtRw" name="homeRtRw" placeholder="Cth: 004/008">
              @error('homeRtRw')
              <div class="form-validation-error"><small>{{ $message }}</small></div>
              @enderror
            </div>
            <div class="w-full">
              <label class="form-label">Negara <span class="form-required">*</span></label>
              <div wire:ignore>
                <select id="homeCountry" name="homeCountry">
                  <option></option>
                  @foreach ($countries as $country)
                  <option value="{{ $country->name }}" {{ $country->name === 'INDONESIA' ? 'selected' : '' }}>
                    {{ $country->name }}
                  </option>
                  @endforeach
                </select>
              </div>
              @error('homeCountry')
              <div class="form-validation-error"><small>{{ $message }}</small></div>
              @enderror
            </div>
            <div class="w-full">
              <label class="form-label">Provinsi <span class="form-required">*</span></label>
              @if ($homeCountry === 'INDONESIA')
              <select wire:model="homeProvince" name="homeProvince" class="mb-1">
                <option value="">-- Pilih --</option>
                @foreach ($provinces as $province)
                <option value="{{ $province->id }}">{{ $province->name }}</option>
                @endforeach
              </select>
              @error('homeProvince')
              <div class="form-validation-error"><small>{{ $message }}</small></div>
              @enderror
              @else
              <input type="text" wire:model.lazy="homeProvinceText" name="homeProvinceText" placeholder="Nama Provinsi">
              @error('homeProvinceText')
              <div class="form-validation-error"><small>{{ $message }}</small></div>
              @enderror
              @endif
            </div>
            <div class="w-full">
              <label class="form-label">Kota <span class="form-required">*</span></label>
              @if ($homeCountry === 'INDONESIA')
              <select wire:model="homeCity" name="homeCity" class="mb-1">
                <option value="">-- Pilih --</option>
                @foreach ($homeCities as $city)
                <option value="{{ $city->id }}">{{ $city->name }}</option>
                @endforeach
              </select>
              @error('homeCity')
              <div class="form-validation-error"><small>{{ $message }}</small></div>
              @enderror
              @else
              <input type="text" wire:model.lazy="homeCityText" name="homeCityText" placeholder="Nama Kota">
              @error('homeCityText')
              <div class="form-validation-error"><small>{{ $message }}</small></div>
              @enderror
              @endif
            </div>
            <div class="w-full">
              <label class="form-label">Kode Pos <span class="form-required">*</span></label>
              <input type="text" wire:model.lazy="homeZip" name="homeZip" placeholder="Cth: 11250">
              @error('homeZip')
              <div class="form-validation-error"><small>{{ $message }}</small></div>
              @enderror
            </div>
            <div class="w-full">
              <label class="form-label">Kecamatan <span class="form-required">*</span></label>
              @if ($homeCountry === 'INDONESIA')
              <select wire:model="homeDistrict" name="homeDistrict" class="mb-1">
                <option value="">-- Pilih --</option>
                @foreach ($homeDistricts as $district)
                <option value="{{ $district->id }}">{{ $district->name }}</option>
                @endforeach
              </select>
              @error('homeDistrict')
              <div class="form-validation-error"><small>{{ $message }}</small></div>
              @enderror
              @else
              <input type="text" wire:model.lazy="homeDistrictText" name="homeDistrictText"
                placeholder="Nama Kecamatan">
              @error('homeDistrictText')
              <div class="form-validation-error"><small>{{ $message }}</small></div>
              @enderror
              @endif
            </div>
            <div class="w-full">
              <label class="form-label">Kelurahan <span class="form-required">*</span></label>
              @if ($homeCountry === 'INDONESIA')
              <select wire:model="homeSubDistrict" name="homeSubDistrict" class="mb-1">
                <option value="">-- Pilih --</option>
                @foreach ($homeSubDistricts as $subDistrict)
                <option value="{{ $subDistrict->id }}">{{ $subDistrict->name }}</option>
                @endforeach
              </select>
              @error('homeSubDistrict')
              <div class="form-validation-error"><small>{{ $message }}</small></div>
              @enderror
              @else
              <input type="text" wire:model.lazy="homeSubDistrictText" name="homeSubDistrictText"
                placeholder="Nama Kelurahan">
              @error('homeSubDistrictText')
              <div class="form-validation-error"><small>{{ $message }}</small></div>
              @enderror
              @endif
            </div>
          </div>
        </div>
        @endif

        <div class="w-full flex flex-wrap gap-y-2 mt-4">
          <div class="w-full grid grid-cols-1 md:grid-cols-2 gap-x-4 gap-y-2">
            <div class="w-full">
              <label class="form-label">Status Tempat Tinggal <span class="form-required">*</span></label>
              <select wire:model="homeStatus" name="homeStatus" class="mb-1">
                <option value="" disabled>-- Pilih --</option>
                <option value="Milik Keluarga">Milik Keluarga</option>
                <option value="Milik Sendiri">Milik Sendiri</option>
                <option value="Milik Suami/Istri">Milik Suami/Istri</option>
                <option value="Rumah Dinas">Rumah Dinas</option>
                <option value="Sewa/Kontrak">Sewa/Kontrak</option>
              </select>
            </div>

            <div class="w-full">
              <label class="form-label">Menempati Sejak</label>
              <div class="flex flex-nowrap gap-2">
                <select id="homeMonth" wire:model="homeMonth" name="homeMonth" class="mb-1">
                  <option value="" disabled>Bln</option>
                  @for ($i = 1; $i <= 12; $i++) <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                </select>
                <select id="homeYear" wire:model="homeYear" name="homeYear" class="mb-1">
                  <option value="" disabled>Thn</option>
                  @for ($i = date("Y"); $i >= (date("Y") - 100); $i--)
                  <option value="{{ $i }}">{{ $i }}</option>
                  @endfor
                </select>
              </div>

              @error('homeMonth')
              <div class="form-validation-error"><small>{{ $message }}</small></div>
              @enderror
              @error('homeYear')
              <div class="form-validation-error"><small>{{ $message }}</small></div>
              @enderror

            </div>

          </div>
        </div>

      </div>

      <div class="flex flex-wrap gap-2">
        <div class="w-full mt-4">
          <h4 class="font-bold text-lg">Alamat Korespondensi</h4>
        </div>
        <div class="w-full flex flex-wrap gap-y-2">
          <div class="w-full grid grid-cols-1 md:grid-cols-2 gap-x-4 gap-y-2">
            <div class="w-full">
              <label class="form-label">Alamat Korespondensi <span class="form-required">*</span></label>
              <select wire:model="postalPreference" name="postalPreference" class="mb-1">
                <option value="" disabled>-- Pilih --</option>
                <option value="Alamat Identitas">Sesuai Alamat Identitas</option>
                <option value="Alamat Tempat Tinggal">Alamat Tempat Tinggal</option>
                <option value="Alamat Kantor">Alamat Kantor</option>
              </select>
            </div>
            <div class="w-full">
              <label class="form-label">Pengiriman Konfirmasi <span class="form-required">*</span></label>
              <select wire:model="confirmVia" name="confirmVia" class="mb-1">
                <option value="" disabled>-- Pilih --</option>
                <option value="Faksimili">Via Faksimili</option>
                <option value="Email">Via Email</option>
              </select>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>

  {{-- Informasi Tambahan --}}
  <div class="flex flex-wrap px-4 py-6 lg:flex-nowrap lg:gap-6 lg:px-8 lg:py-11">
    <div class="w-full lg:w-1/4">
      <h3 class="text-xl font-bold">Informasi Tambahan</h3>
      <p class="mt-1 mb-4 text-sm text-gray-600"><em>Centang informasi yang sesuai dengan Anda</em></p>
    </div>

    <div class="w-full grid grid-cols-1 gap-3 lg:w-3/4">
      <div class="w-full">
        <div class="form-check mt-1 inline-flex">
          <input wire:model="infoQ1" type="checkbox" name="infoQ1" id="infoQ1" class="form-check-input">
          <label class="form-check-label inline-block ml-2" for="infoQ1">
            Saya atau anggota keluarga Saya bekerja pada Perusahaan Efek, Bursa Efek, perusahaan yang diatur oleh Bursa
            Efek/BAPEPAM dan LK, Bank, Asuransi atau Lembaga Keuangan sejenis.
          </label>
        </div>
        @if ($infoQ1)
        <div class="w-full mt-2 mb-2 pl-6">
          <input type="text" wire:model.lazy="infoQ1Text" name="infoQ1Text"
            placeholder="Sebutkan nama Perusahaan/Lembaga tersebut *">
          @error('infoQ1Text')
          <div class="form-validation-error"><small>{{ $message }}</small></div>
          @enderror
        </div>
        @endif
      </div>

      <div class="w-full">
        <div class="form-check mt-1 inline-flex">
          <input wire:model="infoQ2" type="checkbox" name="infoQ2" id="infoQ2" class="form-check-input">
          <label class="form-check-label inline-block ml-2" for="infoQ2">
            Saya sudah memiliki Rekening Efek pada Perusahaan Efek lain.
          </label>
        </div>
        @if ($infoQ2)
        <div class="w-full mt-2 mb-2 pl-6">
          <input type="text" wire:model.lazy="infoQ2Text" name="infoQ2Text"
            placeholder="Sebutkan nama Perusahaan Efek tersebut *">
          @error('infoQ2Text')
          <div class="form-validation-error"><small>{{ $message }}</small></div>
          @enderror
        </div>
        @endif
      </div>

      <div class="w-full">
        <div class="form-check mt-1 inline-flex">
          <input wire:model="infoQ3" type="checkbox" name="infoQ3" id="infoQ3" class="form-check-input">
          <label class="form-check-label inline-block ml-2" for="infoQ3">
            Saya memiliki 5% atau lebih saham suatu perusahaan publik.
          </label>
        </div>
        @if ($infoQ3)
        <div class="w-full mt-2 pl-6">
          <input type="text" wire:model.lazy="infoQ3Text" name="infoQ3Text"
            placeholder="Sebutkan nama saham publik tersebut">
          @error('infoQ3Text')
          <div class="form-validation-error"><small>{{ $message }}</small></div>
          @enderror
        </div>
        @endif
      </div>


    </div>
  </div>

</div>

<script>
  $(document).ready(function() {
    $('#nationality').select2({
      placeholder: "-- Pilih --",
    });
    $('#birthCountry').select2({
      placeholder: "-- Pilih --",
    });
    $('#birthPlace').select2({
      placeholder: "-- Pilih --",
    });
    $('#idCountry').select2({
      placeholder: "-- Pilih --",
    });
    $('#homeCountry').select2({
      placeholder: "-- Pilih --",
    });
    $('#postalAddressCountry').select2({
      placeholder: "-- Pilih --",
    });
    // let localNationality = localStorage.getItem('nationality');
    // if (localNationality) {
    //   $('#nationality').val(localNationality);
    //   $('#nationality').trigger('change');
    //   @this.set('nationality', localNationality);
    // }
    $('#nationality').on('change', function(e) {
      @this.set('nationality', e.target.value);
      localStorage.setItem('nationality', e.target.value);
    });
    $('#birthCountry').on('change', function(e) {
      @this.set('birthCountry', e.target.value);
    });
    $('#birthPlace').on('change', function(e) {
      @this.set('birthPlace', e.target.value);
    });
    $('#idCountry').on('change', function(e) {
      @this.set('idCountry', e.target.value);
    });
    $('#homeCountry').on('change', function(e) {
      @this.set('homeCountry', e.target.value);
    });
    $('#postalAddressCountry').on('change', function(e) {
      @this.set('postalAddressCountry', e.target.value);
    });

    const mobileInput = window.intlTelInput(document.querySelector("#mobileNumber"), {
      initialCountry: "id",
      separateDialCode: true,
      preferredCountries: ["id", "sg", "au", "my"],
      utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.min.js",
    });
    $('#mobileNumber').on('change', function(e) {
      let mobileNumber = mobileInput.getNumber();
      let countryData = mobileInput.getSelectedCountryData();
      //console.log(countryData.dialCode);
      //console.log(mobileNumber);
      @this.set('mobileCountryCode', countryData.dialCode);
      @this.set('mobileNumber', mobileNumber);
    });

    const phoneInput = window.intlTelInput(document.querySelector("#phoneNumber"), {
      initialCountry: "id",
      separateDialCode: true,
      preferredCountries: ["id", "sg", "au", "my"],
      utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.min.js",
    });
    $('#phoneNumber').on('change', function(e) {
      let phoneNumber = phoneInput.getNumber();
      let countryData = phoneInput.getSelectedCountryData();
      @this.set('phoneCountryCode', countryData.dialCode);
      @this.set('phoneNumber', phoneNumber);
    });
  });
</script>