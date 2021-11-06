<?php

namespace App\Http\Controllers\Api\Follower;

use App\Http\Controllers\Controller;
use App\Http\Resources\ApiResponseResource;
use App\Service\FollowerService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Illuminate\Support\Facades\Route;


class FollowerController extends Controller
{
    protected $responseResource;
    protected $followerService;

    public function __construct(ApiResponseResource $responseResource,FollowerService $followerService)
    {
        $this->responseResource = $responseResource;
        $this->followerService = $followerService;
    }

    public function followPerson(Request $request)
    {
        try{
            $routeName = Route::currentRouteName();
            $data = $this->followerService->getFollowerType($request->personId,$routeName);
            return $this->responseResource->ResponseSuccess($data,"Logged user is following  Another user successfully", Response::HTTP_CREATED);
        }catch (\Exception $e){
            return $this->responseResource->ResponseError(null,$e->getMessage(),Response::HTTP_INTERNAL_SERVER_ERROR);
        }

    }

    public function followPage(Request $request)
    {
        try{
            $routeName = Route::currentRouteName();
            $data = $this->followerService->getFollowerType($request->pageId,$routeName);
            return $this->responseResource->ResponseSuccess($data,"Logged user is following page successfully", Response::HTTP_CREATED);
        }catch (\Exception $e){
            return $this->responseResource->ResponseError(null,$e->getMessage(),Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }




}
