@extends('layouts.app')

@section('content')
    <script type="text/javascript">
        $('.a-shop').addClass('active');
    </script>

    @if(!empty($stocks))
        @foreach($stocks as $stock)
            <div data-product-id="{{$stock->id}}" class="col-sm-3 element-outline">
                <div class="product">
                    <div class="image">
                        <div class="product-type">
                            <span>{{ $stock->type }}</span>
                        </div>
                        <img class="product-image" src="images/{{$stock->image1Url}}">
                    </div>
                    <div class="product-price">
                        <span>Rs.{{ $stock->price}}/-</span>
                    </div>
                    <div class="cart-btn-area">
                        <div class="btn-group btn-group-sm btn-block">
                            <button class="add-to-cart add-to-cart-btn" data-auth-id="{{$authId}}" data-auth-country="{{$authCountry}}" data-id="{{$stock->id}}" data-name="{{$stock->productName}}" data-product-id="{{$stock->id}}" data-summary="{{$stock->description}}" data-price="{{$stock->price}}" data-quantity="{{ $stock->quantity}}" data-shipping-local="{{ $stock->shippingLocal}}" data-shipping-international="{{ $stock->shippingInternational}}" data-seller-country="{{$stock->country}}" data-image="images/{{$stock->user_id}}{{$stock->id}}frontImage.jpg">
                                <input class="item-qty " type="text" value=" 01" >
                                <span class="hidden-xs hidden-md"> Add to Cart</span>
                                <i class="glyphicon glyphicon-shopping-cart add-to-cart-icon"></i>
                            </button>
                            <button class="add-to-favorite-btn" data-auth-id="{{$authId}}" data-auth-country="{{$authCountry}}" data-id="{{$stock->id}}" data-name="{{$stock->productName}}" data-product-id="{{$stock->id}}" data-summary="{{$stock->description}}" data-price="{{$stock->price}}" data-quantity="{{ $stock->quantity}}" data-shipping-local="{{ $stock->shippingLocal}}" data-shipping-international="{{ $stock->shippingInternational}}" data-seller-country="{{$stock->country}}" data-image="images/{{$stock->user_id}}{{$stock->id}}frontImage.jpg">
                                <i class="glyphicon glyphicon-heart-empty favorite-icon" ></i>
                            </button>
                            <button class="view-more-btn" data-auth-id="{{$authId}}" data-auth-country="{{$authCountry}}" data-id="{{$stock->id}}" data-name="{{$stock->productName}}" data-product-id="{{$stock->id}}" data-summary="{{$stock->description}}" data-price="{{$stock->price}}" data-quantity="{{ $stock->quantity}}" data-shipping-local="{{ $stock->shippingLocal}}" data-shipping-international="{{ $stock->shippingInternational}}" data-seller-country="{{$stock->country}}" data-image="images/{{$stock->user_id}}{{$stock->id}}frontImage.jpg">
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
        @else
        <h3>Enter tags or select types</h3>
    @endif
@endsection