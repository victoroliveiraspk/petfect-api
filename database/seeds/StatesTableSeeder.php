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
        DB::table('states')->insert(['name' => 'Acre']);
        DB::table('states')->insert(['name' => 'Alagoas']);
        DB::table('states')->insert(['name' => 'Amazonas']);       
        DB::table('states')->insert(['name' => 'Amapá']);
        DB::table('states')->insert(['name' => 'Bahia']);
        DB::table('states')->insert(['name' => 'Ceará']);
        DB::table('states')->insert(['name' => 'Distrito Federal']);
        DB::table('states')->insert(['name' => 'Espírito Santo']);
        DB::table('states')->insert(['name' => 'Goiás']);
        DB::table('states')->insert(['name' => 'Maranhão']);
        DB::table('states')->insert(['name' => 'Minas Gerais']);
        DB::table('states')->insert(['name' => 'Mato Grosso do Sul']);
        DB::table('states')->insert(['name' => 'Mato Grosso']);
        DB::table('states')->insert(['name' => 'Pará']);
        DB::table('states')->insert(['name' => 'Paraíba']);
        DB::table('states')->insert(['name' => 'Pernambuco']);
        DB::table('states')->insert(['name' => 'Piauí']);
        DB::table('states')->insert(['name' => 'Paraná']);
        DB::table('states')->insert(['name' => 'Rio de Janeiro']);
        DB::table('states')->insert(['name' => 'Rio Grande do Norte']);
        DB::table('states')->insert(['name' => 'Rondônia']);
        DB::table('states')->insert(['name' => 'Roraima']);
        DB::table('states')->insert(['name' => 'Rio Grande do Sul']);
        DB::table('states')->insert(['name' => 'Santa Catarina']);
        DB::table('states')->insert(['name' => 'Sergipe']);
        DB::table('states')->insert(['name' => 'São Paulo']);
        DB::table('states')->insert(['name' => 'Tocantins']);
    }
}
