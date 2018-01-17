@extends('layouts.app')

@section('content')

    <div class="col-sm-5">
        <h2 class="view-product-name alert-success">{{$message}}</h2>
    </div>
    <div class="col-sm-7">
        <h1>{{$stock->productName}}</h1>
    </div>

    <div class="col-sm-5 view-product-image-element">
        <img class="view-product-image" src="images/product-images/front-images/{{$stock->image1Url}}">
        @if(($stock->image2Url)==!null)
            <img class="hidden" src="images/product-images/back-images/{{$stock->image2Url}}">
        @endif
    </div>

    <div class="col-sm-7">
        <p>{{$stock->description}}</p>

        <h4>Price: Rs.{{$stock->price}}/-</h4>

        <p>Available Quantity : {{$stock->quantity}} </p>

        <button class="btn btn-primary">
            <a href="{{route('sell')}}" style="color: white;">Sell Another Product</a>
        </button>


    </div>



@endsection

