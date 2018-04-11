<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class accountManagerController extends Controller
{
    public function index()
    {
        return view('account_manager');
    }

    public function edit()
    {
        if ($_POST['function'] == 'name') {
            \DB::table('users')->where('id', '=', $_POST['user-id'])->update(['name' => $_POST['user-text']]);
        } else if ($_POST['function'] == 'mail') {
            \DB::table('users')->where('id', '=', $_POST['user-id'])->update(['email' => $_POST['user-text']]);
        } else if ($_POST['function'] == 'pass') {
            \DB::table('users')->where('id', '=', $_POST['user-id'])->update(['password' => $_POST['user-text']]);
        }
        return view('account_manager');
    }
}
