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

        $param = [
            "token" => session('token')
        ];

        $data['aboutus'] = json_decode(HelperService::myCurl('/aboutus', $param));
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
        $param = [
            "id" => $request->has('id') ? $request->get('id') : ""
        ];

        $data['sevices'] = json_decode(HelperService::myCurl('/news-detail', $param));
        return view('Frontend.Services', $data);
    }

    public function news(Request $request)
    {
        $data = [];
        $data['menu'] = "news";
        $param = [
            "token" => session('token')
        ];

        $data['category'] = json_decode(HelperService::myCurl('/category-news', $param));
        $data['tags'] = json_decode(HelperService::myCurl('/tags-news', $param));
        return view('Frontend.News', $data);
    }


    public function newsListData(Request $request)
    {
        $param = [
            "page" => $request->post('page', 1), // Default to page 1 if not provided
            "per_page" => $request->post('per_page', 2) // Default to 10 items per page if not provided
        ];

        $data = json_decode(HelperService::myCurl('/news', $param));
        return response()->json($data);
    }

    public function contact(Request $request)
    {
        $data = [];
        $data['menu'] = "contact";
        $param = [
            "token" => session('token')
        ];

        $data['contact'] = json_decode(HelperService::myCurl('/contact', $param));
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
