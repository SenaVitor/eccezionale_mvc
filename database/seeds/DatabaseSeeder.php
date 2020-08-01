<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('mesas')->insert([
            "tipo_mesa" => "Normal",
            "qtd_cadeiras" => 1,
            "preco_mesa" => 30.0,
            "reservada" => 0
        ]);
        DB::table('mesas')->insert([
            "tipo_mesa" => "Vip",
            "qtd_cadeiras" => 1,
            "preco_mesa" => 60.0,
            "reservada" => 0
        ]);
        DB::table('mesas')->insert([
            "tipo_mesa" => "Vip ",
            "qtd_cadeiras" => 2,
            "preco_mesa" => 60.0,
            "reservada" => 0
        ]);
        DB::table('mesas')->insert([
            "tipo_mesa" => "Normal",
            "qtd_cadeiras" => 2,
            "preco_mesa" => 30.0,
            "reservada" => 0
        ]);
        DB::table('mesas')->insert([
            "tipo_mesa" => "Normal",
            "qtd_cadeiras" => 3,
            "preco_mesa" => 30.0,
            "reservada" => 0
        ]);
        DB::table('mesas')->insert([
            "tipo_mesa" => "Vip",
            "qtd_cadeiras" => 3,
            "preco_mesa" => 60.0,
            "reservada" => 0
        ]);
        DB::table('mesas')->insert([
            "tipo_mesa" => "Normal",
            "qtd_cadeiras" => 4,
            "preco_mesa" => 30.0,
            "reservada" => 0
        ]);
        DB::table('mesas')->insert([
            "tipo_mesa" => "Vip",
            "qtd_cadeiras" => 4,
            "preco_mesa" => 60.0,
            "reservada" => 0
        ]);
        DB::table('mesas')->insert([
            "tipo_mesa" => "Normal",
            "qtd_cadeiras" => 5,
            "preco_mesa" => 30.0,
            "reservada" => 0
        ]);
        DB::table('mesas')->insert([
            "tipo_mesa" => "Vip",
            "qtd_cadeiras" => 5,
            "preco_mesa" => 60.0,
            "reservada" => 0
        ]);
    }
}