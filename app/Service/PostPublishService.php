<?php

namespace App\Service;

use App\Repository\PostInterface;

class PostPublishService
{
    private $post;
    public function __construct( PostInterface $post )
    {
        $this->post = $post;
    }

   public function publishPost($data,$routeName){

       if(strpos($routeName,'persons') !== false){
           $type = "App\Model\User";

       }
       if(strpos($routeName,'pages') !== false){
           $type = "App\Model\Page";
       }
       return $this->post->publishPost($data,$type);
   }

}
