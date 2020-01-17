<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = File::get('database/data/estados.json');
        $data = json_decode($json);
        foreach ($data as $obj) {
            DB::table('states')->insert(['name' => $obj->Nome]);
        }
    }
}
