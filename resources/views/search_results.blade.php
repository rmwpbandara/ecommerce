@extends('layouts.app')

@section('content')
    <script type="text/javascript">
        $('.a-shop').addClass('active');
    </script>

    @if(!empty($stocks))

        @foreach($stocks as $stock)
            @include('elements.element')
        @endforeach

        @else
        <h3>Enter tags or select types</h3>
    @endif
@endsection