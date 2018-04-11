<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CoordsController extends Controller
{
    public function index() {
        return view('coords');
    }

    public function show() {
        $device = \DB::table('devices')->select('devices.device_id', 'devices.name as device_name', 'types.picture',
            'types.name as type_name', 'devices.type_id')->join('types', 'devices.type_id', '=', 'types.type_id')
            ->where('devices.device_id', '=', $_POST['device-id'])->get();
        $device = json_decode($device, true);

        $datetime_from = strtotime($_POST['date-from'].' '.$_POST['time-from']);
        $datetime_to = strtotime($_POST['date-to'].' '.$_POST['time-to']);

        $coords = \DB::table('locations')->where([['device_id', '=', $_POST['device-id']]])->get();
        $coords = json_decode($coords, true);
        //return $coords;
        return view('coords')->with(['coords' => $coords, 'device' => $device]);
    }
}
