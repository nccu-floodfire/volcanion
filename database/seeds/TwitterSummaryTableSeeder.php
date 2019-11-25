<?php

use Illuminate\Database\Seeder;
use App\TwitterSummary;
use Carbon\Carbon;

class TwitterSummaryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	for ($i=0; $i<50; $i++){
		$Twitter = new TwitterSummary;
		$Twitter_cat_array = array("Tsai_long", "China_long", "Taiwan_long");
		$Twitter_datetime_ran =mt_rand(1570701099,1572601899);
		$date_value = date("Y-m-d H:i:s",$Twitter_datetime_ran);
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
		$random_cat = array_rand($Twitter_cat_array);
		$bin_name = $Twitter_cat_array[$random_cat]."_".$before_year."_".$before_month;
		$Twitter->date = $date_value;
		$Twitter->bin_name = $bin_name;
		$Twitter->count_num = rand(10,100);
		$Twitter->save();
	}
	 //
    }
}
