<?php

namespace App\Http\Controllers\Api\Post;

use App\Http\Controllers\Controller;
use App\Http\Resources\ApiResponseResource;
use App\Service\PostPublishService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class PostController extends Controller
{

    private $postPublishService;

    public function __construct( PostPublishService $postPublishService)
    {
        $this->postPublishService = $postPublishService;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function postPublishedByPerson(Request $request)
    {
        try{
            $routeName = Route::currentRouteName();
            $data = $this->postPublishService->publishPost($request->all(),$routeName);
            return $this->responseResource->ResponseSuccess($data,"Post Published By Person successfully", ResponseAlias::HTTP_OK);

        }catch (\Exception $e){
            return $this->responseResource->ResponseError(null,$e->getMessage(), ResponseAlias::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @param Request $request
     * @param $pageId
     * @return \Illuminate\Http\JsonResponse
     */
    public function postPublishedByPersonFromPage(Request $request,$pageId)
    {
        try{
            $routeName = Route::currentRouteName();
            $request['pageId'] =$pageId;
            $data = $this->postPublishService->publishPost($request->all(),$routeName);
            return $this->ResponseSuccess($data,"Page created successfully", ResponseAlias::HTTP_CREATED);

        }catch (\Exception $e){
            return $this->ResponseError(null,$e->getMessage(), ResponseAlias::HTTP_INTERNAL_SERVER_ERROR);
        }
    }



}
