<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Portfolio;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    public function AllPortfolio()
    {
        $portfolio = Portfolio::latest()->get();

        return view('admin.portfolio.portfolio_all', compact('portfolio'));

    }//End methord

    public function AddPortfolio()
    {
        return view('admin.portfolio.portfolio_add');
    }

    public function StorePortfolio(Request $request)
    {
        try{
            $request->validate([
                'portfolio_name' => 'required',
                'portfolio_title' => 'required',
                'portfolio_image' => 'required',
            ],[
                'portfolio_name.required' => 'Portfolio Name is Required',
                'portfolio_title.required' => 'Portfolio Title is Required',
               
            ]);
            
            $imageName = $request->portfolio_image->getClientOriginalName();  
            $save_url = 'upload/portfolio/'.$imageName;
            $request->portfolio_image->move(public_path('upload/portfolio'), $imageName);
    
                Portfolio::insert([
                    'portfolio_name' => $request->portfolio_name,
                    'portfolio_title' => $request->portfolio_title,
                    'portfolio_description' => $request->portfolio_description,
                    'portfolio_image' => $save_url,
                    'created_at' => Carbon::now(),
    
                ]); 
                $notification = array(
                'message' => 'Portfolio Inserted Successfully', 
                'alert-type' => 'success'
                );
    
    
            return redirect()->route('all.portfolio')->with($notification);
        }catch (\Throwable $th) {
            $notification = array( 
                'message' => 'Something Went Wrong',
                'alert-type' => 'success'
            );
        }
        

    }//end 

    public function EditPortfolio ($id)
    {
        $portfolio = Portfolio::findOrFail($id);

        return view('admin.portfolio.portfolio_edit', compact('portfolio'));

    }//End

    public function UpdatePortfolio(Request $request)
    {
        try{
            $portfolio_id = $request->id;

            if ($request->file('portfolio_image')) 
            {
                $imageName = $request->portfolio_image->getClientOriginalName();  
                $save_url = 'upload/portfolio/'.$imageName;
                $request->portfolio_image->move(public_path('upload/portfolio'), $imageName);
    
                Portfolio::findOrFail($portfolio_id)->update([
                    'portfolio_name' => $request->portfolio_name,
                    'portfolio_title' => $request->portfolio_title,
                    'portfolio_description' => $request->portfolio_description,
                    'portfolio_image' => $save_url,
    
                ]); 
                $notification = array(
                'message' => 'Portfolio Updated with Image Successfully', 
                'alert-type' => 'success'
                );
    
                return redirect()->route('all.portfolio')->with($notification);
    
            } 
            else
            {
    
                Portfolio::findOrFail($portfolio_id)->update([
                    'portfolio_name' => $request->portfolio_name,
                    'portfolio_title' => $request->portfolio_title,
                    'portfolio_description' => $request->portfolio_description,
    
    
                ]); 
                $notification = array(
                'message' => 'Portfolio Updated without Image Successfully', 
                'alert-type' => 'success'
                );
    
                return redirect()->route('all.portfolio')->with($notification);
    
            } // end Else
        }catch (\Throwable $th) {
            $notification = array( 
                'message' => 'Something Went Wrong',
                'alert-type' => 'success'
            );
        }
      

    }//End

    public function DeletePortfolio ($id)
    {
        try{
            $portfolio = Portfolio::findOrFail($id);
            $img = $portfolio->portfolio_image;
           // unlink($img);
    
            Portfolio::findOrFail($id)->delete();
    
             $notification = array(
                'message' => 'Portfolio Image Deleted Successfully', 
                'alert-type' => 'success'
            );
    
            return redirect()->back()->with($notification);  
        }catch (\Throwable $th) {
            $notification = array( 
                'message' => 'Something Went Wrong',
                'alert-type' => 'success'
            );
        }
           

    }//End

    public function DetailsPortfolio($id)
    {
        $portfolio = Portfolio::findOrFail($id);
        return view('frontend.portfolio_details',compact('portfolio'));
    }//End


    public function HomePortfolio() {
        $portfolio =  Portfolio::latest()->get();
        return view('frontend.portfolio', compact('portfolio'));
    }//End

}
