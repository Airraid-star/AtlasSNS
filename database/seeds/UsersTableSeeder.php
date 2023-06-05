<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'username' => 'Atlas花子',
                'mail' => 'Atlashanako@mail.com',
                'password' => Hash::make('12345678'),
                'bio' => '学生です。よろしくお願いします。',
            ]
            ]);
    }
}
