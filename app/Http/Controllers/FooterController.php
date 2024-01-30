<?php

namespace App\Http\Controllers;

use App\Models\footer;
use Illuminate\Http\Request;


class FooterController extends Controller
{
    public function FooterSetup ()
    {
        $allfooter = $this->getFooterPage();
        return view('admin.footer.footer_all', compact('allfooter'));
    }//End

    public function getFooterPage() {
      
        $allfooter = footer::first();
    
        if(!$allfooter){
            $allfooter = array( 
                'id'=> 1,
                'number' => '01753507238',
                'short_description' => 'There are many variations of passages of lorem ipsum available but the majority have suffered alteration in some form is also here.',
                'address' => 'Derai, Sylhet Bangladesh.',
                'email' => 'puja@gmail.com',
                'facebook' => 'https://www.facebook.com/',
                'twitter' => 'https://en.wikipedia.org/wiki/Twitter',
                'copyright' => 'Puja',

            ); 
            $allfooter = (object) $allfooter;
        }

        return $allfooter;
    }

    public function UpdateFooter(Request $request)
    {
        try{
            $footer_id = $request->id;
    
            footer::updateOrCreate([
                'id' => $footer_id
            ],[
                'number' => $request->number,
                'short_description' => $request->short_description,
                'address' => $request->address,
                'email' => $request->email,
                'facebook' => $request->facebook,
                'twitter' => $request->twitter,
                'copyright' => $request->copyright,
            ]);
    
            $notification = array(
                'message' => 'Footer Updated Successfully', 
                'alert-type' => 'success'
            );

        
        }catch (\Throwable $th) {
            $notification = array( 
                'message' => 'Something Went Wrong',
                'alert-type' => 'success'
            );
        }
        return redirect()->back()->with($notification);
    }//End
}
