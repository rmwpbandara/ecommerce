@extends('layouts.app')

@section('content')

    <script type="text/javascript">
        $('.a-favourite').addClass('active');
    </script>

    <h4 class="page-heading">My Favourites</h4>
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
                            <img class="product-image" src="images/product-images/front-images/{{$stock->image1Url}}">
                        </span>
                        <span class="btn-img-hover">
                            <img class="product-image-2" src="images/product-images/back-images/{{$stock->image2Url}}">
                        </span>
                    </div>

                    <div class="product-price">
                        <span>Rs.{{ $stock->price}}/-</span>
                    </div>
                    <div class="cart-btn-area">

                        <div class="btn-group btn-group-sm btn-block">

                        <span id="{{$stock->id}}" class="product-btns">
                            <input title="Order Quantity" id="data-qty-{{$stock->id}}" class="item-qty" type="number"
                                   value="1" name="count">
                            <button class="modify-cart" style="display: none"></button>
                            <button title="Add to Cart " class="add-to-cart add-to-cart-btn"
                                    data-auth-id="{{$authId}}"
                                    data-auth-country="{{$authCountry}}"
                                    data-id="{{$stock->id}}"
                                    data-name="{{$stock->productName}}"
                                    data-product-id="{{$stock->id}}"
                                    data-summary="{{$stock->description}}"
                                    data-price="{{$stock->price}}"
                                    data-quantity="{{ $stock->quantity}}"
                                    data-shipping-local="{{ $stock->shippingLocal}}"
                                    data-shipping-international="{{ $stock->shippingInternational}}"
                                    data-seller-country="{{$stock->country}}"
                                    data-image="{{$stock->image1Url}}">
                                <span class="hidden-xs hidden-md"> Add to Cart</span>
                                <i class="glyphicon glyphicon-shopping-cart add-to-cart-icon"></i>
                            </button>
                        </span>

                            <span id="{{$stock->id}}">
                                {{--<button class="view-favourite" style="display: none"></button>--}}
                                <button id="favouriteBtn{{$stock->id}}" onclick="removeFromFavourite(this)"
                                        title="Remove From Favourite" class="add-to-favorite-btn" data-auth-id="{{$authId}}"
                                        data-product-id="{{$stock->id}}">
                                    <i class="glyphicon glyphicon-remove favorite-icon-remove"></i>
                                    <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                                </button>
                            </span>

                            <form action="{{route('viewProductDetails')}}" method="post" enctype="multipart/form-data" style="display: inline;">
                                <button type="submit" title="View Product Details" class="view-more-btn">
                                    <i class="glyphicon glyphicon-eye-open more-icon"></i>
                                    <input type="hidden" name="authId" id="token" value="{{$authId}}">
                                    <input type="hidden" name="productId" id="token" value="{{$stock->id}}">
                                    <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                                </button>
                            </form>
                        </div>
                    </div>
                    <div class="product-name">
                        <a href="#" class="limit"><span>{{ $stock->productName}}</span></a>
                    </div>
                </div>
            </div>
        @endforeach



@endsection