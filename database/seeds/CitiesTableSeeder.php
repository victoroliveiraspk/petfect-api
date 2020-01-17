<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = File::get('database/data/cidades.json');
        $data = json_decode($json);
        foreach ($data as $obj) {
            DB::table('cities')->insert(['name' => $obj->Nome, 'state_id' => $obj->Estado]);
        }
    }
}
