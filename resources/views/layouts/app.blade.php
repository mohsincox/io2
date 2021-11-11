<?php
    if(strpos($_SERVER['HTTP_USER_AGENT'], 'wv') !== FALSE) {
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>MYOL</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/ionicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/_all-skins.min.css') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <style type="text/css">

        body {
          font-size: 16px;
        }


        .alert {
            padding: 2px; 
            margin-bottom: 5px;
        }

        .required:after{ 
            content:'*'; 
            color:red; 
            padding-left:5px;
        }

        .skin-blue .main-header .navbar {
          background-color: #38418E;
        }

        
            .fixed .content-wrapper, .fixed .right-side {
                padding-top: 50px;
            
    </style>

     @yield('style')
</head>

<body class="hold-transition skin-blue fixed layout-top-nav">
    <div class="wrapper">
        <header class="main-header">
            <nav class="navbar navbar-static-top">
                <div class="container">

                    <div class="navbar-header">
                        <a onclick="goBack()" class="navbar-brand"><i class="fa fa-arrow-left"></i> &nbsp;&nbsp;&nbsp;&nbsp;</a>
                        {{-- <a href="{{ url('/') }}" class="navbar-brand">
                            @if( (url('/')) != (substr_replace('http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] ,"", -1) ))
                                <!-- <i class="fa fa-arrow-left"></i> Back -->
                                <i class="fa fa-arrow-left"></i> 
                            @endif
                        </a> --}}
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                            <i class="fa fa-bars"></i>
                        </button>
                    </div>
                    @if (Auth::guest())
                    <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
                        <ul class="nav navbar-nav">
                    <li class="active"><a href="{{ url('/login') }}"> <i class="fa fa-sign-in"></i> Login <span class="sr-only">(current)</span></a></li> 
                            <!-- <li class="active"><a href="{{ url('/register') }}"> <i class="fa fa-sign-in"></i> Registration <span class="sr-only">(current)</span></a></li>  -->
                        </ul>
                    </div>
                    @else
                    <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
                        <ul class="nav navbar-nav">
                            <!-- <li class="active"><a href="{{ url('/') }}">Home <span class="sr-only">(current)</span></a></li> -->
                            <!-- <li {{ ( Request::is('/') ? 'class=active' : '' ) }} ><a href="{{ url('/') }}"> <i class="fa fa-home"></i> Home</a></li> -->
                    
                    <li class="pull-right"><a class="btn btn-app" style="color: #FFFFFF; background-color: #000000;" href="{{ url('/logout') }}"><i class="fa fa-sign-out"></i> Sign out</a></li>
                    <li class="pull-right"><a class="btn btn-app" style="color: #FFFFFF; background-color: #000000;" href="{{ url('/search') }}"> <i class="fa fa-search"></i> Search</a></li>
                    <li class="pull-right"><a class="btn btn-app" style="color: #FFFFFF; background-color: #000000;" href="{{ url('/report/delivery-status-form') }}"> <i class="fa fa-bar-chart"></i> Status</a></li>

                    <!-- <a class="btn btn-app">
                        <i class="fa fa-play"></i> Play
                    </a> -->

                            
                        </ul>
                  
                    </div>

                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">
                            <li class="">
                                <a href="{{ url('/') }}" >
                                    <i class="fa fa-home"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                    
                    @endif
                </div>
            </nav>
        </header>

        

        <div class="content-wrapper" style="margin-bottom: 10px;">
            <div class="container">
                <div class="col-sm-8 col-sm-offset-2">
                    @include('flash::message')
                </div>
            </div>

            
            @yield('content')
            
        </div>
  
        <footer class="main-footer navbar-fixed-bottom" style="background-color: #38418E;">
            <div class="container" style="color: #FFFFFF;">
              <strong>IGLOO Ice Cream</strong>
                <div class="pull-right">
                  {{-- @if(isset(Auth::user()->name )) --}}
                    {{ Auth::user()->name }}
                  {{-- @endif --}}
                </div>
                
            </div>
        </footer>
    </div>

    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ asset('assets/js/fastclick.js') }}"></script>
    <script src="{{ asset('assets/js/script.min.js') }}"></script>
    <!-- <script src="{{ asset('assets/js/demo.js') }}"></script> -->
    <script>
        function goBack() {
            window.history.back();
        }

        if(performance.navigation.type == 2){
            location.reload(true);
        }
    </script>
    @yield('script')
</body>
</html>
<?php
    } else {
        echo '';
    }
?>