@extends('layouts.frontlayout.front_design');
@section('content')

<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="#">Home</a></li>
				  <li class="active">Shopping Cart</li>
				</ol>
			</div>
			
			@if(Session::has('flash_message_error'))
        <div class="alert alert-error alert-block" style="background-color:#E44D26;">
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
        
			<div class="table-responsive cart_info">
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image">Item</td>
							<td class="description"></td>
							<td class="price">Price</td>
							<td class="quantity">Quantity</td>
							<td class="total">Total</td>
							<td></td>
						</tr>
					</thead>
					<tbody>
					{{$totalamount=0}}
					@foreach($usersession as $user)
						<tr>
							<td class="cart_product">
								<a href="" ><img style="width:70px;" src="{{asset('images/backend_images/products_images/small/'.$user->image)}}" alt=""></a>
							</td>
							<td class="cart_description">
								<h4><a href="">{{$user->product_name}}</a></h4>
								<p>Code: {{$user->product_code}} | {{$user->size}}</p>
							</td>
							<td class="cart_price">
								<p>USD {{$user->price}}</p>
							</td>
							<td class="cart_quantity">
								<div class="cart_quantity_button">
									<a class="cart_quantity_up" href="{{url('/cart/update-cartquantity/'.$user->id.'/1')}}"> + </a>
									<input class="cart_quantity_input" type="text" name="quantity" value="{{$user->quantity}}" autocomplete="off" size="2">
									@if($user->quantity>1)
									<a class="cart_quantity_down" href="{{url('/cart/update-cartquantity/'.$user->id.'/-1')}}"> - </a>
									@endif
								</div>
							</td>
							<td class="cart_total">
								<p class="cart_total_price">USD {{$user->price*$user->quantity}}</p>
							</td>
							<td class="cart_delete">
								<a class="cart_quantity_delete" href="{{url('/cart/delete-cartproduct/'.$user->id)}}"><i class="fa fa-times"></i></a>
							</td>
						</tr>
                   {{$totalamount=$totalamount+$user->price*$user->quantity}}
                    @endforeach
						
					</tbody>
				</table>
			</div>
		</div>
	</section> <!--/#cart_items-->

<section id="do_action">
		<div class="container">
			<div class="heading">
				
				<p>Choose if you have a discount code  you want to use </p>
			</div>
			<div class="row">
				<div class="col-sm-6">
					<div class="chose_area">
					<form action="{{url('apply-coupon')}}" method="post" name="applycoupons">{{csrf_field()}}
						<ul class="user_option">
							<li>
								<label>Use Coupon Code</label>
								<input type="text" name="coupon_code">
                                <input type="submit" class="btn btn-default" value="Apply">
							</li>
							
						</ul>
						</form>
						
					</div>
				</div>
				<div class="col-sm-6">
					<div class="total_area">
						<ul>
						@if(!empty(Session::get('CouponAmount')))
							<li>Cart Sub Total <span>${{$totalamount}}</span></li>
							<li>Coupon Discount <span>${{(Session::get('CouponAmount'))}}</span></li>
				     		<li>Grand Total <span>${{$totalamount-(Session::get('CouponAmount'))}}</span></li>

				        @else			
							<li>Total <span>${{$totalamount}}</span></li>
				        @endif			
						</ul>
							<a class="btn btn-default update" href="">Update</a>
							<a class="btn btn-default check_out" href="">Check Out</a>
					</div>
				</div>
			</div>
		</div>
	</section><!--/#do_action-->

@endsection