<!--
=========================================================
* Material Dashboard Dark Edition - v2.1.0
=========================================================

* Product Page: https://www.creative-tim.com/product/material-dashboard-dark
* Copyright 2019 Creative Tim (http://www.creative-tim.com)

* Coded by www.creative-tim.com

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="{{asset('adm/assets/img/apple-icon.png')}}">

    <link rel="icon" href="{{asset('ldp/dist/images/logo.png')}}" type="image/icon type">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>
        @yield('title')
    </title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <!-- CSS Files -->
    <link href="{{asset('adm/assets/css/material-dashboard.css?v=2.1.0')}}" rel="stylesheet" />
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="{{asset('adm/assets/demo/demo.css')}}" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css" rel="stylesheet">
    <style>
        body {
            overflow: hidden;

        }
        html {
            scroll-behavior: smooth;
        }

        /* Preloader */

        #preloader {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #212121;
            /* change if the mask should have another color then white */
            z-index: 99;
            /* makes sure it stays on top */
        }

        #status {
            width: 200px;
            height: 200px;
            position: absolute;
            left: 50%;
            /* centers the loading animation horizontally one the screen */
            top: 50%;
            /* centers the loading animation vertically one the screen */

            /* path to your loading animation */
            background-repeat: no-repeat;
            background-position: center;
            margin: -100px 0 0 -100px;
            /* is width and height divided by two */
        }

        .clickable {
            cursor:pointer;
        }
    </style>




    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@600&display=swap" rel="stylesheet">


</head>

<body id="mainBody" class="dark-edition" style="font-family: 'Source Sans Pro', sans-serif !important;">

<div id="preloader">
    <div id="status">&nbsp;</div>
</div>



<div class="wrapper ">
    <div class="sidebar" data-color="purple" data-background-color="black" data-image="{{asset('adm/assets/img/sidebar-2.jpg')}}">
        <!--
          Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

          Tip 2: you can also add an image using data-image tag
      -->
        <div class="logo"><a href="{{route('dashboard')}}" class="simple-text logo-normal">
                <img style="height: 150px" class="header-logo-image" src="{{asset('ldp/dist/images/logo.png')}}" alt="Logo">
            </a></div>
        <div class="sidebar-wrapper">
            <ul class="nav">
                <li class="nav-item @yield('navDashboard')  ">
                    <a class="nav-link" href="{{route('dashboard')}}">
                        <i class="material-icons">dashboard</i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item @yield('navProductList') ">
                    <a class="nav-link" href="{{route('productsList')}}">
                        <i class="material-icons">backup_table</i>
                        <p>Product List</p>
                    </a>
                </li>
                <li class="nav-item @yield('navUpdateProduct') ">
                    <a class="nav-link" href="{{route('updateProduct')}}">
                        <i class="fas fa-clipboard-check"></i>
                        <p>Update Products</p>
                    </a>
                </li>
                <li class="nav-item @yield('navAddProduct')">
                    <a class="nav-link" href="{{route('addProduct')}}">
                        <i class="material-icons">add_shopping_cart</i>
                        <p>Add Products</p>
                    </a>
                </li>
                <li class="nav-item @yield('navPlaceOrder')">
                    <a class="nav-link" href="{{route('placeOrder')}}">
                        <i class="material-icons">content_paste</i>
                        <p>Place Order</p>
                    </a>
                </li>


            </ul>
        </div>
    </div>
    <div class="main-panel">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top " id="navigation-example">
            <div class="container-fluid">
                <div class="navbar-wrapper">
                    <a class="navbar-brand" href="javascript:void(0)">@yield('navigationIdentifier')</a>
                </div>
                <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation" data-target="#navigation-example">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="navbar-toggler-icon icon-bar"></span>
                    <span class="navbar-toggler-icon icon-bar"></span>
                    <span class="navbar-toggler-icon icon-bar"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end">
                    <form class="navbar-form">
                        <div class="input-group no-border">
                            <input type="text" value="" class="form-control" placeholder="Search..." name="search">
                            <button type="submit" class="btn btn-default btn-round btn-just-icon">
                                <i class="material-icons">search</i>
                                <div class="ripple-container"></div>
                            </button>
                        </div>
                    </form>
                    <ul class="navbar-nav">

                        <li class="nav-item dropdown">
                            <a class="nav-link" href="javscript:void(0)" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="material-icons">notifications</i>
                                <span class="notification">5</span>
                                <p class="d-lg-none d-md-block">
                                    Notifications
                                </p>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item" href="javascript:void(0)">Not yet Updated</a>

                            </div>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link" href="javscript:void(0)" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="material-icons">person</i>

                                <p class="d-lg-none d-md-block">
                                    User
                                </p>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item" href="{{route('AdminProfile')}}">Profile</a>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();"
                                   >
                                    Log Out
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>


                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- End Navbar -->
        @yield('content')


        <footer class="footer">
            <div class="container-fluid">
                <nav class="float-left">
                    <ul>
                        <li>
                            <a href="{{route('welcome')}}">
                                Life Line Pharma
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                About Us
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                Blog
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                License
                            </a>
                        </li>
                    </ul>
                </nav>
                <div class="copyright float-right" id="date">
                    | made with <i class="material-icons">favorite</i> by
                    <a href="https://www.creative-tim.com" target="_blank">Tuhin Mridha</a> for Life Line Pharma.
                </div>
            </div>
        </footer>
        <script>
            const x = new Date().getFullYear();
            let date = document.getElementById('date');
            date.innerHTML = '&copy; ' + x + date.innerHTML;
        </script>
    </div>
