<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OperatingSystemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $file = json_decode(file_get_contents(__DIR__ . "/data/os.json"));

        foreach ($file as $key => $value) {
            DB::table('operating_systems')->insert([
                'name' => $value->name,
                'version' => json_encode($value->versions),
            ]);
        }
    }
}
