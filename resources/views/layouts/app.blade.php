<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Sparring</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset("favicon.ico")}}">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/tag.css') }}" rel="stylesheet">
</head>
<body>
<div id="app">
    <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
        <div class="container">
                @if(Auth::user())
                    @if(Auth::user()->photo !== "universal_pic.png")
                    <a class="navbar-brand" href="/user/0">
                        <img class="card-img" style="width: 4em; height:3em; border-radius:50%;"
                             src="/storage/photos/users/user{{Auth::user()->id}}/profilepics/{{Auth::user()->photo}}"
                             alt="Profile picture">
                    </a>
                    @else
                    <a class="navbar-brand" href="/user/0">
                    <img class="card-img my-3" style="width: 3.5rem; height:3rem;"
                        src="/storage/photos/users/default/{{Auth::user()->photo}}" alt="Profile picture">
                    </a>
                    @endif
                @endif

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{action("UserController@index")}}">Users</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{action("GroupController@index")}}">Groups</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{action('NoticeController@index')}}">Noticeboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{action("TrainerController@index")}}">FIND TRAINER</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{action('SearchController@create')}}">FIND SPARRING</a>
                    </li>
                </ul>
                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    @if(\Gate::denies('trainer'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{action("TrainerController@create")}}">Become a Trainer</a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{action("TrainerController@dashboard")}}">Trainer dashboard</a>
                        </li>


                    @endif
                <!-- Authentication Links -->
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @else
                        <form action="{{action('SearchController@store_simple')}}" method="post"
                              class="navbar-form navbar-left" role="search">
                            @csrf
                            <div class="form-group">
                                <input type="text" name="search" class="form-control" placeholder="Search">
                            </div>
                            <input type="submit" style="display: none"/>
                            {{--<button type="submit" class="btn btn-default">--}}
                            {{--<span class="glyphicon glyphicon-search"></span>--}}
                            {{--</button>--}}
                        </form>
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                      style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>

                    @endguest
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        @include("inc.messages")
        @yield('content')
    </div>
</div>
</body>
</html>
