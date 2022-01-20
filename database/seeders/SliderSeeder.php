<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SliderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $slider = [
            [
              'id' => '1',
              'title' => 'Welcome To IntroVerse',
               'description'=>'Ut velit est quam dolor ad a aliquid qui aliquid. Sequi ea ut et est quaerat sequi nihil ut aliquam. Occaecati alias dolorem mollitia ut. Similique ea voluptatem. Esse doloremque accusamus repellendus deleniti vel. Minus et tempore modi architecto.',
               'image'=>'image/slider/1721719165656724.jpg'
            ],
            [
                'id' => '2',
                'title' => 'Welcome To IntroVerse',
                 'description'=>'Ut velit est quam dolor ad a aliquid qui aliquid. Sequi ea ut et est quaerat sequi nihil ut aliquam. Occaecati alias dolorem mollitia ut. Similique ea voluptatem. Esse doloremque accusamus repellendus deleniti vel. Minus et tempore modi architecto.',
                 'image'=>'image/slider/1721719192205560.jpg'
              ],
              [
                'id' => '3',
                'title' => 'Welcome To IntroVerse',
                 'description'=>'Ut velit est quam dolor ad a aliquid qui aliquid. Sequi ea ut et est quaerat sequi nihil ut aliquam. Occaecati alias dolorem mollitia ut. Similique ea voluptatem. Esse doloremque accusamus repellendus deleniti vel. Minus et tempore modi architecto.',
                 'image'=>'image/slider/1721719192205560.jpg'
              ],
        ];
        DB::table('sliders')->insert(
            $slider
        );
        
    }
}
