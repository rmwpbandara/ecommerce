
@foreach($stocks as $stock)
    @extends('layouts.element')

    @section('images')
        <img class="image-img" src="images/{{$stock->user_id}}{{$stock->id}}frontImage.jpg">
    @endsection

    @section('product_type')
        @foreach($types as $type)
            @if($stock->type_id == $type->id)
                <span>{{ $type->type }}</span>
            @endif
        @endforeach
    @endsection

    @section('product_name')
        <span>{{ $stock->name}}</span>
    @endsection

    @section('product_price')
        <span>Rs.{{ $stock->price}}/-</span>
    @endsection

    @section('cart')
        <span>add to cart</span>
    @endsection

@endforeach