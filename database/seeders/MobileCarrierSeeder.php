<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MobileCarrierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $file = json_decode(file_get_contents(__DIR__ . "/data/mobile_carrier.json"));

        foreach ($file as $key => $value) {
            DB::table('mobile_carriers')->insert([
                'name' => $value->name,
                'country' => $value->country_name,

            ]);
        }
    }
}
