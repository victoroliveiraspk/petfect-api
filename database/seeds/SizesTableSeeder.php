<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SizesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sizes')->insert(['name' => 'Pequeno']);
        DB::table('sizes')->insert(['name' => 'Médio']);
        DB::table('sizes')->insert(['name' => 'Grande']);
    }
}
