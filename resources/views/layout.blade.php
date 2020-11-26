<!DOCTYPE html>

<html lang="en" class="no-js">

<head>
    <!-- Basic need -->
    <title>movieTime</title>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <link rel="profile" href="#">

    <!--Google Font-->
    <link rel="stylesheet" href='http://fonts.googleapis.com/css?family=Dosis:400,700,500|Nunito:300,400,600' />
    <!-- Mobile specific meta -->
    <meta name=viewport content="width=device-width, initial-scale=1">
    <meta name="format-detection" content="telephone-no">

    <!-- CSS files -->
    <link rel="stylesheet" href="/css/plugins.css">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" type="text/css" href="/css/normalize.css" />
    <link rel="stylesheet" type="text/css" href="/css/demo.css" />
    <link rel="stylesheet" type="text/css" href="/css/component.css" />

    <script src="{{ asset('js/app.js') }}" defer></script>
    <meta name="csrf-token" content="{{csrf_token()}}">
    <script>
        (function(e, t, n) {
            var r = e.querySelectorAll("html")[0];
            r.className = r.className.replace(/(^|\s)no-js(\s|$)/, "$1js$2")
        })(document, window, 0);

    </script>
</head>

<body>
    <div id="app">
    {{-- <div id="preloader">
        <img class="logo" src="images/logo1.png" alt="" width="119" height="58">
        <div id="status">
            <span></span>
            <span></span>
        </div>
    </div> --}}

    <!-- BEGIN | Header -->
    <header class="ht-header">
        <div class="container">
            <nav class="navbar navbar-default navbar-custom">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header logo">
                    <div class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <div id="nav-icon1">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </div>
                    <a href="/home"><img class="logo" src="/images/logo1.png" alt="" width="119" height="58"></a>
                </div>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse flex-parent" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav flex-child-menu menu-left">
                        <li class="hidden">
                            <a href="#page-top"></a>
                        </li>
                        <li>
                            <a href="/home" class="btn btn-default">
                                Home
                            </a>
                        </li>
                        <li>
                            <a href="/movies" class="btn btn-default">
                                Movies
                            </a>
                        </li>
                        <li>
                            <a href="/cast" class="btn btn-default">
                                Celebrities
                            </a>
                        </li>

                        {{-- @can('isAdmin', Auth::user())
                        <li>
                            <a href="/showDashboard" class="btn btn-default">
                                Dashboard
                            </a>
                        </li>
                        @endcan
                     --}}
                        @auth
                        <li class="dropdown first">
                            <a class="btn btn-default dropdown-toggle lv1" data-toggle="dropdown" data-hover="dropdown">
                                User <i class="fa fa-angle-down" aria-hidden="true"></i>
                            </a>
                            <ul class="dropdown-menu level1">
                                <li><a href="/users/{{Auth::user()->id}}">My profile</a></li>
                                <li><a href="/notifications">Notifications</a></li>
                            </ul>
                        </li>
                        @endauth
                    </ul>
                    <ul class="nav navbar-nav flex-child-menu menu-right">
                        @guest
                        <li><a href="/login">Log In</a></li>
                        <li><a href="/register">Sign Up</a></li>
                        @endguest
                        @auth
                        <li><a href="/logout">Log out</a></li>
                        @endauth
                    </ul>
                </div>
                <!-- /.navbar-collapse -->
            </nav>

            <!-- top search form -->
            <form metod="GET" action="/search">
                <div class="top-search">

                        <select name="searchOptions">
                            <option value="movies">Movies</option>
                            <option value="celebrities">Celebrities</option>
                            <option value="users">Users</option>
                        </select>
                        <input type="text" name="search" placeholder="Search for a movie, celebrity or user that you are looking for">
                        <input type="submit" value="">


                </div>
            </form>
        </div>
    </header>

    <!-- END | Header -->
    @yield('home')
    @yield('userProfile')
    @yield('showMovie')
    @yield('showCast')
    @yield('movieList')
    @yield('castList')
    @yield('userList')

    <!-- START | Footer-->
    <footer class="ht-footer">
        <div class="container">
            <div class="flex-parent-ft">

            </div>
        </div>
        <div class="ft-copyright">
            <div class="ft-left">
                <p>© 2020 movieTime. Application for movie reviews</p>
            </div>
            <div class="backtotop">
                <p><a href="#" id="back-to-top">Back to top <i class="ion-ios-arrow-thin-up"></i></a></p>
            </div>
        </div>
    </footer>
    </div>

    <script src="/js/jquery.js"></script>
    <script src="/js/plugins.js"></script>
    <script src="/js/plugins2.js"></script>
    <script src="/js/custom.js"></script>

    <script>
        window.AuthUser = @json(auth()->user())
    </script>
</body>

</html>
