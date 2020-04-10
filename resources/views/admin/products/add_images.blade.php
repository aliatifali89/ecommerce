@extends('layouts.adminlayout.admin_design')
@section('content')
<div id="content">
    <div id="content-header">
        <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Form elements</a> <a href="#" class="current"></a> </div>
        <h1>Add Product Image</h1>
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
                        <h5>Products</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <form enctype="multipart/form-data" class="form-horizontal" method="post" action="{{url('/admin/addp-images/'.$p_details->id)}}" name="addp_images" id="addp_images" >{{ csrf_field() }}
                        <input type="hidden" name="product_id" value="{{$p_details->id}}">  
                                
                            <div class="control-group">
                                <label class="control-label">Product Name</label>
                                <label class="control-label"><strong>{{$p_details->product_name}}</strong></label>

                            </div>
                            
                            <div class="control-group">
                                <label class="control-label">Product Code</label>
                                <label class="control-label"><strong>{{$p_details->product_code}}</strong></label>
                            </div>
                            
                             <div class="control-group">
                                <label class="control-label">Alternate Image(s)</label>
                                <div class="controls">
                                    <input type="file" name="image[]" id="image[]" multiple="multiple">
                                </div>
                            </div>
                          
                            <div class="form-actions">
                                <input type="submit" value="Add Images" class="btn btn-success">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
       <div class="row-fluid">
            <div class="span12">
                <div class="widget-box">
                    <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                        <h5>Products</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <table class="table table-bordered data-table">
                            <thead>
                                <tr>
                                    <th>Image Id</th>
                                    <th>Product ID</th>
                                    <th>Image</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                              @foreach($pimage as $imagedetails)
                               <tr>
                                <td>{{$imagedetails->id}}</td>
                                <td>{{$imagedetails->product_id}}</td>
                                <td style="width:100px; "><img src={{asset('images/backend_images/products_images/small/'.$imagedetails->image)}}></td>
                                <td> <a rel="{{$imagedetails->id}}" rel1="delete-alt-image" href="javascript:" class="btn btn-danger btn-mini deleteRecord" title="Delete Product Image">Delete</a></td>
                               </tr>
                               @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
</div>

@endsection
