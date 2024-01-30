<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\MultiImage;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function AboutSlider()
    {
        $aboutSlide = $this->getAboutSlide();
        return view('admin.about_page.about_page_all', compact('aboutSlide'));
        
    }//End

    //-----------------------------------------------------------------------
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
                'skills_description' => 'About Skills Description',
                'awards_description' => 'About Awards Description',
                'educations_description' => 'About Education Description',
                'about_image' => 'https://png.pngtree.com/png-vector/20220709/ourmid/pngtree-businessman-user-avatar-wearing-suit-with-red-tie-png-image_5809521.png',
            );
            $aboutSlide = (object) $aboutSlide;
        }

        return $aboutSlide;
    }

    //-----------------------------------------------------------------------
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
                'skills_description' => $request->skills_description,
                'awards_description' => $request->awards_description,
                'educations_description' => $request->educations_description,
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

    //-----------------------------------------------------------------------
    public function HomeAbout()
    {
        $aboutSlide = $this->getAboutSlide();
        return view('frontend.about_page', compact('aboutSlide'));
    }//End

    //==================================multi_Image============================
    public function AboutMultiImage()
    {
         return view('admin.about_page.multiImage');
    }//End

    //-----------------------------------------------------------------------
    public function StoreMultiImage(Request $request){

            $image = $request->file('multi_image');

            foreach ($image as $multi_image) {
                 
                $imageName = $multi_image->getClientOriginalName();  
                $save_url = 'upload/multi/'.$imageName;
               
                $multi_image->move(public_path('upload/multi'), $imageName);
     
        
                 MultiImage::insert([
     
                     'multi_image' => $save_url,
                     'created_at' => Carbon::now()
     
                 ]); 
     
                  } // End of the froeach
     
     
                 $notification = array(
                 'message' => 'Multi Image Inserted Successfully', 
                 'alert-type' => 'success'
             );
     
             return redirect()->route('all.multi.image')->with($notification);
     

    
       
        

    }// End Method 

    //-----------------------------------------------------------------------
    public function AllMultiImage(){

        $allMultiImage = MultiImage::all();
        return view('admin.about_page.all_multiimage',compact('allMultiImage'));

    }// End Method 

    //-----------------------------------------------------------------------
    public function EditMultiImage($id){

        $multiImage = MultiImage::findOrFail($id);
        return view('admin.about_page.edit_multi_image',compact('multiImage'));

    }// End Method 

    //-----------------------------------------------------------------------
    public function DeleteMultiImage($id){

        $multi = MultiImage::findOrFail($id);
        $img = $multi->multi_image;
        unlink($img);

        MultiImage::findOrFail($id)->delete();

         $notification = array(
            'message' => 'Multi Image Deleted Successfully', 
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    }// End Method 

    //-----------------------------------------------------------------------
    public function UpdateMultiImage(Request $request){

        $multi_image_id = $request->id;

        if ($request->file('multi_image')) {
            $imageName = $request->multi_image->getClientOriginalName();  
            $save_url = 'upload/multi/'.$imageName;
            
            $request->multi_image->move(public_path('upload/multi'), $imageName);

            MultiImage::findOrFail($multi_image_id)->update([

                'multi_image' => $save_url,

            ]); 
            $notification = array(
            'message' => 'Multi Image Updated Successfully', 
            'alert-type' => 'success'
        );

        return redirect()->route('all.multi.image')->with($notification);

        }

    }// End Method 



}