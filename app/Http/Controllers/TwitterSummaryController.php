<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TwitterSummary;
use Carbon\Carbon;

class TwitterSummaryController extends Controller
{
	public function show_all_14(){
        $today = Carbon::today('Asia/Tokyo');
        $title_select = "Twitter";
        $today_time = $today->format('Y-m-d');
        $back_14_array = array();
        $temp = $today->copy();
        $first_day = $today->copy();
        for ($x=0; $x<=14; $x++){
            $temp->subDay();
            $useDay = $temp->copy()->format('Y-m-d');
            $temp_array['day'] = $useDay;
            $temp_array['count'] = 0;
            array_push($back_14_array, $temp_array);
            $temp_array = array();
            if($x===14){
                $first_day = $useDay;
            }
        
        }
        $back30_time = $today;
        print_r($back_14_array);
        $all_data = TwitterSummary::all()->toArray();
        $cat_month = TwitterSummary::selectraw("DATE_FORMAT(`date`, '%Y-%m-%d') as `new_date`, `bin_name`, sum(`count_num`) as `sum_count`")->whereBetween("date", [$first_day, $today_time])->groupby('new_date', 'bin_name') -> get();
        $each_bin_day_count = array();
        for ($i=0; $i<count($cat_month); $i++){
            $bin_name = $cat_month[$i]['bin_name'];
            $new_date = $cat_month[$i]['new_date'];
            $sum_date = $cat_month[$i]['sum_count'];
            if(array_key_exists($bin_name, $each_bin_day_count)){
                $each_bin_day_count[$bin_name] = array();
            }
            $each_bin_day_count[$bin_name][$new_date] = $sum_date;
        }

        print_r($each_bin_day_count);
        return view('show_twitter_14', compact('title_select'));
    }
    
    public function indexCategory(){
        //$today = Carbon::today('Asia/Tokyo');
        $today = Carbon::createFromDate('2019', '10', '20', 'Asia/Tokyo' );
        $today_time = $today->format('Y-m-d');
        $first_day = $today->copy()->subDays(14);
        $cat_month = array_unique(TwitterSummary::selectraw("DATE_FORMAT(`date`, '%Y-%m-%d') as `new_date`, `bin_name`")->whereBetween("date", [$first_day, $today_time])->groupby('new_date','bin_name')->pluck('bin_name')->toArray());
        $re_value_cat = array_values($cat_month);
        return (['category'=>$re_value_cat]);
    }

    public function showByCategory($category){
    //    $today = Carbon::today('Asia/Tokyo');
        $today = Carbon::createFromDate('2019', '10', '20', 'Asia/Tokyo' );
        $today_time = $today->format('Y-m-d');
        $back_14_array = array();
        $temp = $today->copy();
        $first_day = $today->copy();
        for ($x = 0; $x <= 14 ; $x++){
            $temp->subDay();
            $useDay = $temp->copy()->format('Y-m-d');
            $temp_array['day'] = $useDay;
            $temp_array['count'] = 0;
            array_push($back_14_array, $temp_array);
            $temp_array = array();
            if ($x===14){
                $first_day = $useDay; 
            }  
        }
        $cat_before_data = TwitterSummary::selectraw("DATE_FORMAT(`date`, '%Y-%m-%d') as `new_date`, `bin_name`, sum(count_num) as `sum_count`")->whereBetween("date", [$first_day, $today_time])->groupby('new_date','bin_name')->where('bin_name',$category)->get();
        $cat_eachday = $back_14_array;
        foreach( $cat_before_data as $each_value){
            for( $i=0; $i<count($cat_eachday); $i++){
                if($cat_eachday[$i]['day'] == $each_value['new_date']){
                    $cat_eachday[$i]['count'] = $each_value['sum_count'];
                }
            }

        }
        return(['results' => $cat_eachday]); 
        
    }
    //
}
