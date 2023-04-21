<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
use Image;
use Illuminate\Support\Carbon;

class BlogController extends Controller
{
    public function AllBlog(){
        $blogs = Blog::latest()->get();

        return view('admin.blog.blogs_all', compact('blogs'));
    }
    public function AddBlog(){

        return view('admin.blog.blogs_add');
    }
}
