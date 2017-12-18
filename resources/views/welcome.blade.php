
@foreach($stocks as $stock)
    <div class="col-sm-4 element-outline">
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
            <div class="cart-btn">
                <span>add to cart</span>
            </div>
        </div>
    </div>
@endforeach