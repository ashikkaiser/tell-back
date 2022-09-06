<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $file = json_decode(file_get_contents(__DIR__ . "/data/region.json"));

        foreach ($file as $key => $value) {
            DB::table('regions')->insert([
                'name' => $value->name,
                'country' => $value->countryName,
            ]);
        }
    }
}
