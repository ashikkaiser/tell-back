<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DeviceTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $file = json_decode(file_get_contents(__DIR__ . "/data/devicetype.json"));

        foreach ($file as $key => $value) {

            DB::table('device_types')->insert([
                'name' => $value->name,
            ]);
        }
    }
}
