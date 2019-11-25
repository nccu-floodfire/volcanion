<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ShowPttController extends Controller
{
    //
    public function showPtt(){
        $title_select = 'Ptt';
        return(view('PttPage', compact('title_select')));
    }
}
