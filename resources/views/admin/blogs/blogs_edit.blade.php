@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<style type="text/css">
    .bootstrap-tagsinput .tag{
        margin-right: 2px;
        color: #b70000;
        font-weight: 700px;
    } 
</style>
<div class="page-content">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Edit Blogs Page</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Upcube</a></li>
                            <li class="breadcrumb-item active">Add Blogs</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <h4 class="card-title">Add Blogs</h4>
                        <p class="card-title-desc">Here are form of <code class="highlighter-rouge">Add Blogs</code> to your Blogs Page.</p>
                        <form action="{{ route('update.blog', $blogs->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
    
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Blog Category</label>
                                    <div class="col-sm-10">
                                        <select name="blog_category_id" class="form-select" aria-label="Default select example">
                                            <option selected="">Select Blog Category</option>
                                            @foreach ($categories as $item)
                                                <option value="{{ $item->id }}" {{ $item->id == $blogs->blog_category_id ? 'selected' : ''}}>{{ $item->blog_category }}</option> <!-- matched id -->
                                            @endforeach
                                            </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Blog Title</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" name="blog_title" id="example-text-input" value="{{ $blogs->blog_title }}">
                                        @error('blog_title')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <!-- end row -->
                                <div class="row mb-3">
                                    <label for="example-email-input" class="col-sm-2 col-form-label">Blog Tags</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" name="blog_tags"  value="{{ $blogs->blog_tags }}" data-role="tagsinput" id="example-email-input">
                                    </div> 
                                </div>
                                <!-- end row -->
                                <div class="row mb-3">
                                    <label for="example-email-input" class="col-sm-2 col-form-label">Blog Description</label>
                                    <div class="col-sm-10">
                                        <textarea id="elm1" name="blog_description" > {{ $blogs->blog_description }} </textarea>
                                    </div> 
                                </div>
                                <!-- end row -->
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Blog Image</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="file" name="blog_image" id="image">
                                    </div>
                                </div>
                                <!-- end row -->
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Preview Blog</label>
                                    <div class="col-sm-10">
                                        <img id="showImage" class="rounded avatar-lg" src="{{ asset($blogs->blog_image) }}" alt="Card image cap">
                                        
                                    </div>
                                </div>
                                <!-- end row -->
                                <input type="submit" class="btn btn-info waves-effect waves-light" value="Update Blog">
                            </form>
                    </div>
                </div>
            </div> <!-- end col -->
        </div>
    </div>
</div>
{{-- Preview Image --}}
<script type="text/javascript">
    $(document).ready(function(){
        $('#image').change(function(e){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#showImage').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        })
    })
</script>
@endsection