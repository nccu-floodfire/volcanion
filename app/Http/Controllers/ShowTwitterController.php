<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ShowTwitterController extends Controller
{
    //
    public function showTwitter(){
        $title_select = 'Twitter';
        return(view('TwitterPage', compact('title_select')));
    }
}
