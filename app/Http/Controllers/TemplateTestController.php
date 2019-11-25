<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TemplateTestController extends Controller
{
    //
    public function select_type(){
    $title_select = "News";
    return view('templateTest', compact('title_select'));
    }
}
