<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Storage;


use Illuminate\support\Facades\session;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(){
        $this->middleware('auth');
    }

    public function index()
    {
        //show tat ca category
        $categories = Category::all();
        return view('categories.index')->with('categories', $categories);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //kiem tra
        $request -> validate([
            'name' => 'required|max:255',
        ]);
        //lay data tu input
        $category = new Category;

        $category->name = $request-> name;
        $category->save();

        //flash (thong bao)
        session::flash('success', 'New Category has been created');
        return redirect()->route('categories.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //Hien thi theo id
        $category = Category::find($id);
        $posts = Category::find($id)->post;
        $allPosts = Post::all();
        $users = User::all();

        return view('categories.show')->with('category', $category)->with('posts', $posts)
        ->with('allPosts', $allPosts)->with('users', $users);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //xoa
        $category = Category::find($id);
        $posts = Post::where('category_id',"=", $id)->get();
        foreach ($posts as $post) {
            if (isset($post->image)) {
                Storage::delete($post->image);
            }
            $post -> tags()->detach();
            $post->delete();
        }
        $category->delete();

        session::flash('success','The post has been successfully deleted.');
        return redirect()->route('categories.index');
    }
}
