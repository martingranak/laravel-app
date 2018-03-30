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

        } else if ($_POST['function'] == 'e-mail') {

        } else if ($_POST['function'] == 'password') {

        }
        return view('account_manager');
    }
}
