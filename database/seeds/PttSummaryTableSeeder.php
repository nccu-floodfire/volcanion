<?php

use Illuminate\Database\Seeder;
use App\PttSummary;

class PttSummaryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	for ($i=0; $i<50; $i++){
        $ptt = new PttSummary;
//		$random_date = mt_rand(1553615999, 1564156799);
        $random_date = mt_rand(1569906231 ,1571634231);
        $ptt->date = date("Y-m-d H:i:s",$random_date);
		$ptt_cat_array = array("政黑","八卦");
		$random_cat = array_rand($ptt_cat_array);
		$ptt->category = $ptt_cat_array[$random_cat];
		$ptt->count_num = rand(10,100);
		$ptt->save();

	}
    }
}
