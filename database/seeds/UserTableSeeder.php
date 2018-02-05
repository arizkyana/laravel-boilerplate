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
        DB::table('users')->insert([
            [
                'name' => 'developer',
                'email' => 'dev@jlo.id',
                'password' => bcrypt(12341234),
                'roles_id' => 1
            ],
            [
                'name' => 'admin',
                'email' => 'admin@jlo.id',
                'password' => bcrypt(12341234),
                'roles_id' => 2
            ],
            [
                'name' => 'manager',
                'email' => 'manager@jlo.id',
                'password' => bcrypt(12341234),
                'roles_id' => 3
            ]
        ]);
    }
}
