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

    public function AddBlogCategory()
    {

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

    public function EditBlogCategory($id)
    {
        $blogCategory = BlogCategory::findOrFail($id);

        return view('admin.blog_category.blog_category_edit', compact('blogCategory'));

    }//End

    public function UpdateBlogCategory(Request $request, $id)
    {
        
        BlogCategory::findOrFail($id)->update([
            'blog_category' => $request->blog_category,
        ]);

        $notification = array(
            'message' => 'Blog Category Update Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.blog_category')->with($notification);

    }//End

    public function DeleteBlogCategory($id)
    {
        BlogCategory::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Blog Category Deleted Successfully', 
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);   
    }


}
