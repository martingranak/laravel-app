<?php
/**
 * Created by PhpStorm.
 * User: Martin-NOTEBOOK
 * Date: 19.03.2018
 * Time: 10:37
 */

use Illuminate\Http\Request;
?>

@extends('home')

@section('menu')
    <nav id="device-menu">
        <div>
            <h4><i class="{{ $device[0]['picture'] }}"></i>{{ $device[0]['device_name'] }}</h4>

            <?php
            $currant_datetime = \Carbon\Carbon::now();
            ?>
            {!! Form::open(array('route' => 'coords')) !!}
            {!! Form::hidden('device-id', $device[0]['device_id']) !!}
            <div>
                {!! Form::label('from', 'From: ') !!}
                {!! Form::date('date-from', $currant_datetime) !!}
                {!! Form::time('time-from', $currant_datetime->hour.':'.$currant_datetime->minute) !!}
            </div>
            {!! Form::radio('to-present', 'false', 'true', array('id' => 'rb-to-date')) !!}
            {!! Form::label('to-spec-date', 'To specific date ')!!}
            <br>
            <div>
                {!! Form::label('to', 'To: ') !!}
                {!! Form::date('date-to', $currant_datetime, array('id' => 'date-to')) !!}
                {!! Form::time('time-to', $currant_datetime->hour.':'.$currant_datetime->minute, array('id' => 'time-to')) !!}
            </div>
            {!! Form::radio('to-present', 'true', '', array('id' => 'rb-to-present')) !!}
            {!! Form::label('to-now', 'To present ')!!}
            <br>
            <div>
                {!! Form::label('freq', 'Frequency: ')!!}
                {!! Form::number('frequency', 5,['min'=>5,'max'=>100, 'id' => 'number-frequency']) !!}
            </div>
            <br>
            <div class="submit-group">
                {!! Form::submit('Show', array('id' => 'btn-find-coord', 'class' => 'btn')) !!}
            </div>
            {!! Form::close() !!}
        </div>
        <div>
            <script>

                function eqfeed_callback(results) {
                    if (window.XMLHttpRequest) {
                        // code for IE7+, Firefox, Chrome, Opera, Safari
                        xmlhttp = new XMLHttpRequest();
                    } else {
                        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                    }
                    xmlhttp.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                            console.log('je zle');
                            document.getElementById("txtHint").innerHTML = this.responseText;
                        }
                    };

                    xmlhttp.open("GET","{{ url('find') }}?q={{ $device[0]['device_id'] }}",true);
                    xmlhttp.send();

                    for (var i = 0; i < coords.length(); i++) {
                        var latLng = new google.maps.LatLng(coords[i][0],coords[i][1]);
                        var marker = new google.maps.Marker({
                            position: latLng,
                            map: map
                        });
                    }
                }
            </script>
        </div>
    </nav>

    <script>
        document.getElementById("rb-to-date").addEventListener("click", setFalse);
        function setFalse() {
            document.getElementById('date-to').disabled = false;
            document.getElementById('time-to').disabled = false;
        }
        document.getElementById("rb-to-present").addEventListener("click", setTrue);
        function setTrue() {
            document.getElementById('date-to').disabled  = true;
            document.getElementById('time-to').disabled  = true;
        }
    </script>
@endsection
