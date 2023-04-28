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

        return view('admin.blogs.blogs_all', compact('blogs'));
    }
    public function AddBlog(){
        $categories = BlogCategory::orderBy('blog_category', 'ASC')->get();

        return view('admin.blogs.blogs_add', compact('categories'));
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

    public function EditBlog($id){
        $blogs = Blog::findOrFail($id);
        $categories = BlogCategory::orderBy('blog_category', 'ASC')->get();

        return view('admin.blogs.blogs_edit', compact('blogs', 'categories'));
    }

    public function UpdateBlog(Request $request, $id){

        if ($request->file('blog_image')) {

            $image = $request->file('blog_image');
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();

            Image::make($image)->resize(430,327)->save('upload/blog/'.$name_gen);
            $save_url = 'upload/blog/'.$name_gen;

            Blog::findOrFail($id)->update([
                'blog_category_id' => $request->blog_category_id,
                'blog_title' => $request->blog_title,
                'blog_tags' => $request->blog_tags,
                'blog_description' => $request->blog_description,
                'blog_image' => $save_url,
            ]);
            $notification = array(
                'message' => 'Blog Updated With Image Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('all.blog')->with($notification);
        } else {
            Blog::findOrFail($id)->update([
                'blog_category_id' => $request->blog_category_id,
                'blog_title' => $request->blog_title,
                'blog_tags' => $request->blog_tags,
                'blog_description' => $request->blog_description,

            ]);
            $notification = array(
                'message' => 'Blog Updated Without Image Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('all.blog')->with($notification);
        }
    }

    public function DeleteBlog($id){
        $blogs = Blog::findOrFail($id);
        $img = $blogs->blog_image;
        unlink($img);

        Blog::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Blog Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function BlogDetails($id){
        $categories = BlogCategory::orderBy('blog_category', 'ASC')->get();
        $allblogs = Blog::latest()->limit(5)->get();
        $blogs = Blog::findOrFail($id);

        return view('frontend.blog_details', compact('categories','allblogs','blogs'));
    }

    public function CategoryBlog($id){
        $blogpost = Blog::where('blog_category_id', $id)->orderBy('id','DESC')->get();
        $categories = BlogCategory::orderBy('blog_category', 'ASC')->get();
        $allblogs = Blog::latest()->limit(5)->get();
        $categoryname= BlogCategory::findOrFail($id);
        return view('frontend.cat_blog_details', compact('blogpost','categories','allblogs','categoryname'));
    }

    public function HomeBlog(){
        $allblogs = Blog::latest()->paginate(3);
        $categories = BlogCategory::orderBy('blog_category', 'ASC')->get();

        return view('frontend.blog', compact('allblogs','categories'));
    }
}
 