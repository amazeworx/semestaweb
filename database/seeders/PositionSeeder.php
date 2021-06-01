<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PositionSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $positions = [
      ['id' => '1', 'name' => 'Pelajar/Mahasiswa'],
      ['id' => '2', 'name' => 'PNS Esselon 1'],
      ['id' => '3', 'name' => 'PNS Esselon 2'],
      ['id' => '4', 'name' => 'Hakim'],
      ['id' => '5', 'name' => 'Jaksa'],
      ['id' => '6', 'name' => 'Panitera'],
      ['id' => '7', 'name' => 'PNS Penyidik'],
      ['id' => '8', 'name' => 'PNS Auditor Pajak'],
      ['id' => '9', 'name' => 'PNS Auditor BPKP'],
      ['id' => '10', 'name' => 'PNS Auditor BPK'],
      ['id' => '11', 'name' => 'Ka. Kantor Pajak'],
      ['id' => '12', 'name' => 'Ka. Kantor Bea Cukai'],
      ['id' => '13', 'name' => 'Ka. Kas Negara'],
      ['id' => '14', 'name' => 'Pengawas Bea Cukai'],
      ['id' => '15', 'name' => 'Penyidik'],
      ['id' => '16', 'name' => 'Perwira Tinggi'],
      ['id' => '17', 'name' => 'Presiden'],
      ['id' => '18', 'name' => 'Wakil Presiden'],
      ['id' => '19', 'name' => 'Anggota MPR'],
      ['id' => '20', 'name' => 'Anggota DPR'],
      ['id' => '21', 'name' => 'Anggota DPD'],
      ['id' => '22', 'name' => 'Watimpres'],
      ['id' => '23', 'name' => 'Pimpinan MA'],
      ['id' => '24', 'name' => 'Pimpinan BPK'],
      ['id' => '25', 'name' => 'Anggota Komisi Yudisial'],
      ['id' => '26', 'name' => 'Dewan Gubernur BI'],
      ['id' => '27', 'name' => 'Dewan Komisioner OJK'],
      ['id' => '28', 'name' => 'Pimpinan Komisi'],
      ['id' => '29', 'name' => 'Gubernur'],
      ['id' => '30', 'name' => 'Wakil Gubernur'],
      ['id' => '31', 'name' => 'Anggota DPRD I'],
      ['id' => '32', 'name' => 'Bupati/Walikota'],
      ['id' => '33', 'name' => 'Wakil Bupati/Walikota'],
      ['id' => '34', 'name' => 'Anggota DPRD II'],
      ['id' => '35', 'name' => 'Pimpinan PTN'],
      ['id' => '36', 'name' => 'Direktur BUMN/BUMD'],
      ['id' => '37', 'name' => 'Pensiunan PNS Esselon 1/2'],
      ['id' => '38', 'name' => 'Pensiunan Perwira Tinggi'],
      ['id' => '39', 'name' => 'Pensiunan Pejabat Daerah'],
      ['id' => '40', 'name' => 'Pemilik'],
      ['id' => '41', 'name' => 'Pejabat Senior'],
      ['id' => '42', 'name' => 'Konsultan Hukum'],
      ['id' => '43', 'name' => 'Konsultan Pajak'],
      ['id' => '44', 'name' => 'Konsultan Keuangan'],
      ['id' => '45', 'name' => 'Pengurus Partai Politik'],
      ['id' => '46', 'name' => 'Pengurus Ormas/LSM'],
      ['id' => '47', 'name' => 'Pengurus Organisasi Non-Profit'],
      ['id' => '48', 'name' => 'Dokter Umum'],
      ['id' => '49', 'name' => 'Dokter Spesialis'],
      ['id' => '50', 'name' => 'Pengacara'],
      ['id' => '51', 'name' => 'Akuntan'],
      ['id' => '52', 'name' => 'Wartawan'],
      ['id' => '53', 'name' => 'Seniman'],
      ['id' => '54', 'name' => 'Notaris'],
      ['id' => '97', 'name' => 'Guru'],
      ['id' => '98', 'name' => 'Ibu Rumah Tangga'],
      ['id' => '99', 'name' => 'Lainnya'],
    ];
    DB::table('positions')->insert($positions);
  }
}
