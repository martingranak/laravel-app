<?php
use Illuminate\Support\Facades\DB;
?>

<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    @yield('assets')
    <style>
        .form-group {
            width: 420px;
            margin: 0;
        }

        .form-control {
            width: 89%;
            display: inline-block;
        }

        select{
            font-family: FontAwesome, sans-serif;
        }

        option {
            font-family: FontAwesome, sans-serif;
        }

        a {
            color: #636b6f;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
            display: inline-block;
            height: 100%;
            padding: 0 10px 0 0;
        }

        ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        #btn-home a {
            width: 100%;
            text-align: center;
            font-size: 20px;
            line-height: 50px;
            padding: 0 30px 0 30px;
        }

        #navbarDropdown {
            line-height: 50px;
            padding: 0 20px 0 20px;
        }

        #navbarDropdown:hover, #btn-home a:hover, #btn-search:hover, .dropdown-item:hover, .nav-link:hover, #btn-find-coord:hover {
            text-decoration: none;
            background: #636b6f;
            color: #fff !important;
            animation-name: example;
            animation-duration: 400ms;
        }

        /* Safari 4.0 - 8.0 */
        @-webkit-keyframes example {
            0%   {background: none; color:#636b6f; }
            100% {background:#636b6f; color: #fff; }
        }

        @keyframes example {
            0%   {background: none; color:#636b6f; }
            100% {background:#636b6f; color: #fff; }
        }

        #number-frequency {
            width: 70px;
            float: right;
        }

        #btn-find-coord {
            width: 150px;
        }

        .submit-group {
            text-align: center;
        }
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            @guest
            @else
                <div id="btn-home"><a href="{{ url('home') }}">Home</a></div>
            @endguest
            <div class="container">
                @guest
                @else
                <?php
                    $devices2 = DB::table('devices')->where('user_id', Auth::user()->id)->orderBy('type_id')->get();
                ?>

                <div class="form-group">
                    {!! Form::open(array('route' => 'device')) !!}
                    <select class="form-control" name="device_id">
                        <option selected value="" disabled hidden>Choose device ...</option>
                        <?php
                            $u_agent = $_SERVER['HTTP_USER_AGENT'];
                            if(preg_match('/Firefox/i',$u_agent)) {
                                $mobiles = [];
                                $laptops = [];
                                $tablets = [];
                                $others = [];

                                foreach ($devices2 as $device) {
                                    if($device->type_id == 1) {
                                        array_push($mobiles, $device);
                                    } else if($device->type_id == 2) {
                                        array_push($laptops, $device);
                                    } else if($device->type_id == 3) {
                                        array_push($tablets, $device);
                                    } else {
                                        array_push($others, $device);
                                    }
                                }
                                if (!empty($mobiles)) {
                                    echo '<optgroup label="Mobiles">';
                                    foreach ($mobiles as $mobile) {
                                        echo '<option value="'.$mobile->device_id.'">'.$mobile->name.'</option>';
                                    }
                                    echo '</optgroup>';
                                }
                                if (!empty($laptops)) {
                                    echo '<optgroup label="Laptops">';
                                    foreach ($laptops as $laptop) {
                                        echo '<option value="'.$laptop->device_id.'">'.$laptop->name.'</option>';
                                    }
                                    echo '</optgroup>';
                                }
                                if (!empty($tablets)) {
                                    echo '<optgroup label="Tablets">';
                                    foreach ($tablets as $tablet) {
                                        echo '<option value="'.$tablet->device_id.'">'.$tablet->name.'</option>';
                                    }
                                    echo '</optgroup>';
                                }
                                if (!empty($others)) {
                                    echo '<optgroup label="Others">';
                                    foreach ($others as $other) {
                                        echo '<option value="'.$other->device_id.'">'.$other->name.'</option>';
                                    }
                                    echo '</optgroup>';
                                }
                            } else {
                                foreach ($devices2 as $device) {
                                    echo '<option value="'.$device->device_id.'">';
                                    switch ($device->type_id) {
                                        case 1:
                                            echo '&#xf10b; ';
                                            break;
                                        case 2:
                                            echo '&#xf109; ';
                                            break;
                                        case 3:
                                            echo '&#xf10a; ';
                                            break;
                                        default:
                                            echo '&#xf1ec; ';
                                            break;
                                    }
                                    echo $device->name.'</option>';
                                }
                            }
                        ?>
                    </select>
                    <button class="btn btn-default-sm" type="submit" id="btn-search">
                        <i class="fa fa-search"></i>
                    </button>
                    {!! Form::close() !!}
                </div>
                <script>
                    var select = document.getElementsByName('item_id');
                    select.onchange = function(){
                        this.form.submit();
                    };
                </script>
                @endguest
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li><a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a></li>
                            <li><a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a></li>
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ url('devices').'/all' }}">Manage devices</a>
                                    <a class="dropdown-item" href="{{ url('settings') }}">Manage account</a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        @yield('content')
    </div>
    @yield('menu')
    @yield('map')

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
