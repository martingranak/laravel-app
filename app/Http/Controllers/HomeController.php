<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function show() {
        if (isset($_POST['device-id'])) {
            $device = \DB::table('devices')->select('devices.device_id', 'devices.name as device_name', 'types.picture',
                'types.name as type_name', 'devices.type_id')->join('types', 'devices.type_id', '=', 'types.type_id')
                ->where('devices.device_id', '=', $_POST['device-id'])->get();
            $device = json_decode($device, true);
            return view('coords')->with('device', $device);
        } else {
            return view('home');
        }
    }
}
