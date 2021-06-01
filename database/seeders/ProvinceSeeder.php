<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProvinceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      //DB::table('provinces')->truncate();

      $provinces = [
        ['id' => '11', 'name' => 'ACEH', 'ksei_code' => '20', 'ksei_name' => 'NANGGROE ACEH DARUSSALAM'],
        ['id' => '12', 'name' => 'SUMATERA UTARA', 'ksei_code' => '33', 'ksei_name' => 'SUMATERA UTARA'],
        ['id' => '13', 'name' => 'SUMATERA BARAT', 'ksei_code' => '31', 'ksei_name' => 'SUMATERA BARAT'],
        ['id' => '14', 'name' => 'RIAU', 'ksei_code' => '25', 'ksei_name' => 'RIAU'],
        ['id' => '15', 'name' => 'JAMBI', 'ksei_code' => '7', 'ksei_name' => 'JAMBI'],
        ['id' => '16', 'name' => 'SUMATERA SELATAN', 'ksei_code' => '32', 'ksei_name' => 'SUMATERA SELATAN'],
        ['id' => '17', 'name' => 'BENGKULU', 'ksei_code' => '3', 'ksei_name' => 'BENGKULU'],
        ['id' => '18', 'name' => 'LAMPUNG', 'ksei_code' => '17', 'ksei_name' => 'LAMPUNG'],
        ['id' => '19', 'name' => 'KEPULAUAN BANGKA BELITUNG', 'ksei_code' => '15', 'ksei_name' => 'KEPULAUAN BANGKA BELITUNG'],
        ['id' => '21', 'name' => 'KEPULAUAN RIAU', 'ksei_code' => '16', 'ksei_name' => 'KEPULAUAN RIAU'],
        ['id' => '31', 'name' => 'DKI JAKARTA', 'ksei_code' => '5', 'ksei_name' => 'DKI. JAKARTA'],
        ['id' => '32', 'name' => 'JAWA BARAT', 'ksei_code' => '8', 'ksei_name' => 'JAWA BARAT'],
        ['id' => '33', 'name' => 'JAWA TENGAH', 'ksei_code' => '9', 'ksei_name' => 'JAWA TENGAH'],
        ['id' => '34', 'name' => 'DI YOGYAKARTA', 'ksei_code' => '4', 'ksei_name' => 'D.I. YOGYAKARTA'],
        ['id' => '35', 'name' => 'JAWA TIMUR', 'ksei_code' => '10', 'ksei_name' => 'JAWA TIMUR'],
        ['id' => '36', 'name' => 'BANTEN', 'ksei_code' => '2', 'ksei_name' => 'BANTEN'],
        ['id' => '51', 'name' => 'BALI', 'ksei_code' => '1', 'ksei_name' => 'BALI'],
        ['id' => '52', 'name' => 'NUSA TENGGARA BARAT', 'ksei_code' => '21', 'ksei_name' => 'NUSA TENGGARA BARAT'],
        ['id' => '53', 'name' => 'NUSA TENGGARA TIMUR', 'ksei_code' => '22', 'ksei_name' => 'NUSA TENGGARA TIMUR'],
        ['id' => '61', 'name' => 'KALIMANTAN BARAT', 'ksei_code' => '11', 'ksei_name' => 'KALIMANTAN BARAT'],
        ['id' => '62', 'name' => 'KALIMANTAN TENGAH', 'ksei_code' => '13', 'ksei_name' => 'KALIMANTAN TENGAH'],
        ['id' => '63', 'name' => 'KALIMANTAN SELATAN', 'ksei_code' => '12', 'ksei_name' => 'KALIMANTAN SELATAN'],
        ['id' => '64', 'name' => 'KALIMANTAN TIMUR', 'ksei_code' => '14', 'ksei_name' => 'KALIMANTAN TIMUR'],
        ['id' => '65', 'name' => 'KALIMANTAN UTARA', 'ksei_code' => '34', 'ksei_name' => 'KALIMANTAN UTARA'],
        ['id' => '71', 'name' => 'SULAWESI UTARA', 'ksei_code' => '30', 'ksei_name' => 'SULAWESI UTARA'],
        ['id' => '72', 'name' => 'SULAWESI TENGAH', 'ksei_code' => '28', 'ksei_name' => 'SULAWESI TENGAH'],
        ['id' => '73', 'name' => 'SULAWESI SELATAN', 'ksei_code' => '27', 'ksei_name' => 'SULAWESI SELATAN'],
        ['id' => '74', 'name' => 'SULAWESI TENGGARA', 'ksei_code' => '29', 'ksei_name' => 'SULAWESI TENGGARA'],
        ['id' => '75', 'name' => 'GORONTALO', 'ksei_code' => '6', 'ksei_name' => 'GORONTALO'],
        ['id' => '76', 'name' => 'SULAWESI BARAT', 'ksei_code' => '26', 'ksei_name' => 'SULAWESI BARAT'],
        ['id' => '81', 'name' => 'MALUKU', 'ksei_code' => '18', 'ksei_name' => 'MALUKU'],
        ['id' => '82', 'name' => 'MALUKU UTARA', 'ksei_code' => '19', 'ksei_name' => 'MALUKU UTARA'],
        ['id' => '91', 'name' => 'PAPUA BARAT', 'ksei_code' => '24', 'ksei_name' => 'PAPUA BARAT'],
        ['id' => '94', 'name' => 'PAPUA', 'ksei_code' => '23', 'ksei_name' => 'PAPUA'],
        ['id' => '999', 'name' => 'OTHERS', 'ksei_code' => '999', 'ksei_name' => 'OTHERS'],
        ['id' => '1000', 'name' => 'FOREIGN', 'ksei_code' => '1000', 'ksei_name' => 'FOREIGN']
      ];

      DB::table('provinces')->insert($provinces);
    }
}
