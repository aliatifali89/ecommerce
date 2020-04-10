@extends('layouts.adminlayout.admin_design')
@section('content')
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Form elements</a> <a href="#" class="current"></a> </div>
    <h1>Edit Product</h1>
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
  <div class="container-fluid"><hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
            <h5>Products</h5>
          </div>
          <div class="widget-content nopadding">
            <form class="form-horizontal" method="post" action="{{url('/admin/edit-product/'.$product_details->id)}}" name="edit_product" id="edit_product" novalidate="novalidate" enctype="multipart/form-data">{{ csrf_field() }}
              <div class="control-group">
                <label class="control-label">Product Name</label>
                <div class="controls">
                  <input type="text" name="name" id="name" value="{{$product_details->product_name}}">
                </div>
              </div>
               <div class="control-group">
                <label class="control-label">Category Id</label>
                <div class="controls">
                  <input type="text" name="category_id" id="category_id" value="{{$product_details->category_id}}">
                </div>
              </div>
               <div class="control-group">
                <label class="control-label">Under Category</label>
                <div class="controls">
                  <select name="category_dropdown" id="category_dropdown" style="width:220px" value="">
                    <?php echo $categories_dropdown;?>  
                  </select>
                </div>
              </div>
               <div class="control-group">
                <label class="control-label">Description</label>
                <div class="controls">
                    <textarea name="description" id="description" value="">{{$product_details->product_description}}</textarea>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Care</label>
                <div class="controls">
                    <textarea name="care" id="care" value="">{{$product_details->care}}</textarea>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Product Price</label>
                <div class="controls">
                  <input type="text" name="price" id="price" value="{{$product_details->price}}">
                </div>
              </div>
               <div class="control-group">
                <label class="control-label">Product Code</label>
                <div class="controls">
                  <input type="text" name="code" id="code" value="{{$product_details->product_code}}">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Product Color</label>
                <div class="controls">
                  <input type="text" name="color" id="color" value="{{$product_details->product_color}}">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Image</label>
                <div class="controls">
                  <input type="file" name="image" id="image">
                  <input type="hidden" name="cimage" id="cimage" value="{{$product_details->image}}">
                  @if(!empty($product_details->image))
                  <img style="width:50px;" src="{{asset('/images/backend_images/products_images/small/'.$product_details->image)}}">
                  <a href="{{url('/admin/delete-pimage/'.$product_details->id)}}" id="delpro" class="btn btn-danger btn-mini">Delete</a>
                  @endif
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Enable</label>
                <div class="controls">
                  <input type="checkbox" name="status" id="status" @if($product_details->status=="1") checked @endif value="1">
                </div>
              </div>
              <div class="form-actions">
                <input type="submit" value="Validate" class="btn btn-success">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection