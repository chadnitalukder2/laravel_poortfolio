<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        $notification = array(
         'message' => 'User Logout Successfully',
         'alert-type' => 'success'
       ); 

        return redirect('/login')->with($notification);
    } //Login destroy 

    public function Profile()
     {
        $id = Auth::user()->id;
        $adminData = User::find($id);

        //profile-page e dd hobe
        //dd($adminData->toArray()); 
        return view('admin.admin_profile_view', compact('adminData'));
     } //Profile View Page

     public function EditProfile()
     { 
        $id = Auth::user()->id;
        $editData = User::find($id);

        return view('admin.admin_profile_edit', compact('editData'));
     }//edit Profile 


     public function StoreProfile(Request $request)
     {
        $id = Auth::user()->id;
        $data = User::find($id);
        $data->name     = $request->name;
        $data->email    = $request->email;
        $data->username = $request->username;

        if($request->file('profile_image')){
            $file = $request->file('profile_image');

            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/admin_images'),$filename );             
            $data['profile_image'] = $filename;
        }
        $data->save(); 

        $notification = array(
            'message' => 'Admin Profile Updated Successfully',
            'alert-type' => 'success'
        ); 

        return redirect()->route('admin.profile')->with($notification);  
     }//store profile img

     public function ChangePassword(){
       return view('admin.admin_change_password');
     }

}
