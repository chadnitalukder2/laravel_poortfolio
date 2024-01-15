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

        return redirect('/login');
    } //End Method  

    public function Profile(){
        $id = Auth::user()->id;
        $adminData = User::find($id);

        //profile-page e dd hobe
        //dd($adminData->toArray()); 
        return view('admin.admin_profile_view', compact('adminData'));
     } //End Method  

     public function EditProfile(){
        $id = Auth::user()->id;
        $editData = User::find($id);

        return view('admin.admin_profile_edit', compact('editData'));
     }//End Method 
}
