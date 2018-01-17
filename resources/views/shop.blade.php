@extends('layouts.app')

@section('content')
    <script type="text/javascript">
        $('.a-shop').addClass('active');
    </script>


    @if(count($stocks)>0)
        @foreach($stocks as $stock)
            @include('elements.element')
        @endforeach
    @else
        @include('elements.no_results')
    @endif
@endsection