<?php

namespace App\Http\Controllers\Admin;


use App\ElaHelper;
use App\Http\Controllers\Controller;
use Excel;
use Illuminate\Http\Request;
use App\Helpers\HelperService;
use Session;


class News extends Controller
{
    public function index(Request $request)
    {

        $data['menu'] = "news";
        return view('Admin.News.News', $data);
    }

    public function listdata(Request $request)
    {
        $sanitizedInput = HelperService::sanitizeInput($request);
        $draw = $sanitizedInput['draw'];
        $start = $sanitizedInput['start'];
        $length = $sanitizedInput['length'];
        $page = ($start == 0) ? 1 : ($start / $length) + 1;
        $urlMenu = '/admin/news/index-admin';
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
                $nestedData['short_description'] = $rows->data[$i]->short_description;
                $nestedData['category_name'] = $rows->data[$i]->category_name;
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
        $data['menu'] = "news";
        $data['title'] = "Create News";

        $param = [
            "token" => session('token')
        ];

        $data['category'] = json_decode(HelperService::myCurl('/category-news', $param));
        $data['tags'] = json_decode(HelperService::myCurl('/tags-news', $param));
        return view('Admin.News.Add', $data);
    }

    public function Edit(Request $request)
    {
        $data['menu'] = "news";
        $data['title'] = "Edit News";
        $data['id'] = $request->id;


        $param = [
            "id" => $request->id
        ];

        $data['news'] = json_decode(HelperService::myCurl('/news-detail', $param));
        $param = [
            "token" => session('token')
        ];

        $data['category'] = json_decode(HelperService::myCurl('/category-news', $param));
        $data['tags'] = json_decode(HelperService::myCurl('/tags-news', $param));
        return view('Admin.News.Edit', $data);
    }

    public function doAdd(Request $request)
    {
        $file_before =  $request->post('file_before');
        $image = "";
        $image_ori = "";
        if ($request->hasFile('file')) {
            // Check if there is a file to delete
            if ($file_before) {
                $oldFilePath = base_path('public/template/images/news') . '/' . $file_before;
                if (file_exists($oldFilePath)) {
                    unlink($oldFilePath);
                }
            }

            $image_ori = $request->file('file')->getClientOriginalName();
            $extension = $request->file('file')->getClientOriginalExtension();
            $image = date('YmdHis') . '.' . $extension;
            $destinationPath = base_path('public/template/images/news');
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
            'category_id' => $request->post('category_id'),
            'tag' => $request->post('tag'),
            'short_description' => $request->post('short_description'),
            'description' => $request->post('description')
        ];

        $rows = json_decode(HelperService::myCurlToken('/admin/news/do-add', $param));
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

        $rows = json_decode(HelperService::myCurlToken('/admin/news/do-delete', $param));
        // Make a curl request with the parameters
        // Prepare response data
        $data['response_code'] = $rows->response_code;
        $data['message'] = $rows->message;

        // Return JSON response
        return response()->json($data);
    }

    public function listdataCategory(Request $request)
    {
        $sanitizedInput = HelperService::sanitizeInput($request);
        $draw = $sanitizedInput['draw'];
        $start = $sanitizedInput['start'];
        $length = $sanitizedInput['length'];
        $page = ($start == 0) ? 1 : ($start / $length) + 1;
        $urlMenu = '/admin/news/index-category';
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
                $nestedData['category_name'] = $rows->data[$i]->category_name;
                $menu_access = '';
                $menu_access .= '<a class="btn btn-warning" style="margin-right:5px" dataaction="editCategory" dataid="' . $rows->data[$i]->id . '" onclick="getaction(this)"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>';

                $menu_access .= '<a class="btn btn-danger"style="margin-right:5px" dataaction="deleteCategory"  dataid="' . $rows->data[$i]->id . '" onclick="getaction(this)"><i class="fa fa-trash" aria-hidden="true"></i></a>';
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

    public function AddCategory(Request $request)
    {
        $data['menu'] = "news";
        $data['title'] = "Create News";
        return view('Admin.News.AddCategory', $data);
    }

    public function EditCategory(Request $request)
    {
        $data['menu'] = "category";
        $data['title'] = "Edit Category";
        $data['id'] = $request->id;

        $param = [
            "id" => $request->id
        ];

        $data['category'] = json_decode(HelperService::myCurlToken('/admin/news/master-category-detail', $param));
        return view('Admin.News.EditCategory', $data);
    }

    public function doAddCategory(Request $request)
    {

        $param = [
            'id' => $request->has('id') ? $request->post('id') : "",
            'category_name' => $request->post('category_name')
        ];

        $rows = json_decode(HelperService::myCurlToken('/admin/news/do-add-category', $param));
        // Make a curl request with the parameters
        // Prepare response data
        $data['response_code'] = $rows->response_code;
        $data['message'] = $rows->message;

        // Return JSON response
        return response()->json($data);
    }

    public function doDeleteCategory(Request $request)
    {
        $param = [
            'id' => $request->has('id') ? $request->post('id') : ""
        ];

        $rows = json_decode(HelperService::myCurlToken('/admin/news/do-delete-category', $param));
        // Make a curl request with the parameters
        // Prepare response data
        $data['response_code'] = $rows->response_code;
        $data['message'] = $rows->message;

        // Return JSON response
        return response()->json($data);
    }
}
