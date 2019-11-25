<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ShowOverallController extends Controller
{
    //
    public function showOverall(){
        $title_select = 'all';
        return(view('OverallPage', compact('title_select')));
    }
}
