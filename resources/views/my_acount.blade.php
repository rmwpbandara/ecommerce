@extends('layouts.app')

@section('content')
    <script type="text/javascript">
        $('.a-myaccount').addClass('active');
    </script>

    <link href="/css/myaccount-styles.css" rel="stylesheet"/>



    <div class="col-lg-12 col-sm-12">
        <div class="card hovercard">
            <div class="card-background col-sm-12">
                <img class="card-bkimg" alt="" src="images/cover-photos/{{$user->id}}coverPhoto.jpg">
            </div>
            <div class="useravatar">
                <img alt="" src="images/profile-pictures/{{$user->id}}profilePic.jpg">
            </div>
            <div class="card-info"><span class="card-title">{{$user->name}}</span>

            </div>
        </div>
        <div class="btn-pref btn-group btn-group-justified btn-group-lg" role="group" aria-label="...">
            <div class="btn-group" role="group">
                <button type="button" id="stars" class="btn btn-primary" href="#tab1" data-toggle="tab">
                    <span class="glyphicon glyphicon-wrench" aria-hidden="true"></span>

                    <div class="hidden-xs">Account Settings</div>
                </button>
            </div>

            <div class="btn-group" role="group">
                <button type="button" id="favorites" class="btn btn-default" href="#tab2" data-toggle="tab">
                    <span class="glyphicon glyphicon-open" aria-hidden="true"></span>

                    <div class="hidden-xs">My Products</div>
                </button>
            </div>

            <div class="btn-group" role="group">
                <button type="button" id="following" class="btn btn-default" href="#tab3" data-toggle="tab">
                    <span class="	glyphicon glyphicon-transfer" aria-hidden="true"></span>

                    <div class="hidden-xs">Pending Shipping</div>
                </button>
            </div>

            <div class="btn-group" role="group">
                <button type="button" id="favorites" class="btn btn-default" href="#tab4" data-toggle="tab">
                    <span class="glyphicon glyphicon-credit-card" aria-hidden="true"></span>

                    <div class="hidden-xs">My Account Balance</div>
                </button>
            </div>

            <div class="btn-group" role="group">
                <button type="button" id="following" class="btn btn-default" href="#tab5" data-toggle="tab">
                    <span class="glyphicon glyphicon-user" aria-hidden="true"></span>

                    <div class="hidden-xs">Following</div>
                </button>
            </div>
        </div>
        <div class="well">
            <div class="tab-content">

                <div class="tab-pane fade in active" id="tab1">
                    <form class="form-horizontal" role="form" action="{{ url('/updateAccount') }}" method="post"
                          enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="panel-body">

                            <div class="form-group">
                                <label for="name" class="col-md-4 control-label">Name</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name"
                                           value="{{$user->name}}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="email" class="col-md-4 control-label">E-Mail</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" name="email"
                                           value="{{$user->email}}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="Address" class="col-md-4 control-label">Address</label>

                                <div class="col-md-6">
                                    <input id="address" type="text" class="form-control" name="address"
                                           value="{{$user->address}}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="country" class="col-md-4 control-label">Country</label>

                                <div class="col-md-6">
                                    <input id="country_selector" class="form-control" type="text" name="country"
                                           value="{{$user->country}}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="Address" class="col-md-4 control-label">Contact Number</label>

                                <div class="col-md-6">
                                    <input id="contactNo" type="number" class="form-control" name="contactNo"
                                           value="{{$user->contactNo}}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="image_01" class="col-md-4 control-label">Change Profile Picture</label>

                                <div class="col-md-3">
                                    <input id="frontImage" class="image" type="file" name="profilePicture"
                                           accept="image/*">
                                </div>

                            </div>

                            <div class="form-group">
                                <label for="image_01" class="col-md-4 control-label">Change Cover Photo</label>

                                <div class="col-md-6">
                                    <input id="frontImage" class="image" type="file" name="coverPhoto" accept="image/*">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="change password" class="col-md-6 control-label">Change Password</label>
                            </div>

                            <div class="form-group">
                                <div class="col-md-4 control-label"></div>
                                @if (count($errors) > 0)
                                    <div class="alert alert-danger col-md-6">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="old_password" class="col-md-4 control-label">Current Password</label>

                                <div class="col-md-6">
                                    <input id="old_password" type="password" class="form-control" name="old_password">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="password" class="col-md-4 control-label">New Password</label>

                                <div class="col-md-6">
                                    <input id="newPassword" type="password" class="form-control" name="new_password">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                                <div class="col-md-6">
                                    <input id="password_confirmation" type="password" class="form-control"
                                           name="confirm_password">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="tab-pane fade in" id="tab2">
                    <div class="panel-body">
                        <div class="form-group">
                            <div class="product-list col-md-12">
                                <label class="col-md-1">Image</label>
                                <label class="col-md-1">Type</label>
                                <label class="col-md-1">Name</label>
                                <label class="col-md-2">Description</label>
                                <label class="col-md-1">Price</label>
                                <label class="col-md-1">Quantity</label>
                                <label class="col-md-2">Shipping Cost
                                    <label class="col-md-6">Local </label>
                                    <label class="col-md-6">International</label>
                                </label>
                                <label class="col-md-1"></label>
                                <label class="col-md-1"></label>
                                <label class="col-md-1">Edit</label>
                            </div>
                            @foreach($stocks as $stock)
                                <div class="product-list col-md-12">
                                    <form action="{{route('editProduct')}}" method="post" enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        <label class="col-md-1">
                                            <img style="max-height: 50px;max-width: 60px;" src="images/product-images/front-images/{{$stock->image1Url}}">
                                        </label>
                                        <label for="" class="col-md-1">{{$stock->type}}</label>
                                        <label for="" class="col-md-1">{{$stock->productName}}</label>
                                        <label for="" class="col-md-2">{{$stock->description}}</label>
                                        <label for="" class="col-md-1">{{$stock->price}}</label>
                                        <label for="" class="col-md-1">{{$stock->quantity}}</label>

                                        <label for="" class="col-md-1">{{$stock->shippingLocal}}</label>
                                        <label for="" class="col-md-1">{{$stock->shippingInternational}}</label>

                                        <label for="" class="col-md-1"></label>
                                        <label for="" class="col-md-1"></label>

                                        <input type="hidden" name="productId" value="{{$stock->id}}">
                                        <label for="" class="col-md-1">
                                            <button type="submit">Edit</button>
                                        </label>
                                    </form>

                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade in" id="tab3">
                    <h3>This is tab 3</h3>
                </div>
                <div class="tab-pane fade in" id="tab4">
                    <h3>This is tab 4</h3>
                </div>
                <div class="tab-pane fade in" id="tab5">
                    <h3>This is tab 5</h3>
                </div>

            </div>
        </div>
    </div>

    <script src="country-selector/build//js/countrySelect.min.js"></script>

    <script>
        $("#country_selector").countrySelect({
            {{--defaultCountry: "{{$user->email}}",--}}
            //onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
            preferredCountries: ['lk', 'us', 'gb']
        });
    </script>

@endsection