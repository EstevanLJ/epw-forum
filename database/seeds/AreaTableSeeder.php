<?php

use App\Area;
use Illuminate\Database\Seeder;

class AreaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();   
        
        for($i = 0; $i < SEEDERS_AREAS; $i++) {
            Area::create([
                'name' => $faker->realText(20),
                'description' => $faker->realText(50)
            ]);
        }


    }
}
