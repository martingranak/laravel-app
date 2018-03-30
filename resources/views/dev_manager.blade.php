<?php
/**
 * Created by PhpStorm.
 * User: Martin-NOTEBOOK
 * Date: 19.03.2018
 * Time: 15:51
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

        .position-ref {
            position: relative;
        }

        .m-b-md {
            margin-bottom: 30px;
        }

        .dev_picture, .material-icons {
            font-size: 50px;
            text-align: center;
            display: inline-block;
            width: 75px;
        }

        #output-menu, #filter-menu {
            display: inline-block;
        }

        #filter-menu {
            border-top: solid #636b6f 2px;
            border-right: solid #636b6f 2px;
            border-bottom: solid #636b6f 2px;
            vertical-align: top;
            width: 200px;
        }

        #filter-menu a, #output-menu a:first-child {
            width: 100%;
        }

        .mini-icon {
            font-size: 30px;
            line-height: 80px;
        }

        .material-icon {
            width: 75px;
            text-align: center;
        }

        #output-menu ul li {
            text-align: left;
            border-bottom: dotted #636b6f 1px;

        }

        #output-menu ul li * {
            vertical-align: middle;
        }

        #output-menu ul li:first-child {
            margin-left: 10px;
        }

        #output-menu ul li:first-child a {
            padding-left: 20px;
        }

        #output-menu a:hover, #filter-menu a:hover {
            text-decoration: none;
            background: #636b6f;
            color: #fff !important;
            animation-name: example;
            animation-duration: 400ms;
        }

        .left-part {
            width: 500px;
            display: inline-block;
            margin-left: 10px;
        }

        .left-part:first-child a {
            padding-left: 20px;
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

        #edit-select {
            width: 200px;
        }

        .qr-image {
            position: absolute;
            top: 150px;
            left: 40%;
            display: none;
        }

        #qr-group {
            min-height: 300px;
        }

        .form-group p {
            display: inline-block;
            width: 49%;
        }

        #messages {
            display: inline-block;
            text-align: center;
            position: absolute;
            left: 45%;
            top: 100px;
        }

        .message a {
            font-size: inherit;
            padding: 5px 10px;
        }

    </style>
@endsection

@section('content')
    <div id="filter-menu">
        <ul>
            <li><a href="{{ url('devices').'/all' }}"><div class="dev_picture"><i class="material-icons">storage</i></div>All</a></li>
            <li><a href="{{ url('devices').'/mobiles' }}"><div class="dev_picture"><i class="fa fa-mobile"></i></div>Mobiles</a></li>
            <li><a href="{{ url('devices').'/laptops' }}"><div class="dev_picture"><i class="fa fa-laptop"></i></div>Laptops</a></li>
            <li><a href="{{ url('devices').'/tablets' }}"><div class="dev_picture"><i class="fa fa-tablet"></i></div>Tablets</a></li>
            <li><a href="{{ url('devices').'/others' }}"><div class="dev_picture"><i class="fa fa-calculator"></i></div>Others</a></li>
        </ul>
    </div>
    @guest
        <div id="messages">
            <div class="message"><h4>You are logged out.</h4></div>
            <div class="message"><h4>Please, <a href="{{ route('login') }}">log in</a>.</h4></div>
        </div>
    @else
        <div class="position-ref" id="output-menu">
            <div class="m-b-md">
                <h4>Your devices:</h4>
                <ul>
                    <li><a href="" id="myBtn" onclick="event.preventDefault(); openWindow();"><div class="dev_picture"><i class="fa fa-plus-square-o"></i></div>add device</a></li>
                    @foreach($devices as $device)
                        <li>
                            <div class="left-part"><a href="" onclick="event.preventDefault(); openInfo('{{ $device->device_name }}','{{ $device->type_name }}','{{ $device->created_at }}', '{{ $device->updated_at }}');">
                                    <div class="dev_picture"><i class="{{ $device->picture }}"></i></div>{{ $device->device_name }}</a></div>
                            <a href="" onclick="event.preventDefault(); openEditWindow('{{ $device->device_id }}','{{ $device->device_name }}','{{ $device->type_id }}')"><i class="material-icons mini-icon">mode_edit</i>edit</a>
                            <a href="" onclick="event.preventDefault(); showQR('qr-{{ $device->device_id }}');"><i class="fa mini-icon material-icon">&#xf029;</i>QR code</a>
                            <a href="" onclick="event.preventDefault(); deleteDevice({{ $device->device_id }})"><i class="material-icons mini-icon">delete_forever</i>delete</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endguest

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
                            {!! Form::hidden('dev-id', '', array('id' => 'edit-id')) !!}
                            {!! Form::label('dev-name', 'Device name')!!}
                            {!! Form::text('dev-name-text', '', array('id' => 'edit-text', 'required' => 'required')); !!}
                        </div>
                        <div>
                            {!! Form::label('dev-type', 'Device type')!!}
                            {!! Form::select('dev-type-text', array(1 => 'Mobile', 2 => 'Laptop', 3 => 'Tablet', 4 => 'Others'), null, array('class' => 'form-control', 'id' => 'edit-select', 'required' => 'required')); !!}
                        </div>
                        <button class="btn btn-default-sm modal-footer" type="submit">
                            Submit
                        </button>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>

        <div id="qr-group">
            @if($devices != null)
                @foreach($devices as $device)
                    <img class="qr-image" id="qr-{{ $device->device_id }}" src="https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl={{ str_replace(' ', '_', \Auth::user()->name.\Auth::user()->id.'/'.$device->device_name) }}"/>
                @endforeach
            @endif
        </div>

        <div class="modal-content" id="info-group">
            <div class="modal-header">
                <h5>Device Info</h5><span class="close" onclick="closeWindow();">&times;</span>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <p>Name:</p><p id="info-name"></p>
                    <p>Type:</p><p id="info-type"></p>
                    <p>Created:</p><p id="info-created"></p>
                    <p>Last update:</p><p id="info-updated"></p>
                </div>
            </div>
        </div>
    </div>

    <script>
        var modal = document.getElementById('myModal');
        var frGroup = document.getElementById('fr-group');
        var qrGroup = document.getElementById('qr-group');
        var infoGroup = document.getElementById('info-group');
        var span = document.getElementsByClassName("close")[0];
        var functionValue = document.getElementById('function');
        var qr_image;

        function openWindow() {
            modal.style.display = "block";
            frGroup.style.display = "inline-block";
            qrGroup.style.display = "none";
            infoGroup.style.display = "none";

            functionValue.value = 'create';
            document.getElementById('edit-id').value = '';
            document.getElementById('edit-text').value = '';
            document.getElementById('edit-select').value = '';
        }

        function openEditWindow(id, name, type) {
            modal.style.display = "block";
            frGroup.style.display = "inline-block";
            qrGroup.style.display = "none";
            infoGroup.style.display = "none";

            functionValue.value = 'edit';
            document.getElementById('edit-id').value = id;
            document.getElementById('edit-text').value = name;
            document.getElementById('edit-select').value = type;
        }

        function showQR(qr_id) {
            modal.style.display = "block";
            frGroup.style.display = "none";
            qrGroup.style.display = "block";
            infoGroup.style.display = "none";
            qr_image = document.getElementById(qr_id);
            qr_image.style.display = "block";
        }

        function openInfo(name, type, createdAt, updatedAt) {
            modal.style.display = "block";
            frGroup.style.display = "none";
            qrGroup.style.display = "none";
            infoGroup.style.display = "inline-block";

            document.getElementById('info-name').innerHTML = name;
            document.getElementById('info-type').innerHTML = type;
            document.getElementById('info-created').innerHTML = createdAt;
            document.getElementById('info-updated').innerHTML = updatedAt;
        }

        function deleteDevice(id) {
            if (confirm('Are you sure you want delete this device?')) {
                functionValue.value = 'delete';
                document.getElementById('edit-id').value = id;
                document.getElementById("edit-form").submit();
            } else {

            }
        }

        function closeWindow() {
            modal.style.display = "none";
        }

        window.onclick = function(event) {
            if (event.target == modal || event.target == qrGroup) {
                modal.style.display = "none";
                frGroup.style.display = "none";
                infoGroup.style.display = "none";
                if (qr_image != null) {
                    qr_image.style.display = "none";
                }
            }
        }
    </script>
@endsection