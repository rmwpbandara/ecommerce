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
                    <button class="btn-success cart-btn ">add to cart</button>
                </div>
            </div>
        </div>
    @endforeach
@endsection