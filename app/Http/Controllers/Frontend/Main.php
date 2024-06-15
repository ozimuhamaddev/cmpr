<?php

namespace App\Http\Controllers\Frontend;


use App\Http\Controllers\Controller;
use Excel;
use Illuminate\Http\Request;
use App\Helpers\HelperService;
use Session;


class Main extends Controller
{
    public function index(Request $request)
    {
        $data = [];
        $data['menu'] = "home";
        $param = [
            "token" => session('token')
        ];

        $data['banner-home'] = json_decode(HelperService::myCurl('/banner-home', $param));
        $data['news-home'] = json_decode(HelperService::myCurl('/news-home', $param));
        $data['services-home'] = json_decode(HelperService::myCurl('/services-home', $param));
        $data['projects-home'] = json_decode(HelperService::myCurl('/projects-home', $param));
        $data['aboutus-home'] = json_decode(HelperService::myCurl('/aboutus-home', $param));
        $data['others-home'] = json_decode(HelperService::myCurl('/others-home', $param));
        
        return view('Frontend.Home', $data);
    }

    public function about(Request $request)
    {
        $data = [];
        $data['menu'] = "about";
        return view('Frontend.About', $data);
    }

    public function projects(Request $request)
    {
        $data = [];
        $data['menu'] = "projects";
        return view('Frontend.Projects', $data);
    }

    public function services(Request $request)
    {
        $data = [];
        $data['menu'] = "services";
        return view('Frontend.Services', $data);
    }

    public function news(Request $request)
    {
        $data = [];
        $data['menu'] = "news";
        return view('Frontend.News', $data);
    }

    public function contact(Request $request)
    {
        $data = [];
        $data['menu'] = "contact";
        return view('Frontend.Contact', $data);
    }
}
