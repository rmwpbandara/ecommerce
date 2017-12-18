<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>E-Commerce</title>

    <!-- Styles -->
    <link href="/css/app.css" rel="stylesheet">
    <link href="/css/styles.css" rel="stylesheet">
    <link href="/bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="/slider/nouislider.min.css" rel="stylesheet">

    <link rel="stylesheet" href="/Minimal-Full-Width-Content-Carousel-Plugin-with-jQuery/css/infinityCarousel.css"/>

    <!-- Scripts -->
    <script src="/js/angular-1.6.4/angular.min.js"></script>
    <script src="/js/jquery-3.2.1/jquery-3.2.1.min.js"></script>
    <script src="/slider/nouislider.min.js"></script>



    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet"/>


    <script>
        window.Laravel = <?php echo json_encode([
                'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>
<div id="app">
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container" style="width: auto;">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                    <span id="icon" onclick="closeNav()">
                        <i id="iconSide" class="glyphicon glyphicon-chevron-left"></i>
                    </span>
                <a class="navbar-brand" style="color: #006600; ;" href="{{ url('/') }}">
                    <strong>E-Commerce</strong>
                </a>

            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">

                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    &nbsp;
                    {{--<p class="heading">Welcome to E-commerce Buying and Selling Website</p>--}}
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a id="login" class="links">Login</a></li>
                        <li><a id="register" class="links">Register</a></li>
                        {{--<li><a href="{{ url('/register') }}">Register</a></li>--}}
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                               aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li>
                                    <a href="{{ url('/logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>

                                    <form id="logout-form" action="{{ url('/logout') }}" method="POST"
                                          style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
</div>


<div id="main">

    {{--left sidebar--}}
    <div id="mySidenav" class="sidenav">
        <div class="content-leftnav">
            <div class="main-menu menu">
                <a id="welcome" class="active links"><span><i class="glyphicon glyphicon-home"></i></span><span class="list-name">Home</span></a>
                <a id="shop" class="links"><span><i class="glyphicon glyphicon-shopping-cart"></i></span><span class="list-name">Shop Products</span></a>
                <a id="subscriptions" class="links"><span><i class="glyphicon glyphicon-asterisk"></i></span><span class="list-name">subscriptions</span></a>
                <a id="myorders" class="links"><span><i class="glyphicon glyphicon-paperclip"></i></span><span class="list-name">My Orders</span></a>
                <a id="sell" class="links"><span><i class="glyphicon glyphicon-open"></i></span><span class="list-name">Sell Products</span></a>


                {{--<a id="sell" class="links"><span><i class="glyphicon glyphicon-open"></i></span><span class="list-name">Sell Products</span></a>--}}
                <hr class="menu-section">
            </div>

            <div class="search-menu menu">

                <label>Add tags here. .</label>
                <select class="select-tags" name="states[]" multiple="multiple" style="width: 100%;">
                    @foreach($tags as $tag)
                        <option value="{{ $tag->id}}"> {{ $tag->name }}</option>
                    @endforeach
                </select>

                <script type="text/javascript">
                    $(document).ready(function() {
                        $('.select-tags').select2();
                    });
                </script>
                <hr class="menu-section">
            </div>

            <div class="product-type menu">
                <label>Select types here. .</label>
                <div class="sidebar-types">
                    @foreach($types as $type)
                        <br>

                        <input type="checkbox" name="stamps" value="{{ $type->id}}">
                        <label style="margin-left: 10px;">{{ $type->type }}</label>
                    @endforeach
                </div>
                <hr class="menu-section">
            </div>

            <div class="filter-price menu">
                <div id="slider-range"></div>
                <div id="price-range">
                    Rs.&nbsp;<span name="slider-snap-value-lower" class="example-val-input" id="slider-snap-value-lower"></span> - Rs.&nbsp;
                    <span name="slider-snap-value-upper" class="example-val-input" id="slider-snap-value-upper"></span>
                    <input type="hidden" name="lowerPrice" id="lower-range"/>
                    <input type="hidden" name="upperPrice" id="upper-range"/>
                </div>
            </div>

            <div class="search-button menu">
                <a href="#"><span><i class="glyphicon glyphicon-search"></i></span><span class="list-name">Find Products</span></a>
                <hr class="menu-section">
            </div>

            <div class="main-menu menu">
                <a id="home" class="links"><span><i class="glyphicon glyphicon-wrench"></i></span><span class="list-name">My Account</span></a>
                <hr class="menu-section">
            </div>
        </div>
    </div>

    <div id="content" class="main-content" style="margin: 20px;">
        {{--content append here--}}
    </div>
</div>

        <!-- Scripts -->
<script src="/js/app.js"></script>
<script src="/js/scripts.js"></script>
<script src="/js/select2.min.js"></script>



</body>
</html>
