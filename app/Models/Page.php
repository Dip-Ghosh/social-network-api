<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;
    protected $fillable = ['page_name', 'user_id'];

    public function posts(){
        return $this->morphMany(Post::class, 'postable');
    }

    public function follows(){
        return $this->morphMany(Follower::class, 'followable');
    }
}
