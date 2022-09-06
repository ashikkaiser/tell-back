<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $file = json_decode(file_get_contents(__DIR__ . "/data/brands.json"));

        foreach ($file as $key => $value) {
            DB::table('brands')->insert([
                'name' => $value->name,
                'models' => json_encode($value->models),
            ]);
        }
    }
}
