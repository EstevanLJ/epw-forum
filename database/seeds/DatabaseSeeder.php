<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserTableSeeder::class);
        $this->call(AreaTableSeeder::class);
        $this->call(PostTableSeeder::class);
        $this->call(PostEditTableSeeder::class);
        $this->call(CommentTableSeeder::class);
    }
}
