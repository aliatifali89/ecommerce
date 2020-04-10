@extends('layouts.frontlayout.front_design');
@section('content')
	<section id="form" style="margin-top:0px;"><!--form-->
		<div class="container">
			<div class="row">
			@if(Session::has('flash_message_error'))
                   <div class="alert alert-error alert-block" style="background-color:#FFD2D2">
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
				<div class="col-sm-4 col-sm-offset-1">
					<div class="signup-form"><!--login form-->
						<h2>Update Account!</h2>
			      <form action="{{url('/account')}}" method="post" name="accountform" id="accountform">
						{{csrf_field()}}
							<input type="text" name="name" id="name" value="{{$userdetails->name}}"placeholder="Name"/>
							<input type="text" name="address" id="address" value="{{$userdetails->address}}" placeholder="Address"/>
							<input type="text" name="city" id="city" value="{{$userdetails->city}}" placeholder="City"/>
							<input type="text" name="state" id="state" value="{{$userdetails->state}}" placeholder="State"/>
							
							<select name="country" id="country">
							    <option value="">Select Country</option>
							    @foreach($countrydetails as $cd)
							    <option value="{{$cd->country_name}}"@if($cd->country_name==$userdetails->country) selected @endif>{{$cd->country_name}}</option>
							    @endforeach
							</select>
							
							<input style="margin-top:10px" type="text" name="pincode" id="pincode" value="{{$userdetails->pincode}}" placeholder="Pincode"/>
							<input type="text" name="mobile" id="mobile" value="{{$userdetails->mobile}}" placeholder="Mobile"/>
							
							<button type="submit" class="btn btn-default">Signup</button>
						</form>
					</div><!--/login form-->
				</div>
				<div class="col-sm-1">
					<h2 class="or">OR</h2>
				</div>
				<div class="col-sm-4">
					<div class="signup-form"><!--sign up form-->
						<h2>Update Password</h2>
                        <form action="{{url('/update-pwd')}}" method="post" name="userpasswordform" id="userpasswordform">{{csrf_field()}}
                            <input type="password" name="current_pwd" id="current_pwd" value="" placeholder="Current Password"/>
                            <span id="chkpwd"></span>
                            <input type="password" name="new_pwd" id="new_pwd" value="" placeholder="New Password"/>
                            <input type="password" name="con_pwd" id="con_pwd" value="" placeholder="Confirm Password"/>
                            <button type="submit" class="btn btn-default">Update</button>
                        </form>
					</div><!--/sign up form-->
				</div>
			</div>
		</div>
	</section><!--/form-->
	<script>
//$().ready(function(){
////    $("#loginregister").validate({
//        alert("test");
//});

</script>	
@endsection