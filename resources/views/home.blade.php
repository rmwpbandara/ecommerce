@extends('layouts.app')

@section('content')
    <script type="text/javascript">
        $('.a-home').addClass('active');
    </script>

    {{--Our Categories--}}
    <h3 class="page-heading"style="margin-top: 55px;">Our Categories</h3>
    <div class="categories">
        @foreach($types as $type)
            <div class="col-sm-3 element-outline">
                <a href="#">

                <div class="product">
                    <div class="image">
                        {{--<img class="image-img" src="images/{{$stock->user_id}}{{$stock->id}}frontImage.jpg" style="padding-top: 20px;">--}}
                    </div>
                    <div class="categories-name">
                        <span>{{ $type->type }}</span>
                    </div>
                </div>
                </a>

            </div>
        @endforeach
    </div>

    {{--recent products--}}
    <h3 class="page-heading">Recent Products</h3>
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
                        <img class="image-img" src="images/{{$recentStock->user_id}}{{$recentStock->id}}frontImage.jpg">
                    </div>
                    <div class="product-name">
                        <span>{{ $recentStock->name}}</span>
                    </div>
                    <div class="product-price">
                        <span>Rs.{{ $recentStock->price}}/-</span>
                    </div>
                    <div class="cart-btn-area">
                        <button class="btn-success cart-btn ">add to cart</button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    {{--Lower Price Products--}}
    <h3 class="page-heading">Lower Price Products</h3>
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

                        <img class="image-img" src="images/{{$lowestPriceStock->user_id}}{{$lowestPriceStock->id}}frontImage.jpg" style="display: contents;">
                    </div>

                    <div class="product-name">
                        <span>{{ $lowestPriceStock->name}}</span>
                    </div>
                    <div class="product-price">
                        <span>Rs.{{ $lowestPriceStock->price}}/-</span>
                    </div>
                    <div class="cart-btn-area">
                        <button class="btn-success cart-btn ">add to cart</button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>




    <script type="text/javascript" src="slick/slick.min.js"></script>
    <script type="text/javascript">
        $('.responsive').slick({
            dots: false,
            infinite: true,
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


        $('.categories').slick({
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