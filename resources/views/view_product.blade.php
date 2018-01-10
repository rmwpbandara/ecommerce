@extends('layouts.app')

@section('content')

    <div class="col-sm-5">
        <h2 class="view-product-name alert-success">{{$message}}</h2>
    </div>
    <div class="col-sm-7">
        <h1 class="view-product-name">{{$stock->productName}}</h1>
    </div>

    <div class="col-sm-5 view-product-image-element">
        <img class="view-product-image" src="images/{{$stock->image1Url}}">
        @if(($stock->image2Url)==!null)
            <img class="hidden" src="images/{{$stock->image2Url}}">
        @endif
    </div>

    <div class="col-sm-7">
        <p>{{$stock->description}}</p>

        <h4>Price: Rs.{{$stock->price}}/-</h4>

        <p>Available Quantity : {{$stock->quantity}} </p>

        <button>
            <a href="{{route('sell')}}">Sell Another Product</a>
        </button>


    </div>



@endsection

