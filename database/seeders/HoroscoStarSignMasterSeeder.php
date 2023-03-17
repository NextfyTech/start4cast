<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;



class HoroscoStarSignMasterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $makes = array(
            array('id' =>1 , 'starsign' => 'Aries' ,'starsign_date_range' => 'March 21 - April 20','starsign_img' => 'starpix/button_aries.gif'),
            array('id' =>2 , 'starsign' => 'Taurus' ,'starsign_date_range' => 'April 21 - May 20','starsign_img' => 'starpix/button_taurus.gif'),
            array('id' =>3 , 'starsign' => 'Gemini' ,'starsign_date_range' => 'May 21 - June 21','starsign_img' => 'starpix/button_gemini.gif'),
            array('id' =>4 , 'starsign' => 'Cancer' ,'starsign_date_range' => 'June 22 - July 23','starsign_img' => 'starpix/button_aries.gif'),
            array('id' =>5 , 'starsign' => 'Leo' ,'starsign_date_range' => 'July 24 - August 23','starsign_img' => 'starpix/button_aries.gif'),
            array('id' =>6 , 'starsign' => 'Virgo' ,'starsign_date_range' => 'August 24 - September 23','starsign_img' => 'starpix/button_aries.gif'),
            array('id' =>7 , 'starsign' => 'Libra' ,'starsign_date_range' => 'September 24 - October 22','starsign_img' => 'starpix/button_aries.gif'),
            array('id' =>8 , 'starsign' => 'Scorpio' ,'starsign_date_range' => 'October 23 - November 22','starsign_img' => 'starpix/button_aries.gif'),
            array('id' =>9 , 'starsign' => 'Sagittarius' ,'starsign_date_range' => 'November 23 - December 22','starsign_img' => 'starpix/button_aries.gif'),
            array('id' =>10 , 'starsign' => 'Capricorn' ,'starsign_date_range' => 'December 23 - January 20','starsign_img' => 'starpix/button_aries.gif'),
            array('id' =>11 , 'starsign' => 'Aquarius' ,'starsign_date_range' => 'January 21 - February 19','starsign_img' => 'starpix/button_aries.gif'),
            array('id' =>12 , 'starsign' => 'Pisces' ,'starsign_date_range' => 'February 20 - March 20','starsign_img' => 'starpix/button_aries.gif'),
        );
        \DB::table('horosco_starsign_master')->insert($makes);
    }
}
