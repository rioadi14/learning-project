@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<div class="page-content">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Add Blog Category Page</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Upcube</a></li>
                            <li class="breadcrumb-item active">Add Blog Category</li>
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

                        <h4 class="card-title">Add Blog Category</h4>
                        <p class="card-title-desc">Here are form of <code class="highlighter-rouge">Add Blog Category</code> to your Blog Category Page.</p>
                        <form action="{{ route('store.blog.category') }}" method="post" id="myForm">
                        @csrf

                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Blog Category Name</label>
                                <div class="form-group col-sm-10">
                                    <input class="form-control" type="text" name="blog_category"   id="example-text-input">
                                    
                                </div>
                            </div>
                            <!-- end row -->
                            
                            <!-- end row -->
                            <input type="submit" class="btn btn-info waves-effect waves-light" value="Add Blog Category">
                        </form>
                    </div>
                </div>
            </div> <!-- end col -->
        </div>
    </div>
</div>
{{-- Validate JS --}}
<script type="text/javascript">
    $(document).ready(function(){
        $('#myForm').validate({
            rules: {
                blog_category: {
                    required : true,
                },
            },
            messages :{
                blog_category: {
                    required : 'Please Input the Blog Category',
                },
            },
            errorElement : 'span',
            errorPlacement: function(error, element){
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight : function(element, errorClass, validClass){
                $(element).addClass('is-invalid');
            },
            unhighlight : function(element, errorClass, validClass){
                $(element).removeClass('is-invalid');
            },
        })
    })
</script>
@endsection