<?php

/*
 * This file is part of the IndoRegion package.
 *
 * (c) Azis Hapidin <azishapidin.com | azishapidin@gmail.com>
 *
 */

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use AzisHapidin\IndoRegion\RawDataGetter;
use Illuminate\Support\Facades\DB;

class SubDistrictSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @deprecated
     *
     * @return void
     */
    public function run()
    {
        // Get Data
        $sub_districts = RawDataGetter::getVillages();

        // Insert Data with Chunk
        DB::transaction(function() use($sub_districts) {
            $collection = collect($sub_districts);
            $parts = $collection->chunk(1000);
            foreach ($parts as $subset) {
                DB::table('sub_districts')->insert($subset->toArray());
            }
        });
    }
}
