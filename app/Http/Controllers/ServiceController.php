<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function AllService(){
        $service = Service::latest()->get();
        return view('admin.service.all_service',compact('service'));
    }//End

    public function AddService(){
        return view('admin.service.add_service');
    }//End

    public function StoreService(Request $request)
    {
        $request->validate([
            'service_title' => 'required',
            'service_description' => 'required',
            'service_image' => 'required',
        ],[
            'service_title.required' => 'Service Title is Required',
            'service_description.required' => 'Service Description Title is Required',
        ]);

        $image = $request->file('service_image');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();  // 3434343443.jpg

        //Image::make($image)->resize(1020,519)->save('upload/portfolio/'.$name_gen);
        $save_url = 'upload/Service/'.$name_gen;

        Service::insert([
            'service_title' => $request->service_title,
            'service_description' => $request->service_description,
            'service_image' =>  $save_url,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Service Inserted Successfully', 
            'alert-type' => 'success'
            );

        return redirect()->route('all.service')->with($notification);

    }//End

    public function EditService($id) 
    {
        $service = Service::findOrFail($id);

        return view('admin.service.service_edit', compact('service'));

    }

    public function UpdateService(Request $request){
        //dd($request->toArray());
        $service_id = $request->id;

        if ($request->file('service_image')) 
        {
            $image = $request->file('service_image');
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();  // 3434343443.jpg

            //Image::make($image)->resize(1020,519)->save('upload/portfolio/'.$name_gen);
            $save_url = 'upload/Service/'.$name_gen;

            Service::findOrFail($service_id)->update([
                'service_title' => $request->service_title,
                'service_description' => $request->service_description,
                'service_image' => $save_url,

            ]); 
            $notification = array(
            'message' => 'Service Updated with Image Successfully', 
            'alert-type' => 'success'
            );

            return redirect()->route('all.service')->with($notification);

        } 
        else
        {

            Service::findOrFail($service_id)->update([
                'service_title' => $request->service_title,
                'service_description' => $request->service_description,
            ]); 

            $notification = array(
            'message' => 'Service Updated without Image Successfully', 
            'alert-type' => 'success'
            );

            return redirect()->route('all.service')->with($notification);

        } // end Else
    }

    public function DeleteService($id){
        $service = Service::findOrFail($id);
        $img = $service->portfolio_image;
       // unlink($img);

       Service::findOrFail($id)->delete();

         $notification = array(
            'message' => 'Portfolio Image Deleted Successfully', 
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);  
    }


    public function HomeService()
    {
        $service = Service::latest()->get();
        return view('frontend.service',compact('service'));
    }

}
