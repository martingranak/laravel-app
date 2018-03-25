<?php
/**
 * Created by PhpStorm.
 * User: Martin-NOTEBOOK
 * Date: 19.03.2018
 * Time: 15:54
 */
?>

@extends('layouts.app')

@section('assets')
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Raleway', sans-serif;
            margin: 0;
        }

        #info-group {
            display: inline-block;
            position: absolute;
            left: 20%;
            top: 100px
        }

        #info-group h5,  #info-group h6 {
            display: inline-block;
            width: 150px;
        }

        #info-group p {
            display: inline-block;
            width: 250px;
        }

        #info-group ul li {
            text-align: left;
            border-bottom: dotted #636b6f 1px;

        }

        #info-group a {
            text-align: center;
            width: 120px;
            padding: 5px;
        }

        #info-group a:hover {
            text-decoration: none;
            background: #636b6f;
            color: #fff !important;
            animation-name: example;
            animation-duration: 400ms;
        }
    </style>
@endsection

@section('content')
    <div id="info-group">
        <ul>
            @guest
            @else
                    <li><h5>Name </h5><p>{{Auth::user()->name}}</p> <a href="#"><i class="material-icons mini-icon">mode_edit</i>edit</a></li>
                    <li><h5>E-mail </h5><p>{{Auth::user()->email}}</p> <a href="#"><i class="material-icons mini-icon">mode_edit</i>edit</a></li>
                    <li><h5>Password </h5><p></p><a href="#"><i class="material-icons mini-icon">mode_edit</i>Change</a></li>
                <li><h6>Create date</h6> <p>{{Auth::user()->created_at}}</p></li>
            @endguest
        </ul>
    </div>
@endsection