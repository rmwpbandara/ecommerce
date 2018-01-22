@extends('layouts.app')


@section('content')

    <div class="main-content">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Edit Product</div>
                    <div class="panel-body">
                        <form id="saveProduct" class="form-horizontal" action="{{route('updateProduct')}}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            {{--product Types--}}
                            <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                                <label for="type" class="col-md-4 control-label">Type</label>
                                <div class="col-md-6">
                                    <select class="form-control" name="productType" >
                                        @foreach($types as $type)
                                            <option value="{{ $type->id}}" {{($stock->type_id)==($type->id) ? 'selected="selected"' : ''}}> {{ $type->type }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            {{--product name--}}
                            <div class="form-group">
                                <label for="name" class="col-md-4 control-label">Name</label>
                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="productName" value="{{$stock->productName}}" required autofocus>
                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            {{--product description--}}
                            <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                                <label for="description" class="col-md-4 control-label">Description</label>

                                <div class="col-md-6">
                                    <textarea id="description" class="form-control" name="description"  required autofocus>{{$stock->description}}</textarea>
                                    @if ($errors->has('description'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            {{--product price--}}
                            <div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
                                <label for="price" class="col-md-4 control-label">Price</label>

                                <div class="col-md-6">
                                    <input id="price" type="number" min="1" step="1" value="{{$stock->price}}" class="form-control" name="price" required autofocus>
                                    @if ($errors->has('price'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('price') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            {{--product quantity--}}
                            <div class="form-group{{ $errors->has('quantity') ? ' has-error' : '' }}">
                                <label for="quantity" class="col-md-4 control-label">Quantity</label>

                                <div class="col-md-6">
                                    <input id="quantity" type="number" min="1" step="1" class="form-control" name="quantity" value="{{$stock->quantity}}" required autofocus>
                                    @if ($errors->has('quantity'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('quantity') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            {{--product image_01--}}
                            <div class="form-group{{ $errors->has('frontImage') ? ' has-error' : '' }}">
                                <label for="image_01" class="col-md-2 control-label">
                                    <img style="max-height: 50px;max-width: 60px;" src="images/product-images/front-images/{{$stock->image1Url}}">
                                </label>
                                <label for="image_01" class="col-md-2 control-label" style="padding-top: 20px">Front Image</label>
                                <div class="col-md-6" style="padding-top: 20px">
                                    <input id="frontImage" class="image" type="file" name="frontImage" accept="image/*">
                                    @if ($errors->has('frontImage'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('frontImage') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            {{--product image_02--}}
                            <div class="form-group{{ $errors->has('backImage') ? ' has-error' : '' }}">
                                <label for="image_01" class="col-md-2 control-label">
                                    <img style="max-height: 50px;max-width: 60px;" src="images/product-images/back-images/{{$stock->image2Url}}">
                                </label>
                                <label for="image_02" class="col-md-2 control-label" style="padding-top: 20px">Back Image</label>
                                <div class="col-md-6" style="padding-top: 20px">
                                    <input id="backImage" class="image" type="file" name="backImage" accept="image/*">
                                    @if ($errors->has('backImage'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('backImage') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            {{--aria-selected="true"--}}

                            {{--product tags--}}
                            <div class="form-group{{ $errors->has('tags') ? ' has-error' : '' }}">
                                <label for="tags" class="col-md-4 control-label">Tags</label>
                                <div class="col-md-6">
                                    <select class="select-tags-change form-control" name="states[]" multiple="multiple">
                                        @foreach($tags as $tag)
                                            <option value="{{ $tag->id}}"> {{ $tag->tag_name }}</option>
                                        @endforeach
                                    </select>

                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <input type="hidden" name="productId" value="{{$stock->id}}">
                                    <button id="addProductBtn" class="btn btn-primary addproduct" type="submit">Update Product</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">

        var currentTags = [];
        @foreach($taggings as $tagging)
            currentTags.push({{$tagging->tag_id}});
        @endforeach

        $(document).ready(function() {
                    $('.select-tags-change').select2().val(currentTags).trigger('change');
                });
    </script>

@endsection