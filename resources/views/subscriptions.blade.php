@extends('layouts.app')

@section('page_title')
    Subscriptions
@endsection

@section('content')
    <script type="text/javascript">
        $('.a-subscriptions').addClass('active');
    </script>


    <div style="margin-top: 40px;">
    <div class="center">
        <a href=# id="prev">Prev</a>
        <a href=# id="next">Next</a>
    </div>
    <div class="cycle-slideshow" data-cycle-fx="scrollHorz" data-cycle-slides="> div" data-cycle-timeout="0" data-cycle-prev="#prev" data-cycle-next="#next" >
        <div style="width: 100%;">
            @foreach($stocks as $stock)
                <div class="col-sm-4 element-outline">
                    <div class="product">
                        <div class="image">
                            image
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
                        <div class="cart-btn" style="background-color: #008800; text-align: center;">
                            <span>add to cart</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div style="width: 100%;">
            @foreach($stocks as $stock)
                <div class="col-sm-4 element-outline">
                    <div class="product">
                        <div class="image">
                            image
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
                        <div class="cart-btn" style="background-color: #008800; text-align: center;">
                            <span>add to cart</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

{{--add cycle2 jqueary plugin--}}
<script src="/js/cycle2/cycle2.js"></script>


    @endsection