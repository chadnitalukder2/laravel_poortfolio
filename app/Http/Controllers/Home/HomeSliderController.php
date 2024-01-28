<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\HomeSlide;
use Illuminate\Http\Request;


class HomeSliderController extends Controller
{
    public function HomeSlider (){
        $homeslide = $this->getHomeSlide();
        return view('admin.home_slide.home_slide_all', compact('homeslide'));
    }

    public function getHomeSlide() {
        $homeslide = HomeSlide::first();
        //  dd($homeslide);
        if(!$homeslide){
            $homeslide = array( 
                'id'=> 1,
                'title' => 'Home Slider Title',
                'short_title' => 'Home Slider Short Title',
                'video_url' => 'www.youtube.com',
                'home_slide' => 'https://png.pngtree.com/png-vector/20220709/ourmid/pngtree-businessman-user-avatar-wearing-suit-with-red-tie-png-image_5809521.png',
            ); 
            $homeslide = (object) $homeslide;
        }

        return $homeslide;
    }

    public function UpdateSlider(Request $request){
        try {
            $slide_id = $request->id;
            if($request->file('home_slide')){
                $imageName = $request->home_slide->getClientOriginalName();  
                $save_url = 'upload/home_slide/'.$imageName;

                if(file_exists($save_url)){
                unlink($save_url);
                }
                $request->home_slide->move(public_path('upload/home_slide'), $imageName);
            }
            else{
                $save_url = '';
            }
            HomeSlide::updateOrCreate([
                'id' => $slide_id
            ],[
                'title' => $request->title,
                'short_title' => $request->short_title,
                'video_url' => $request->video_url,
                'home_slide' => $save_url,
            ]);
            $notification = array( 
                'message' => 'Home Slide Updated With Image Successfully',
                'alert-type' => 'success'
            );
        } catch (\Throwable $th) {
            $notification = array( 
                'message' => 'Something Went Wrong',
                'alert-type' => 'success'
            );
        }

        return redirect()->back()->with($notification);
      
   
    }//end method


}