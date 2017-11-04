<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //phòng 1
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('123456'),
            'role_id' => 1,
            'department_id' => 1,
        ]);

        DB::table('users')->insert([
            'name' => 'manager',
            'email' => 'manager@gmail.com',
            'password' => Hash::make('123456'),
            'role_id' => 2,
            'department_id' => 1,
        ]);

        DB::table('users')->insert([
            'name' => 'user',
            'email' => 'user@gmail.com',
            'password' => Hash::make('123456'),
            'role_id' => 3,
            'department_id' => 1,
        ]);
    }
}
