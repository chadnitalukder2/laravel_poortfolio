<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function AllService(){
        $service = Service::latest()->get();
        return view('admin.service.all_service',compact('service'));
    }//End

    public function AddService(){
        return view('admin.service.add_service');
    }
}