</div>
<div style="margin-top: -50px" class="fixed-plugin">
    <div class="dropdown show-dropdown">
        <a href="#" data-toggle="dropdown">
            <i class="fa fa-cog fa-2x"> </i>
        </a>
        <ul class="dropdown-menu">
            <li class="header-title"> App Mode</li>
            <li class="header-title">Please choose your desired Theme</li>
            <li class="button-container text-center">
                <form>
                    @csrf

                </form>
                <button id="lightMode" onclick="enableLightMode()" class="btn btn-round btn-twitter"> Light</button>
                <button id="darkMode" onclick="enableDarkMode()" class="btn btn-round btn-facebook"> Dark </button>


                <br>
                <br>
            </li>
        </ul>
    </div>
</div>
<!--   Core JS Files   -->
<script src="{{asset('adm/assets/js/core/jquery.min.js')}}"></script>
<script src="{{asset('adm/assets/js/core/popper.min.js')}}"></script>
<script src="{{asset('adm/assets/js/core/bootstrap-material-design.min.js')}}"></script>
<script src="https://unpkg.com/default-passive-events"></script>
<script src="{{asset('adm/assets/js/plugins/perfect-scrollbar.jquery.min.js')}}"></script>
<!-- Place this tag in your head or just before your close body tag. -->
<script async defer src="https://buttons.github.io/buttons.js"></script>
{{--<!--  Google Maps Plugin    -->--}}
{{--<script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>--}}
<!-- Chartist JS -->
<script src="{{asset('adm/assets/js/plugins/chartist.min.js')}}"></script>
<!--  Notifications Plugin    -->
<script src="{{asset('adm/assets/js/plugins/bootstrap-notify.js')}}"></script>
<!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
<script src="{{asset('adm/assets/js/material-dashboard.js?v=2.1.0')}}"></script>
<!-- Material Dashboard DEMO methods, don't include it in your project! -->
<script src="{{asset('adm/assets/demo/demo.js')}}"></script>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@3/dark.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9/dist/sweetalert2.min.js"></script>

<script type="text/javascript">
    $('#search').on('keyup',function(){
        $value=$(this).val();
        $.ajax({
            type : 'get',
            url : '{{URL::to('search')}}',
            data:{'search':$value},
            success:function(data){

                if(data==""){
                    document.getElementById("searchText").style.display="none";
                    document.getElementById("preText").style.display="flex";
                }
                else{
                    document.getElementById("searchText").style.display="flex";
                    document.getElementById("preText").style.display="none";
                }
                $('#searchText').html(data);
            }
        });
    })
</script>

<script type="text/javascript">
    $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
</script>



<script>
    function enableDarkMode() {
        var element = document.getElementById("mainBody");
        element.classList.remove("light-edition");
        element.classList.add("dark-edition");
        document.getElementById("mainBody").style.color = "#c0c7d1";

    }

    function enableLightMode() {
        var element = document.getElementById("mainBody");
        element.classList.remove("dark-edition");
        element.classList.add("light-edition");
        document.getElementById("mainBody").style.color = "inherit";

    }
</script>

<script>
    window.addEventListener('load', (event) => {
        var element = document.getElementById("mainBody");

        var mode="";
        $.ajax({
            type : 'get',
            url : '{{URL::to('getSession')}}',
            data:{},
            success:function(data){
                if(data=="light-edition"){
                    element.classList.remove("dark-edition");
                    element.classList.add("light-edition");
                    document.getElementById("mainBody").style.color = "inherit";

                }
                else if(data=="dark-edition"){
                    element.classList.remove("light-edition");
                    element.classList.add("dark-edition");
                    document.getElementById("mainBody").style.color = "#c0c7d1";
                }
            }
        });


    });
</script>

<script>
    $('#lightMode').on('click',function(){
        $value="light-edition";
        $.ajax({
            type : 'get',
            url : '{{URL::to('setSessionLight')}}',
            data:{'mode':$value},
            success:function(data){
                console.log(data);
            }
        });
    })
</script>

<script>
    $('#darkMode').on('click',function(){
        $value="dark-edition";
        $.ajax({
            type : 'get',
            url : '{{URL::to('setSessionLight')}}',
            data:{'mode':$value},
            success:function(data){
                console.log(data);
            }
        });
    })
</script>


<script>
    $(document).ready(function() {
        // Javascript method's body can be found in assets/js/demos.js
        md.initDashboardPageCharts();

    });
</script>

<script>
    $(window).on('load', function() { // makes sure the whole site is loaded
        $('#status').fadeOut(); // will first fade out the loading animation
        $('#preloader').delay(40).fadeOut('slow'); // will fade out the white DIV that covers the website.
        $('body').delay(40).css({'overflow':'visible'});
    })
</script>
@yield('dashboardJS')


</body>

</html>
