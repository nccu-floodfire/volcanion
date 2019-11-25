<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PttSummary;
use App\TwitterSummary;
use App\NewsSummary;
use Carbon\Carbon;

class OverallSummaryController extends Controller
{
    //

    public function indexCategory(){
        $each_page = array('Ptt', 'Twitter', 'News');
        return (['category'=>$each_page]);
    }


    public function showByTitle($title){
       // $today = Carbon::today('Asia/Tokyo');
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
        $cat_before_data = [];
        
        switch($title){
            case "Ptt":
                $cat_before_data = PttSummary::selectraw("DATE_FORMAT(`date`, '%Y-%m-%d') as `new_date`, sum(count_num) as `sum_count`")->whereBetween("date", [$first_day, $today_time])->groupby('new_date')->get();
                break;
            case "Twitter":
                $cat_before_data = TwitterSummary::selectraw("DATE_FORMAT(`date`, '%Y-%m-%d') as `new_date`, sum(count_num) as `sum_count`")->whereBetween("date", [$first_day, $today_time])->groupby('new_date')->get();
                break;
            case "News":
                $cat_before_data = NewsSummary::selectraw("DATE_FORMAT(`date`, '%Y-%m-%d') as `new_date`, sum(count_num) as `sum_count`")->whereBetween("date", [$first_day, $today_time])->groupby('new_date')->get();
                break;
        }
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
}
