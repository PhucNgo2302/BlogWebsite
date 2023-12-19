<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\support\Facades\session;



class BlogController extends Controller
{
    public function index(){
        //Get all posts (for public)
        $posts = Post::paginate(9);
        $recentposts = Post::orderBy('id','desc')->paginate(10);
        $categories = Category::paginate(4);
        $users = User::all();

        return view('blog.index')->with('posts', $posts )->with('users', $users)->with('recentposts', $recentposts)
        ->with('categories', $categories);
    }

    public function single($slug){
        //Lay data bang slug(URL dep dung cho public page)
        $post = Post::where('slug', '=', $slug)->first();
        $recentposts = Post::orderBy('id','desc')->paginate(10);
        $comments = Comment::all();

        return view('blog.single')->with('post', $post)->with('comments', $comments)->with('recentposts', $recentposts);;
    }

    public function search(request $request){
        //Tim kiem post
        $posts = Post::where('title','like','%'.$request->input('search').'%')->paginate(9);
        $users = User::all();
        $categories = Category::paginate(4);
        $recentposts = Post::orderBy('id','desc')->paginate(10);

        return view('blog.search')->with('posts', $posts)->with('users', $users)
        ->with('recentposts', $recentposts)->with('categories', $categories);
    }

    public function categorySearch($category_id){
        //Tim kiem trong thanh category
        $posts = Post::where('category_id', $category_id)->orderBy('id','DESC')->get();
        $recentposts = Post::orderBy('id','desc')->paginate(10);
        $categories = Category::paginate(4);
        $users = User::all();
        return view('blog.categorysearch')->with('posts', $posts)->with('categories', $categories)
        ->with('recentposts', $recentposts)->with('users', $users);
    }

    public function storeComment(request $request){
        if (Auth::check()) {
            //kiem tra
            $request->validate([
                'body' => 'required|max:255',
            ]);

            //lay du lieu tu data
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

    public function deleteComment($id){
            //xoa comment
            $comment = Comment::find($id);
            $comment->delete();

            return redirect()->back()->with('success','your comment has been deleted');

    }
}
