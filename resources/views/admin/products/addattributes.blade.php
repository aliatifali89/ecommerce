@extends('layouts.adminlayout.admin_design')
@section('content')
<div id="content">
    <div id="content-header">
        <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Form elements</a> <a href="#" class="current"></a> </div>
        <h1>Add Product Attributes</h1>
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
                        <form enctype="multipart/form-data" class="form-horizontal" method="post" action="{{url('/admin/addp-attributes/'.$p_details->id)}}" name="addp_attributes" id="addp_attributes" >{{ csrf_field() }}
                        <input type="hidden" name="product_id" value="{{$p_details->id}}">         
                            <div class="control-group">
                                <label class="control-label">Product Name</label>
                                <label class="control-label"><strong>{{$p_details->product_name}}</strong></label>

                            </div>
                            <div class="control-group">
                                <label class="control-label">Product Color</label>
                                <label class="control-label"><strong>{{$p_details->product_code}}</strong></label>

                            </div>
                            <div class="control-group">
                                <label class="control-label">Product Code</label>
                                <label class="control-label"><strong>{{$p_details->product_color}}</strong></label>
                            </div>
                            <div class="control-group">
                                <label class="control-label"></label>
                                <div class="field_wrapper">
                                    <div>
                                        <input required type="text" name="sku[]" id="sku" Placeholder="Sku" style="width:120px"/>
                                        <input required type="text" name="size[]" id="size" Placeholder="Size" style="width:120px" />
                                        <input required type="text" name="price[]" id="price" Placeholder="Price" style="width:120px" />
                                        <input required type="text" name="stock[]" id="stock" Placeholder="Stock" style="width:120px"/>
                                        <a href="javascript:void(0);" class="add_button" title="Add field" style="width:120px">Add</a>
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions">
                                <input type="submit" value="Add Attribute" class="btn btn-success">
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
                       <form action="{{url('/admin/editp-attributes/'.$p_details->id)}}" method="post">
                       {{ csrf_field() }}
                        <table class="table table-bordered data-table">
                            <thead>
                                <tr>
                                    <th>Attribute Id</th>
                                    <th>Sku</th>
                                    <th>Size</th>
                                    <th>Price</th>
                                    <th>Stock</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($p_details['attributes'] as $pdetails)
                                <tr class="gradeX">
                                    <td><input type="hidden" name="attr_id[]" value="{{$pdetails->id}}">{{$pdetails->id}}</td>
                                    <td>{{$pdetails->sku}}</td>
                                    <td>{{$pdetails->size}}</td>
                                    <td><input type="text" name="price[]" value="{{$pdetails->price}}"></td>
                                    <td><input type="text" name="stock[]" value="{{$pdetails->stock}}"></td>                                   
                                    <td class="center">
                                       <input type="submit" value="update"  class="btn btn-primary btn-mini">
                                        <a rel="{{$pdetails->id}}" rel1="delete-attributes" href="javascript:" class="btn btn-danger btn-mini deleteRecord">Delete</a></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                       </form>
                    </div>
                </div>
            </div>
        </div>
</div>

@endsection
