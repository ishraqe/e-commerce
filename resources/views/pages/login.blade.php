@extends('layouts.master')

@section('content')
<section id="form"><!--form-->
	<div class="container">
		<div class="row">
			<div class="col-sm-4 col-sm-offset-1">
				<div class="login-form"><!--login form-->
					<h2>Login to your account</h2>
					@if(Session::has('login_error'))
                    <div class="alert alert-danger flash" id="#flash">{{Session::get('login_error')}}</div>
                    @endif
                   	@if (!$errors->SignInError->isEmpty())
			            <div class="form_error_login">
			                <strong>Whoops!</strong> There were some problems with your input.<br><br>
			                    <ul>
			                        @foreach ($errors->SignInError->all() as $error)
			                            <li class="alert alert-danger signInError">{{ $error }}</li>
			                        @endforeach
			                    </ul>
			            </div>
			        @endif
					<form action="{{url('/signIn')}}" method="post">
						<input type="hidden" name="_token" value="{{csrf_token()}}">
						<input type="email" name="email" value="{{old('name')}}" placeholder="Email Address" />
						<input type="password" name="password"  placeholder="Password" />
						<!-- <span>
							<input type="checkbox" class="checkbox"> 
							Keep me signed in
						</span> -->
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
					 @if (!$errors->SignUpError->isEmpty())
			            <div class="form_error_login">
			                <strong>Whoops!</strong> There were some problems with your input.<br><br>
			                    <ul>
			                        @foreach ($errors->SignUpError->all() as $error)
			                            <li class="alert alert-danger signUpError">{{ $error }}</li>
			                        @endforeach
			                    </ul>
			            </div>
			          @endif
					<form id="signUp" action="{{url('/signUp')}}" method="post">
						<input type="hidden" name="_token" value="{{csrf_token()}}">
						<input type="text" name="name" value="{{old('name')}}" placeholder="Name"/>
						<input type="email" name="email" value="{{old('email')}}" placeholder="Email Address"/>
						<input type="password" id="registerPassword" name="password" placeholder="Password"/>
						<small id="ConfirmPasswordMessage" ></small>
						<input type="password" id="registerConfirmPassword" name="confirm_password" placeholder="Confirm Password"/>

						<span>
							<input type="checkbox" value="1" name="marchent" class="checkbox"> 
							Make Marchent
						</span>
						<button type="submit" class="btn btn-default">Signup</button>
					</form>
				</div><!--/sign up form-->
			</div>
		</div>
	</div>
</section><!--/form-->
@endsection	

@section('script')
<script type="text/javascript">
  $('#registerConfirmPassword').on('keyup', function () {
    if ($(this).val() == $('#registerPassword').val()) {
        $('#ConfirmPasswordMessage').html('Password matched').css('color', 'green');
    } else $('#ConfirmPasswordMessage').html('Password didn\'t matched').css('color', 'red');
});
</script>  
@endsection
	