<?php

namespace App\Http\Controllers\Api\Post;

use App\Http\Controllers\Controller;
use App\Http\Resources\ApiResponseResource;
use App\Service\PostPublishService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;

class PostController extends Controller
{

    private $postPublishService;
    private $responseResource;

    public function __construct( PostPublishService $postPublishService,ApiResponseResource $responseResource )
    {
        $this->postPublishService = $postPublishService;
        $this->responseResource   = $responseResource;
    }


    public function postPublishedByPerson(Request $request)
    {
        try{
            $routeName = Route::currentRouteName();
            $data = $this->postPublishService->publishPost($request->all(),$routeName);
            return $this->responseResource->ResponseSuccess($data,"Post Published By Person successfully",Response::HTTP_OK);

        }catch (\Exception $e){
            return $this->responseResource->ResponseError(null,$e->getMessage(),Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }


    public function postPublishedByPersonFromPage(Request $request,$pageId)
    {
        try{
            $routeName = Route::currentRouteName();
            $request['pageId'] =$pageId;
            $data = $this->postPublishService->publishPost($request->all(),$routeName);
            return $this->responseResource->ResponseSuccess($data,"Page created successfully",Response::HTTP_CREATED);

        }catch (\Exception $e){
            return $this->responseResource->ResponseError(null,$e->getMessage(),Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }



}
