<?php

use Illuminate\Database\Seeder;

class RegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 9; $i++) {
            for ($y = 1; $y <= 5; $y++) {
                \App\Region::create([
                    'name' => 'Region #'.$y,
                    'oblast_id' => $i,
                ]);
            }
        }
    }
}
