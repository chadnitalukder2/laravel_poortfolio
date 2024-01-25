<?php

namespace App\Http\Controllers;

use App\Models\footer;
use Illuminate\Http\Request;

class FooterController extends Controller
{
    public function FooterSetup ()
    {
        $allfooter = footer::find(1);
        return view('admin.footer.footer_all', compact('allfooter'));
    }//End

    public function UpdateFooter(Request $request)
    {
        $footer_id = $request->id;

        footer::findOrFail($footer_id)->update([
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

        return redirect()->back()->with($notification);
    }//End
}
