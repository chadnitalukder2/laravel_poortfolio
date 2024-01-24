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
}
