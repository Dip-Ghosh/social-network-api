<?php

namespace App\Http\Controllers\Api\Follower;

use App\Http\Controllers\Controller;
use App\Http\Resources\ApiResponseResource;
use App\Service\FollowerService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;


class FollowerController extends Controller
{

    private $followerService;

    public function __construct(FollowerService $followerService)
    {
        $this->followerService = $followerService;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @param person_id
     */
    public function followPerson(Request $request)
    {
        try{
            $routeName = Route::currentRouteName();
            $data = $this->followerService->getFollowerType($request->personId,$routeName);
            return $this->ResponseSuccess($data,"Logged user is following  Another user successfully", ResponseAlias::HTTP_CREATED);
        }catch (\Exception $e){
            return $this->ResponseError(null,$e->getMessage(), ResponseAlias::HTTP_INTERNAL_SERVER_ERROR);
        }

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @param page_id
     */
    public function followPage(Request $request)
    {
        try{
            $routeName = Route::currentRouteName();
            $data = $this->followerService->getFollowerType($request->pageId,$routeName);
            return $this->ResponseSuccess($data,"Logged user is following page successfully", ResponseAlias::HTTP_CREATED);
        }catch (\Exception $e){
            return $this->ResponseError(null,$e->getMessage(), ResponseAlias::HTTP_INTERNAL_SERVER_ERROR);
        }
    }




}
