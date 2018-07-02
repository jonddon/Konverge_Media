<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
	<link rel="icon" type="image/png" sizes="96x96" href="/Knvg_favicon.png">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>Konverge Media Training App</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />


    <!-- Bootstrap core CSS     -->
    <link href="{{ url('/assets/css/bootstrap.min.css') }}" rel="stylesheet" />

    <!-- Animation library for notifications   -->
    <link href="{{ url('/assets/css/animate.min.css') }}" rel="stylesheet"/>

    <!--  Paper Dashboard core CSS    -->
    <link href="{{ url('/assets/css/paper-dashboard.css') }}" rel="stylesheet"/>

    <!--  SweetAlert CSS z    -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" rel="stylesheet"/>





    <!--  Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Muli:400,300' rel='stylesheet' type='text/css'>
    <link href="{{ url('/assets/css/themify-icons.css') }}" rel="stylesheet">

</head>
<body>

<div class="wrapper">
    <div class="sidebar" data-background-color="white" data-active-color="danger">

    <!--
		Tip 1: you can change the color of the sidebar's background using: data-background-color="white | black"
		Tip 2: you can change the color of the active button using the data-active-color="primary | info | success | warning | danger"
	-->

    	<div class="sidebar-wrapper">
            <div class="logo">
                <a href="{{ url('/') }}" class="simple-text">
                   <img src="{{ url('/knvg_favicon.png') }}" style="width: 30px;"> Konverge Media
                </a>
            </div>

            <ul class="nav">
                <li>
                    <a href="{{ url('/dashboard') }}">
                        <i class="ti-panel"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li>
                    <a href="{{ url('/newsletter') }}">
                        <i class="ti-email"></i>
                        <p>Newsletter</p>
                    </a>
                </li>
                 <li>
                    <a href="{{ url('/upload') }}">
                        <i class="ti-upload"></i>
                        <p>Upload Email</p>
                    </a>
                </li>
                <li>
                    <a href="{{ url('/uploadmany') }}">
                        <i class="ti-upload"></i>
                        <p>Upload Many to One</p>
                    </a>
                </li>
                <li>
                    <a href="{{ url('/uploadsms') }}">
                        <i class="ti-file"></i>
                        <p>Upload SMS</p>
                    </a>
                </li>

                <li>
                    <a href="{{ url('/profile') }}">
                        <i class="ti-user"></i>
                        <p>User Profile</p>
                    </a>
                </li>
                <li>
                    <a href="{{url('/table')}}">
                        <i class="ti-view-list-alt"></i>
                        <p>Sent Table List</p>
                    </a>
                </li>
                <li>
                    <a href="{{url('/showbounces')}}">
                        <i class="ti-list"></i>
                        <p>UnSent Table List</p>
                    </a>
                </li>
                </li>
				<li class="">
                    <a href="#">
                        <i class="ti-export"></i>
                        <p>Upgrade to PRO</p>
                    </a>
                </li>
                 <li>
                    <a href="{{ url('/logout') }}"
                        onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                        <i class="ti-export"></i>
                        <p>Logout</p>
                    </a>

                    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </li>
            </ul>
    	</div>
    </div>
        @yield('content')


        <footer class="footer">
            <div class="container-fluid">
                <nav class="pull-left">
                    <ul>

                        <li>
                            <a href="https://www.knvgmedia.com/">
                                Konverge Media
                            </a>
                        </li>
                        <li>
                            <a href="https://www.knvgmedia.com/">
                               Blog
                            </a>
                        </li>
                        <li>
                            <a href="https://www.knvgmedia.com/">
                                Licenses
                            </a>
                        </li>
                    </ul>
                </nav>
                <div class="copyright pull-right">
                    &copy; <script>document.write(new Date().getFullYear())</script>, made with <i class="fa fa-heart heart"></i> by <a href="https://www.knvgmedia.com/">Konverge Media</a>
                </div>
            </div>
        </footer>

    </div>
</div>


</body>

    <!--   Core JS Files   -->
    <script src="{{ url('/assets/js/jquery-1.10.2.js') }}" type="text/javascript"></script>
    <script src="{{ url('/assets/js/bootstrap.min.js') }}" type="text/javascript"></script>

    <!--  Checkbox, Radio & Switch Plugins -->
    <script src="{{ url('/assets/js/bootstrap-checkbox-radio.js') }}"></script>

    <!--  Charts Plugin -->
    <script src="{{ url('/assets/js/chartist.min.js') }}"></script>

    <!--  Notifications Plugin    -->
    <script src="{{ url('/assets/js/bootstrap-notify.js') }}"></script>

    <!--  Google Maps Plugin    -->
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js"></script>

     <!--  SweetAlert CDN js   -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>

    <!-- Include this after the sweet alert js file -->
    @include('sweet::alert')

    <!-- Paper Dashboard Core javascript and methods for Demo purpose -->
    <script src="{{ url('/assets/js/paper-dashboard.js') }}"></script>

    <!-- Paper Dashboard DEMO methods, don't include it in your project! -->
    <script src="{{ url('/assets/js/demo.js') }}"></script>

    <script type="text/javascript">
        $(document).ready(function(){

            demo.initChartist();

            $.notify({
                icon: 'ti-gift',
                message: "Welcome to <b>Konverge Media App</b> - premium app for training companies."

            },{
                type: 'success',
                timer: 4000
            });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function(){ $("#bounce").addClass("animated rotateIn"); });
    </script>

</html>
