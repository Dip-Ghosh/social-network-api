<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

   protected $fillable = [
       'post_content',
       'post_publish_type',
       'publisher_id',
       'page_id'
   ];
}
