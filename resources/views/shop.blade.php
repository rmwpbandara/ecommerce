@extends('layouts.app')

@section('content')
    <script type="text/javascript">
        $('.a-shop').addClass('active');
    </script>

    @foreach($stocks as $stock)
        <div class="col-sm-3 element-outline">
            <div class="product">
                <div class="image">
                    <div class="">
                        @foreach($types as $type)
                            @if($stock->type_id == $type->id)
                                <span>{{ $type->type }}</span>
                            @endif
                        @endforeach
                    </div>
                    <img class="image-img" src="images/{{$stock->user_id}}{{$stock->id}}frontImage.jpg">
                </div>
                <div class="product-name">
                    <span>{{ $stock->name}}</span>
                </div>
                <div class="product-price">
                    <span>Rs.{{ $stock->price}}/-</span>
                </div>
                <div class="cart-btn-area">
                    <button class="btn-success cart-btn add-to-cart" data-id="{{$stock->id}}" data-name="{{$stock->name}}" data-summary="{{$stock->description}}" data-price="{{$stock->price}}" data-quantity="{{ $stock->quantity}}" data-image="images/{{$stock->user_id}}{{$stock->id}}frontImage.jpg">
                        <span class="cart-button">
                            <i class="glyphicon glyphicon-shopping-cart"></i>
                        </span>Add to Cart
                    </button>
                </div>
            </div>
        </div>
    @endforeach
@endsection