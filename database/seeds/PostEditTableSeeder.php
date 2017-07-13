<?php

use App\Post;
use App\PostEdit;

use Illuminate\Database\Seeder;

class PostEditTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();  
		
		for($i = 0; $i < SEEDERS_POST_EDITS; $i++) {

			$post = Post::find(rand(0, SEEDERS_POSTS));

            $postEdit = PostEdit::create([ 
                'text' => $faker->paragraph(5), 
                'user_id' => $post->author->id, 
                'post_id' => $post->id 
            ]);

			$data = new DateTime($post->created_at);     
			$data->add(new DateInterval('PT'.rand(5,30).'H')); 

			$postEdit->date = $data->format('Y-m-d H:i:s');

			$postEdit->save();
        }


    }
}
