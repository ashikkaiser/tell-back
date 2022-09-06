<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $file = json_decode(file_get_contents(__DIR__ . "/country.json"));

        foreach ($file as $key => $value) {

            DB::table('countries')->insert([
                'name' => $value->name,
                'code' => $value->code,
                'phone_code' => $value->dial_code,
            ]);
        }
    }
}
