<?php

namespace App\Repository;

use App\Models\Page;
use Illuminate\Support\Facades\Auth;

class PageRepository implements PageInterface
{

    private $page;
    public function __construct(Page $page)
    {
        $this->page = $page;
    }


    public function savePageInformation(array $data)
    {
        return $this->page::create([
            'page_name' => $data['page_name'],
            'user_id' => Auth::id()
        ]);
    }
}
