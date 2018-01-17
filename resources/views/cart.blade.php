@extends('layouts.app')

@section('content')

    <div class="main-content">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Cart</div>
                    <div class="panel-body">
                        <button id="clear-cart">Clear Cart</button>

                        <form id="saveProduct" class="form-horizontal" action="" method="post"
                              enctype="multipart/form-data">
                            {{ csrf_field() }}

                            <div class="col-sm-12 cart-top">
                                <label class='col-sm-2 cart-product-name'>Product Image</label>
                                <label class='col-sm-2 cart-product-name'>Product Name</label>
                                <label class='col-sm-3 cart-product-quantity'>Product Quantity</label>
                                <label class='col-sm-2 cart-product-price'>Unit Price</label>
                                <label class='col-sm-2 cart-product-total'>Total</label>
                                <label id="cart-product-delete" class='col-sm-1 cart-product-delete'>Delete</label>
                            </div>
                            <div class="col-sm-12 show-cart" id="show-cart">
                                {{--append here in cart items--}}
                            </div>

                            <div class="col-sm-12 cart-bottom">
                                <span class="col-sm-9 cart-product-total">Total</span>
                                <span id="total-cart" class="col-sm-2 cart-product-total"></span>
                                <span class="col-sm-1"></span>

                                <span class="col-sm-9 cart-product-total">Shipping</span>
                                <span id="shipping-value"
                                      class="col-sm-2 cart-product-total cart-shipping-value"></span>
                                <span class="col-sm-1"></span>

                                <span class="col-sm-9 cart-product-total">Order Total</span>
                                <span id="order-total" class="col-sm-2 cart-product-total cart-total-value"></span>
                                <span class="col-sm-1"></span>

                                <span class="col-sm-9 cart-product-total"></span>
                            <span class="col-sm-2 cart-product-total">
                                <button class="checkout-btn">Checkout</button>
                            </span>
                                <span class="col-sm-1"></span>

                                <span class="col-md-12"></span>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection