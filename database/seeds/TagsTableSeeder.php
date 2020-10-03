<?php

use Illuminate\Database\Seeder;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = [
            'Endurance Training',
            'Weightlifting',
            'Football',
            'Basketball',
            'Squash',
            'Ice Hockey',
            'Tennis',
            'Floorball',
            'Crossfit',
            'Jogging',
            'Swimming',
            'Climbing',
            'Volleyball',
            'Mixed Martial Arts',
            'Judo',
            'Baseball',
            'American Football',
            'Table Tennis',
            'Chess',
            'Cricket'
        ];

        for($i=0;$i<sizeof($tags);$i++){
            DB::table('tags')->insert([
                'tag' => $tags[$i]
            ]);
        }
    }
}
