@extends('layouts.app')

@section('page_title')
    Home
@endsection

@section('content')
    <script type="text/javascript">
        $('.a-home').addClass('active');
    </script>

    <p>Recent Products</p>

    <div class="col-sm-12">
        {{--recent products--}}
        @foreach($recentStocks as $recentStock)
            <div class="col-sm-3 element-outline">
                <div class="product">
                    <div class="image">
                        <img class="image-img" src="images/{{$recentStock->user_id}}{{$recentStock->id}}frontImage.jpg">
                    </div>
                    <div class="product-type">
                        @foreach($types as $type)
                            @if($recentStock->type_id == $type->id)
                                <span>{{ $type->type }}</span>
                            @endif
                        @endforeach
                    </div>
                    <div class="product-name">
                        <span>{{ $recentStock->name}}</span>
                    </div>
                    <div class="product-price">
                        <span>Rs.{{ $recentStock->price}}/-</span>
                    </div>
                    <div class="cart-btn-area">
                        <button class="btn-success cart-btn">add to cart</button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>


    <p>Lower Price Products</p>
    <div class="col-sm-12">
        {{--recent products--}}
        @foreach($lowerstPriceStocks as $lowerstPriceStock)
            <div class="col-sm-3 element-outline">
                <div class="product">
                    <div class="image">
                        <img class="image-img" src="images/{{$lowerstPriceStock->user_id}}{{$lowerstPriceStock->id}}frontImage.jpg">
                    </div>
                    <div class="product-type">
                        @foreach($types as $type)
                            @if($lowerstPriceStock->type_id == $type->id)
                                <span>{{ $type->type }}</span>
                            @endif
                        @endforeach
                    </div>
                    <div class="product-name">
                        <span>{{ $lowerstPriceStock->name}}</span>
                    </div>
                    <div class="product-price">
                        <span>Rs.{{ $lowerstPriceStock->price}}/-</span>
                    </div>
                    <div class="cart-btn">
                        <span>add to cart</span>
                    </div>
                </div>
            </div>
        @endforeach

    </div>

    <p>Our Categories</p>

    <div class="col-sm-12">
        {{--recent products--}}
        @foreach($types as $type)
            {{--@foreach($stocks as $stock)--}}
                {{--@if($type->id==$stock->type_id)--}}
                    {{--<div class="col-sm-3 element-outline">--}}
                        {{--<div class="product">--}}
                            {{--<div class="image">--}}
                                {{--<img class="image-img" src="images/{{$stock->user_id}}{{$stock->id}}frontImage.jpg">--}}
                            {{--</div>--}}
                            {{--<div class="product-type">--}}
                                {{--@if($stock->type_id == $type->id)--}}
                                    <span>{{ $type->type }}</span>
                                {{--@endif--}}
                            {{--</div>--}}
                            {{--<div class="product-name">--}}
                                {{--<span>{{ $stock->name}}</span>--}}
                            {{--</div>--}}
                            {{--<div class="product-price">--}}
                                {{--<span>Rs.{{ $stock->price}}/-</span>--}}
                            {{--</div>--}}
                            {{--<div class="cart-btn-area">--}}
                                {{--<button class="btn-success cart-btn">add to cart</button>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--@endif--}}
            {{--@endforeach--}}
        @endforeach
    </div>
@endsection