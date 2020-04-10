@extends('layouts.adminlayout.admin_design')
@section('content')
<div id="content">
    <div id="content-header">
        <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Form elements</a> <a href="#" class="current"></a> </div>
        <h1>Edit Banners</h1>
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
                    <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
                        <h5>Edit Banner</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <form class="form-horizontal" method="post" action="{{url('/admin/edit-banners/'.$bannerdetails->id)}}" name="edit_banners" id="edit_banners" enctype="multipart/form-data" novalidate="novalidate">{{ csrf_field() }}
                           
                            <div class="control-group">
                                <label class="control-label">Banner image</label>
                                <div class="controls">
                                    <input type="file" name="image" id="image">
                                    <input type="hidden" name="current_image" id="current_image" value="{{$bannerdetails->image}}">
                                      @if(!empty($bannerdetails->image))
                                      <img style="width:50px;" src="{{asset('/images/frontend_images/banners/'.$bannerdetails->image)}}">
                                      <a href="{{url('/admin/delete-bannerimage/'.$bannerdetails->id)}}" id="delban" class="btn btn-danger btn-mini">Delete</a>
                                      @endif
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Title</label>
                                <div class="controls">
                                    <input type="text" name="banner_title" id="banner_title" value="{{$bannerdetails->title}}">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Link</label>
                                <div class="controls">
                                    <input type="text" name="banner_link" id="banner_link" value="{{$bannerdetails->link}}">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Enable</label>
                                <div class="controls">
                                  <input type="checkbox" name="status" id="status" value="1" @if($bannerdetails->status==1) checked @endif>
                                </div>
                            </div>
                          
                            <div class="form-actions">
                                <input type="submit" value="Add Banner" class="btn btn-success">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
