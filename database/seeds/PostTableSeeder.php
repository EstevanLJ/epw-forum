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

        for($i = 0; $i < SEEDERS_POSTS; $i++) {
			$data = new DateTime('America/Sao_Paulo');     
			$data->sub(new DateInterval('PT'.rand(5,30).'H')); 

            $post = Post::create([
                'title' => $faker->realText(50), 
                'text' => $faker->paragraph(5), 
                'user_id' => rand(2,SEEDERS_USERS), 
                'area_id' => rand(1,SEEDERS_AREAS)
            ]);

			$post->created_at = $data->format('Y-m-d H:i:s');
			$post->updated_at = $data->format('Y-m-d H:i:s');

			$post->save();
        }
    }
}
