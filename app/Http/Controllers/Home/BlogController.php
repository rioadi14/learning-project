<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
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
        $categories = BlogCategory::orderBy('blog_category', 'ASC')->get();

        return view('admin.blog.blogs_add', compact('categories'));
    }
    
    public function StoreBlog(Request $request){

        $request->validate([
            'blog_category_id' => 'required',
            'blog_title' => 'required',
            'blog_tags' => 'required',
            'blog_description' => 'required',
            'blog_image' => 'required'
        ],[
            'blog_title.required' => 'Blog Title is Required',
        ]);

        $image = $request->file('blog_image');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();

        Image::make($image)->resize(430,327)->save('upload/blog/'.$name_gen);
        $save_url = 'upload/blog/'.$name_gen;

        Blog::insert([
            'blog_category_id' => $request->blog_category_id,
            'blog_title' => $request->blog_title,
            'blog_tags' => $request->blog_tags,
            'blog_description' => $request->blog_description,
            'blog_image' => $save_url,
            'created_at' => Carbon::now(),
        ]);
        $notification = array(
            'message' => 'Blog Added With Image Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.blog')->with($notification);
    }
}
