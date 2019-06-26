<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
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
                'id'           => 1,
                'name'         => 'super admin',
                'email'        => 'super@email.com',
                'password'     => bcrypt('admin'),
                'is_permission'     => 1,
                'created_at'=>Carbon::now()->toDateTimeString(),
                'updated_at'=>Carbon::now()->toDateTimeString()
            ],
            [  
                'id'           => 2,
                'name'         => 'admin',
                'email'        => 'admin@email.com',
                'password'     => bcrypt('admin'),
                'is_permission'     => 1,
                'created_at'=>Carbon::now()->toDateTimeString(),
                'updated_at'=>Carbon::now()->toDateTimeString()
            ]
           
        ]);
    }
}
