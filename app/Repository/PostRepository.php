<?php

namespace App\Repository;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PostRepository implements PostInterface
{
    private $post;
    public function __construct( Post $post )
    {
        $this->post = $post;
    }


    public function publishPost($data,$type)
    {
       return $this->post::create([
           "post_content" =>$data['post_content'],
           "post_publish_type" =>$type,
           "page_id" =>(isset($data['pageId']) && !empty($data['pageId'])) ? $data['pageId'] : null,
           "publisher_id" =>Auth::id()
       ]);
    }

}
