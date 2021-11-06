<?php

namespace App\Repository;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class FeedRepository implements FeedInterface
{

    public function getFeed()
    {
        return Post::where("publisher_id", "=",Auth::id())->get();

    }
}
