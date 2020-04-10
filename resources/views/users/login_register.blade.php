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
						<h2>User Login!</h2>
						<form action="{{url('/login')}}" method="post" name="userlogin" id="userlogin">
						{{csrf_field()}}
							<input type="email" name="email" id="email" placeholder="Email Address"/>
							<input type="password" name="password" id="password1" placeholder="Password" />
							<button type="submit" class="btn btn-default">Login</button>
						</form>
					</div><!--/login form-->
				</div>
				<div class="col-sm-1">
					<h2 class="or">OR</h2>
				</div>
				<div class="col-sm-4">
					<div class="signup-form"><!--sign up form-->
						<h2>New User Signup!</h2>
						<form action="{{url('/login-register')}}" method="post" name="loginregister" id="loginregister">
						{{csrf_field()}}
							<input type="text" name="name" id="name" placeholder="Name"/>
							<input type="email" name="email" id="email" placeholder="Email Address"/>
							<input type="password" name="password" id="password" placeholder="Password" />
							<button type="submit" class="btn btn-default">Signup</button>
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