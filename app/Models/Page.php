<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;
    public function posts(){
        return $this->morphMany(Post::class, 'postable');
    }

    public function follows(){
        return $this->morphMany(Follower::class, 'followable');
    }
}
