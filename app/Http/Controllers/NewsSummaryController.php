<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\NewsSummary;
use Carbon\Carbon;

class NewsSummaryController extends Controller
{
    //
	public function show_all_14(){
        $title_select = "News";
        return view('show_news_14', compact('title_select'));
    }
    public function indexCategory(){
        //$today = Carbon::today('Asia/Tokyo'); 
        $today = Carbon::createFromDate('2019', '10', '31', 'Asia/Tokyo' );
        $today_time = $today->format('Y-m-d');
        $first_day = $today->copy()->subDays(14);
        $cat_month = array_unique(NewsSummary::selectraw("DATE_FORMAT(`date`, '%Y-%m-%d') as `new_date`, `media`")->whereBetween("date", [$first_day, $today_time])->groupby('new_date','media')->pluck('media')->toArray());
        $re_value_cat = array_values($cat_month);
        return(['category'=>$re_value_cat]);
    }

    public function showByCategory($category){
        //$today = Carbon::today('Asia/Tokyo');
        $today = Carbon::createFromDate('2019', '10', '31', 'Asia/Tokyo' );
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
        $cat_before_data_list = NewsSummary::selectraw("DATE_FORMAT(`date`, '%Y-%m-%d') as `new_date`, `type`, `media` ,sum(count_num) as `sum_count`")->whereBetween("date", [$first_day, $today_time])->groupby('new_date','type', 'media')->where('media',$category)->where('type','list')->get();
        $cat_eachday_list = $back_14_array;
        foreach($cat_before_data_list as $each_value){
            for($i=0; $i<count($cat_eachday_list); $i++){
                if($cat_eachday_list[$i]['day'] == $each_value['new_date']){
                    $cat_eachday_list[$i]['count'] = $each_value['sum_count'];
                }

            }
        }
        $cat_before_data_page = NewsSummary::selectraw("DATE_FORMAT(`date`, '%Y-%m-%d') as `new_date`, `type`, `media` ,sum(count_num) as `sum_count`")->whereBetween("date", [$first_day, $today_time])->groupby('new_date','type', 'media')->where('media',$category)->where('type','page')->get();
        $cat_eachday_page = $back_14_array;
        foreach($cat_before_data_page as $each_value){
            for($i=0; $i<count($cat_eachday_page); $i++){
                if($cat_eachday_page[$i]['day'] == $each_value['new_date']){
                    $cat_eachday_page[$i]['count'] = $each_value['sum_count'];
                }
            }

        }
        $return_value['results']['list'] = $cat_eachday_list;
        $return_value['results']['page'] = $cat_eachday_page;
        return($return_value);
    }
}
