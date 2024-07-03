<?php

namespace App\Http\Controllers\Admin;


use App\ElaHelper;
use App\Http\Controllers\Controller;
use Excel;
use Illuminate\Http\Request;
use App\Helpers\HelperService;
use Session;


class WeDo extends Controller
{
    public function index(Request $request)
    {

        $data['menu'] = "wedo";
        return view('Admin.WeDo.WeDo', $data);
    }

    public function listdata(Request $request)
    {
        $sanitizedInput = HelperService::sanitizeInput($request);
        $draw = $sanitizedInput['draw'];
        $start = $sanitizedInput['start'];
        $length = $sanitizedInput['length'];
        $page = ($start == 0) ? 1 : ($start / $length) + 1;
        $urlMenu = '/admin/wedo/index-admin';
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
                $nestedData['title'] = $rows->data[$i]->title;
                $nestedData['icon_image'] = '<img src="' . env('GLOBAL_PLUGIN_PATH') . '/template/images/icon-image/' . $rows->data[$i]->icon_image . '" alt="default.png">';
                $nestedData['created_at'] = $rows->data[$i]->created_at;
                $nestedData['updated_at'] = $rows->data[$i]->updated_at;

                $menu_access = '';
                $menu_access .= '<a class="btn btn-warning" style="margin-right:5px" dataaction="edit" dataid="' . $rows->data[$i]->id . '" onclick="getaction(this)"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>';

                $menu_access .= '<a class="btn btn-danger"style="margin-right:5px" dataaction="delete"  dataid="' . $rows->data[$i]->id . '" onclick="getaction(this)"><i class="fa fa-trash" aria-hidden="true"></i></a>';
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

    public function Add(Request $request)
    {
        $data['menu'] = "wedo";
        $data['title'] = "Create WeDo";
        $param = [
            "token" => session('token')
        ];

        $data['icon'] = json_decode(HelperService::myCurl('/icon', $param));
        return view('Admin.WeDo.Add', $data);
    }

    public function Edit(Request $request)
    {
        $data['menu'] = "wedo";
        $data['title'] = "Edit WeDo";
        $data['id'] = $request->id;

        $param = [
            "id" => $request->id
        ];

        $data['wedo'] = json_decode(HelperService::myCurlToken('/admin/wedo/wedo-detail', $param));

        $param = [
            "token" => session('token')
        ];

        $data['icon'] = json_decode(HelperService::myCurl('/icon', $param));
        return view('Admin.WeDo.Edit', $data);
    }

    public function doAdd(Request $request)
    {

        $param = [
            'id' => $request->has('id') ? $request->post('id') : "",
            'title' => $request->post('title'),
            'icon_id' => $request->post('icon_id')
        ];

        $rows = json_decode(HelperService::myCurlToken('/admin/wedo/do-add', $param));
        // Make a curl request with the parameters
        // Prepare response data
        $data['response_code'] = $rows->response_code;
        $data['message'] = $rows->message;

        // Return JSON response
        return response()->json($data);
    }


    public function doDelete(Request $request)
    {
        $param = [
            'id' => $request->has('id') ? $request->post('id') : ""
        ];

        $rows = json_decode(HelperService::myCurlToken('/admin/wedo/do-delete', $param));
        // Make a curl request with the parameters
        // Prepare response data
        $data['response_code'] = $rows->response_code;
        $data['message'] = $rows->message;

        // Return JSON response
        return response()->json($data);
    }
}
