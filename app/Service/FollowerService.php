<?php

namespace App\Service;
use App\Repository\FollowerInterface;

class FollowerService
{
    public function __construct(FollowerInterface $follower)
    {
        $this->follower = $follower;

    }

    public function getFollowerType($id,$routeName){

        if(strpos($routeName,'persons') !== false){
            $type = "App\Model\User";
        }
        if(strpos($routeName,'pages') !== false){
            $type = "App\Model\Page";
        }
        return $this->follower->followPerson($id,$type);
    }

}
