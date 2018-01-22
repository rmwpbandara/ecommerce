@extends('layouts.app')

@section('content')

    <script type="text/javascript">
        $('.a-favourite').addClass('active');
    </script>

    @if(count($stocks)>0)
        <h4 class="page-heading">My Favourites</h4>
        @foreach($stocks as $stock)
            @if($stock->user_id!=$authId)
                @include('elements.element')
            @endif
        @endforeach

    @else
        @include('elements.no_results')
    @endif

@endsection