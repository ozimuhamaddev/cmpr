<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\HelperService;
use Illuminate\Support\Facades\Storage;
use Exception;

class About extends Controller
{
    public function index(Request $request)
    {
        $data['menu'] = "about";
        $param = [
            "token" => session('token')
        ];
        $data['aboutus'] = json_decode(HelperService::myCurl('/aboutus-home', $param));
        return view('Admin.About.About', $data);
    }

    public function doAdd(Request $request)
    {

        $file_before =  $request->post('file_before');
        $image = "";
        $image_ori = "";
        if ($request->hasFile('file')) {
            // Check if there is a file to delete
            if ($file_before) {
                $oldFilePath = base_path('public/template/images/slider-pages') . '/' . $file_before;
                if (file_exists($oldFilePath)) {
                    unlink($oldFilePath);
                }
            }

            $image_ori = $request->file('file')->getClientOriginalName();
            $extension = $request->file('file')->getClientOriginalExtension();
            $image = date('YmdHis') . '.' . $extension;
            $destinationPath = base_path('public/template/images/slider-pages');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }
            $request->file('file')->move($destinationPath, $image);
        }

        $param = [
            'image' => $image,
            'image_ori' => $image_ori,
            'short_description' => $request->post('short_description'),
            'description' => $request->post('description'),
        ];
        // Make a curl request with the parameters
        $rows = json_decode(HelperService::myCurlToken('/admin/about/do-update', $param));

        // Prepare response data
        $data['response_code'] = $rows->response_code;
        $data['message'] = $rows->message;

        // Return JSON response
        return response()->json($data);
    }
}
