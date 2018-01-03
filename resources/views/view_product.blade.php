@extends('layouts.app')

@section('content')
    <div class="col-sm-4 element-outline">
        <div class="product">
            <div class="image">
                <img class="image-img" src="images/{{$stock->user_id}}{{$stock->id}}frontImage.jpg">
            </div>
            <div class="product-type">
                <span>{{ $type->type }}</span>
            </div>
            <div class="product-name">
                <span>{{ $stock->productName}}</span>
            </div>
            <div class="product-price">
                <span>Rs.{{ $stock->price}}/-</span>
            </div>
            <div class="cart-btn">
                <span>add to cart</span>
            </div>
        </div>
    </div>
@endsection

