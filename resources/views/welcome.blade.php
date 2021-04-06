<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{-- jQuery --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <title>MyTV Tracker</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">

    <!-- Styles -->
    <style>
        html,
        body {

            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
            background: rgba(0, 0, 0, 0.9);
        }

        .full-height {
            height: 100vh;
        }

        .welcome {
            background: linear-gradient(rgba(0, 0, 0, .5), rgba(0, 0, 0, .8)), url('{{ 'background/postershow.jpg' }}');
            /* background-color: rgba($color: #2927278d, $alpha: 0.2); */
            /* background-color: rgb(59, 58, 58); */
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
            font-weight: bold;
            color: rgb(241, 202, 28)
        }

        .links>a {
            color: #a2a7aa;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .links {
            font-weight: bold;
        }

        .links>a:hover {
            background-color: rgba(241, 202, 28, 0.5);
            transition: 2s;
            border-radius: 8px;
        }

        .m-b-md {
            margin-bottom: 30px;
        }

        /* Make the image fully responsive */
        .carousel-inner img {
            width: 100%;
            height: 100%;
        }

    </style>
</head>

<body>
    <div class="welcome no-gutters flex-center position-ref full-height">
        @if (Route::has('login'))
            <div class="top-right links d-flex flex-wrap">
                @auth
                    <a href="{{ url('/home') }}">Home</a>
                    <a href="{{ url('/progress') }}">Progress</a>
                    <a href="{{ url('/discover') }}">Discover</a>
                    <a href="{{ url('/profile') }}">Profile</a>
                @else
                    <a href="{{ route('login') }}">Login</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}">Register</a>
                    @endif
                @endauth
            </div>
        @endif

        <div class="content">
            <div class="title m-b-md">
                MyTV Tracker
                <h3>Track all your favourite shows</h3>
            </div>



            <div class="links d-flex justify-content-center flex-wrap">
                <a href="https://laravel.com/docs">Docs</a>
                <a href="https://laracasts.com">API</a>
                <a href="https://laravel-news.com">News</a>
                <a href="https://blog.laravel.com">Blog</a>
                <a href="https://github.com/laravel/laravel">GitHub</a>
            </div>
        </div>

    </div>
    {{-- <div id="myCarousel" class="no-gutters carousel slide mt-5 col-sm-12">
        <h2 class="text-center">Best shows</h2>
        <!-- Indicators -->
        <ul class="carousel-indicators">
            <li class="item1 active"></li>
            <li class="item2"></li>
            <li class="item3"></li>
            <li class="item4"></li>
            <li class="item5"></li>
            <li class="item6"></li>
            <li class="item7"></li>
        </ul>

        <!-- The slideshow -->
        <div class="carousel-inner no-gutters" style="">
            <div class="carousel-item active">
                <img src="{{ asset('/carousel/peakyblinders.jpg') }}" alt="bb">
            </div>
            <div class="carousel-item no-gutters ">
                <img src="{{ asset('/carousel/dark.jpg') }}" alt="dark">
            </div>
            <div class="carousel-item no-gutters">
                <img src="{{ asset('/carousel/got.jpg') }}" alt="got">
            </div>
            <div class="carousel-item no-gutters">
                <img src="{{ asset('/carousel/bb.jpg') }}" alt="bb">
            </div>
            <div class="carousel-item no-gutters">
                <img src="{{ asset('/carousel/blacksails.jpg') }}" alt="bb">
            </div>
            <div class="carousel-item no-gutters">
                <img src="{{ asset('/carousel/theoffice.jpg') }}" alt="bb">
            </div>
            <div class="carousel-item no-gutters">
                <img src="{{ asset('/carousel/vikings.jpg') }}" alt="bb">
            </div>
        </div>

        <!-- Left and right controls -->
        <a class="carousel-control-prev" href="#myCarousel">
            <span class="carousel-control-prev-icon"></span>
        </a>
        <a class="carousel-control-next" href="#myCarousel">
            <span class="carousel-control-next-icon"></span>
        </a>
    </div> --}}
</body>
<script>
    $(document).ready(function() {
        // Activate Carousel
        $("#myCarousel").carousel();

        // Enable Carousel Indicators
        $(".item1").click(function() {
            $("#myCarousel").carousel(0);
        });
        $(".item2").click(function() {
            $("#myCarousel").carousel(1);
        });
        $(".item3").click(function() {
            $("#myCarousel").carousel(2);
        });
        $(".item4").click(function() {
            $("#myCarousel").carousel(2);
        });
        $(".item5").click(function() {
            $("#myCarousel").carousel(2);
        });
        $(".item6").click(function() {
            $("#myCarousel").carousel(2);
        });
        $(".item7").click(function() {
            $("#myCarousel").carousel(2);
        });

        // Enable Carousel Controls
        $(".carousel-control-prev").click(function() {
            $("#myCarousel").carousel("prev");
        });
        $(".carousel-control-next").click(function() {
            $("#myCarousel").carousel("next");
        });
    });

</script>

</html>
