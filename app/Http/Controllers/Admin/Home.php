<?php

namespace App\Http\Controllers\Admin;


use App\ElaHelper;
use App\Http\Controllers\Controller;
use Excel;
use Illuminate\Http\Request;
use App\Helpers\HelperService;
use Session;


class Home extends Controller
{
    public function index(Request $request)
    {
        $data['menu'] = "home";
        return view('Admin.Page.Home', $data);
    }

    public function listdata(Request $request)
    {
        $sanitizedInput = HelperService::sanitizeInput($request);
        $draw = $sanitizedInput['draw'];
        $start = $sanitizedInput['start'];
        $length = $sanitizedInput['length'];
        $page = ($start == 0) ? 1 : ($start / $length) + 1;
        $urlMenu = '/admin/home';
        $sort_by = $request->post('order')[0]['column'];
        $dir = $request->post('order')[0]['dir'];
        $search = $sanitizedInput['columns'];

        $param = [
            "page" => $page,
            "per_page" => $request->post('length'),
            "search" => $search,
            "sort_by" => $sort_by,
            "dir" => $dir
        ];

        $rows = json_decode(HelperService::myCurlToken($urlMenu, $param));
        $a = $start + 1;
        $employee = [];
        if ($rows) {
            for ($i = 0; $i < count($rows->data); $i++) {
                $nestedData['no'] = $a++;
                $nestedData['menu_name'] = $rows->data[$i]->menu_name;

                if ($rows->data[$i]->link != "") {
                    $nestedData['link'] = '<a href="' . env('APP_URL') . '/admin-page/' . $rows->data[$i]->link . '"  type="button" class="btn btn-primary btn-sm">redirect menu</a>';
                } else {
                    $nestedData['link'] = '<a type="button" class="btn btn-danger btn-sm" dataaction="update" dataid="' . $rows->data[$i]->menu_name . '" onclick="getaction(this)">edit content</a>';
                }
                $menu_access = '';
                if ($rows->data[$i]->active != "Y") {
                    $menu_access .= '
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" dataaction="status" dataid="' . $rows->data[$i]->id . '|Y" onchange="getaction(this)">
                    </div>
                    ';
                } else {
                    $menu_access .= '
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked dataaction="status" dataid="' . $rows->data[$i]->id . '|N" onchange="getaction(this)">
                    </div>
                    ';
                }

                $nestedData['action'] = $menu_access;
                $employee[] = $nestedData;
            }

            $data = array(
                'draw' => $draw,
                'recordsTotal' => $rows->recordsTotal,
                'recordsFiltered' => $rows->recordsTotal,
                'data' => $employee,
            );
        } else {
            $data = array(
                'draw' => $draw,
                'recordsTotal' => 0,
                'recordsFiltered' => 0,
                'data' => $employee,
            );
        }
        echo json_encode($data);
    }

    public function updateStatic(Request $request)
    {
        $data['menu'] = "home";
        $data['title'] = "Update Menu " . ucWords($request->id);
        return view('Admin.Update', $data);
    }

    public function doStatus(Request $request)
    {
        $param = [
            'value' =>  $request->value,
            'id' =>  $request->id,

        ];
        json_decode(HelperService::myCurlToken('/admin/do-status-menu', $param));
        return true;
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
