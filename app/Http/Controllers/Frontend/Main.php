<?php

namespace App\Http\Controllers\Frontend;


use App\Http\Controllers\Controller;
use Excel;
use Illuminate\Http\Request;
use App\Helpers\HelperService;
use Session;


class Main extends Controller
{
    public $perPage = 8;
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
        $data['menu'] = json_decode(HelperService::myCurl('/menu', $param));

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
        $param = [
            "token" => session('token')
        ];
        $data['projects'] = json_decode(HelperService::myCurl('/projects', $param));
        $data['projects_category'] = json_decode(HelperService::myCurl('/projects-category', $param));
        return view('Frontend.Projects', $data);
    }

    public function services(Request $request)
    {
        $data = [];
        $data['menu'] = "services";
        $param = [
            "token" => session('token')
        ];

        $data['services'] = json_decode(HelperService::myCurl('/services', $param));
        return view('Frontend.Services', $data);
    }

    public function servicesDetail($value)
    {
        $data = [];
        $data['menu'] = "news";

        $param = [
            "id" => $value
        ];

        $data['services'] = json_decode(HelperService::myCurl('/services-detail', $param));
        return view('Frontend.ServicesDetail', $data);
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
            "per_page" => $request->post('per_page', $this->perPage) // Default to 10 items per page if not provided
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

    public function newsTags($values)
    {
        $data = [];
        $data['menu'] = "news";
        $data['id'] = $values;
        $param = [
            "token" => session('token')
        ];

        $data['category'] = json_decode(HelperService::myCurl('/category-news', $param));
        $data['tags'] = json_decode(HelperService::myCurl('/tags-news', $param));
        return view('Frontend.NewsTags', $data);
    }

    public function newsTagsListdata(Request $request)
    {
        $param = [
            "id" => urldecode($request->post('id')),
            "page" => $request->post('page', 1), // Default to page 1 if not provided
            "per_page" => $request->post('per_page', $this->perPage) // Default to 10 items per page if not provided
        ];

        $data = json_decode(HelperService::myCurl('/news-tags', $param));
        return response()->json($data);
    }

    public function newsCategory($values)
    {
        $data = [];
        $data['menu'] = "news";

        $data['id'] = $values;
        $param = [
            "token" => session('token')
        ];

        $data['category'] = json_decode(HelperService::myCurl('/category-news', $param));
        $data['tags'] = json_decode(HelperService::myCurl('/tags-news', $param));
        return view('Frontend.NewsCategory', $data);
    }

    public function newsCategoryListData(Request $request)
    {
        $param = [
            "id" => $request->post('id'),
            "page" => $request->post('page', 1), // Default to page 1 if not provided
            "per_page" => $request->post('per_page', $this->perPage) // Default to 10 items per page if not provided
        ];

        $data = json_decode(HelperService::myCurl('/news-category', $param));
        return response()->json($data);
    }

    public function getNavigatorData(Request $request)
    {
        $param = [
            "token" => session('token')
        ];

        $menuResponse = json_decode(HelperService::myCurl('/menu', $param), true);

        // Initialize segments
        $segments = [
            'home' => '',
            'about' => '',
            'projects' => '',
            'services' => '',
            'news' => '',
            'contact' => '',
        ];

        // Check if the first segment is empty, set 'home' as active
        if ($request->segment(1) == "" || $request->segment(1) == null) {
            $segments['home'] = 'active';
        } else if (array_key_exists($request->segment(1), $segments)) {
            $segments[$request->segment(1)] = 'active';
        }

        // Default data array
        $data = [
            ['active' => $segments['home'], 'name' => 'Home', 'url' => env('APP_URL')],
        ];

        // Check if additional menu items should be added
        foreach ($menuResponse['data'] as $menuItem) {
            switch ($menuItem['menu_id']) {
                case 13:
                    if ($menuItem['active'] == 'Y') {
                        $data[] = ['active' => $segments['services'], 'name' => 'Services', 'url' => env('APP_URL') . '/services'];
                    }
                    break;

                case 12:
                    if ($menuItem['active'] == 'Y') {
                        $data[] = ['active' => $segments['projects'], 'name' => 'Projects', 'url' => env('APP_URL') . '/projects'];
                    }
                    break;

                case 11:
                    if ($menuItem['active'] == 'Y') {
                        $data[] = ['active' => $segments['news'], 'name' => 'News', 'url' => env('APP_URL') . '/news'];
                    }
                    break;

                case 10:
                    if ($menuItem['active'] == 'Y') {
                        $data[] = ['active' => $segments['contact'], 'name' => 'Contact', 'url' => env('APP_URL') . '/contact'];
                    }
                    break;

                case 8:
                    if ($menuItem['active'] == 'Y') {
                        $data[] = ['active' => $segments['about'], 'name' => 'About Us', 'url' => env('APP_URL') . '/about'];
                    }
                    break;
            }
        }

        return $data;
    }


    public function getFooterData(Request $request)
    {
        $data = [];
        $param = [
            "token" => session('token')
        ];

        $data['menu'] = json_decode(HelperService::myCurl('/menu', $param));
        $data['services'] = json_decode(HelperService::myCurl('/services-home', $param));
        $data['aboutus'] = json_decode(HelperService::myCurl('/aboutus-home', $param));
        $data['others'] = json_decode(HelperService::myCurl('/others-home', $param));

        return $data;
    }
}
