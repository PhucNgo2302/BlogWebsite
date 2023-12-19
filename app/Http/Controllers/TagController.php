<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Models\Tag;
use App\Models\User;
use Illuminate\support\Facades\session;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(){
        $this ->middleware('auth');
    }


    public function index()
    {
        $tags = Tag::orderBy('id','desc')->paginate(10);
        $users = User::all();
        return view('tags.index')->with('tags', $tags)->with('users', $users);;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = Tag::where('user_id', '=', Auth::user()->id)->orderBy('id','desc')->paginate(10);

        return view('tags.create')->with('tags', $tags);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request ->validate([
            'name' => 'required|max:255'
        ]);
        $tag = new Tag();
        $tag -> name = $request->name;
        $tag -> user_id = Auth::user()->id;
        $tag -> save();

        session::flash('success', 'New Tag Added Success');
        return redirect()->route('tags.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tag = Tag::find($id);

        return view('tags.show')->with('tag', $tag);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tag = tag::find($id);

        return view('tags.edit')->with('tag', $tag);
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
        $tag = tag::findOrFail($id);

            $request->validate([
                'name' => 'required|max:255'
            ]);

            $tag -> name = $request-> name;
            $tag -> save();

            session::flash('success','Successfully saved your new tag');

            return redirect()->route('tags.show',$tag->id);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tag = Tag::find($id);

        $tag->posts()->detach();
        $tag->delete();

        //Messesge
        session::flash('success','Tag was successfully removed');

        return redirect()->route('tags.index');
    }
}
