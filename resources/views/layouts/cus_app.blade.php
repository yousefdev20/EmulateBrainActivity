<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/cus_app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" crossorigin="anonymous" />

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/cus_app.css') }}" rel="stylesheet">
    <style>
        .blue{
            background: #f9f9f9 !important;
        }
        table tr{
            color: #76838f;
        }
        table thead {
            border-color: #eaeaea;
            background: #f8fafc;
            cursor: pointer;
            border-bottom: 1px solid #e4eaec;
            color: #526069;
        }
    </style>
</head>
<body>
<div class="wrapper" id="app">
    <div class="list">
        <div class="head-title">
            <div class="img-rouete">
                <img class="img" src="{{ url('assets/images/logo.jpg') }}">
                <b class="px-4">Welcome</b>
            </div>
        </div>
        <div class="opacity">
            <div class="head-imgage">
            </div>
        </div>
        <ul class="text-captilize">
            <div class="item link-active">
                <li class="link-active">
                    <i class="fas fa-bars"></i>
                    <div class="item-text">
                        dashboard
                    </div>
                </li>
            </div>
            <div class="item">
                <a href="{{ route('admin.home') }}">
                    <li>
                        <i class="fas fa-home"></i>
                        <div class="item-text">
                            home
                        </div>
                    </li>
                </a>
            </div>
            @if(can('browse_users'))
            <div class="item">
                <a href="{{ route('admin.users') }}">
                    <li>
                        <i class="fas fa-users"></i>
                        <div class="item-text">
                            users
                        </div>
                    </li>
                </a>
            </div>
            @endif
            @if(can('browse_roles'))
            <div class="item">
                <a href="{{ route('admin.roles') }}">
                    <li>
                        <i class="fas fa-lock"></i>
                        <div class="item-text">
                            roles
                        </div>
                    </li>
                </a>
            </div>
            @endif
            @if(can('browse_media'))
            <div class="item">
                <li>
                    <i class="fas fa-images"></i>
                    <div class="item-text">
                        Media
                    </div>
                </li>
            </div>
            @endif
            @if(can('browse_setting'))
            <div class="item">
                <li>
                    <i class="fas fa-cogs"></i>
                    <div class="item-text">
                        Setting
                    </div>
                </li>
            </div>
            @endif
            <div class="item">
                <a href="{{ route('visualize') }}">
                    <li>
                        <i class="fas fa-chart-area"></i>
                        <div class="item-text">
                            visualize data
                        </div>
                    </li>
                </a>
            </div>
            <div class="item">
                <a href="{{ route('game') }}">
                    <li>
                        <i class="fas fa-gamepad"></i>
                        <div class="item-text">
                            play new game
                        </div>
                    </li>
                </a>
            </div>
        </ul>
    </div>
    <div class="blue">
        <div class="nav-section px-3 pt-3">
            <div class="fas fa-arrow-left" id="arrow-clicker"></div>
            <div class="nav-title">
                <i class="fas fa-home"></i>
                dashbord
            </div>
            <div class="cus">
                <img class="img-rounded-cus" src="{{ url(auth()->user()->avatar) }}" width="50px" height="50px">
                <i class="fas fa-angle-down"></i>
            </div>
        </div>
        <div class="profile-list in-active text-captilize">
            <img class="profile-list-img" src="{{ url(auth()->user()->avatar) }}" width="50px" height="60px">
            <h6>{{ auth()->user()->name }}</h6>
            <h5>{{ auth()->user()->email }}</h5>
            <hr>
            <p>
                <a href="{{ route('admin.users.profile') }}">
                    <i class="fas fa-user"></i>
                    profile
                </a>
            </p>
            <p>
                <a href="/admin/home">
                    <i class="fas fa-home"></i>
                    home
                </a>
            </p>
            <a class="" href="{{ route('logout') }}"
               onclick="event.preventDefault();
                 document.getElementById('logout-form').submit();">
            <button>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
                <i class="fas fa-power-off"></i>
                logout
            </button>
            </a>
        </div>
        <main style="color: #526069;">
            @yield('content')
        </main>

    </div>
</div>
</body>
</html>
<script>
    function previewFile(id) {
        const preview = document.getElementById('img-'+id);
        const file = document.querySelector('input[type=file]').files[0];
        const reader = new FileReader();

        reader.addEventListener("load", function () {
            // convert image file to base64 string
            $("#img-"+id).removeClass('in-active');
            $("#img-"+id).removeClass('in-active');
            preview.src = reader.result;
        }, false);

        if (file) {
            reader.readAsDataURL(file);
        }
    }
</script>
