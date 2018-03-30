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
            echo Form::getValueAttribute('to-present');
            ?>
            {!! Form::open() !!}
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
                {!! Form::submit('Show', array('id' => 'btn-find-coord', 'class' => 'btn', 'onclick' => 'event.preventDefault(); showUser(1);')) !!}
            </div>
            {!! Form::close() !!}
        </div>
        <div>
            <script>
                function showUser(str) {
                    if (str == "") {
                        document.getElementById("txtHint").innerHTML = "";
                        return false;
                    } else {
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

                        xmlhttp.open("GET","{{ url('find') }}?q="+str,true);
                        xmlhttp.send();
                        return true;
                    }
                }

                /*function eqfeed_callback(results) {
                    var coords;

                    for (var i = 0; i < coords; i++) {
                        var latLng = new google.maps.LatLng(,);
                        var marker = new google.maps.Marker({
                            position: latLng,
                            map: map
                        });
                    }
                }*/
            </script>
        </div>
        <div id="txtHint"><b>Person info will be listed here...</b></div>
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
