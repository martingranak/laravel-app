@extends('layouts.app')

@section('assets')
    <style>
        #map {
            height: 90%;
        }

        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }

        .form-group {
            width: 350px;
        }

        .form-control {
            width: 80%;
            display: inline-block;
        }

        #device-menu {
            position: absolute;
            top: 69px;
            background: #fff;
            z-index: 5;
            padding: 5px;
        }
        #device-menu div div label {
            width: 50px;
        }
        #device-menu div label {
            width: 150px;
        }

        a:hover {
            text-decoration: none;
            background: #636b6f;
            color: #fff;
        }

        #device-menu i {
            font-size: 30px;
            width: 50px;
            text-align: center;
        }

        .btn {

        }
    </style>
@endsection

@section('content')
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
@endsection

@section('map')
    <div id="map"></div>
    <script>
        var map;
        function initMap() {
            map = new google.maps.Map(document.getElementById('map'), {
                zoom: 11,
                center: {lat: 49.222778, lng: 18.75},
                mapTypeId: 'terrain'
            });

            var script = document.createElement('script');
            script.src = 'https://developers.google.com/maps/documentation/javascript/examples/json/earthquake_GeoJSONP.js';
            document.getElementsByTagName('head')[0].appendChild(script);

            map.data.setStyle(function(feature) {
                var magnitude = feature.getProperty('mag');
                return {
                    icon: getCircle(magnitude)
                };
            });
        }

        function getCircle(magnitude) {
            return {
                path: google.maps.SymbolPath.CIRCLE,
                fillColor: 'red',
                fillOpacity: .2,
                scale: Math.pow(2, magnitude) / 2,
                strokeColor: 'white',
                strokeWeight: .5
            };
        }

        function eqfeed_callback(results) {
            map.data.addGeoJson(results);
        }
    </script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDc1s_lxkjXLQW2LIcNvDdEm3pra2EAw4w&callback=initMap"></script>
@endsection