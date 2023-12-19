<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Post;

class Tag extends Model
{
    use HasFactory;
    protected $table = 'tags';

    public function posts(){
        return $this->belongsToMany(Post::class,'post_tag');
    }

    public function users(){
        return $this->belongsTo(User::class,'user_id','id');
    }

}
