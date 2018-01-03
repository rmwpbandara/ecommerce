@extends('layouts.app')

@section('content')
    <script type="text/javascript">
        $('.a-home').addClass('active');
    </script>

    {{--recent products--}}
    <span class="page-heading">Recent Products</span>
    <div class="responsive">
        @foreach($recentStocks as $recentStock)
            <div class="col-sm-3 element-outline">
                <div class="product">
                    <div class="image">
                        <div class="">
                            @foreach($types as $type)
                                @if($recentStock->type_id == $type->id)
                                    <span>{{ $type->type }}</span>
                                @endif
                            @endforeach
                        </div>
                        <img class="product-image" src="images/{{$recentStock->user_id}}{{$recentStock->id}}frontImage.jpg">
                    </div>
                    <div class="product-name">
                        <span>{{ $recentStock->productName}}</span>
                    </div>
                    <div class="product-price">
                        <span>Rs.{{ $recentStock->price}}/-</span>
                    </div>
                    <div class="cart-btn-area">
                        <button class="btn-success cart-btn "><span class="cart-button"><i class="glyphicon glyphicon-shopping-cart"></i></span>Add to Cart</button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    {{--Lower Price Products--}}
    <span class="page-heading">Lower Price Products</span>

    <div class="responsive">
        @foreach($lowestPriceStocks as $lowestPriceStock)
            <div class="col-sm-3 element-outline">
                <div class="product">
                    <div class="image">
                        <div class="">
                            @foreach($types as $type)
                                @if($recentStock->type_id == $type->id)
                                    <span>{{ $type->type }}</span>
                                @endif
                            @endforeach
                        </div>

                        <img class="product-image" src="images/{{$lowestPriceStock->user_id}}{{$lowestPriceStock->id}}frontImage.jpg" style="display: contents;">
                    </div>

                    <div class="product-name">
                        <span>{{ $lowestPriceStock->productName}}</span>
                    </div>
                    <div class="product-price">
                        <span>Rs.{{ $lowestPriceStock->price}}/-</span>
                    </div>
                    <div class="cart-btn-area">
                        <button class="btn-success cart-btn "><span class="cart-button"><i class="glyphicon glyphicon-shopping-cart"></i></span>Add to Cart</button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>




    <script type="text/javascript" src="slick/slick.min.js"></script>
    <script type="text/javascript">
        $('.responsive').slick({
            dots: false,
            infinite: false,
            speed: 300,
            slidesToShow: 4,
            slidesToScroll: 1,
            responsive: [
                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 3,
                        infinite: true,
                        dots: true
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
                // You can unslick at a given breakpoint now by adding:
                // settings: "unslick"
                // instead of a settings object
            ]
        });
    </script>
@endsection