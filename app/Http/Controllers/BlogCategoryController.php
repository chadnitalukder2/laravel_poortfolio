<?php

namespace App\Http\Controllers;

use App\Models\BlogCategory;
use Illuminate\Http\Request;

class BlogCategoryController extends Controller
{
    public function AllBlogCategory()
    {
        $blogCategory = BlogCategory::latest()->get();

        return view('admin.blog_category.blog_category_all',compact('blogCategory'));
    }//End

    public function AddBlogCategory(){

        return view('admin.blog_category.blog_category_add');
    } // End Method

    public function StoreBlogCategory(Request $request)
    {
        $request->validate([
            'blog_category' => 'required'
        ],[ 
            'blog_category.required' => 'Blog Category Name is Required',
        ]);
   
        BlogCategory::insert([
            'blog_category' => $request->blog_category,
        ]);

        
        $notification = array(
            'message' => 'Blog Category Inserted Successfully', 
            'alert-type' => 'success'
        );

        return redirect()->route('all.blog_category')->with($notification);

    }//End




}
