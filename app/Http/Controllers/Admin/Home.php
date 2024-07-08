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
                    if (in_array($rows->data[$i]->menu_name, ['icon top', 'icon bottom'])) {
                        $nestedData['link'] = '<a type="button" class="btn btn-danger btn-sm" dataaction="updateImage" dataid="' . $rows->data[$i]->id . '|' . $rows->data[$i]->menu_name . '" onclick="getaction(this)">edit content</a>';
                    } else {
                        $nestedData['link'] = '<a type="button" class="btn btn-danger btn-sm" dataaction="update" dataid="' . $rows->data[$i]->id . '|' . $rows->data[$i]->menu_name . '" onclick="getaction(this)">edit content</a>';
                    }
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
        $data['title'] = "Update " . ucWords($request->menu_name);
        $data['id'] = $request->id;

        $param = [
            'id' =>  $request->id,
        ];

        $data['data'] =  json_decode(HelperService::myCurlToken('/admin/static', $param));

        return view('Admin.Form.Text', $data);
    }

    public function updateImage(Request $request)
    {
        $data['menu'] = "home";
        $data['title'] = "Update " . ucWords($request->menu_name);
        $data['id'] = $request->id;

        $param = [
            'id' =>  $request->id,
        ];

        $data['data'] =  json_decode(HelperService::myCurlToken('/admin/static', $param));

        return view('Admin.Form.Image', $data);
    }

    public function doAddStatic(Request $request)
    {
        $param = [
            'description' =>  $request->post('description'),
            'id' =>  $request->post('id'),
        ];
        $rows =  json_decode(HelperService::myCurlToken('/admin/do-add-static', $param));

        $data['response_code'] = $rows->response_code;
        $data['message'] = $rows->message;
        return json_encode($data);
    }

    public function doAddStaticImage(Request $request)
    {
        $file_before =  $request->post('file_before');
        $image = "";
        $image_ori = "";
        if ($request->hasFile('file')) {
            // Check if there is a file to delete
            if ($file_before) {
                $oldFilePath = base_path('public/template/images') . '/' . $file_before;
                if (file_exists($oldFilePath)) {
                    unlink($oldFilePath);
                }
            }

            $image_ori = $request->file('file')->getClientOriginalName();
            $extension = $request->file('file')->getClientOriginalExtension();
            $image = date('YmdHis') . '.' . $extension;
            $destinationPath = base_path('public/template/images');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }
            $request->file('file')->move($destinationPath, $image);
        }


        $param = [
            'id' => $request->has('id') ? $request->post('id') : "",
            'image' => $image,
            'image_ori' => $image_ori
        ];

        $rows = json_decode(HelperService::myCurlToken('/admin/do-add-static-image', $param));
        // Make a curl request with the parameters
        // Prepare response data
        $data['response_code'] = $rows->response_code;
        $data['message'] = $rows->message;

        // Return JSON response
        return response()->json($data);
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

    public function uploadImage(Request $request)
    {
        if ($request->hasFile('file')) {
            try {
                $file = $request->file('file');
                $fileName = 'upload_' . time() . '.' . $file->getClientOriginalExtension();

                // Simpan gambar ke direktori public/uploads
                $file->storeAs('public/uploads', $fileName);

                // URL gambar yang dapat diakses publik
                $imageUrl = asset('storage/uploads/' . $fileName);

                return response()->json(['imageUrl' => $imageUrl]);
            } catch (\Exception $e) {
                return response()->json(['error' => 'Failed to upload image'], 500);
            }
        }

        return response()->json(['error' => 'No file uploaded'], 400);
    }

    public function listdataIcon(Request $request)
    {
        $sanitizedInput = HelperService::sanitizeInput($request);
        $draw = $sanitizedInput['draw'];
        $start = $sanitizedInput['start'];
        $length = $sanitizedInput['length'];
        $page = ($start == 0) ? 1 : ($start / $length) + 1;
        $urlMenu = '/admin/icon/index-admin';
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
                $nestedData['icon_name'] = $rows->data[$i]->icon_name;
                $nestedData['icon_image'] = '<img style="width: 50px;" src="' . env('GLOBAL_PLUGIN_PATH') . '/template/images/icon-image/' . $rows->data[$i]->icon_image . '" alt="' . $rows->data[$i]->icon_image_ori . '">';
                $menu_access = '';
                $menu_access .= '<a class="btn btn-warning" style="margin-right:5px" dataaction="editIcon" dataid="' . $rows->data[$i]->id . '" onclick="getaction(this)"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>';

                $menu_access .= '<a class="btn btn-danger"style="margin-right:5px" dataaction="deleteIcon"  dataid="' . $rows->data[$i]->id . '" onclick="getaction(this)"><i class="fa fa-trash" aria-hidden="true"></i></a>';
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

    public function AddIcon(Request $request)
    {
        $data['menu'] = "icon";
        $data['title'] = "Create Icon";
        return view('Admin.Page.AddIcon', $data);
    }

    public function EditIcon(Request $request)
    {
        $data['menu'] = "Icon";
        $data['title'] = "Edit Icon";
        $data['id'] = $request->id;

        $param = [
            "id" => $request->id
        ];

        $data['icon'] = json_decode(HelperService::myCurlToken('/admin/icon/master-icon-detail', $param));
        return view('Admin.Page.EditIcon', $data);
    }

    public function doAddIcon(Request $request)
    {
        $file_before =  $request->post('file_before');
        $icon = "";
        $icon_ori = "";
        if ($request->hasFile('file')) {
            // Check if there is a file to delete
            if ($file_before) {
                $oldFilePath = base_path('public/template/images/icon-image') . '/' . $file_before;
                if (file_exists($oldFilePath)) {
                    unlink($oldFilePath);
                }
            }

            $icon_ori = $request->file('file')->getClientOriginalName();
            $extension = $request->file('file')->getClientOriginalExtension();
            $icon = date('YmdHis') . '.' . $extension;
            $destinationPath = base_path('public/template/images/icon-image');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }
            $request->file('file')->move($destinationPath, $icon);
        }

        $param = [
            'id' => $request->has('id') ? $request->post('id') : "",
            'icon_name' => $request->post('icon_name'),
            'icon_image' => $icon,
            'icon_image_ori' => $icon_ori
        ];

        $rows = json_decode(HelperService::myCurlToken('/admin/icon/do-add', $param));
        // Make a curl request with the parameters
        // Prepare response data
        $data['response_code'] = $rows->response_code;
        $data['message'] = $rows->message;

        // Return JSON response
        return response()->json($data);
    }

    public function doDeleteIcon(Request $request)
    {
        $param = [
            'id' => $request->has('id') ? $request->post('id') : ""
        ];

        $rows = json_decode(HelperService::myCurlToken('/admin/icon/do-delete', $param));
        // Make a curl request with the parameters
        // Prepare response data
        $data['response_code'] = $rows->response_code;
        $data['message'] = $rows->message;

        // Return JSON response
        return response()->json($data);
    }
}
