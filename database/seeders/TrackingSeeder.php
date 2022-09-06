<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TrackingSeeder extends Seeder
{

    public function run()
    {
        $files = json_decode(file_get_contents(__DIR__ . "/data/tracking.json"));
        foreach ($files as $key => $value) {
            DB::table('tracking_methods')->insert([
                'name' => $value->name,
                'code' => $value->code,
                'type' => $value->type,
                // 'status' => true
            ]);
        }
    }
}
