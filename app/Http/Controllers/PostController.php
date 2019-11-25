<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

//use Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Vinkla\Hashids\Facades\Hashids;
use App\PttSummary;
use App\TwitterSummary;
use App\NewsSummary;


class PostController extends Controller
{
    //
    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'type' => [
                'required',
                Rule::in(['ptt', 'twitter', 'news', 'facebook'])
            ],
            'detail' => 'required|string',
            'date' => 'required|date_format:Y-m-d H:i:s',
            'count_num' => 'required|numeric',
            ]);

        if ($validator->fails()){
            return response()->json([
                'status' =>422,
                'type' => 'error',
                'message' => $validator->messages()
            ], 422);

        }
        $select_type = $request->type;
        $select_date = $request->date;
        $select_date = str_replace("-","",$select_date);
        $select_date = str_replace(":","",$select_date);
        $select_date = str_replace(" ","",$select_date);
#       print_r(Hashids::connection($select_type)->encode($select_date));
       
        if (Hashids::connection($select_type)->encode($select_date) == $request->hashid){
 #           print_r("XuX");
            switch($select_type){
                case "ptt":
#                    print_r("OuO");
                    $ptt_cat_array = explode("__", $request->detail);
                    if (count($ptt_cat_array) == 1){
                        
                        $ptt = new PttSummary;
                        $ptt->date = $request->date;
                        $ptt->category = $ptt_cat_array[0];
                        $ptt->count_num = $request->count_num;
                        $ptt->save();
                        $output = $ptt;
#                        print_r("ptt save");
                        
                    }
                    break;
                case "twitter":
                    $twitter_cat_array = explode("__", $request->detail);
                    if (count($twitter_cat_array) == 1){ 
                        $twitter = new TwitterSummary;
                        $twitter->date = $request->date;
                        $twitter->bin_name = $twitter_cat_array[0];
                        $twitter->count_num = $request->count_num;
                        $twitter->save();
                        $output = $twitter;
#                        print_r("twitter save");
                            
                    }
                    break;

                case "news":
#                    print_r("NuN");
                    $news_cat_array = explode("__", $request->detail);
                    if (count($news_cat_array) == 2){ 
                        $news = new NewsSummary;
                        $news->date = $request->date;
                        $news->type = $news_cat_array[0];
                        $news->media = $news_cat_array[1];
                        $news->count_num = $request->count_num;
                        $news->save();
                        $output = $news;
                                
                    }
                    break;
           }
           $response['status'] = 201;
           $resoonse['type'] = 'success';
           $response['message'] = 'Type ' . $select_type . ' has been created.';
           return response()->json($response, $response['status']);


        }

    }

}
