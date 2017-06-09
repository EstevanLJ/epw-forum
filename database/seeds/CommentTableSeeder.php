<?php

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
            Comment::create([
                'comment' => $faker->paragraph(2), 
                'user_id' => rand(2,SEEDERS_USERS), 
                'post_id' => rand(1,SEEDERS_POSTS)
            ]);
        }
    }
}
