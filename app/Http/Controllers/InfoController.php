<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class InfoController extends Controller
{
    //
    public function about_us(){
    	return view('about.about_us');
    }
}
