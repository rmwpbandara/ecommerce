@extends('layouts.app')

@section('page_title')
    Home
@endsection

@section('content')
    <script type="text/javascript">
        $('.a-home').addClass('active');
    </script>

    <p>Recent Products</p>
    {{--recent products--}}
    @foreach($recentStocks as $recentStock)
        <div class="col-sm-4 element-outline">
            <div class="product">
                <div class="image">
                    <img class="image-img" src="images/{{$recentStock->user_id}}{{$recentStock->id}}frontImage.jpg">
                </div>
                <div class="product-type">
                    @foreach($types as $type)
                        @if($recentStock->type_id == $type->id)
                            <span>{{ $type->type }}</span>
                        @endif
                    @endforeach
                </div>
                <div class="product-name">
                    <span>{{ $recentStock->name}}</span>
                </div>
                <div class="product-price">
                    <span>Rs.{{ $recentStock->price}}/-</span>
                </div>
                <div class="cart-btn">
                    <span>add to cart</span>
                </div>
            </div>
        </div>
    @endforeach



    <p>Lower Price Products</p>
    {{--recent products--}}
    @foreach($lowerstPriceStocks as $lowerstPriceStock)
        <div class="col-sm-4 element-outline">
            <div class="product">
                <div class="image">
                    <img class="image-img" src="images/{{$lowerstPriceStock->user_id}}{{$lowerstPriceStock->id}}frontImage.jpg">
                </div>
                <div class="product-type">
                    @foreach($types as $type)
                        @if($lowerstPriceStock->type_id == $type->id)
                            <span>{{ $type->type }}</span>
                        @endif
                    @endforeach
                </div>
                <div class="product-name">
                    <span>{{ $lowerstPriceStock->name}}</span>
                </div>
                <div class="product-price">
                    <span>Rs.{{ $lowerstPriceStock->price}}/-</span>
                </div>
                <div class="cart-btn">
                    <span>add to cart</span>
                </div>
            </div>
        </div>
    @endforeach


@endsection