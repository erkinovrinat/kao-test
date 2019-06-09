<?php

use Illuminate\Database\Seeder;

class SchoolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 45; $i++) {
            for ($y = 1; $y <= 3; $y++) {
                \App\School::create([
                    'name' => 'School #'.$y,
                    'region_id' => $i,
                ]);
            }
        }
    }
}
