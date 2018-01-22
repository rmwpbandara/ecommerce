@extends('layouts.app')

@section('content')

<script type="text/javascript">
    $('.a-subscriptions').addClass('active');
</script>

@if(count($subscribes)>0)
    @foreach($subscribes as $subscribe)
        <div class="col-md-12">
            <h3>Seller :{{$subscribe->name}}</h3>
            <div class="responsive">
                @foreach($stocks as $stock)
                    @if($subscribe->subscribes_user_id==$stock->user_id)
                        @include('elements.element')
                    @endif
                @endforeach
            </div>
        </div>
    @endforeach
@else
    @include('elements.no_results')
@endif

<script type="text/javascript" src="slick/slick.min.js"></script>
<script type="text/javascript">
    $('.responsive').slick({
        dots: false,
        infinite: true,
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