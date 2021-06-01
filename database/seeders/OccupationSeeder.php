<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OccupationSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {

    $occupations = [
      ['id' => '1', 'name' => 'Pelajar/Mahasiswa', 'ksei_code' => '6'],
      ['id' => '2', 'name' => 'Ibu Rumah Tangga', 'ksei_code' => '4'],
      ['id' => '3', 'name' => 'Karyawan Swasta', 'ksei_code' => '2'],
      ['id' => '4', 'name' => 'Pegawai Negeri', 'ksei_code' => '3'],
      ['id' => '5', 'name' => 'TNI/Polri', 'ksei_code' => '7'],
      ['id' => '6', 'name' => 'Pejabat Negara/Daerah', 'ksei_code' => '3'],
      ['id' => '7', 'name' => 'Pensiunan', 'ksei_code' => '8'],
      ['id' => '8', 'name' => 'Pengusaha Pabrikan', 'ksei_code' => '5'],
      ['id' => '9', 'name' => 'Pedagang', 'ksei_code' => '5'],
      ['id' => '10', 'name' => 'Pengusaha Jasa', 'ksei_code' => '5'],
      ['id' => '15', 'name' => 'Guru', 'ksei_code' => '9'],
      ['id' => '17', 'name' => 'Profesional', 'ksei_code' => '1'],
      ['id' => '18', 'name' => 'Lainnya', 'ksei_code' => '1'],
    ];
    DB::table('occupations')->insert($occupations);
  }
}
