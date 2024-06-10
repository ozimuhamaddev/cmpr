<?php

namespace App\Http\Controllers\Admin;


use App\ElaHelper;
use App\Http\Controllers\Controller;
use Excel;
use Illuminate\Http\Request;
use Session;


class Main extends Controller
{
    public function index(Request $request)
    {
        $data = [];
        $data['menu'] = "login";
        return view('Admin.Login', $data);
    }
}
