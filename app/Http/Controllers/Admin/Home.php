<?php

namespace App\Http\Controllers\Admin;


use App\ElaHelper;
use App\Http\Controllers\Controller;
use Excel;
use Illuminate\Http\Request;
use Session;


class Home extends Controller
{
    public function index(Request $request)
    {
        $data = [];
        $data['menu'] = "home";
        return view('Admin.Page.Home', $data);
    }

    public function about(Request $request)
    {
        $data = [];
        $data['menu'] = "about";
        return view('Admin.Page.About', $data);
    }

    public function projects(Request $request)
    {
        $data = [];
        $data['menu'] = "projects";
        return view('Admin.Page.Projects', $data);
    }

    public function services(Request $request)
    {
        $data = [];
        $data['menu'] = "services";
        return view('Admin.Page.Services', $data);
    }

    public function news(Request $request)
    {
        $data = [];
        $data['menu'] = "news";
        return view('Admin.Page.News', $data);
    }

    public function contact(Request $request)
    {
        $data = [];
        $data['menu'] = "contact";
        return view('Admin.Page.Contact', $data);
    }
}
