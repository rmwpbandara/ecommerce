@extends('layouts.app')

@section('content')
    <script type="text/javascript">
        $('.a-home').addClass('active');
    </script>


    {{--recent products--}}

    @if(count($recentStocks)>0)
    <span class="page-heading">Recent Products</span>
        <div class="responsive">
            @foreach($recentStocks as $stock)
                @include('elements.element')
            @endforeach
        </div>
        @else
        @include('elements.no_results')
    @endif

    {{--<span class="page-heading">Popular Products</span>--}}
    {{--<div class="responsive">--}}
        {{--@foreach($stocks as $stock)--}}
            {{--@include('elements.element')--}}
        {{--@endforeach--}}

    {{--</div>--}}




    <script type="text/javascript" src="slick/slick.min.js"></script>
    <script type="text/javascript">
        $('.responsive').slick({
            dots: false,
            infinite: false,
            speed: 300,
            slidesToShow: 4,
            slidesToScroll: 1,
            responsive: [
                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 3,
                        infinite: true,
                        dots: true
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
                // You can unslick at a given breakpoint now by adding:
                // settings: "unslick"
                // instead of a settings object
            ]
        });
    </script>
@endsection