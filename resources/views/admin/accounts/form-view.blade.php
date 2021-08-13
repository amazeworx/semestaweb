<x-page-layout>
  <page size="A4">
    <a href="{{ URL::to('/pdf/149') }}">Export to PDF</a>
    <div class="block mb-2">
      <img class="h-20 w-auto" src="/images/logo_semesta_indovest_sekuritas.png" alt="Semesta Indovest Sekuritas"
        width="86" height="82">
    </div>
    <div class="block mb-2">
      <h1 class="text-title">FORMULIR PEMBUKAAN REKENING EFEK INDIVIDU</h1>
    </div>

    <table class="mb-2">
      <tr>
        <td width="50%" class="ver-align-middle">
          <table>
            <td class="shrink ver-align-middle"><strong>Cabang: </strong></td>
            <td class="expand">
              <div class="w-full border-b border-black"></div>
            </td>
          </table>
        </td>
        <td width="50%" class="ver-align-middle">
          <table>
            <td class="shrink ver-align-middle"><strong>No. Rekening: </strong></td>
            <td class="expand ver-align-middle">
              <table class="w-auto">
                <td class="fill-box fill-box-lg"></td>
                <td class="fill-box fill-box-lg"></td>
                <td class="fill-box fill-box-lg"></td>
                <td class=""> - </td>
                <td class="fill-box fill-box-lg"></td>
                <td class="fill-box fill-box-lg"></td>
                <td class="fill-box fill-box-lg"></td>
              </table>
            </td>
          </table>
        </td>
      </tr>
    </table>

    <table class="table-box">
      <thead>
        <tr>
          <td colspan="2">
            <h2>DATA PRIBADI PEMOHON</h2>
          </td>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td colspan="2">
            <table>
              <tr>
                <td class="field-name">Nama sesuai Identitas</td>
                <td class="field-colon">:</td>
                <td class="field-entry">
                  <div class="w-full border-b border-black">{{ $data->full_name }}</div>
                </td>
              </tr>
            </table>
          </td>
        </tr>
        <tr>
          <td colspan="2">
            <table>
              <tr>
                <td class="field-name">Jenis Kartu Identitas</td>
                <td class="field-colon">:</td>
                <td class="field-entry">
                  <table>
                    <tr>
                      <td class="fill-box"></td>
                      <td style="padding-left: 10px">KTP</td>
                      <td class="fill-box"></td>
                      <td style="padding-left: 10px">Paspor</td>
                    </tr>
                  </table>
                </td>
              </tr>
            </table>
          </td>
        </tr>
        <tr>
          <td width="50%">
            <table>
              <tr>
                <td class="field-name">Nomor Identitas</td>
                <td class="field-colon">:</td>
                <td class="field-entry">
                  <div class="w-full border-b border-black">{{ $data->full_name }}</div>
                </td>
              </tr>
            </table>
          </td>
          <td width="50%">
            <table>
              <tr>
                <td class="field-name">Berlaku s/d.</td>
                <td class="field-colon">:</td>
                <td class="field-entry">
                  <table>
                    <tr>
                      <td class="fill-box"></td>
                      <td class="fill-box"></td>
                      <td> - </td>
                      <td class="fill-box"></td>
                      <td class="fill-box"></td>
                      <td> - </td>
                      <td class="fill-box"></td>
                      <td class="fill-box"></td>
                      <td class="fill-box"></td>
                      <td class="fill-box"></td>
                    </tr>
                  </table>
                </td>
              </tr>
            </table>
          </td>
        </tr>
      </tbody>
    </table>

  </page>
</x-page-layout>