<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Response;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Return success response in JSON format.
     *
     * @param  mixed  $data
     * @return \Illuminate\Http\JsonResponse
     */
    public function success(mixed $data = null)
    {
        return Response::json([
            'status' => 'OK',
            'data' => $data
        ]);
    }

    /**
     * Return fail response in JSON format.
     *
     * @param  string  $msg
     * @return \Illuminate\Http\JsonResponse
     */
    public function fail(string $msg, int $status = 500)
    {
        return Response::json([
            'status' => 'FAIL',
            'message' => $msg
        ], $status);
    }
}
