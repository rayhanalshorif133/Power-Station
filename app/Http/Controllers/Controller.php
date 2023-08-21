<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Session;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    // web
    protected function respondWithSuccessWeb($message, $route = null)
    {
        Session::flash('message', $message);
        Session::flash('class', 'success');
        if ($route == null) {
            return redirect()->back()->withInput();
        } else {
            return $route;
        }
    }
    protected function respondWithErrorWeb($message, $route = null, $class = 'danger')
    {
        Session::flash('message', $message);
        Session::flash('class', $class);
        if ($route == null) {
            return redirect()->back()->withInput();
        } else {
            return $route;
        }
    }


    // For API
    protected function respondWithSuccess($message = '', $data = [], $code = 200)
    {
        return response()->json([
            'status'   => true,
            'errors'  => false,
            'message'  => $message,
            'data'     => $data
        ], $code);
    }
    protected function respondWithError($message, $data = [], $code = 203)
    {
        return response()->json([
            'status'   => false,
            'errors'  => true,
            'message'  => $message,
            'data'     => $data
        ], $code);
    }

    protected function getRandomBadge()
    {
        $badges = [
            "primary",
            "secondary",
            "success",
            "danger",
            "warning",
            "info",
        ];
        return $badges[rand(0, count($badges) - 1)];
    }
}
