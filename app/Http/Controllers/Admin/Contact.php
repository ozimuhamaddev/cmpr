<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\HelperService;
use Illuminate\Support\Facades\Storage;
use Exception;

class Contact extends Controller
{
    public function index(Request $request)
    {
        $data['menu'] = "contact";
        $param = [
            "token" => session('token')
        ];
        $data['contact'] = json_decode(HelperService::myCurl('/contact', $param));
        return view('Admin.Contact.Contact', $data);
    }

    public function doAdd(Request $request)
    {
        $param = [
            'title' => $request->post('title'),
            'sub_title' => $request->post('sub_title'),
            'address' => $request->post('address'),
            'email' => $request->post('email'),
            'phone' => $request->post('phone'),
            'lat' => $request->post('lat'),
            'long' => $request->post('long'),
        ];
        // Make a curl request with the parameters
        $rows = json_decode(HelperService::myCurlToken('/admin/contact/do-update', $param));

        // Prepare response data
        $data['response_code'] = $rows->response_code;
        $data['message'] = $rows->message;

        // Return JSON response
        return response()->json($data);
    }
}
