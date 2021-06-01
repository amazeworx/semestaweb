<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BusinessSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $businesses = [
      ['id' => '1', 'name' => 'Pendidikan'],
      ['id' => '2', 'name' => 'Pemerintahan'],
      ['id' => '3', 'name' => 'Pengolahan Hasil Hutan'],
      ['id' => '4', 'name' => 'Barang Seni/Antik'],
      ['id' => '5', 'name' => 'Batu Permata/Logam Mulia'],
      ['id' => '6', 'name' => 'Eksim Minyak'],
      ['id' => '7', 'name' => 'Eksim Mineral'],
      ['id' => '8', 'name' => 'SPBU'],
      ['id' => '9', 'name' => 'Minimarket'],
      ['id' => '10', 'name' => 'Barang/Kendaraan Mewah'],
      ['id' => '11', 'name' => 'Senjata Api/Peledak/Alusista'],
      ['id' => '12', 'name' => 'Money Changer'],
      ['id' => '13', 'name' => 'Pengiriman Uang'],
      ['id' => '14', 'name' => 'Investasi Logam Mulia'],
      ['id' => '15', 'name' => 'Konsultan Hukum'],
      ['id' => '16', 'name' => 'Konsultan Pajak'],
      ['id' => '17', 'name' => 'Konsultan Keuangan'],
      ['id' => '18', 'name' => 'Properti'],
      ['id' => '19', 'name' => 'Survey'],
      ['id' => '20', 'name' => 'Tour dan Travel'],
      ['id' => '21', 'name' => 'Freight Fowarding'],
      ['id' => '22', 'name' => 'Pengelola Parkir'],
      ['id' => '23', 'name' => 'Kasino/Executive Club'],
      ['id' => '24', 'name' => 'Organisasi International'],
      ['id' => '25', 'name' => 'Hukum'],
      ['id' => '26', 'name' => 'Pajak'],
      ['id' => '27', 'name' => 'Keuangan'],
      ['id' => '28', 'name' => 'Politik'],
      ['id' => '29', 'name' => 'Ormas/LSM'],
      ['id' => '30', 'name' => 'Organisasi Non-Profit'],
      ['id' => '31', 'name' => 'Kesehatan'],
      ['id' => '32', 'name' => 'Media'],
      ['id' => '33', 'name' => 'Seni dan Budaya'],
      ['id' => '34', 'name' => 'Hukum PPAT'],
      ['id' => '98', 'name' => 'Ibu Rumah Tangga'],
      ['id' => '99', 'name' => 'Lainnya'],
    ];
    DB::table('businesses')->insert($businesses);
  }
}
