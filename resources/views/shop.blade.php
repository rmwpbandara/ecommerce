@extends('layouts.app')

@section('content')
    <script type="text/javascript">
        $('.a-shop').addClass('active');
    </script>

    @foreach($stocks as $stock)
        <div class="col-sm-3 element-outline">
            <div class="product">
                <div class="image">
                    <div class="product-type">
                        @foreach($types as $type)
                            @if($stock->type_id == $type->id)
                                <span>{{ $type->type }}</span>
                            @endif
                        @endforeach
                    </div>
                    <img class="product-image" src="images/{{$stock->image1Url}}">
                </div>

                <div class="product-price">
                    <span>Rs.{{ $stock->price}}/-</span>
                </div>

                <div class="cart-btn-area">
                    <div class="btn-group btn-group-sm btn-block">
                        <button class=" cart-btn add-to-cart" data-auth-id="{{$authId}}" data-auth-country="{{$authCountry}}" data-id="{{$stock->id}}" data-name="{{$stock->productName}}" data-product-id="{{$stock->id}}" data-summary="{{$stock->description}}" data-price="{{$stock->price}}" data-quantity="{{ $stock->quantity}}" data-shipping-local="{{ $stock->shippingLocal}}" data-shipping-international="{{ $stock->shippingInternational}}" data-seller-country="{{$stock->country}}" data-image="images/{{$stock->user_id}}{{$stock->id}}frontImage.jpg">
                            <i class="glyphicon glyphicon-shopping-cart"></i><span class="hidden-xs"> Add to Cart</span>
                        </button>
                        <button class="cart-btn add-to-like" data-auth-id="{{$authId}}" data-auth-country="{{$authCountry}}" data-id="{{$stock->id}}" data-name="{{$stock->productName}}" data-product-id="{{$stock->id}}" data-summary="{{$stock->description}}" data-price="{{$stock->price}}" data-quantity="{{ $stock->quantity}}" data-shipping-local="{{ $stock->shippingLocal}}" data-shipping-international="{{ $stock->shippingInternational}}" data-seller-country="{{$stock->country}}" data-image="images/{{$stock->user_id}}{{$stock->id}}frontImage.jpg">
                            <i class="glyphicon glyphicon-pushpin"></i><span class="hidden-xs"> Like</span>
                        </button>
                        <button class=" cart-btn view-more" data-auth-id="{{$authId}}" data-auth-country="{{$authCountry}}" data-id="{{$stock->id}}" data-name="{{$stock->productName}}" data-product-id="{{$stock->id}}" data-summary="{{$stock->description}}" data-price="{{$stock->price}}" data-quantity="{{ $stock->quantity}}" data-shipping-local="{{ $stock->shippingLocal}}" data-shipping-international="{{ $stock->shippingInternational}}" data-seller-country="{{$stock->country}}" data-image="images/{{$stock->user_id}}{{$stock->id}}frontImage.jpg">
                            <i class="glyphicon glyphicon-eye-open"></i><span class="hidden-xs">  More </span>
                        </button>
                    </div>
                </div>
                <div class="product-name">
                    <a href="#" class="limit"><span>{{ $stock->productName}}</span></a>
                </div>
            </div>
        </div>
    @endforeach
@endsection