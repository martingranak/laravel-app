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

        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            padding-top: 100px;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            text-align: center;
            background-color: rgba(0,0,0,0.4);
        }

        .modal-content {
            position: relative;
            background-color: #fefefe;
            margin: auto;
            padding: 0;
            border: 1px solid #888;
            display: inline-block;
            width: auto;
            box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);
            -webkit-animation-name: animatetop;
            -webkit-animation-duration: 0.4s;
            animation-name: animatetop;
            animation-duration: 0.4s
        }

        @-webkit-keyframes animatetop {
            from {top:-300px; opacity:0}
            to {top:0; opacity:1}
        }

        @keyframes animatetop {
            from {top:-300px; opacity:0}
            to {top:0; opacity:1}
        }

        .close {
            color: white;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: #000;
            text-decoration: none;
            cursor: pointer;
        }

        .modal-header {
            padding: 2px 16px;
            background-color: #5cb85c;
            color: white;
        }

        .modal-body {
            padding: 2px 16px;
            text-align: left;
        }

        .modal-footer {
            padding: 3px 26px;
            background-color: #5cb85c;
            color: white;
            float: right;
        }
    </style>
@endsection

@section('content')
    <div id="info-group">
        <ul>
            @guest
            @else
                    <li><h5>Name </h5><p>{{Auth::user()->name}}</p> <a href="" onclick="event.preventDefault(); editName();"><i class="material-icons mini-icon">mode_edit</i>edit</a></li>
                    <li><h5>E-mail </h5><p>{{Auth::user()->email}}</p> <a href="" onclick="event.preventDefault(); editEmail();"><i class="material-icons mini-icon">mode_edit</i>edit</a></li>
                    <li><h5>Password </h5><p></p><a href="" onclick="event.preventDefault(); editPassword();"><i class="material-icons mini-icon">mode_edit</i>edit</a></li>
                <li><h6>Create date</h6> <p>{{Auth::user()->created_at}}</p></li>
            @endguest
        </ul>
    </div>
@endsection

@section('map')
    <div id="myModal" class="modal">
        <div class="modal-content" id="fr-group">
            <div class="modal-header">
                <span class="close" onclick="closeWindow();">&times;</span>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    {!! Form::open(array('route' => 'create_device', 'id' => 'edit-form')) !!}
                    <div>
                        {!! Form::hidden('function', '', array('id' => 'function')) !!}
                        {!! Form::hidden('user-id', \Auth::user()->id, array('id' => 'user-id')) !!}
                        {!! Form::label('user-label', 'Device name')!!}
                        {!! Form::text('user-text', '', array('id' => 'edit-text', 'required' => 'required')); !!}
                    </div>
                    <button class="btn btn-default-sm modal-footer" type="submit">
                        Submit
                    </button>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

    <script>
        var modal = document.getElementById('myModal');
        var span = document.getElementsByClassName("close")[0];
        var functionValue = document.getElementById('function');

        function editName() {
            modal.style.display = "block";

            functionValue.value = 'name';
            document.getElementById('edit-text').value = "{{ \Auth::user()->name }}";
        }

        function editEmail() {
            modal.style.display = "block";

            functionValue.value = 'e-mail';
            document.getElementById('edit-text').value = "{{ \Auth::user()->email }}";
        }

        function editPassword() {
            modal.style.display = "block";

            functionValue.value = 'e-mail';
            document.getElementById('edit-text').value = '';
        }

        function closeWindow() {
            modal.style.display = "none";
        }

        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>
@endsection