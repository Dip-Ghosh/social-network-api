<?php

namespace App\Resource;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;

class ApiResponseResource
{
    /**
     * @param $data
     * @param string $message
     * @param int $status_code
     * @return \Illuminate\Http\JsonResponse
     */
    public function ResponseSuccess($data, string $message = "Successful", int $status_code = JsonResponse::HTTP_OK)
    {
        return response()->json([
            'status' => true,
            'message' => $message,
            'data' => $data
        ], $status_code);
    }

    /**
     * @param $errors
     * @param string $message
     * @param int $status_code
     * @return \Illuminate\Http\JsonResponse
     */
    public  function ResponseError($errors, string $message = 'Data is invalid', int $status_code = JsonResponse::HTTP_BAD_REQUEST)
    {
        return response()->json([
            'status' => false,
            'message' => $message,
            'errors' => $errors
        ], $status_code);
    }


}
