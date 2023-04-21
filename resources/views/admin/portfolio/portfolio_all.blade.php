@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<div class="page-content">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Data Portfolio All</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Portfolio All</a></li>
                            <li class="breadcrumb-item active">Data Portfolio All</li>
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

                        <h4 class="card-title">Portfolio All</h4>
                        <p class="card-title-desc">DataTables has most features enabled by
                            default, so all you need to do to use it with your own tables is to call
                            the construction function: <code>$().DataTable();</code>.
                        </p>

                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th>Serial Number</th>
                                <th>Portfolio Name</th>
                                <th>Portfolio Title</th>
                                <th>Portfolio Image</th>
                                <th>Action</th>
                            </tr>
                            </thead>

                            <tbody>
                            @php($i = 1)
                            @foreach ($portfolio as $item)    
                                <tr>
                                    <td>{{ $i++}}</td>
                                    <td> {{ $item->portfolio_name }}</td>
                                    <td> {{ $item->portfolio_title }}</td>
                                    <td> <img src="{{ asset($item->portfolio_image) }}" alt="" style="width: 60px; height: 60px;"></td>
                                    <td>
                                        <a href="{{ route('edit.portfolio', $item->id) }}" class="btn btn-info sm " title="Edit Data">
                                            <i class="fas fa-edit"></i>
                                        </a> 
                                        <a href="{{ route('delete.portfolio',$item->id) }}" class="btn btn-danger sm " id="delete" title="Delete Data">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                    </td>
                                    
                                </tr>
                            @endforeach
                            
                            </tbody>
                        </table>

                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->
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