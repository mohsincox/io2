<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Log in</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/font-awesome.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/ionicons.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/style.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/blue.css') }}">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <style type="text/css">
      .login-box, .register-box {
    
    margin: 0% auto;
}
  </style>
</head>
<body class="hold-transition login-page" style="background-color: #38418E;">
<div class="login-box">
  <div class="login-logo">
    <a href="#" style="color: #FFFFFF;"><b>IGLOO</b> </a>
    <!-- <a href="#"><img src="{{ asset('assets/images/berger.jpg') }}" height="150" width="350" ></a> -->
    <a href="#"><img src="{{ asset('assets/images/AML-Igloo-Logo.jpeg') }}" width="350"></a>
  </div>
  <div class="login-box-body">
    <p class="login-box-msg">Login into App</p>

    <form action="{{ url('/login') }}" method="post">
      {{ csrf_field() }}
      <div class="form-group has-feedback{{ $errors->has('email') ? ' has-error' : '' }}">
        <input type="text" class="form-control" placeholder="Username" name="email" value="{{ old('email') }}">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        @if ($errors->has('email'))
          <span class="help-block">
            <strong>{{ $errors->first('email') }}</strong>
          </span>
        @endif
      </div>

      <div class="form-group has-feedback{{ $errors->has('password') ? ' has-error' : '' }}">
        <input type="password" class="form-control" placeholder="Password" name="password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        @if ($errors->has('password'))
          <span class="help-block">
            <strong>{{ $errors->first('password') }}</strong>
          </span>
        @endif
      </div>

      <div class="form-group has-feedback{{ $errors->has('role') ? ' has-error' : '' }}">
        {!! Form::select('role', ['app_admin' => 'Order Manager', 'app_user' => 'Delivery Boy'], null, ['class' => 'form-control', 'placeholder' => 'Select User Type', 'required' => 'required']) !!}
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
        @if ($errors->has('role'))
          <span class="help-block">
            <strong>{{ $errors->first('role') }}</strong>
          </span>
        @endif
      </div>

      <div class="row">
        <!-- <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox" name="remember"> Remember Me
            </label>
          </div>
        </div>
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div> -->
        <div class="col-xs-12">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
      </div>
      
    </form>

  </div>
</div>
<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/icheck.min.js') }}"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });
</script>
</body>
</html>
