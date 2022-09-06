<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConnectionTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //connection_types
        $file = json_decode(file_get_contents(__DIR__ . "/data/connection_types.json"));

        foreach ($file as $key => $value) {

            DB::table('connection_types')->insert([
                'name' => $value->name,
            ]);
        }
    }
}
