@extends('layouts.adminlayout.admin_design')
@section('content')
<div id="content">
    <div id="content-header">
        <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Form elements</a> <a href="#" class="current">View Banners</a> </div>
        <h1>Banners</h1>
        @if(Session::has('flash_message_error'))
        <div class="alert alert-error alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{!!Session('flash_message_error')!!}</strong>
        </div>
        @endif

        @if(Session::has('flash_message_success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{!!Session('flash_message_success')!!}</strong>
        </div>
        @endif
    </div>
    <div class="container-fluid">
        <hr>
        <div class="row-fluid">
            <div class="span12">
                <div class="widget-box">
                    <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                        <h5>Banners</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <table class="table table-bordered data-table">
                            <thead>
                                <tr>
                                    <th>Banner Id</th>
                                    <th>Title</th>
                                    <th>Link</th>
                                    <th>Status</th>
                                    <th>Image</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($bannerdetail as $bannerdetails)
                                <tr class="gradeX">
                                    <td>{{$bannerdetails->id}}</td>
                                    <td>{{$bannerdetails->title}}</td>
                                    <td>{{$bannerdetails->link}}</td>
                                    <td>{{$bannerdetails->status}}</td>
                                    <td>
                                    <img src="{{asset('images/frontend_images/banners/'.$bannerdetails->image)}}" style="width:50px;">
                                    </td>
                                    <td class="center">
                                        <a href="{{url('/admin/edit-banners/'.$bannerdetails->id)}}" class="btn btn-primary btn-mini" title="Edit Product">Edit</a>
                                        <a <?php //href="{{url('admin/delete-product/'.$product->id)}}"?> rel="{{$bannerdetails->id}}" rel1="delete-banners" href="javascript:" class="btn btn-danger btn-mini deleteRecord" title="Delete Banners">Delete</a></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
