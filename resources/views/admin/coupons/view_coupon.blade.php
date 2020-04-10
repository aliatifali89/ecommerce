@extends('layouts.adminlayout.admin_design')
@section('content')
<div id="content">
    <div id="content-header">
        <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Form elements</a> <a href="#" class="current">View Coupons</a> </div>
        <h1>Products</h1>
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
                        <h5>Products</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <table class="table table-bordered data-table">
                            <thead>
                                <tr>
                                    <th>Coupon Id</th>
                                    <th>Coupon Code</th>
                                    <th>Coupon Amount</th>
                                    <th>Coupon Amount Type</th>
                                    <th>Coupon ExpiryDate</th>
                                    <th>Coupon Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($coupondetails as $coupon)
                                <tr class="gradeX">
                                    <td>{{$coupon->id}}</td>
                                    <td>{{$coupon->coupon_code}}</td>
                                    <td>{{$coupon->amount}}
                                     @if($coupon->amount_type=="percentage") %  @else USD
                                     @endif
                                    </td>
                                    <td>{{$coupon->amount_type}}</td>
                                    <td>{{$coupon->expiry_date}}</td>
                                    <td>
                                     @if($coupon->status=="1") Active  @else Inactive
                                     @endif
                                    </td>
                                    <td class="center"><a href="#myModal{{ $coupon->id }}" data-toggle="modal" class="btn btn-success btn-mini" title="View Product">View</a>
                                        <a href="{{url('/admin/edit-coupons/'.$coupon->id)}}" class="btn btn-primary btn-mini" title="Edit Coupon">Edit</a>
                                         <a href="{{url('/admin/addp-attributes/'.$coupon->id)}}" class="btn btn-success btn-mini" title="Add Attribute">Add</a>
                                          <a href="{{url('/admin/addp-images/'.$coupon->id)}}" class="btn btn-info btn-mini" title="Add images">Add</a>
                                        <a <?php //href="{{url('admin/delete-coupons/'.$coupon->id)}}"?> rel="{{$coupon->id}}" rel1="delete-coupons" href="javascript:" class="btn btn-danger btn-mini deleteRecord" title="Delete Coupon">Delete</a></td>
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
