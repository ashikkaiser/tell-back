<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TimeZoneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $file = json_decode(file_get_contents(__DIR__ . "/timezone.json"));

        foreach ($file as $key => $value) {

            DB::table('time_zones')->insert([
                'name' => $value->name,
                'code' => $value->code,

            ]);
        }
    }
}
