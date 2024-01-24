<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function AllBlog()
    {
        $blogs = Blog::latest()->get();

        return view('admin.blogs.blogs_all', compact('blogs'));
    }//end
}
