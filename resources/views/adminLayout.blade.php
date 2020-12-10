<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="img/apple-icon.png">
    <link rel="icon" type="image/png" href="img/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>
        Admin Dashboard
    </title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no'
        name='viewport' />
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <!-- CSS Files -->
    <link href="/css/material-dashboard.css?v=2.1.0" rel="stylesheet" />
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="/demo/demo.css" rel="stylesheet" />

    <!--   Core JS Files   -->



    <script src="/js/core/jquery.min.js"></script>
    <script src="/js/core/popper.min.js"></script>
    <script src="/js/core/bootstrap-material-design.min.js"></script>
    <script src="https://unpkg.com/default-passive-events"></script>
    <script src="/js/plugins/perfect-scrollbar.jquery.min.js"></script>
    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!--  Google Maps Plugin    -->
    <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
    <!-- Chartist JS -->
    <script src="/js/plugins/chartist.min.js"></script>
    <!--  Notifications Plugin    -->
    <script src="/js/plugins/bootstrap-notify.js"></script>
    <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="/js/material-dashboard.js?v=2.1.0"></script>
    <!-- Material Dashboard DEMO methods, don't include it in your project! -->
    <script src="/demo/demo.js"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>

</head>

<body class="dark-edition">
    <div id="app" class="wrapper ">
        <div class="sidebar" data-color="purple" data-background-color="black" data-image="/images/cover.jpg">
            <!--
        Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

        Tip 2: you can also add an image using data-image tag
    -->
            <div class="logo"><a href="/home" class="simple-text logo-normal">
                    movieTime
                </a></div>

            <div class="sidebar-wrapper">
                <ul class="nav">
                    <li class="{{Request::is('showDashboard') ? 'nav-item active' : 'nav-item'}} ">
                        <a class="nav-link" href="/showDashboard">
                            <i class="material-icons">dashboard</i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="{{Request::is('showUserTable') ? 'nav-item active' : 'nav-item'}} ">
                        <a class="nav-link" href="/showUserTable">
                            <i class="fa fa-users"></i>
                            <p>User list</p>
                        </a>
                    </li>
                    <li class="{{Request::is('showMovieTable') ? 'nav-item active' : 'nav-item'}} ">
                        <a class="nav-link" href="/showMovieTable">
                            <i class="fa fa-film"></i>
                            <p>Movie list</p>
                        </a>
                    </li>
                    <li class="{{Request::is('showCommentTable') ? 'nav-item active' : 'nav-item'}} ">
                        <a class="nav-link" href="/showCommentTable">
                            <i class="material-icons">comment</i>
                            <p>Comment list</p>
                        </a>
                    </li>
                    <li class="{{Request::is('showRatingTable') ? 'nav-item active' : 'nav-item'}} ">
                        <a class="nav-link" href="/showRatingTable">
                            <i class="material-icons">star</i>
                            <p>Rating list</p>
                        </a>
                    </li>
                    <li class="{{Request::is('newMovie') ? 'nav-item active' : 'nav-item'}} ">
                        <a class="nav-link" href="/newMovie">
                            <i class="material-icons">add_to_queue</i>
                            <p>Add movie</p>
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
                        <a class="navbar-brand" href="javascript:void(0)">
                         <p> <i class="fa fa-user"> Admin: Marko Dumnic</i></p> </a>
                    </div>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index"
                        aria-expanded="false" aria-label="Toggle navigation" data-target="#navigation-example">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="navbar-toggler-icon icon-bar"></span>
                        <span class="navbar-toggler-icon icon-bar"></span>
                        <span class="navbar-toggler-icon icon-bar"></span>
                    </button>

                </div>
            </nav>
            <!-- End Navbar -->
            @yield('dashboard')
            @yield('table')
            @yield('newMovie')
            @yield('editMovie')
        </div>
    </div>




</body>

</html>
