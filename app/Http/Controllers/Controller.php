<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @param $data
     * @param string $message
     * @param int $status_code
     * @return \Illuminate\Http\JsonResponse
     */
    public function ResponseSuccess($data, $message = "Successful", $status_code = JsonResponse::HTTP_OK)
    {
        return response()->json([
            'status' => true,
            'message' => $message,
            'data' => $data
        ],$status_code);
    }

    /**
     * @param $errors
     * @param string $message
     * @param int $status_code
     * @return \Illuminate\Http\JsonResponse
     */
    public  function ResponseError($errors, $message = 'Data is invalid', $status_code = JsonResponse::HTTP_BAD_REQUEST)
    {
        return response()->json([
            'status' => false,
            'message' => $message,
            'errors' => $errors
        ],$status_code);
    }

}
