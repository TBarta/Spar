<?php

use Illuminate\Database\Seeder;
use App\UserHasTag;

class UserHasTagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UserHasTag::insert([
            'user_id' => 1,
            'tag_id' => 2
        ]);

        UserHasTag::insert([
            'user_id' => 1,
            'tag_id' => 3
        ]);

        UserHasTag::insert([
            'user_id' => 1,
            'tag_id' => 4
        ]);

        UserHasTag::insert([
            'user_id' => 2,
            'tag_id' => 3
        ]);

        UserHasTag::insert([
            'user_id' => 1,
            'tag_id' => 1
        ]);

        UserHasTag::insert([
            'user_id' => 6,
            'tag_id' => 15
        ]);

        UserHasTag::insert([
            'user_id' => 8,
            'tag_id' => 7
        ]);

        UserHasTag::insert([
            'user_id' => 8,
            'tag_id' => 5
        ]);

        UserHasTag::insert([
            'user_id' => 3,
            'tag_id' => 24
        ]);

        UserHasTag::insert([
            'user_id' => 4,
            'tag_id' => 20
        ]);

        UserHasTag::insert([
            'user_id' => 4,
            'tag_id' => 16
        ]);

        UserHasTag::insert([
            'user_id' => 5,
            'tag_id' => 3
        ]);

        UserHasTag::insert([
            'user_id' => 7,
            'tag_id' => 7
        ]);

        UserHasTag::insert([
            'user_id' => 7,
            'tag_id' => 11
        ]);

        UserHasTag::insert([
            'user_id' => 3,
            'tag_id' => 12
        ]);

        UserHasTag::insert([
            'user_id' => 3,
            'tag_id' => 13
        ]);

        UserHasTag::insert([
            'user_id' => 3,
            'tag_id' => 14
        ]);

        UserHasTag::insert([
            'user_id' => 3,
            'tag_id' => 15
        ]);

        UserHasTag::insert([
            'user_id' => 9,
            'tag_id' => 11
        ]);

        UserHasTag::insert([
            'user_id' => 9,
            'tag_id' => 15
        ]);

        UserHasTag::insert([
            'user_id' => 9,
            'tag_id' => 14
        ]);

        UserHasTag::insert([
            'user_id' => 10,
            'tag_id' => 25
        ]);

        UserHasTag::insert([
            'user_id' => 10,
            'tag_id' => 1
        ]);
    }
}
