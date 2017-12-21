@extends('layouts.app')

@section('content')
    <script type="text/javascript">
        $('.a-myorders').addClass('active');
    </script>

    {{--content my orders--}}
    <div class="responsive">
        <div>your content</div>
        <div>your content</div>
        <div>your content</div>
        <div>your content</div>
        <div>your content</div>
        <div>your content</div>
        <div>your content</div>
        <div>your content</div>
        <div>your content</div>
    </div>

    <script type="text/javascript" src="slick/slick.min.js"></script>

    <script type="text/javascript">
        $('.responsive').slick({
            dots: true,
            infinite: false,
            speed: 300,
            slidesToShow: 4,
            slidesToScroll: 4,
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