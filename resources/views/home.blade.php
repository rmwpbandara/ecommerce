@extends('layouts.app')

@section('content')
    <script type="text/javascript">
        $('.a-home').addClass('active');
    </script>

    {{--recent products--}}
    <span class="page-heading">Recent Products</span>
    <div class="responsive">
        @foreach($stocks as $stock)
            <div class="col-sm-3 element-outline">
                <div class="product" id="product-id-{{$stock->id}}">
                    <div class="image container-img">
                        <div class="product-type image-blur">
                            @foreach($types as $type)
                                @if($stock->type_id == $type->id)
                                    <span>{{ $type->type }}</span>
                                @endif
                            @endforeach
                        </div>
                        <span class="image-blur">
                            <img class="product-image" src="images/{{$stock->image1Url}}">
                        </span>
                        <span class="btn-img-hover">
                            <img class="product-image-2" src="images/{{$stock->image2Url}}">
                        </span>
                    </div>

                    <div class="product-price">
                        <span>Rs.{{ $stock->price}}/-</span>
                    </div>
                    <div class="cart-btn-area">
                        <div  class="btn-group btn-group-sm btn-block">
                        <span id="{{$stock->id}}" class="product-btns">
                            <input title="Order Quantity" id="data-qty-{{$stock->id}}" class="item-qty" type="number" value="1" name="count">
                            <button class="modify-cart" style="display: none"></button>
                            <button title="Add to Cart " class="add-to-cart add-to-cart-btn" data-auth-id="{{$authId}}" data-auth-country="{{$authCountry}}" data-id="{{$stock->id}}" data-name="{{$stock->productName}}" data-product-id="{{$stock->id}}" data-summary="{{$stock->description}}" data-price="{{$stock->price}}" data-quantity="{{ $stock->quantity}}" data-shipping-local="{{ $stock->shippingLocal}}" data-shipping-international="{{ $stock->shippingInternational}}" data-seller-country="{{$stock->country}}" data-image="images/{{$stock->user_id}}{{$stock->id}}frontImage.jpg">
                                <span class="hidden-xs hidden-md"> Add to Cart</span>
                                <i class="glyphicon glyphicon-shopping-cart add-to-cart-icon"></i>
                            </button>
                        </span>
                            <span id="{{$stock->id}}">
                                {{--<button class="view-favourite" style="display: none"></button>--}}
                                <button id="favouriteBtn{{$stock->id}}" onclick="addToFavourite(this)" title="Add To Favorite" class="add-to-favorite-btn" data-auth-id="{{$authId}}" data-product-id="{{$stock->id}}">
                                    <i class="glyphicon glyphicon-heart-empty favorite-icon" ></i>
                                    <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                                </button>
                            </span>

                            <button title="Quick View" class="view-more-btn" data-auth-id="{{$authId}}" data-auth-country="{{$authCountry}}" data-id="{{$stock->id}}" data-name="{{$stock->productName}}" data-product-id="{{$stock->id}}" data-summary="{{$stock->description}}" data-price="{{$stock->price}}" data-quantity="{{ $stock->quantity}}" data-shipping-local="{{ $stock->shippingLocal}}" data-shipping-international="{{ $stock->shippingInternational}}" data-seller-country="{{$stock->country}}" data-image="images/{{$stock->user_id}}{{$stock->id}}frontImage.jpg">
                                <i class="glyphicon glyphicon-eye-open more-icon"></i>
                            </button>
                        </div>
                    </div>
                    <div class="product-name">
                        <a href="#" class="limit"><span>{{ $stock->productName}}</span></a>
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