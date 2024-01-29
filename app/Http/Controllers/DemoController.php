<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Home\HomeSliderController;
use App\Http\Controllers\Home\AboutController;
use Illuminate\Http\Request;

class DemoController extends Controller
{
    public function HomeMain(){
        //home
        $HomeSliderController =  new HomeSliderController();
        $homeslide = $HomeSliderController->getHomeSlide();

        //About
        $AboutController = new AboutController();
        $aboutSlide  = $AboutController->getAboutSlide();

      
        //dd($homeslide->toArray());
        return view('frontend.index', compact('homeslide','aboutSlide'));
    }
}
