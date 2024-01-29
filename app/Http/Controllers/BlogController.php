<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\BlogCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function AllBlog()
    {
        $blogs = Blog::latest()->get();

        return view('admin.blogs.blogs_all', compact('blogs'));
    }//end

    public function AddBlog(){
        $categories = BlogCategory::orderBy('blog_category', 'ASC')->get();
        return view('admin.blogs.blogs_add', compact('categories'));
    }//end

    public function StoreBlog(Request $request)
    {
        try{
            $imageName = $request->blog_image->getClientOriginalName();  
            $save_url = 'upload/blog/'.$imageName;
            $request->blog_image->move(public_path('upload/blog'), $imageName);

        Blog::insert([
            'blog_category_id' => $request->blog_category_id,
            'blog_title' => $request->blog_title,
            'blog_tags' => $request->blog_tags,
            'blog_description' => $request->blog_description,
            'blog_image' => $save_url,
            'created_at' => Carbon::now(),

        ]);
        
        $notification = array(
            'message' => 'Blog Inserted Successfully', 
            'alert-type' => 'success'
        );

        return redirect()->route('all.blog')->with($notification);
        }catch (\Throwable $th) {
            $notification = array( 
                'message' => 'Something Went Wrong',
                'alert-type' => 'success'
            );
        }
           
    }//end

    public function EditBlog($id)
    {

        $blogs = Blog::findOrFail($id);
        $categories = BlogCategory::orderBy('blog_category','ASC')->get();

        return view('admin.blogs.blogs_edit',compact('blogs','categories'));
    }//End

    public function UpdateBlog(Request $request)
    {
        try{
            $blog_id = $request->id;

            if ($request->file('blog_image')) {
             $imageName = $request->blog_image->getClientOriginalName();  
             $save_url = 'upload/blog/'.$imageName;
             $request->blog_image->move(public_path('upload/blog'), $imageName);
     
                Blog::findOrFail($blog_id)->update([
                    'blog_category_id' => $request->blog_category_id,
                    'blog_title' => $request->blog_title,
                    'blog_tags' => $request->blog_tags,
                    'blog_description' => $request->blog_description,
                    'blog_image' => $save_url,
     
                ]); 
                $notification = array(
                'message' => 'Blog Updated with Image Successfully', 
                'alert-type' => 'success'
            );
     
            return redirect()->route('all.blog')->with($notification);
     
            } else{
     
                Blog::findOrFail($blog_id)->update([
                    'blog_category_id' => $request->blog_category_id,
                    'blog_title' => $request->blog_title,
                    'blog_tags' => $request->blog_tags,
                    'blog_description' => $request->blog_description, 
     
                ]); 
     
                $notification = array(
                'message' => 'Blog Updated without Image Successfully', 
                'alert-type' => 'success'
            );
     
           return redirect()->route('all.blog')->with($notification);
     
            } // end Else
        }catch (\Throwable $th) {
            $notification = array( 
                'message' => 'Something Went Wrong',
                'alert-type' => 'success'
            );
        }

    } // End Method

   public function DeleteBlog($id)
   {
    Blog::findOrFail($id)->delete();

    $notification = array(
        'message' => 'Blog Deleted Successfully',
        'alert-type' => 'success',
    );

    return redirect()->back()->with($notification);
   }//End


   
   public function BlogDetails($id)
    {
        $allblogs = Blog::latest()->limit(5)->get();
        $blogs = Blog::findOrFail($id);
        $categories = BlogCategory::orderBy('blog_category','ASC')->get();
        return view('frontend.blog_details',compact('blogs','allblogs','categories'));

    } // End Method 

    public function CategoryBlog($id)
    {
        $blogpost = Blog::where('blog_category_id',$id)->orderBy('id','DESC')->get();
        $allblogs = Blog::latest()->limit(5)->get();
        $categories = BlogCategory::orderBy('blog_category','ASC')->get();
        $categoryname = BlogCategory::findOrFail($id);
        return view('frontend.cat_blog_details',compact('blogpost','allblogs','categories','categoryname'));

    } // End Method 


    public function HomeBlog()
    {

        $categories = BlogCategory::orderBy('blog_category','ASC')->get();
        $allblogs = Blog::latest()->paginate(3);
        return view('frontend.blog',compact('allblogs','categories'));

     } // End Method 

}
