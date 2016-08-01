<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'uid'=>'2014218700',
            'name'=>'admin',
            'type'=>'0',
            'password'=>bcrypt('123456'),
        ]);
        User::create([
            'uid'=>'2014218701',
            'name'=>'teacher',
            'type'=>'1',
            'password'=>bcrypt('123456'),
        ]);
        User::create([
            'uid'=>'2014218702',
            'name'=>'马甲',
            'type'=>'2',
            'password'=>bcrypt('123456'),
        ]);
        //
    }
}
