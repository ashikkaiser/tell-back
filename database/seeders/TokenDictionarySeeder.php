<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TokenDictionarySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $files = json_decode(file_get_contents(__DIR__ . "/token.json"));
        foreach ($files as $key => $value) {
            DB::table('token_dictionaries')->insert([
                'name' => $value->name,
                'code' => $value->code,
                'type' => $value->type
                // 'status' => true
            ]);
        }
    }
}
