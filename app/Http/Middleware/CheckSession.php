<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Helpers\HelperService;


class CheckSession
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Get session token from request
        $sessionToken = session('token');
        // Check if session token exists
        if (!$sessionToken) {
            // return redirect(env('APP_URL') . '/admin-page/logout');
        }
        // Redirect to the desired route if the session exists
        $param = [
            "token" => Session('token')
        ];
        $check = json_decode(HelperService::myCurl('/check-token', $param));

        if ($check->response_code != 200) {
            return redirect(env('APP_URL') . '/admin-page/logout');
        }



        // Optionally, you can refresh session expiry time here if needed

        // Attach session data to request for further use
        // $request->merge(['session_data' => $session]);

        return $next($request);
    }
}
