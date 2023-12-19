<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    public function user(){
        return $this -> hasMany(User::class);
    }

    public function category(){
        return $this ->belongsTo(Category::class,'category_id','id');
    }

    public function tags(){
        return $this ->belongsToMany(Tag::class,'post_tag');
    }

    public function comments(){
        return $this->hasMany(Comment::class,'post_id','id');
    }
}
