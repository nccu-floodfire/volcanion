<?php

use Illuminate\Database\Seeder;
use App\NewsSummary;
use Carbon\Carbon;

class NewsSummaryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    for ($i=0; $i<50; $i++){
        $News = new NewsSummary;
        $News_cat_array = array("APD","CNA", "CNT", "ETT", "LTN", "UDN");
        $News_type = array("list","page");
        $News_datetime_ran = mt_rand(1569912112,1572504112);
        $date_value = date("Y-m-d H:i:s",$News_datetime_ran);
        $year = date("Y",strtotime($date_value));
		$month = date("m",strtotime($date_value));
		$day = date("d",strtotime($date_value));
		$hour = date("H",strtotime($date_value));
		$minute = date("i",strtotime($date_value));
		$second = date("s",strtotime($date_value));
		$Car_date = Carbon::create($year,$month,$day,$hour,$minute,$second);
		$before_date = $Car_date->addMonths(-1);
		$before_year = date("y",strtotime($before_date));
		$before_month = date("m",strtotime($before_date));
        $random_cat = array_rand($News_cat_array);
        $random_type = array_rand($News_type);
    
        $News->date  = $date_value;
        $News->type = $News_type[$random_type];
        $News->media = $News_cat_array[$random_cat];
        $News->count_num = rand(10,100);
        $News->save();
        }
    }
}
