<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BrowserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $file = json_decode(file_get_contents(__DIR__ . "/data/browsers.json"));

        foreach ($file as $key => $value) {
            DB::table('browsers')->insert([
                'name' => $value->name,
                'version' => json_encode($value->versions),
            ]);
        }
    }
}
