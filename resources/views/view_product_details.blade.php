@extends('layouts.app')

@section('content')

    <div class="product-details-view col-md-12">
        <div class="col-sm-4 col-md-4 col-lg-4">

            <div class="image-view-in-product-view">
                <div class="front-image-view">
                    <img class="front-image"  src="images/product-images/front-images/{{$stock->image1Url}}">
                </div>
                <div class="back-image-view">
                    <img class="back-image" src="images/product-images/back-images/{{$stock->image2Url}}">
                </div>
            </div>

        </div>
        <div class="col-sm-4 col-md-4 col-lg-4">
            <div class="product-name-view">
                <h1>{{$stock->productName}}</h1>
            </div>
            <div class="product-name-view">
                <h6>({{$stock->type}})</h6>
            </div>
            <div class="product-description-view">
                <h4>{{$stock->description}}</h4>
            </div>
            <div class="product-price-view">
                <h5><span>Rs.{{$stock->price}}/- </span> <span style="margin-left: 10px"> (Available: {{$stock->quantity}}) </span></h5>
            </div>
            <div class="product-quantity-view">
            </div>
            <span data-product-id="{{$stock->id}}" class="product-btns">
                <input id="data-qty-{{$stock->id}}" title="Order Quantity" class="item-qty" type="number" value="1" name="count">
                <button id="modify-cart-id-{{$stock->id}}" class="modify-cart" style="display: none"></button>
                <button id="add-to-cart-btn-{{$stock->id}}" title="Add to Cart " class="add-to-cart add-to-cart-btn"

                        data-auth-id="{{$authId}}"
                        data-id="{{$stock->id}}"
                        data-name="{{$stock->productName}}"
                        data-product-id="{{$stock->id}}"
                        data-summary="{{$stock->description}}"
                        data-price="{{$stock->price}}"
                        data-quantity="{{ $stock->quantity}}"
                        data-seller-id="{{$stock->user_id}}"
                        data-seller-country="{{$stock->seller_country}}"
                        data-image="{{$stock->image1Url}}">

                    <span class="hidden-xs hidden-md" > Add to Cart</span>
                    <i class="glyphicon glyphicon-shopping-cart add-to-cart-icon"></i>
                </button>
            </span>
            <span id="{{$stock->id}}">

                @if(in_array($stock->id,$favourites))
                    <button  id="favouriteBtn{{$stock->id}}" onclick="viewFavourite()" title="View Favorite" class="add-to-favorite-btn" data-auth-id="{{$authId}}" data-product-id="{{$stock->id}}">
                        <i class="glyphicon glyphicon-heart favorite-icon"></i>
                        <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                    </button>
                @else
                    <button  id="favouriteBtn{{$stock->id}}" onclick="addToFavourite(this)" title="Add to Favorite" class="add-to-favorite-btn" data-auth-id="{{$authId}}" data-product-id="{{$stock->id}}">
                        <i class="glyphicon glyphicon-heart-empty favorite-icon"></i>
                        <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                    </button>
                @endif
            </span>

        </div>

        <div class="col-sm-4 col-md-4 col-lg-4">
            <h2>Seller Information</h2>
            <div class="product-seller-name-view">
                <h3>Seller :{{$stock->seller_name}}</h3>
            </div>
            <div class="product-seller-name-view">
                <h5>Seller Country :{{$stock->seller_country}}</h5>
            </div>

            <div class="subscribe-btn-area">
                <button id="aaa" class="btn btn{{ $subscribeCount==1 ? '' : '-danger' }}"
                        onclick="{{ $subscribeCount==1 ? 'changeSubscribedBtn(this)' : 'changeSubscribeBtn(this)' }}"

                        data-auth-id="{{$authId}}"
                        data-seller-id="{{$stock->user_id}}">
                    {{ $subscribeCount==1 ? 'Subscribed' : 'Subscribe' }}

                </button>
                <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
            </div>

            <div class="product-rating-view">
                <h4 class="col-md-6">Ratings:</h4>
                <p class="col-md-6" style="font-size: 55px;">***</p>

            </div>
        </div>

    </div>


@endsection
