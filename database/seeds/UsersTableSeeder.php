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
             [  'id'           => 1,
                'name'         => 'admin',
                'email'        => 'admin@email.com',
                'password'     => bcrypt('admin'),
                'is_permission'     => 1,
            ],
            [   'id'           => 2,
                'name'         => 'super admin',
                'email'        => 'super@email.com',
                'password'     => bcrypt('admin'),
                'is_permission'     => 1,
            ]
           
        ]);
    }
}
