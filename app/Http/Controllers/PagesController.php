<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Models\Category;


class PagesController extends Controller
{
    function index(){
        //lay thong tin de cho vao trang chu
        $posts = Post::orderBy('created_at','desc')->limit(5)->get();
        $users = User::all();
        $categories = Category::paginate(4);
        return view('pages.index')->with('posts', $posts)->with('users', $users)
        ->with('categories', $categories);
    }

    function about(){
        return view('pages.about');
    }

    function contact(){
        return view('pages.contact');
    }

}
