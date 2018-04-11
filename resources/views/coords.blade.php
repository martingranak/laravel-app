<?php
/**
 * Created by PhpStorm.
 * User: Martin-NOTEBOOK
 * Date: 25.03.2018
 * Time: 19:13
 */

/*$q = intval($_GET['q']);
echo $q;
$con = mysqli_connect('localhost','root','','bakalar');
if (!$con) {
    echo 'Could not connect: ' . mysqli_error($con);
}

mysqli_select_db($con,"ajax_demo");
$sql="SELECT * FROM locations WHERE device_id = ".$q;
$result = mysqli_query($con,$sql);

header("Content-type: text/xml");
/*echo '<markers>';
while($row = mysqli_fetch_array($result)) {
    echo '<marker id="' . $row['device_id'] . '" lat="' . $row['latitude'] . '" lng="' . $row['longtitude'] . '"/></marker>';
}
echo '</markers>';*/
/*
echo '<script>var coords = new Array();';
while($row = mysqli_fetch_array($result)) {
    echo 'var pom = ['.$row['latitude'].', '.$row['longtitude'].']
        coords.add(pom);';
}

echo '</script>'*/
?>

@extends('device')

@section('map')
    <div id="map"></div>
    <script>
        function initMap() {
            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 18,
                center: {lat: {{$coords[0]['longtitude']}}, lng: {{$coords[0]['latitude']}}},
                mapTypeId: 'terrain'
            });

            <?php
            foreach ($coords as $coord) {
                echo '
                    var pos = {
                        lat: '.$coord['longtitude'].',
                        lng: '.$coord['latitude'].'
                    };
                    var marker = new google.maps.Circle({
                        strokeOpacity: 0,
                        fillOpacity: 0.35,
                        fillColor: "#FF0000",
                        center: pos,
                        map: map,
                        radius: 10
                    });';
            }
            ?>
        }
    </script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDc1s_lxkjXLQW2LIcNvDdEm3pra2EAw4w&callback=initMap"></script>
@endsection
