<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IspSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $file = json_decode(file_get_contents(__DIR__ . "/data/isp.json"));

        foreach ($file as $key => $value) {
            DB::table('isps')->insert([
                'name' => $value->name,

            ]);
        }
    }
}
