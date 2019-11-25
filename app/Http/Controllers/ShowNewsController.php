<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ShowNewsController extends Controller
{
    //
    public function showNews(){
        $title_select = 'News';
        return(view('NewsPage', compact('title_select')));
    }
}
