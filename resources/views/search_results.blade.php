@extends('layouts.app')

@section('content')
    <script type="text/javascript">
        $('.a-shop').addClass('active');
    </script>

    @if(!empty($stocks))
        @if(count($stocks)>0)
            @foreach($stocks as $stock)
                @if($stock->user_id!=$authId)
                    @include('elements.element')
                @endif
            @endforeach

            @else
                @include('elements.no_results')
        @endif
    @else
        <h3 class="alert-danger">Enter tags or select types</h3>
    @endif
@endsection