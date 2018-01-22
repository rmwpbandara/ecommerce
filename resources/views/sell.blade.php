@extends('layouts.app')


@section('content')
    <script type="text/javascript">
        $('.a-sell').addClass('active');
    </script>

    <div class="main-content">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Add Product</div>
                    <div class="panel-body">
                        <form id="saveProduct" class="form-horizontal" action="{{route('addProduct')}}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            {{--product Types--}}
                            <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                                <label for="type" class="col-md-4 control-label">Type</label>
                                <div class="col-md-6">
                                    <select class="form-control" name="productType">
                                        @foreach($types as $type)
                                            <option value="{{ $type->id}}"> {{ $type->type }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            {{--product name--}}
                            <div class="form-group">
                                <label for="name" class="col-md-4 control-label">Name</label>
                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>
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
                                    <textarea id="description" class="form-control" name="description" required autofocus></textarea>
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
                                    <input id="price" type="number" min="1" step="1" value="1" class="form-control" name="price" required autofocus>
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
                                    <input id="quantity" type="number" min="1" step="1" class="form-control" name="quantity" value="1" required autofocus>
                                    @if ($errors->has('quantity'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('quantity') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            {{--product image_01--}}
                            <div class="form-group{{ $errors->has('frontImage') ? ' has-error' : '' }}">
                                <label for="image_01" class="col-md-4 control-label">Front Image</label>
                                <div class="col-md-6">
                                    <input id="frontImage" class="image" type="file" name="frontImage" accept="image/*" required autofocus>
                                    @if ($errors->has('frontImage'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('frontImage') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            {{--product image_02--}}
                            <div class="form-group{{ $errors->has('backImage') ? ' has-error' : '' }}">
                                <label for="image_02" class="col-md-4 control-label">Back Image</label>
                                <div class="col-md-6">
                                    <input id="backImage" class="image" type="file" name="backImage" accept="image/*">
                                    @if ($errors->has('backImage'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('backImage') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            {{--product tags--}}
                            <div class="form-group{{ $errors->has('tags') ? ' has-error' : '' }}">
                                <label for="tags" class="col-md-4 control-label">Tags</label>
                                <div class="col-md-6">
                                    <select class="select-tags form-control" name="states[]" multiple="multiple">
                                        @foreach($tags as $tag)
                                            <option value="{{ $tag->id}}"> {{ $tag->tag_name }}</option>
                                        @endforeach
                                    </select>
                                    <script type="text/javascript">
                                        $(document).ready(function() {
                                            $('.select-tags').select2();
                                        });
                                    </script>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button id="addProductBtn" class="btn btn-primary addproduct" type="submit">
                                        Submit
                                    </button>
                                    {{--<button id="addProductBtn" class="btn btn-primary addproduct" type="submit">--}}
                                        {{--Submit & Add Another Product--}}
                                    {{--</button>--}}
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endsection