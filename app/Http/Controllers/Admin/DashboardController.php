<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use App\Models\Tag;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        $posts = Post::All();
        $users = User::All();
        $categories = Category::All();
        $tags = Tag::All();
        return view('admin.dashboard')->with('posts', $posts)->with('users', $users)
        ->with('categories', $categories)->with('tags', $tags);
    }
}
