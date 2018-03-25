<?php

namespace App\Http\Controllers;

use App\Device;
use Illuminate\Http\Request;

class devManagerController extends Controller
{
    public function index()
    {
        $devices = Device::all();
        return view('dev_manager')->with('devices', $devices);
    }

    public function show($function)
    {
        $devices = null;
        if (\Auth::check()) {
            switch ($function) {
                case 'all':
                    $devices = \DB::table('devices')->select('devices.device_id', 'devices.name as device_name', 'types.picture',
                    'types.name as type_name', 'devices.type_id', \DB::raw('DATE_FORMAT(devices.created_at, "%d. %m. %Y") as created_at'),
                    \DB::raw('DATE_FORMAT(devices.updated_at, "%d. %m. %Y") as updated_at'))->join('types', 'devices.type_id', '=', 'types.type_id')
                    ->where('devices.user_id', '=', \Auth::user()->id)->get();
                    break;
                case 'mobiles':
                    $devices = \DB::table('devices')->select('devices.device_id', 'devices.name as device_name', 'types.picture',
                        'types.name as type_name', 'devices.type_id', \DB::raw('DATE_FORMAT(devices.created_at, "%d. %m. %Y") as created_at'),
                        \DB::raw('DATE_FORMAT(devices.updated_at, "%d. %m. %Y") as updated_at'))->join('types', 'devices.type_id', '=', 'types.type_id')
                        ->where([['devices.type_id', '=', 1], ['devices.user_id', '=', \Auth::user()->id]])->get();
                    break;
                case 'laptops':
                    $devices = \DB::table('devices')->select('devices.device_id', 'devices.name as device_name', 'types.picture',
                        'types.name as type_name', 'devices.type_id', \DB::raw('DATE_FORMAT(devices.created_at, "%d. %m. %Y") as created_at'),
                        \DB::raw('DATE_FORMAT(devices.updated_at, "%d. %m. %Y") as updated_at'))->join('types', 'devices.type_id', '=', 'types.type_id')
                        ->where([['devices.type_id', '=', 2], ['devices.user_id', '=', \Auth::user()->id]])->get();
                    break;
                case 'tablets':
                    $devices = \DB::table('devices')->select('devices.device_id', 'devices.name as device_name', 'types.picture',
                        'types.name as type_name', 'devices.type_id', \DB::raw('DATE_FORMAT(devices.created_at, "%d. %m. %Y") as created_at'),
                        \DB::raw('DATE_FORMAT(devices.updated_at, "%d. %m. %Y") as updated_at'))->join('types', 'devices.type_id', '=', 'types.type_id')
                        ->where([['devices.type_id', '=', 3], ['devices.user_id', '=', \Auth::user()->id]])->get();
                    break;
                case 'others':
                    $devices = \DB::table('devices')->select('devices.device_id', 'devices.name as device_name', 'types.picture',
                        'types.name as type_name', 'devices.type_id', \DB::raw('DATE_FORMAT(devices.created_at, "%d. %m. %Y") as created_at'),
                        \DB::raw('DATE_FORMAT(devices.updated_at, "%d. %m. %Y") as updated_at'))->join('types', 'devices.type_id', '=', 'types.type_id')
                        ->where([['devices.type_id', '=', 4], ['devices.user_id', '=', \Auth::user()->id]])->get();
                    break;
            }
        }
        return view('dev_manager')->with('devices', $devices);
    }
}
