<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function Contact(){
        return view('frontend.contact');
    }//End

    public function StoreMessage(Request $request){

        Contact::insert([

            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'phone' => $request->phone,
            'message' => $request->message, 
            'created_at' => Carbon::now(),

        ]);

         $notification = array(
            'message' => 'Your Message Submited Successfully', 
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    } // end 

    public function ContactMessage(){

        $contacts = Contact::latest()->get();
        return view('admin.contact.allcontact',compact('contacts'));
    } // end 


    public function DeleteMessage($id){

     Contact::findOrFail($id)->delete();

     $notification = array(
            'message' => 'Your Message Deleted Successfully', 
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    } // end
}
