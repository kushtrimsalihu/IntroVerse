<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class USerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            [
              'id' => '1',
              'name' => 'Kushtrimi',
              'email' => 'admin@gmail.com',
              'email_verified_at' => '2022-01-13 14:19:38',
              'password' => '$2y$10$5KnHdSHr9Z5LprkuMVgLXuKc02UFfk3WJxuyLNLWefR7K6r7aVSsu',
              'created_at'=>'2022-01-13 14:19:38',
              'updated_at'=>'2022-01-13 14:19:38'
            ],
          
        ];
        DB::table('users')->insert(
            $user
        );
        
    }
}
