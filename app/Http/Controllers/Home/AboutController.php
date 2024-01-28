<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\About;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function AboutSlider()
    {
        $aboutSlide = $this->getAboutSlide();
        return view('admin.about_page.about_page_all', compact('aboutSlide'));
    }//End

    public function getAboutSlide() {
        $aboutSlide = About::first();
        //  dd($aboutSlide);
        if(!$aboutSlide){
            $aboutSlide = array(
                'id'=> 1,
                'title' => 'About Title',
                'short_title' => 'About Short Title',
                'short_description' => 'About Short Description ',
                'long_description' => 'About Long Description',
                'about_image' => 'https://png.pngtree.com/png-vector/20220709/ourmid/pngtree-businessman-user-avatar-wearing-suit-with-red-tie-png-image_5809521.png',
            );
            $aboutSlide = (object) $aboutSlide;
        }

        return $aboutSlide;
    }

    public function UpdateAboutSlider(Request $request)
    {
        try {
            $about_id = $request->id;
    
            if($request->file('about_image')){
                $imageName = $request->about_image->getClientOriginalName();  
                $save_url = 'upload/about_slide/'.$imageName;
                if(file_exists($save_url)){
                unlink($save_url);
                }
                $request->about_image->move(public_path('upload/about_slide'), $imageName);
            }
            else{
                $save_url = '';
            }
            
            About::updateOrCreate([
                'id' => $about_id
            ],[
                'title' => $request->title,
                'short_title' => $request->short_title,
                'short_description' => $request->short_description,
                'long_description' => $request->long_description,
                'about_image' => $save_url,

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
    }//End


    public function HomeAbout()
    {
        $aboutSlide = $this->getAboutSlide();
        return view('frontend.about_page', compact('aboutSlide'));
    }//End

    public function AboutMultiImage()
    {
         return view('admin.about_page.multiImage');
    }//End

}