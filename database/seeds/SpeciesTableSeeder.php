<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SpeciesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('species')->insert(['name' => 'Gato(a)']);
        DB::table('species')->insert(['name' => 'Cachorro(a)']);
    }
}
