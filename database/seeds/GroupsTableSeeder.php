<?php

use Illuminate\Database\Seeder;
use App\Group;

class GroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        for($i =1;$i <= 5; $i++)
        {
        Group::create([
            "name" => "Group".$i,
            "description" => "description".$i,
            "nr_of_members" => 10 +$i,
        ]);
        }
    }
}
