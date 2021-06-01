<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BusinessOccupationPositionSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $data = [
      ['id' => '1', 'occupation_id' => '1', 'position_id' => '1', 'business_id' => '1'],
      ['id' => '2', 'occupation_id' => '2', 'position_id' => '98', 'business_id' => '98'],
      ['id' => '3', 'occupation_id' => '4', 'position_id' => '2', 'business_id' => '2'],
      ['id' => '4', 'occupation_id' => '4', 'position_id' => '3', 'business_id' => '2'],
      ['id' => '5', 'occupation_id' => '4', 'position_id' => '4', 'business_id' => '2'],
      ['id' => '6', 'occupation_id' => '4', 'position_id' => '5', 'business_id' => '2'],
      ['id' => '7', 'occupation_id' => '4', 'position_id' => '6', 'business_id' => '2'],
      ['id' => '8', 'occupation_id' => '4', 'position_id' => '7', 'business_id' => '2'],
      ['id' => '9', 'occupation_id' => '4', 'position_id' => '8', 'business_id' => '2'],
      ['id' => '10', 'occupation_id' => '4', 'position_id' => '9', 'business_id' => '2'],
      ['id' => '11', 'occupation_id' => '4', 'position_id' => '10', 'business_id' => '2'],
      ['id' => '12', 'occupation_id' => '4', 'position_id' => '11', 'business_id' => '2'],
      ['id' => '13', 'occupation_id' => '4', 'position_id' => '12', 'business_id' => '2'],
      ['id' => '14', 'occupation_id' => '4', 'position_id' => '13', 'business_id' => '2'],
      ['id' => '15', 'occupation_id' => '4', 'position_id' => '14', 'business_id' => '2'],
      ['id' => '16', 'occupation_id' => '4', 'position_id' => '99', 'business_id' => '2'],
      ['id' => '17', 'occupation_id' => '5', 'position_id' => '15', 'business_id' => '2'],
      ['id' => '18', 'occupation_id' => '5', 'position_id' => '16', 'business_id' => '2'],
      ['id' => '19', 'occupation_id' => '5', 'position_id' => '99', 'business_id' => '2'],
      ['id' => '20', 'occupation_id' => '6', 'position_id' => '17', 'business_id' => '2'],
      ['id' => '21', 'occupation_id' => '6', 'position_id' => '18', 'business_id' => '2'],
      ['id' => '22', 'occupation_id' => '6', 'position_id' => '19', 'business_id' => '2'],
      ['id' => '23', 'occupation_id' => '6', 'position_id' => '20', 'business_id' => '2'],
      ['id' => '24', 'occupation_id' => '6', 'position_id' => '21', 'business_id' => '2'],
      ['id' => '25', 'occupation_id' => '6', 'position_id' => '22', 'business_id' => '2'],
      ['id' => '26', 'occupation_id' => '6', 'position_id' => '23', 'business_id' => '2'],
      ['id' => '27', 'occupation_id' => '6', 'position_id' => '24', 'business_id' => '2'],
      ['id' => '28', 'occupation_id' => '6', 'position_id' => '25', 'business_id' => '2'],
      ['id' => '29', 'occupation_id' => '6', 'position_id' => '26', 'business_id' => '2'],
      ['id' => '30', 'occupation_id' => '6', 'position_id' => '27', 'business_id' => '2'],
      ['id' => '31', 'occupation_id' => '6', 'position_id' => '28', 'business_id' => '2'],
      ['id' => '32', 'occupation_id' => '6', 'position_id' => '29', 'business_id' => '2'],
      ['id' => '33', 'occupation_id' => '6', 'position_id' => '30', 'business_id' => '2'],
      ['id' => '34', 'occupation_id' => '6', 'position_id' => '31', 'business_id' => '2'],
      ['id' => '35', 'occupation_id' => '6', 'position_id' => '32', 'business_id' => '2'],
      ['id' => '36', 'occupation_id' => '6', 'position_id' => '33', 'business_id' => '2'],
      ['id' => '37', 'occupation_id' => '6', 'position_id' => '34', 'business_id' => '2'],
      ['id' => '38', 'occupation_id' => '6', 'position_id' => '35', 'business_id' => '2'],
      ['id' => '39', 'occupation_id' => '6', 'position_id' => '36', 'business_id' => '2'],
      ['id' => '40', 'occupation_id' => '6', 'position_id' => '99', 'business_id' => '2'],
      ['id' => '41', 'occupation_id' => '7', 'position_id' => '37', 'business_id' => '2'],
      ['id' => '42', 'occupation_id' => '7', 'position_id' => '38', 'business_id' => '2'],
      ['id' => '43', 'occupation_id' => '7', 'position_id' => '39', 'business_id' => '2'],
      ['id' => '44', 'occupation_id' => '7', 'position_id' => '99', 'business_id' => '2'],
      ['id' => '45', 'occupation_id' => '7', 'position_id' => '99', 'business_id' => '99'],
      ['id' => '46', 'occupation_id' => '8', 'position_id' => '40', 'business_id' => '3'],
      ['id' => '47', 'occupation_id' => '8', 'position_id' => '40', 'business_id' => '99'],
      ['id' => '48', 'occupation_id' => '9', 'position_id' => '40', 'business_id' => '4'],
      ['id' => '49', 'occupation_id' => '9', 'position_id' => '40', 'business_id' => '5'],
      ['id' => '50', 'occupation_id' => '9', 'position_id' => '40', 'business_id' => '6'],
      ['id' => '51', 'occupation_id' => '9', 'position_id' => '40', 'business_id' => '7'],
      ['id' => '52', 'occupation_id' => '9', 'position_id' => '40', 'business_id' => '8'],
      ['id' => '53', 'occupation_id' => '9', 'position_id' => '40', 'business_id' => '9'],
      ['id' => '54', 'occupation_id' => '9', 'position_id' => '40', 'business_id' => '10'],
      ['id' => '55', 'occupation_id' => '9', 'position_id' => '40', 'business_id' => '11'],
      ['id' => '56', 'occupation_id' => '9', 'position_id' => '40', 'business_id' => '12'],
      ['id' => '57', 'occupation_id' => '9', 'position_id' => '40', 'business_id' => '99'],
      ['id' => '58', 'occupation_id' => '10', 'position_id' => '40', 'business_id' => '12'],
      ['id' => '59', 'occupation_id' => '10', 'position_id' => '40', 'business_id' => '13'],
      ['id' => '60', 'occupation_id' => '10', 'position_id' => '40', 'business_id' => '14'],
      ['id' => '61', 'occupation_id' => '10', 'position_id' => '40', 'business_id' => '15'],
      ['id' => '62', 'occupation_id' => '10', 'position_id' => '40', 'business_id' => '16'],
      ['id' => '63', 'occupation_id' => '10', 'position_id' => '40', 'business_id' => '17'],
      ['id' => '64', 'occupation_id' => '10', 'position_id' => '40', 'business_id' => '18'],
      ['id' => '65', 'occupation_id' => '10', 'position_id' => '40', 'business_id' => '19'],
      ['id' => '66', 'occupation_id' => '10', 'position_id' => '40', 'business_id' => '20'],
      ['id' => '67', 'occupation_id' => '10', 'position_id' => '40', 'business_id' => '21'],
      ['id' => '68', 'occupation_id' => '10', 'position_id' => '40', 'business_id' => '22'],
      ['id' => '69', 'occupation_id' => '10', 'position_id' => '40', 'business_id' => '23'],
      ['id' => '70', 'occupation_id' => '10', 'position_id' => '40', 'business_id' => '25'],
      ['id' => '71', 'occupation_id' => '10', 'position_id' => '40', 'business_id' => '34'],
      ['id' => '72', 'occupation_id' => '10', 'position_id' => '40', 'business_id' => '99'],
      ['id' => '73', 'occupation_id' => '17', 'position_id' => '41', 'business_id' => '24'],
      ['id' => '74', 'occupation_id' => '17', 'position_id' => '42', 'business_id' => '25'],
      ['id' => '75', 'occupation_id' => '17', 'position_id' => '43', 'business_id' => '26'],
      ['id' => '76', 'occupation_id' => '17', 'position_id' => '44', 'business_id' => '27'],
      ['id' => '77', 'occupation_id' => '17', 'position_id' => '45', 'business_id' => '28'],
      ['id' => '78', 'occupation_id' => '17', 'position_id' => '46', 'business_id' => '29'],
      ['id' => '79', 'occupation_id' => '17', 'position_id' => '47', 'business_id' => '30'],
      ['id' => '80', 'occupation_id' => '17', 'position_id' => '48', 'business_id' => '31'],
      ['id' => '81', 'occupation_id' => '17', 'position_id' => '49', 'business_id' => '31'],
      ['id' => '82', 'occupation_id' => '17', 'position_id' => '50', 'business_id' => '25'],
      ['id' => '83', 'occupation_id' => '17', 'position_id' => '51', 'business_id' => '27'],
      ['id' => '84', 'occupation_id' => '17', 'position_id' => '52', 'business_id' => '32'],
      ['id' => '85', 'occupation_id' => '17', 'position_id' => '53', 'business_id' => '33'],
      ['id' => '86', 'occupation_id' => '17', 'position_id' => '54', 'business_id' => '25'],
      ['id' => '87', 'occupation_id' => '17', 'position_id' => '99', 'business_id' => '99'],
      ['id' => '88', 'occupation_id' => '15', 'position_id' => '97', 'business_id' => '1'],
    ];
    DB::table('business_occupation_positions')->insert($data);
  }
}
