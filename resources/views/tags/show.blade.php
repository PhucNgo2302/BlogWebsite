@extends('main')
@section("title',' | $tag->name Tag")

@section('content')
    <hr>
    <div class="row">
        <div class="col-md-10">
            <center><h1>All Posts</h1></center>
        </div>
        <div class="col-md-2">
            <a href="{{route('posts.create')}}" class="btn btn-outline-success">Create New Post</a>
        </div>
    </div>
    <hr>
    <div class="row">

        <div class="col-md-6 offset-md-3">
            <div class="row">
                <div class="col-md-8">
                    <h3><Span class="badge badge-primary">{{ $tag->name }} </Span> Tag <small class="text-secondary">{{$tag->posts()->count()}} Post</small> </h3>
                </div>
                <div class="col-md-4">
                    @if (Auth::user()->id == $tag->user_id || Auth::user()->role_as == 1)
                    <div class="row">
                        <div class="col-md-6">
                            <a href="{{route('tags.edit',$tag->id)}}" class="btn btn-lg btn-primary btn-block">Edit</a>
                        </div>
                        <div class="col-md-6">
                            <form method="POST" action="{{route('tags.destroy',$tag->id)}}">
                                @method('delete')
                                @csrf
                                <button type="submit" class="btn btn-lg btn-danger btn-block">Delete</button>
                            </form>
                        </div>
                    </div>
                    @endif

                </div>
            </div>
        </div>

    </div><br>

    <section id="AllPosts" style="background-image: linear-gradient(to top, rgba(205, 156, 242, 1), rgba(246, 243, 255, 1))">

        <div class="TableContainer">
            <table class="table table-hover">
                <thead class="thead-dark">
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Tags</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>

                    @foreach ($tag->posts as $post)
                        <tr>
                            <th>{{$post->id}}</th>
                            <td>{{$post->title}}</td>
                            <td>@foreach ($post -> tags as $tag)
                                <span class="badge badge-primary">{{$tag->name}}</span>
                            @endforeach</td>
                            <td><a href="{{route('blog.singer',$post->slug)}}" class="btn btn-default btn-xs">View</a></td>
                        </tr>
                    @endforeach

                </tbody>
              </table>
        </div>
        <div class="text-center" style="padding-top: 20px">
        </div>
    </section>

@endsection
