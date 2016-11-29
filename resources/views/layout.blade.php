<!DOCTYPE html>
<html lang="fr">
    <head>
        <link rel="stylesheet" type="text/css" href="resources/assets/sass/app.scss"/>
        <link rel="stylesheet" type="text/css" href="resources/assets/sass/app.scss"/>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{config('app.name')}}</title>

        <link rel="stylesheet" href="{{ url('css/app.css') }}">
        <!-- Styles -->
    </head>
    <body>
        <div class="white-box">
            <div class="row">
                <div class="half-col">
                    <img src="{{asset('img/img-santa.png')}}" alt="santa">
                </div>
                <div class="half-col">
                    <h1>Secret <span>Santa</span></h1>
                    <div class="content">
                        @yield('content')
                    </div>
                </div>
            </div>
            <footer>
                <img src="{{asset('img/img-neoxia.png')}}" alt="by neoxia">
            </footer>
        </div>
        <a class="credit" href="https://github.com/mathieutu/secret_santa">Powered with love by your UI/WebDev Team.</a>
    </body>
</html>
