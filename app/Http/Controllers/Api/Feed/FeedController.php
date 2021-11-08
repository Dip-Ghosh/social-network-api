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

    public function __construct(FeedInterface $feed)
    {
        $this->feed = $feed;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function index(Request $request)
    {
        $myCollectionObj = $this->feed->getFeed();
        $data = $this->paginate($myCollectionObj,$request->page_size,$request->page);
        return $this->ResponseSuccess($data,"List Of Feed",Response::HTTP_OK);
    }

    /**
     * @param $items
     * @param int $perPage
     * @param null $page
     * @param array $options
     * @return LengthAwarePaginator
     */
    private function paginate($items,$perPage = 5, $page = null,$options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }
}
