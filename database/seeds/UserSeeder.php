<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'username' => 'admin',
            'password' => Hash::make('admin123'),
            'user_role_id' => 1
        ]);

        DB::table('users')->insert([
            'username' => 'dcu',
            'password' => Hash::make('ujungberung'),
            'user_role_id' => 2
        ]);

        DB::table('users')->insert([
            'username' => 'safetytalk',
            'password' => Hash::make('ujungberung'),
            'user_role_id' => 3
        ]);
    }
}
