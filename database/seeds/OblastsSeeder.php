<?php

use Illuminate\Database\Seeder;

class OblastsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Oblast::create(['name' => 'Бишкек']);
        \App\Oblast::create(['name' => 'Чуйская']);
        \App\Oblast::create(['name' => 'Таласская']);
        \App\Oblast::create(['name' => 'Иссык-Кульская']);
        \App\Oblast::create(['name' => 'Нарынская']);
        \App\Oblast::create(['name' => 'Ош']);
        \App\Oblast::create(['name' => 'Ошская']);
        \App\Oblast::create(['name' => 'Джалал-Абадская']);
        \App\Oblast::create(['name' => 'Баткенская']);
    }
}
