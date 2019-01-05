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
        \Illuminate\Support\Facades\DB::table('users')->insert([
            'name' => 'John Doe',
            'email' => 'admin@demo.com',
            'password' => bcrypt('123456'),
            'gender' => 'male',
            'user_type' => 'admin',
            'active_status' => '1',
        ]);
    }
}
