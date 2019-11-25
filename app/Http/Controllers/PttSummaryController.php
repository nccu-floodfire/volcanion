<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PttSummary;
use Carbon\Carbon;
class PttSummaryController extends Controller
{
	public function index(){
		return PttSummary::all();
    }
    public function show_all(){
        $title_select = "Ptt";
        $all_data = PttSummary::all() ->toArray();
        $cat_hate = PttSummary::where('category','政黑')->orderBy('date')->get();
        $cat_month = PttSummary::selectraw("DATE_FORMAT(`date`, '%Y-%m-%d') as `new_date`, `category`, sum(count_num) as `sum_count`")->whereMonth('date','=','04')->groupby('new_date','category')->get();
//        echo $cat_month;
        $i = count($cat_month);
        $each_day = array();
        for ($j=0; $j<$i; $j++){
            if (!array_key_exists($cat_month[$j]['new_date'],$each_day)){
                $each_day[$cat_month[$j]['new_date']]= array();
                $each_day[$cat_month[$j]['new_date']]['date']= $cat_month[$j]['new_date'];
                $each_day[$cat_month[$j]['new_date']]['政黑']= 0;
                $each_day[$cat_month[$j]['new_date']]['八卦']= 0;
            }
                
            $each_day[$cat_month[$j]['new_date']][$cat_month[$j]['category']] = $cat_month[$j]['sum_count'];
        //print_r($each_day);
        return view('show_ptt', compact('title_select', 'all_data','cat_hate', 'cat_month', 'each_day'));
        }
    }
    public function show_all_30(){
        $today = Carbon::today('Asia/Tokyo');
        $title_select = "Ptt";
//        print_r($today);
        $today_time = $today->format('Y-m-d');
        //        print_r($today_time);
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
//            print_r($temp);
//            array_push($back_14_array, $temp->copy()->format('Y-m-d')=>0);
        
        }
        $back30_time = $today;
        print_r($back_14_array);
//        print_r($first_day);
        $all_data = PttSummary::all() ->toArray();
        $cat_hate = PttSummary::where('category','政黑')->orderBy('date')->get();
        $cat_hate_day = array();
        $cat_gossip_day = array();
//        for ($i=0; $i<count($cat_hate); $i++){
//            $useDay = $cat_hate[$i]['date']->format('Y-m-d');
//            $usecount = $cat_hate[$i]['count_num'];
//            $cat_hate_array[$useDay] = $usecount;
//        }
//        print_r($cat_hate_array);
//        print_r($cat_hate[0]['date']);
        $cat_month = PttSummary::selectraw("DATE_FORMAT(`date`, '%Y-%m-%d') as `new_date`, `category`, sum(count_num) as `sum_count`")->whereBetween("date", [$first_day, $today_time])->groupby('new_date','category')->get();
//        print_r($cat_month);
        for ($i=0; $i<count($cat_month); $i++){
//            print_r('OuO');
//            print_r($i);
//            print_r($cat_month[$i]);
            if ($cat_month[$i]['category'] == '政黑'){
                $cat_hate_day[$cat_month[$i]['new_date']] = $cat_month[$i]['sum_count'];
            }
            elseif($cat_month[$i]['category'] == '八卦'){
                $cat_gossip_day[$cat_month[$i]['new_date']] = $cat_month[$i]['sum_count'];
            } 
        
        }
//        print_r($cat_hate_day);
//        print_r($cat_gossip_day);
        $i = count($cat_month);
        $each_day = array();
        for ($j=0; $j<$i; $j++){
            if (!array_key_exists($cat_month[$j]['new_date'],$each_day)){
                $each_day[$cat_month[$j]['new_date']]= array();
                $each_day[$cat_month[$j]['new_date']]['date']= $cat_month[$j]['new_date'];
                $each_day[$cat_month[$j]['new_date']]['政黑']= 0;
                $each_day[$cat_month[$j]['new_date']]['八卦']= 0;
            }
                
            $each_day[$cat_month[$j]['new_date']][$cat_month[$j]['category']] = $cat_month[$j]['sum_count'];

        }
//        print_r($each_day);
        $cat_hate_eachday = $back_14_array;
        for ($i=0; $i<count($back_14_array); $i++){
            $day_key = $cat_hate_eachday[$i]['day'];
            if(array_key_exists($day_key, $cat_hate_day)){
                $cat_hate_eachday[$i]['count'] = $cat_hate_day[$day_key];
            }
        }
//        print_r('OXO');
//        print_r($cat_hate_eachday);
        $cat_gossip_eachday = $back_14_array;
        for($i=0; $i<count($back_14_array); $i++){
            $day_key = $cat_gossip_eachday[$i]['day'];
            if(array_key_exists($day_key, $cat_gossip_day)){
                $cat_gossip_eachday[$i]['count'] = $cat_gossip_day[$day_key];
            }
        }
//        print_r('OuO');
//        print_r($cat_gossip_eachday);
        return view('show_ptt_30', compact('title_select', 'all_data','cat_hate', 'cat_month', 'each_day', 'cat_gossip_eachday', 'cat_hate_eachday'));
    }

    public function titleSelect(){
        $title_select = "Ptt";
        return(['title'=>$title_select]);

    }
    
    public function indexCategory(){
    //    $today = Carbon::today('Asia/Tokyo');
        $today = Carbon::createFromDate('2019', '10', '20', 'Asia/Tokyo' );
        $today_time = $today->format('Y-m-d');
        $first_day = $today->copy()->subDays(14);
        $cat_month = array_unique(PttSummary::selectraw("DATE_FORMAT(`date`, '%Y-%m-%d') as `new_date`, `category`")->whereBetween("date", [$first_day, $today_time])->groupby('new_date','category')->pluck('category')->toArray());
        $re_value_cat = array_values($cat_month);
        //return (['category'=>$cat_month]);
        return(['category'=>$re_value_cat]);

    }

    public function showByCategory($category){
//        $today = Carbon::today('Asia/Tokyo');
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
 //       print_r($back_14_array);
 //       print_r($category);
        $cat_before_data = PttSummary::selectraw("DATE_FORMAT(`date`, '%Y-%m-%d') as `new_date`, `category`, sum(count_num) as `sum_count`")->whereBetween("date", [$first_day, $today_time])->groupby('new_date','category')->where('category',$category)->get();
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
