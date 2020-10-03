<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => 'Samuel',
                'email' => 'samo.majoros@gmail.com',
                'password' => bcrypt('secret'),
                'address' => 'Opletalova',
                'about' => 'Testing!',
                'phone' => '0910792892',
                'photo' => 'universal_pic.png',
            ],
            [
                'name' => 'John',
                'email' => 'john.doe@gmail.com',
                'password' => bcrypt('secret'),
                'address' => 'Krakovska',
                'about' => 'Testing again!',
                'phone' => '0910213386',
                'photo' => 'universal_pic.png',
            ],
            [
                'name' => 'Thomas',
                'email' => 'thomas.anderson@gmail.com',
                'password' => bcrypt('secret'),
                'address' => 'Curie street',
                'about' => 'Testing for the last time!',
                'phone' => '0910123456',
                'photo' => 'universal_pic.png',
            ],
            [
                'name' => 'Bruce Banner',
                'email' => 'bruce.banner@gmail.com',
                'password' => bcrypt('secret'),
                'address' => 'Superman street',
                'about' => 'Testing for the very last time!',
                'phone' => '0910000000',
                'photo' => 'universal_pic.png',
            ],
            [
                'name' => 'Peter Parker',
                'email' => 'peter.parker@gmail.com',
                'password' => bcrypt('secret'),
                'address' => 'Spiderman street',
                'about' => 'Testing for the very very last time!',
                'phone' => '09102222456',
                'photo' => 'universal_pic.png',
            ],
            [
                'name' => 'Geralt of Rivia',
                'email' => 'geralt@gmail.com',
                'password' => bcrypt('secret'),
                'address' => 'Vizima',
                'about' => 'Up for a game of Gwent?',
                'phone' => '0910456456',
                'photo' => 'universal_pic.png',
            ],
            [
                'name' => 'Bilbo Baggins',
                'email' => 'bilbo@gmail.com',
                'password' => bcrypt('secret'),
                'address' => 'The Shire',
                'about' => 'One ring to rule them all.',
                'phone' => '0910789456',
                'photo' => 'universal_pic.png',
            ],
            [
                'name' => 'Sherlock Holmes',
                'email' => 'sherlock@gmail.com',
                'password' => bcrypt('secret'),
                'address' => 'Baker street',
                'about' => 'One ring to rule them all.',
                'phone' => '0910789987',
                'photo' => 'universal_pic.png',
            ],
            [
                'name' => 'Logen Ninefingers',
                'email' => 'logen@gmail.com',
                'password' => bcrypt('secret'),
                'address' => 'The Shire',
                'about' => 'Once you\'ve got a task to do, it\'s better to do it than to live with the fear of it.',
                'phone' => '0910789456',
                'photo' => 'universal_pic.png',
            ],
            [
                'name' => 'Petyr Baelish',
                'email' => 'petyr@gmail.com',
                'password' => bcrypt('secret'),
                'address' => 'The Fingers',
                'about' => 'Chaos is a ladder.',
                'phone' => '0910329389',
                'photo' => 'universal_pic.png',
            ],
        ];

        foreach($users as $user) {
            DB::table('users')->insert([
                'name' => $user['name'],
                'email' => $user['email'],
                'password' => bcrypt('password'),
                'address' => $user['address'],
                'about' => $user['about'],
                'phone' => $user['phone'],
                'photo' => $user['photo'],
            ]);
        }

    }
}