<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Home\HomeSliderController;
use Illuminate\Http\Request;

class DemoController extends Controller
{
    public function HomeMain(){
        $HomeSliderController =  new HomeSliderController();
        $homeslide = $HomeSliderController->getHomeSlide();
        
        //dd($homeslide->toArray());
        return view('frontend.index', compact('homeslide'));
    }
}
