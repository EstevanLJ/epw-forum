<?php

use App\Post;
use App\Comment;
use Illuminate\Database\Seeder;

class CommentTableSeeder extends Seeder
{
    /**
    * Run the database seeds.
    *
    * @return void
    */
    public function run()
    {
        $faker = Faker\Factory::create();
        
        for($i = 0; $i < SEEDERS_COMMENTS; $i++) {
            
            $post_id = rand(1,SEEDERS_POSTS);
            $post = Post::find($post_id);
            
			if($post->getCommentsCount() == 0) {
                $data = new DateTime($post->created_at);
            	$data->add(new DateInterval('PT'.rand(5,60).'M'));
            } else {
                $last_comment = $post->getLastComment();

                $data = new DateTime($last_comment->created_at);
            	$data->add(new DateInterval('PT'.rand(5,300).'M'));
            }

            $comment = Comment::create([
				'comment' => $faker->paragraph(2),
				'user_id' => rand(2,SEEDERS_USERS),
				'post_id' => $post_id
            ]);          
            
            $comment_date = $data->format('Y-m-d H:i:s');
            
            $comment->created_at = $comment_date;
            $comment->updated_at = $comment_date;
            $comment->save();
        }
    }
}