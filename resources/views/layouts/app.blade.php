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
    <link href="/bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/app.css" rel="stylesheet">
    <link href="/css/select2.min.css" rel="stylesheet"/>
    <link href="/css/styles.css" rel="stylesheet">
    <link href="/slider/nouislider.min.css" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="slick/slick.css"/>
    <link rel="stylesheet" type="text/css" href="slick/slick-theme.css"/>
    <link rel="stylesheet" href="country-selector/build/css/countrySelect.css">


    <!-- Scripts -->
    <script src="/js/angular-1.6.4/angular.min.js"></script>
    <script src="/js/jquery-3.2.1/jquery-3.2.1.min.js"></script>
    <script src="/slider/nouislider.min.js"></script>



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
                <a class="navbar-brand" style="color: #006600;" href="{{ url('/') }}">
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
                        <li><a href="{{ url('/login') }}">Login</a></li>
                        <li><a href="{{ url('/register') }}">Register</a></li>
                        {{--<li><a id="register" class="links">Register</a></li>--}}
                    @else
                        <a href="{{route('mycart')}}"><i class="glyphicon glyphicon-shopping-cart cart-icon" style="font-size: 25px;margin-top: 10px;margin-right: 10px;"><span id="count-cart" style="font-size: 10px;margin-top: 100px;"></span></i></a>

                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu" role="menu">
                                <li>
                                    <a href="{{ url('/logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();
                                                        shoppingCart.clearCart();" class="logout-btn">
                                        Logout
                                    </a>

                                    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            </ul>
                        </li>



                        {{--Rs.<span id="total-cart"></span>--}}
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
                <a href="http://localhost:8000/" class="links a-home"><span><i class="glyphicon glyphicon-home"></i></span><span class="list-name">Home</span></a>
                <a href="http://localhost:8000/shop" class="links a-shop"><span><i class="glyphicon glyphicon-shopping-cart"></i></span><span class="list-name">All Products</span></a>
                <a href="http://localhost:8000/subscriptions" class="links a-subscriptions"><span><i class="glyphicon glyphicon-asterisk"></i></span><span class="list-name">subscriptions</span></a>
                <a href="http://localhost:8000/myorders" class="links a-myorders"><span><i class="glyphicon glyphicon-paperclip"></i></span><span class="list-name">My Orders</span></a>
                <a href="http://localhost:8000/sell" class="links a-sell"><span><i class="glyphicon glyphicon-open"></i></span><span class="list-name">Sell Products</span></a>
                <a id="home" class="links"><span><i class="glyphicon glyphicon-wrench"></i></span><span class="list-name">My Account</span></a>
                {{--<a id="sell" class="links"><span><i class="glyphicon glyphicon-open"></i></span><span class="list-name">Sell Products</span></a>--}}
                <hr class="menu-section">
            </div>
            <form class="search-form" action="{{route('search')}}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}

                <div class="search-menu menu">
                    <label>Add tags here. .</label>
                    <select class="select-tags" name="tagId[]" multiple="multiple" style="width: 100%;">
                        @foreach($tags as $tag)
                            <option value="{{ $tag->id}}"> {{ $tag->tag_name }}</option>
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
                    <div class="sidebar-types">
                        <label>Select Types Here. .</label>
                        @foreach($types as $type)
                            <br>
                            <input type="checkbox" name="typeId[]" value="{{$type->id}}">
                            <label style="margin-left: 10px;">{{ $type->type }}</label>
                        @endforeach
                    </div>
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
                    <button class="search-btn btn-block" type="submit"><span><i class="glyphicon glyphicon-search"></i></span><span class="list-name">Find Products</span></button>
                    <hr class="menu-section">
                    <hr class="menu-section">
                </div>
            </form>
        </div>
    </div>

    <div id="content" class="main-content">
        {{--content append here--}}
        @yield('content')
    </div>
</div>

        <!-- Scripts -->
<script src="js/shoppingCart.js"></script>
<script src="/js/app.js"></script>
<script src="/js/scripts.js"></script>
<script src="/js/select2.min.js"></script>
{{--<script src="/cart/jquery.mycart.js"></script>--}}




</body>
</html>
