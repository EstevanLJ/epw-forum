<?php

use App\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        User::create([
            'first_name' => 'Admin',
            'last_name' => '',
            'user_name' => 'sysadmin',
            'email' => 'admin@ewpforum.com',
            'password' => bcrypt('admin')
        ]);

        User::create([
            'first_name' => 'Estevan',
            'last_name' => 'Junges',
            'user_name' => 'estevan.junges',
            'email' => 'estevan.junges@ewpforum.com',
            'password' => bcrypt('teste123')
        ]);

        for($i = 0; $i < 18; $i++){

            $first = $faker->firstName();
            $last = $faker->lastName();
            $user = strtolower($first.'.'.$last);

            User::create([
                'first_name' => $first,
                'last_name' => $last,
                'user_name' => strtolower($first.'.'.$last),
                'email' => $user.'@ewpforum.com',
                'password' => bcrypt(str_random(6))
            ]);
        }


    }
}
