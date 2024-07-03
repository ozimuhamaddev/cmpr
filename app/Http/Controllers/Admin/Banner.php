<?php

namespace App\Http\Controllers\Admin;


use App\ElaHelper;
use App\Http\Controllers\Controller;
use Excel;
use Illuminate\Http\Request;
use App\Helpers\HelperService;
use Session;


class Banner extends Controller
{
    public function index(Request $request)
    {

        $data['menu'] = "banner";
        return view('Admin.Banner.Banner', $data);
    }

    public function listdata(Request $request)
    {
        $sanitizedInput = HelperService::sanitizeInput($request);
        $draw = $sanitizedInput['draw'];
        $start = $sanitizedInput['start'];
        $length = $sanitizedInput['length'];
        $page = ($start == 0) ? 1 : ($start / $length) + 1;
        $urlMenu = '/admin/banner/index-admin';
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
                $nestedData['created_at'] = $rows->data[$i]->created_at;
                $nestedData['image'] = '<img style="width: 150px;" src="' . env('GLOBAL_PLUGIN_PATH') . '/template/images/slider-main/' . $rows->data[$i]->image . '" alt="' . $rows->data[$i]->image_ori . '">';
                $nestedData['sub_title'] = $rows->data[$i]->sub_title;

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
        $data['menu'] = "banner";
        $data['title'] = "Create Banner";
        return view('Admin.Banner.Add', $data);
    }

    public function Edit(Request $request)
    {
        $data['menu'] = "banner";
        $data['title'] = "Edit Banner";
        $data['id'] = $request->id;

        $param = [
            "id" => $request->id
        ];

        $data['banner'] = json_decode(HelperService::myCurlToken('/admin/banner/banner-detail', $param));
        return view('Admin.Banner.Edit', $data);
    }

    public function doAdd(Request $request)
    {
        $file_before =  $request->post('file_before');
        $image = "";
        $image_ori = "";
        if ($request->hasFile('file')) {
            // Check if there is a file to delete
            if ($file_before) {
                $oldFilePath = base_path('public/template/images/slider-main') . '/' . $file_before;
                if (file_exists($oldFilePath)) {
                    unlink($oldFilePath);
                }
            }

            $image_ori = $request->file('file')->getClientOriginalName();
            $extension = $request->file('file')->getClientOriginalExtension();
            $image = date('YmdHis') . '.' . $extension;
            $destinationPath = base_path('public/template/images/slider-main');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }
            $request->file('file')->move($destinationPath, $image);
        }


        $param = [
            'id' => $request->has('id') ? $request->post('id') : "",
            'image' => $image,
            'image_ori' => $image_ori,
            'title' => $request->post('title'),
            'sub_title' => $request->post('sub_title')
        ];

        $rows = json_decode(HelperService::myCurlToken('/admin/banner/do-add', $param));
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

        $rows = json_decode(HelperService::myCurlToken('/admin/banner/do-delete', $param));
        // Make a curl request with the parameters
        // Prepare response data
        $data['response_code'] = $rows->response_code;
        $data['message'] = $rows->message;

        // Return JSON response
        return response()->json($data);
    }
}
