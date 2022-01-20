<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HomeServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $homeservice = [
            [
              'id' => '1',
              'icon' => 'bx bxl-dribbble',
              'title'=>'Lorem Ipsum',
               'short_description'=>'Voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi'

            ],
                          [
                'id' => '2',
                'icon' => 'bx bx-file',
                'title'=>'Lorem Ipsum',
                 'short_description'=>'Voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi'
  
              ],
              [
                'id' => '3',
                'icon' => 'bx bx-tachometer',
                'title'=>'Lorem Ipsum',
                 'short_description'=>'Voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi'
  
              ],
              [
                'id' => '4',
                'icon' => 'bx bx-layer',
                'title'=>'Lorem Ipsum',
                 'short_description'=>'Voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi'
  
              ],
              [
                'id' => '5',
                'icon' => 'bx bx-slideshow',
                'title'=>'Lorem Ipsum',
                 'short_description'=>'Voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi'
  
              ],
              [
                'id' => '6',
                'icon' => 'bx bx-arch',
                'title'=>'Lorem Ipsum',
                 'short_description'=>'Voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi'
  
              ],
          
        ];
        DB::table('services')->insert(
            $homeservice
        );
        
    }
}
