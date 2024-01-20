<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\About;
use Illuminate\Http\Request;
use Image;

class AboutController extends Controller
{
    public function AboutSlider(){
        $aboutSlide = About::find(1) ;
        return view('admin.about_page.about_page_all', compact('aboutSlide'));
    }

    public function UpdateAboutSlider(Request $request){
        $about_id = $request->id;

        if($request->file('about_slide')){
            $image = $request->file('about_slide');
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension(); //98778.jpg
            
           // \Intervention\Image\Facades\Image::make($image)->resize(523,605)->save('upload/about_slide/'.$name_gen);
          
           
            $save_url = 'upload/about_slide/'.$name_gen;

           About::findOrFail($about_id)->update([
                'title' => $request->title,
                'short_title' => $request->short_title,
                'short_description' => $request->short_description,
                'long_description' => $request->long_description,
                'about_slide' => $save_url,
            ]); 
            $notification = array( 
                'message' => 'About Slide Updated With Image Successfully',
                'alert-type' => 'success'
            ); 
            return redirect()->back()->with($notification);
        }
        else{
            About::findOrFail($about_id)->update([
                'title' => $request->title,
                'short_title' => $request->short_title,
                'short_description' => $request->short_description,
                'long_description' => $request->long_description,
            ]); 
            $notification = array( 
                'message' => 'About Slide Updated Without  Image Successfully',
                'alert-type' => 'success'
            ); 
            return redirect()->back()->with($notification);
        }//end else
    }


    public function HomeAbout(){
        $aboutSlide = About::find(1) ;
        return view('frontend.body.about_page', compact('aboutSlide'));
    }
}
