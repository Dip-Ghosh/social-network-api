<?php

namespace App\Repository;

use App\Models\Follower;
use Illuminate\Support\Facades\Auth;

class FollowerRepository implements FollowerInterface{


    protected $follower;

    public function __construct(Follower $follower)
    {
        $this->follower = $follower;
    }



    public function followPerson($id,$type){

        return $this->follower->create([
            'following_type'=>$type,
            'follower_id'=>$id,
            'following_id'=>Auth::id()
        ]);


    }

}
