<div class="col-sm-3 element-outline">
    <div class="product" id="product-id-{{$stock->id}}">
        <div class="image container-img">
            <div class="product-type image-blur">
                <span>{{ $stock->type }}</span>
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
        <div id="btn-area-id-{{$stock->id}}" class="cart-btn-area">
            <div class="btn-group btn-group-sm btn-block">
                    <span data-product-id="{{$stock->id}}" class="product-btns">
                        <input id="data-qty-{{$stock->id}}" title="Order Quantity" class="item-qty" type="number"
                               value="1" name="count">
                        <button id="modify-cart-id-{{$stock->id}}" class="modify-cart" style="display: none"></button>
                        <button id="add-to-cart-btn-{{$stock->id}}" title="Add to Cart "
                                class="add-to-cart add-to-cart-btn"

                                data-auth-id="{{$authId}}"
                                data-id="{{$stock->id}}"
                                data-name="{{$stock->productName}}"
                                data-product-id="{{$stock->id}}"
                                data-price="{{$stock->price}}"
                                data-quantity="{{ $stock->quantity}}"
                                data-seller-id="{{$stock->user_id}}"
                                data-seller-country="{{$stock->country}}"
                                data-image="{{$stock->image1Url}}">

                            <span class="hidden-xs hidden-md"> Add to Cart</span>
                            <i class="glyphicon glyphicon-shopping-cart add-to-cart-icon"></i>
                        </button>
                    </span>




                @if(in_array($stock->id,$favourites))
                    @if($pageName=='favourite')

                        <button id="favouriteBtn{{$stock->id}}" onclick="removeFromFavourite(this)"
                                title="Remove From Favourite" class="add-to-favorite-btn" data-auth-id="{{$authId}}"
                                data-product-id="{{$stock->id}}">
                            <i class="glyphicon glyphicon-remove favorite-icon-remove"></i>
                            <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                        </button>
                    @else
                        <button id="favouriteBtn{{$stock->id}}" onclick="viewFavourite()" title="View Favorite"
                                class="add-to-favorite-btn" data-auth-id="{{$authId}}" data-product-id="{{$stock->id}}">
                            <i class="glyphicon glyphicon-heart favorite-icon"></i>
                            <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                        </button>
                    @endif
                @else
                    <button id="favouriteBtn{{$stock->id}}" onclick="addToFavourite(this)" title="Add to Favorite"
                            class="add-to-favorite-btn" data-auth-id="{{$authId}}" data-product-id="{{$stock->id}}">
                        <i class="glyphicon glyphicon-heart-empty favorite-icon"></i>
                        <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                    </button>
                @endif

                <form action="{{route('viewProductDetails')}}" method="post" enctype="multipart/form-data"
                      style="display: inline;">
                    <button type="submit" title="View Product Details" class="view-more-btn">
                        <i class="glyphicon glyphicon-eye-open more-icon"></i>
                        <input type="hidden" name="authId" id="token" value="{{$authId}}">
                        <input type="hidden" name="sellerId" id="token" value="{{$stock->user_id}}">
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
