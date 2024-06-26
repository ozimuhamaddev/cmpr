<?php

namespace App\Http\Controllers\Admin;


use App\ElaHelper;
use App\Http\Controllers\Controller;
use Excel;
use Illuminate\Http\Request;
use App\Helpers\HelperService;
use Illuminate\Support\Facades\Session;



class AuthController extends Controller
{
    public function index(Request $request)
    {
        $data = [];
        $data['menu'] = "login";
        // Check if the user session exists
        if (session()->has('token')) {
            // Redirect to the desired route if the session exists
            $param = [
                "token" => Session('token')
            ];
            $check = json_decode(HelperService::myCurl('/check-token', $param));
            if ($check->response_code != 200) {
                return redirect(env('APP_URL') . '/admin-page/logout');
            } else {
                return redirect(env('APP_URL') . '/admin-page/home');
            }
        }

        return view('Admin.Login', $data);
    }

    public function DoLogin(Request $request)
    {
        $param = [
            "cek_username" => $request->username,
            "cek_password" => $request->password
        ];

        $news = json_decode(HelperService::myCurl('/login', $param));

        if ($news->response_code == 200) {
            // Assuming the response contains user data in `data` key
            $userData = $news->data;

            // Create session
            session([
                'token' => $userData->token
                // Add other necessary user data here
            ]);

            // You can also use the Auth facade if you are using Laravel's authentication system
            // Auth::loginUsingId($userData->id);
            // Optionally, you can return a custom response if needed
            return $news;
        }

        // Return the original response if the response code is not 200
        return $news;
    }

    public function Logout(Request $request)
    {
        // Ambil token dari header Authorization
        $token = Session('token');
        // Kirim request logout ke service menggunakan token yang ada
        $param = [
            'token' => $token // Kirim token yang diperoleh dari header Authorization
        ];
        json_decode(HelperService::myCurl('/logout', $param));
        // Hapus semua data sesi Laravel setelah logout
        $request->session()->flush();
        // Jangan lakukan Session::flush() karena token JWT tidak disimpan di session Laravel

        // Redirect ke halaman admin-page atau halaman lain setelah logout
        return redirect(env('APP_URL') . '/admin-page');
    }
}
