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

        $data['banner'] = json_decode(HelperService::myCurl('/banner-home', $param));
        $data['news'] = json_decode(HelperService::myCurl('/news-home', $param));
        $data['services'] = json_decode(HelperService::myCurl('/services-home', $param));
        $data['projects'] = json_decode(HelperService::myCurl('/projects-home', $param));
        $data['aboutus'] = json_decode(HelperService::myCurl('/aboutus-home', $param));
        $data['others'] = json_decode(HelperService::myCurl('/others-home', $param));
        $data['projects_category'] = json_decode(HelperService::myCurl('/projects-category', $param));

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


    public function newsDetail($value)
    {
        $data = [];
        $data['menu'] = "news";

        $param = [
            "id" => $value
        ];

        $data['news'] = json_decode(HelperService::myCurl('/news-detail', $param));
        return view('Frontend.NewsDetail', $data);
    }
}
