<?php

use Illuminate\Database\Seeder;

class UserHasGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_has_group')->insert([
            'user_id' => mt_rand(1,3),
            'group_id' => mt_rand(1,7),
            "is_group_admin" => 0,
        ]);
        DB::table('user_has_group')->insert([
            'user_id' => mt_rand(1,3),
            'group_id' => mt_rand(1,7),
            "is_group_admin" => 0,
        ]);
        DB::table('user_has_group')->insert([
            'user_id' => mt_rand(1,3),
            'group_id' => mt_rand(1,7),
            "is_group_admin" => 0,
        ]);
    }
}
