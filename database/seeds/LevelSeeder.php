<?php

use Illuminate\Database\Seeder;

class LevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Level::create([
            'name' => 'Легкий',
        ]);
        \App\Level::create([
            'name' => 'Средний',
        ]);
        \App\Level::create([
            'name' => 'Сложный',
        ]);
    }
}
