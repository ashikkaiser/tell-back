<?php

namespace Database\Seeders;

use Exception;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return voids
     */
    public function run()
    {
        $file = json_decode(file_get_contents(__DIR__ . "/data/city.json"));

        foreach ($file as $key => $value) {
            try {
                DB::table('cities')->insert([
                    'name' => $value->name,
                ]);
            } catch (Exception $e) {
                Log::info($e);
            }
        }
    }
}
