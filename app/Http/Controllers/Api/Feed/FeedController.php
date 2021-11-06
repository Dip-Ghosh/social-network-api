<?php

namespace App\Http\Controllers\Api\Feed;

use App\Http\Controllers\Controller;
use App\Http\Resources\ApiResponseResource;
use App\Repository\FeedInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class FeedController extends Controller
{
    private $feed;
    private $responseResource;
    public function __construct(FeedInterface $feed,ApiResponseResource $responseResource)
    {
        $this->feed = $feed;
        $this->responseResource = $responseResource;
    }


    public function index(Request $request){

        $myCollectionObj = $this->feed->getFeed();
        $data = $this->paginate($myCollectionObj,$request->page_size,$request->page);
        return $this->responseResource->ResponseSuccess($data,"List Of Feed",Response::HTTP_OK);

    }
    public function paginate($items,$perPage = 5, $page = null,$options = []){

        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }
}
