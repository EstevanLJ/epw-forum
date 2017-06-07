<?php

use App\Post;
use Illuminate\Database\Seeder;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {       
        $faker = Faker\Factory::create();        

        for($i = 0; $i < 50; $i++) {
            Post::create([
                'title' => $faker->realText(50), 
                'text' => $faker->paragraph(5), 
                'user_id' => rand(2,20), 
                'area_id' => rand(1,10)
            ]);
        }
    }
}
