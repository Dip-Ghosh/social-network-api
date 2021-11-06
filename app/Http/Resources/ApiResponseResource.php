<?php

namespace App\Http\Resources;

use Illuminate\Http\JsonResponse;


class ApiResponseResource
{
    /**
     * @param $data
     * @param string $message
     * @param int $status_code
     * @return \Illuminate\Http\JsonResponse
     */
    public function ResponseSuccess($data, $message = "Successful", $status_code = JsonResponse::HTTP_OK)
    {
        return response()->json([
            'code' => $status_code,
            'status' => true,
            'message' => $message,
            'data' => $data
        ]);
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
            'code' => $status_code,
            'status' => false,
            'message' => $message,
            'errors' => $errors
        ]);
    }


}
