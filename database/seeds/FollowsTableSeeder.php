<?php

use Illuminate\Database\Seeder;

class FollowsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('follows')->insert([
            [
                'following_id' => 'Atlas2郎',
                'followed_id' => 'Atlas五郎',
            ]
            ]);
    }
}
