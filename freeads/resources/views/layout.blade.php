<!DOCTYPE html>
<html>
<head>
    <title>FreeAds</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{URL::asset('css/app.css')}}">
</head>
<body>
    
<nav class="navbar navbar-expand-lg navbar-light navbar-laravel">
    <div class="container">
        <a href="{{ route('dashboard') }}">
        <img class="navbar-brand"  src="{{URL::asset('picture/logo freeads.png')}}" alt="logo" height= "100px" width= "100px" >
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
   
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">Register</a>
                    </li>

 
                @else
                    @can('isAdmin')
                    <li>
                        <a class="nav-link" href="{{ route('users.index') }}">Admin</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('access_my_ads') }}">My Ads</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('form_create_ad') }}">Post an Ad</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout') }}">Logout</a>
                    </li>
                    @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('access_my_ads') }}">My Ads</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('form_create_ad') }}">Post an Ad</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout') }}">Logout</a>
                    </li>
                    @endcan

                    

                @endguest
            </ul>
  
        </div>
    </div>
</nav>
  
@yield('content')
     
</body>
</html>