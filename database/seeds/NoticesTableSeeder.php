<?php

use Illuminate\Database\Seeder;


class NoticesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $notices = [
            [
                'title' => 'Looking for a gym partner',
                'text' => 'Hello, I am looking for somebody to go to the gym with.',
            ],
            [
                'title' => 'Looking for a group of football players',
                'text' => 'Hey, I am looking for a football team. I am a casual football player and I am open to playing weekends and Wednesdays',
            ],
            [
                'title' => 'Looking for a gym coach',
                'text' => 'Hi, I am a beginner looking for somebody to guide during my first few weeks in the gym.',
            ],
            [
                'title' => 'Looking for a jogging partner',
                'text' => 'Sup, I am looking for somebody to go running with on mornings.',
            ],
            [
                'title' => 'Looking for an experienced squash player',
                'text' => 'Hey everybody, I am looking for somebody who can actually challenge me on squash.',
            ],
            [
                'title' => 'Looking for a newbie in ice hockey to learn alongside me',
                'text' => 'I am looking for somebody who\'s on a similar level to mine in ice hockey to attend trainings with me.',
            ],
        ];

        foreach($notices as $notice) {
            DB::table('notices')->insert([
                'title' => $notice['title'],
                'text' => $notice['text'],
                'user_id' => mt_rand(1,5),
            ]);
        }
    }
}
