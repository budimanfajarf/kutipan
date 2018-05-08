<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">         
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 90vh;
                margin: 0;
            }

            .full-height {
                height: 90vh;
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
            }

            a {
                color: #007bff;
                text-decoration: none;
                font-size: .9rem;
            }

            a:hover {
                text-decoration: underline;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                /* font-size: 12px; */
                font-size: .8rem;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>       
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        {{-- <a class="nav-link" href="/quotes">Quotes</a> --}}
                        {{-- <a href="{{ url('/home') }}">Home</a> --}}
                    @else
                        {{-- <a class="nav-link" href="/quotes">Quotes</a>                     --}}
                        <a href="{{ route('login') }}">Login</a>
                        <a href="{{ route('register') }}">Register</a>
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    {Quotes} "Kutipan"
                </div>

                <div class="links m-b-md"  style="margin-bottom: 50px;">
                    <a href="/quotes">All Quotes</a>
                    <a href="/quotes/random">Random Quote</a>
                </div>
                <div>
                    @foreach ($tags as $tag)
                        <a href="/quotes/tag/{{$tag->name}}" style="font-weight: 600">#{{$tag->name}}</a> &nbsp;                        
                    @endforeach
                </div>                
                
            </div>
        </div>
    </body>
</html>
