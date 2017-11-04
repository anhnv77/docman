<?php

use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'id' => 1,
            'name' => 'admin',
        ]);

        DB::table('roles')->insert([
            'id' => 2,
            'name' => 'manager',
        ]);

        DB::table('roles')->insert([
            'id' => 3,
            'name' => 'user',
        ]);
    }
}
