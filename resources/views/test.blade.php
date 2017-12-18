
<div id="slider" style="margin-top: 60px;">
    <a href="#" class="control_next">></a>
    <a href="#" class="control_prev"><</a>
    <ul>
        <li>SLIDE 1</li>
        <li style="background: #aaa;">SLIDE 2</li>
        <li>SLIDE 3</li>
        <li style="background: #aaa;">SLIDE 4</li>
    </ul>
</div>

{{--<div class="slider_option">--}}
{{--<input type="checkbox" id="checkbox">--}}
{{--<label for="checkbox">Autoplay Slider</label>--}}
{{--</div>--}}

<script type="text/javascript">

    $(document).ready(function ($) {

//        $('#checkbox').change(function(){
//            setInterval(function () {
//                moveRight();
//            }, 3000);
//        });

        var slideCount = $('#slider ul li').length;
        var slideWidth = $('#slider ul li').width();
        var slideHeight = $('#slider ul li').height();
        var sliderUlWidth = slideCount * slideWidth;

        $('#slider').css({ width: slideWidth, height: slideHeight });

        $('#slider ul').css({ width: sliderUlWidth, marginLeft: - slideWidth });

        $('#slider ul li:last-child').prependTo('#slider ul');

        function moveLeft() {
            $('#slider ul').animate({
                left: + slideWidth
            }, 200, function () {
                $('#slider ul li:last-child').prependTo('#slider ul');
                $('#slider ul').css('left', '');
            });
        };

        function moveRight() {
            $('#slider ul').animate({
                left: - slideWidth
            }, 200, function () {
                $('#slider ul li:first-child').appendTo('#slider ul');
                $('#slider ul').css('left', '');
            });
        };

        $('a.control_prev').click(function () {
            moveLeft();
        });

        $('a.control_next').click(function () {
            moveRight();
        });

    });

</script>








h1 {
color: #fff;
text-align: center;
font-weight: 300;
}

#slider {
position: relative;
overflow: hidden;
margin: 20px auto 0 auto;
border-radius: 4px;
}

#slider ul {
position: relative;
margin: 0;
padding: 0;
height: 200px;
list-style: none;
}

#slider ul li {
position: relative;
display: block;
float: left;
margin: 0;
padding: 0;
width: 500px;
height: 300px;
background: #ccc;
text-align: center;
line-height: 300px;
}

a.control_prev, a.control_next {
position: absolute;
top: 40%;
z-index: 999;
display: block;
padding: 4% 3%;
width: auto;
height: auto;
background: #2a2a2a;
color: #fff;
text-decoration: none;
font-weight: 600;
font-size: 18px;
opacity: 0.8;
cursor: pointer;
}

a.control_prev:hover, a.control_next:hover {
opacity: 1;
-webkit-transition: all 0.2s ease;
}

a.control_prev {
border-radius: 0 2px 2px 0;
}

a.control_next {
right: 0;
border-radius: 2px 0 0 2px;
}

.slider_option {
position: relative;
margin: 10px auto;
width: 160px;
font-size: 18px;
}





-------------------------------------------------------------------------------------------------


{{--<div class="col-sm-4 element-outline">--}}
{{--<div class="product">--}}
{{--<div class="image">--}}
{{--@yield('images')--}}
{{--</div>--}}
{{--<div class="product-type">--}}
{{--@yield('product_type')--}}
{{--</div>--}}
{{--<div class="product-name">--}}
{{--@yield('product_name')--}}
{{--</div>--}}
{{--<div class="product-price">--}}
{{--@yield('product_price')--}}
{{--</div>--}}
{{--<div class="cart-btn">--}}
{{--@yield('cart')--}}
{{--</div>--}}
{{--</div>--}}
{{--</div>--}}





{{--@foreach($stocks as $stock)--}}
{{--@extends('layouts.element')--}}

{{--@section('images')--}}
{{--<img class="image-img" src="images/{{$stock->user_id}}{{$stock->id}}frontImage.jpg">--}}
{{--@endsection--}}

{{--@section('product_type')--}}
{{--@foreach($types as $type)--}}
{{--@if($stock->type_id == $type->id)--}}
{{--<span>{{ $type->type }}</span>--}}
{{--@endif--}}
{{--@endforeach--}}
{{--@endsection--}}

{{--@section('product_name')--}}
{{--<span>{{ $stock->name}}</span>--}}
{{--@endsection--}}

{{--@section('product_price')--}}
{{--<span>Rs.{{ $stock->price}}/-</span>--}}
{{--@endsection--}}

{{--@section('cart')--}}
{{--<span>add to cart</span>--}}
{{--@endsection--}}

{{--@endforeach--}}