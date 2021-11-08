<?php

namespace App\Http\Controllers\Api\Page;

use App\Http\Controllers\Controller;
use App\Http\Requests\PageValidationRequest;
use App\Http\Resources\ApiResponseResource;
use App\Repository\PageInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class PageController extends Controller
{
    private $page;


    public function __construct(PageInterface $page)
    {
        $this->page = $page;
    }

    /**
     * @param PageValidationRequest $request
     * @return \Illuminate\Http\JsonResponse
     * @param page_name
     */
    public function createPage(PageValidationRequest $request){

        try{
            $data = $this->page->savePageInformation($request->all());
            return $this->ResponseSuccess($data,"Page created successfully", ResponseAlias::HTTP_CREATED);

        }catch (\Exception $e){
            return $this->ResponseError(null,$e->getMessage(), ResponseAlias::HTTP_INTERNAL_SERVER_ERROR);
        }

    }


}
