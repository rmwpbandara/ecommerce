@extends('layouts.app')

@section('page_title')
    Subscriptions
@endsection

@section('content')
    <script type="text/javascript">
        $('.a-subscriptions').addClass('active');
    </script>

    @foreach($users as $user)
    <div class="col-sm-4">
        <p>{{$user->name}}</p>
        <div class="center">
            <a href=# id="prev{{$user->id}}">Prev</a>
            <a href=# id="next{{$user->id}}">Next</a>
        </div>

        <div class="col-sm-12">
            <div class="cycle-slideshow" data-cycle-fx="scrollHorz" data-cycle-slides="> div" data-cycle-timeout="0" data-cycle-prev="#prev{{$user->id}}" data-cycle-next="#next{{$user->id}}" >
                @foreach($stocks as $stock)
                    @if($user->id==$stock->user_id)
                        <div class="col-sm-12 element-outline">
                            <div class="product">
                                <div class="image">
                                    <img class="image-img" src="images/{{$stock->user_id}}{{$stock->id}}frontImage.jpg">
                                </div>
                                <div class="product-type">
                                    @foreach($types as $type)
                                        @if($stock->type_id == $type->id)
                                            <span>{{ $type->type }}</span>
                                        @endif
                                    @endforeach
                                </div>
                                <div class="product-name">
                                    <span>{{ $stock->name}}</span>
                                </div>
                                <div class="product-price">
                                    <span>Rs.{{ $stock->price}}/-</span>
                                </div>
                                <div class="cart-btn-area">
                                    <button class="btn-success cart-btn">add to cart</button>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
    @endforeach
{{--add cycle2 jqueary plugin--}}
<script src="/js/cycle2/cycle2.js"></script>


    @endsection