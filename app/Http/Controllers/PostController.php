<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\support\Facades\session;
use mews\Purifier\Facades\Purifier;
use Stevebauman\Purify\Facades\Purify;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function __construct()
     {
         $this->middleware('auth');
     }

    public function index()
    {
        //lay tat ca data

        $posts = Post::where('user_id', "=" , Auth::user()->id)->orderBy('id','desc')->paginate(10);
        $allPosts = Post::all();
        $users = User::all();

        return view('posts.index')->with('posts', $posts)->with('users', $users)->with("allPosts", $allPosts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Tao tag
        $categories = Category::all();
        $tags = Tag::all();
        return view('posts.create')->with('categories', $categories)->with('tags', $tags);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //check data
        $request -> validate([
            'title'       => 'required|max:255',
            'slug'        => 'required|alpha_dash|max:255|min:5|unique:posts,slug',
            'category_id' => 'required|integer',
            'body'        => 'required',
            'thumbnail' => 'sometimes|'
        ]);

        //Luu database
        $post = new Post;
        $post->title = $request->title;
        $post->slug = $request->slug;
        $post->category_id = $request->category_id;
        //Bao mat cho editor (tranh nguoi dung nhap script vao)
        $post->body = Purify::clean($request->body);
        $post->user_id = Auth::user()->id;

        if ($request->hasFile('thumbnail')) {
            //kiem tra va lay ten anh luu vao database
            $image = $request->file('thumbnail');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $location = public_path('images/'.$filename);
            Image::make($image)->resize(800,400)->save($location);
            $post->image = $filename;
        }


        $post->save();
        //lien ket tag voi post thong qua (posts-tags)
        $post->tags()->sync($request->tags, false);
        //flash message thong bao
        Session::flash("success","Your Blog Was Create Successfully !");



        //chuyen trang
        return redirect()->route('posts.show',$post->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Lay data Blog

        $post = Post::findOrFail($id);
        $recentposts = Post::orderBy('id','desc')->paginate(10);

        //kiem tra nguoi dung
        if ($post->user_id == Auth::user()->id || Auth::user()->role_as == 1) {
            return view('posts.show')->with('post', $post)->with('recentposts', $recentposts);
        }
        else {
            return redirect('/');
        }

        //Truyen tham so cho view

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Category::all();
        $post = Post::findOrFail($id);
        $tags = Tag::all();

        if ($post->user_id == Auth::user()->id || Auth::user()->role_as == 1) {
            return view('posts.edit')->with('post',$post)->with('categories',$categories)->with('tags',$tags);
        }
        else {
            return redirect('/');
        }
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
        $post = Post::findOrFail($id);

        if ($post->user_id == Auth::user()->id || Auth::user()->role_as == 1) {

            if ($request->input('slug') == $post->slug) {
                $request -> validate([
                    'title' => 'required|max:255',
                    'body' => 'required',

                ]);
            }else {
                $request -> validate([
                    'title' => 'required|max:255',
                    'slug' => "required|alpha_dash|max:255|min:5|unique:posts,slug,$id",
                    'body' => 'required',
                    'thumbnail' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
                ]);
            }


            $post->title = $request-> input('title');
            $post->slug = $request-> input('slug');
            if ($post->category_id != $request->input('category_id')) {
                $post->category_id = $request-> input('category_id');
            }
            $post->body = $request->input('body');

            if ($request->hasFile('thumbnail')) {
                //tim anh(Chuyen thanh time cho de nhin :)))
                $image = $request->file('thumbnail');
                $filename = time() . '.' . $image->getClientOriginalExtension();
                $location = public_path('images/'.$filename);
                Image::make($image)->resize(800,400)->save($location);

                if (isset($post->image)) {
                    //Neu co anh san thi xoa anh cu
                    $oldFilename = $post->image;
                    Storage::delete($oldFilename);
                }

                //luu tren data
                $post->image = $filename;


            }

            $post->save();

            // lien ket tag voi post table thong qua sync
            if (isset($request->tags)) {
                $post->tags() -> sync($request->tags);
            }else {
                $post->tags() -> sync(array());
            }
            //flash message thong bao
            Session::flash("success","This post was successfully saved !");


            return redirect()->route('posts.show',$post->id);
        }
        else {
            return redirect('/');
        }





    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        if ($post->user_id == Auth::user()->id || Auth::user()->role_as == 1)   {
            //Xoa bo lien ket (xoa bang trong tag-post de ko bi loi)
            $post->tags() ->detach();
            

            if (isset($post->image)) {
                Storage::delete($post->image);
            }
            $post->delete();

            session::flash('success','The post has been successfully deleted.');
            return redirect()->route('posts.index');
        }
        else {
            return redirect('/');
        }

    }
}
