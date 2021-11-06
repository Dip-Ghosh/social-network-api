<?php

namespace App\Http\Controllers\Api\Page;

use App\Http\Controllers\Controller;
use App\Http\Requests\PageValidationRequest;
use App\Http\Resources\ApiResponseResource;
use App\Repository\PageInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PageController extends Controller
{
    protected $page;
    protected $responseResource;

    public function __construct(PageInterface $page,ApiResponseResource $responseResource)
    {
        $this->page = $page;
        $this->responseResource = $responseResource;
    }



    public function createPage(PageValidationRequest $request){

        try{
            $data = $this->page->savePageInformation($request->all());
            return $this->responseResource->ResponseSuccess($data,"Page created successfully",Response::HTTP_CREATED);

        }catch (\Exception $e){
            return $this->responseResource->ResponseError(null,$e->getMessage(),Response::HTTP_INTERNAL_SERVER_ERROR);
        }

    }


}
