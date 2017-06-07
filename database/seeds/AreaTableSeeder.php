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
        
        for($i = 0; $i < 10; $i++) {
            Area::create([
                'name' => $faker->sentence(3),
                'description' => $faker->realText(50)
            ]);
        }


    }
}
