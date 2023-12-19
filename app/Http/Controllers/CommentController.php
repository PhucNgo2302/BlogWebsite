<?php

namespace App\Http\Controllers;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\support\Facades\session;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

        if (Auth::check()) {
            //kiem tra 
            $request->validate([
                'body' => 'required|max:255',
            ]);

            //luu database
            $post = Post::where('slug',$request->slug)->first();
            if ($post) {

                $comment = new Comment;
                $comment->post_id = $request->post_id;
                $comment->user_id = Auth::user()->id;
                $comment->body = $request->body;

                $comment->save();

                Session::flash('success',"Comment Sucess");

                return redirect()->back()->with('message','Comment successfully ');

            }else{
                return redirect()->back()->with('Sucess','No Such Post Found');
            }
        }
        else {

            return redirect()->route('login')->with('message','Login First To Comment');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        //Xoas comment
        if (Auth::check()) {
            $comment = Comment::where('id',$id)
                        ->where('user_id',Auth::user()->id)
                        ->first();
            $comment->delete();

            return response()->json([
                'status' => 200,
                'message' => 'Comment deleted successfully',
            ]);
        }
        else{

            return response()->json([
                'status' => 401,
                'mesage' => 'Login to delete this comment',
            ]);
        }
    }
}
