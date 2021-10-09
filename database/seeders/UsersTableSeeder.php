<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User;
        $user->fullname = "tahungoding";
        $user->username = "tahungoding";
        $user->email = "tahungoding@mail.com";
        $user->password = bcrypt('password'); 
        $user->gender = "laki-laki";
        $user->save();
    }
}
