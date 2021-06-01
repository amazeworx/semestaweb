<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   *
   * @return void
   */
  public function run()
  {
    $this->call([
      CountrySeeder::class,
      ProvinceSeeder::class,
      CitySeeder::class,
      //DistrictSeeder::class,
      //SubDistrictSeeder::class,
      OccupationSeeder::class,
      PositionSeeder::class,
      BusinessSeeder::class,
      BusinessOccupationPositionSeeder::class,
      BankSeeder::class,
    ]);
  }
}
