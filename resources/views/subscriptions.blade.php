@extends('layouts.app')

@section('content')

<script type="text/javascript">
    $('.a-subscriptions').addClass('active');
</script>


@foreach($users as $user)
    <h3 class="subcriber-name">{{$user->name}}'s Products</h3>
    <div class="responsive">
        @foreach($stocks as $stock)
            @if($user->id==$stock['user_id'])
                <div class="col-sm-3 element-outline">
                    <div class="product">
                        <div class="image">
                            <div class="">
                                @foreach($types as $type)
                                    @if($stock['type_id'] == $type->id)
                                        <span>{{ $type->type }}</span>
                                    @endif
                                @endforeach
                            </div>
                            <img class="image-img" src="images/{{$stock['user_id']}}{{$stock['id']}}frontImage.jpg">
                        </div>
                        <div class="product-name">
                            <span>{{ $stock['name']}}</span>
                        </div>
                        <div class="product-price">
                            <span>Rs.{{ $stock['price']}}/-</span>
                        </div>
                        <div class="cart-btn-area">
                            <button class="btn-success cart-btn">add to cart</button>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    </div>
@endforeach

<script type="text/javascript" src="slick/slick.min.js"></script>

<script type="text/javascript">
    $('.responsive').slick({
        dots: false,
        infinite: true,
        speed: 300,
        slidesToShow: 4,
        slidesToScroll: 1,
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3,
                    infinite: true,
                    dots: true
                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
            // You can unslick at a given breakpoint now by adding:
            // settings: "unslick"
            // instead of a settings object
        ]
    });
</script>
@endsection