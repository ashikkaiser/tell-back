<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $file = json_decode(file_get_contents(__DIR__ . "/data/language.json"));

        foreach ($file as $key => $value) {
            DB::table('languages')->insert([
                'name' => $value->name,
                'code' => $value->code,

            ]);
        }
    }
}
