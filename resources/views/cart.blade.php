@extends('layouts.app')

@section('content')

    <div class="main-content">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading ">Cart</div>
                    <div class="panel-body">
                        <button id="clear-cart" class="btn btn-info pull-right btn-sm">Clear Cart</button>
                        <input id="authShippingCountry" type="hidden" name="auth_shipping_country" value="{{$authShippingCountry}}">
                        <form id="saveProduct" class="form-horizontal" action="{{route('checkout')}}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="table-responsive">
                                            <table id="mytable" class="table table-bordred table-striped">
                                                <thead>
                                                    <th>Image</th>
                                                    <th>Name</th>
                                                    <th>Quantity</th>
                                                    <th> </th>
                                                    <th class="text-right">Price</th>
                                                    <th class="text-right">Total</th>
                                                    <th class="">Delete</th>
                                                </thead>
                                                <tbody id="show-cart">
                                                {{--append here in cart items--}}
                                                </tbody>
                                            </table>

                                            <div class="col-sm-12 cart-bottom">

                                                <div class="col-md-6 ">
                                                    <h5>Shipping Address :</h5>
                                                    @if(empty($authShippingName||$authShippingAddress||$authShippingCountry))
                                                        <div class="alert alert-warning">
                                                            <strong>Not Set Your Shipping Details!
                                                                <a href="http://localhost:8000/myaccount" class="btn btn-danger btn-sm pull-right">Edit</a>
                                                            </strong>
                                                        </div>
                                                    @else
                                                        <label class="col-md-12 ">{{$authShippingName}}</label>
                                                        <label class="col-md-12 ">{{$authShippingAddress}}</label>
                                                        <label class="col-md-12 ">{{$authShippingCountry}}</label>
                                                        <a href="http://localhost:8000/myaccount" class="btn btn-danger btn-sm">Edit</a>
                                                    @endif

                                                </div>
                                                <div class="col-md-6 ">
                                                    <span class="col-sm-6 cart-product-total">Total</span>
                                                    <span id="total-cart" class="col-sm-4 cart-product-total" ></span>
                                                    <span class="col-sm-2"></span>

                                                    <span class="col-sm-6 cart-product-total">Shipping</span>
                                                    <span id="shipping-value" class="col-sm-4 cart-product-total cart-shipping-value">222</span>
                                                    <span class="col-sm-2"></span>

                                                    <span class="col-sm-6 cart-product-total">Order Total</span>
                                                    <span id="order-total" class="col-sm-4 cart-product-total cart-total-value"></span>
                                                    <span class="col-sm-2"></span>
                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <button type="submit" class="pull-right btn btn-primary">checkout</button>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection