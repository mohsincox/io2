<?php
    if(strpos($_SERVER['HTTP_USER_AGENT'], 'wv') !== FALSE) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login V2</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- <link rel="icon" type="image/png" href="images/icons/favicon.ico"/> -->

	<!-- <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css"> -->

	<!-- <link rel="stylesheet" type="text/css" href="{{ asset('assets/Login_v2/fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}"> -->
	<link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">

	<link rel="stylesheet" href="{{ asset('assets/css/font-awesome.min.css') }}">

	<link rel="stylesheet" type="text/css" href="{{ asset('assets/Login_v2/fonts/iconic/css/material-design-iconic-font.min.css') }}">

	<!-- <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">

	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">

	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
	
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css"> -->

	<link rel="stylesheet" type="text/css" href="{{ asset('assets/Login_v2/css/util.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/Login_v2/css/main.css') }}">

</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<form class="login100-form validate-form" action="{{ url('/login') }}" method="post">
					{{ csrf_field() }}
					<span class="login100-form-title p-b-26">
						<img src="{{ asset('assets/images/igloo.png') }}">
					</span>
					<!-- <span class="login100-form-title p-b-48">
						<i class="fa fa-home"></i>
					</span> -->

					<div class="wrap-input100 validate-input has-feedback{{ $errors->has('email') ? ' has-error' : '' }}" data-validate = "Enter Username">
						<input class="input100" type="text" name="email">
						<span class="focus-input100" data-placeholder="Username"></span>
						@if ($errors->has('email'))
				          <span class="help-block">
				            <strong>{{ $errors->first('email') }}</strong>
				          </span>
				        @endif
					</div>

					<div class="wrap-input100 validate-input has-feedback{{ $errors->has('password') ? ' has-error' : '' }}" data-validate="Enter Password">
						<span class="btn-show-pass">
							<i class="zmdi zmdi-eye"></i>
						</span>
						<input class="input100" type="password" name="password">
						<span class="focus-input100" data-placeholder="Password"></span>
						@if ($errors->has('password'))
				          <span class="help-block">
				            <strong>{{ $errors->first('password') }}</strong>
				          </span>
				        @endif
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Select User Type">
						<!-- <input class="input100" type="text" name="email"> -->
						{!! Form::select('role', ['app_admin' => 'Order Manager', 'app_user' => 'Delivery Boy'], null, ['class' => 'form-control input100', 'placeholder' => 'Select User Type']) !!}
						<span class="focus-input100"></span>
					</div>

					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button class="login100-form-btn" type="submit">
								Login
							</button>
						</div>
					</div>

					<div class="text-center p-t-115">
						<span class="txt1">
							Powered by: <b>Abdul Monem Ltd.</b>
						</span>

						<!-- <a class="txt2" href="#">
							Sign Up
						</a> -->
					</div>
				</form>
			</div>
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>
	

	<script src="{{ asset('assets/js/jquery.min.js') }}"></script>

	<!-- <script src="vendor/animsition/js/animsition.min.js"></script>

	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>

	<script src="vendor/select2/select2.min.js"></script>

	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>

	<script src="vendor/countdowntime/countdowntime.js"></script> -->

	<script src="{{ asset('assets/Login_v2/js/main.js') }}"></script>

</body>
</html>
<?php
    } else {
        echo '';
    }
?>