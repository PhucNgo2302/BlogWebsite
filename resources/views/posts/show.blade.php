@extends('main')
@section('title',' | View Posts')

@section('posters')
@endsection

@section('content')
    <div class="row">
        <div class="col-md-8">
            <h3>Category :
                {{ $post->category->name }}
            </h3>
            <div class="tags">
                @foreach ($post->tags as $tag)

                    <span class="badge badge-primary">{{$tag ->name}}</span>

                @endforeach
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-body bg-light">

                    <label>URL: </label>
                    <p><a href="{{ url('blog/'.$post->slug)}}">{{url('blog/'.$post->slug)}}</a></p>

                    <label>Create At: </label>
                    <p>{{date('M j, Y H:i',strtotime($post->created_at))}}</p>

                    <label>Last Updated: </label>
                    <p>{{date('M j, Y H:i',strtotime($post->updated_at))}}</p>
                <hr>
                <div class="row">
                    <div class="col-sm-4 offset-1">
                        <form action="{{ route('posts.destroy',$post->id) }}" method="post">
                            @method("delete")
                            @csrf
                            <button type="submit" class="btn btn-danger btn-block">Delete</button>
                        </form>
                    </div>
                    <div class="col-sm-4 offset-1">
                        <a class="btn btn-primary btn-block" href="{{ route('posts.edit',$post->id) }}">Edit</a>
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-12">
                        <a href="{{ route('posts.index') }}" class="btn btn-default btn-block ">Show all posts</a>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <hr>

    <div class="row">
        <div class="col-md-10" id='postBack'>

            @if (isset($post->image))
            <img class ="Header" src="{{asset('images/'.$post->image)}}" alt="">
            @endif
            <section id="Post" style="">
                <center><h1>{{$post->title}} </h1></center>
                <p class="PostBody">{!! $post->body !!}</p>

            </section>
        </div>
        <div class="col-md-2" id="sidebar">
            <h3>Recently Posts</h3>
            <ul class="list-group list-group-light">
                @foreach ($recentposts as $post)
                    <li class="list-group-item bi bi-file-post"><a href="{{ route('blog.singer',$post->slug) }}"> {{ $post->title }}</a></li>
                @endforeach
            </ul>

        </div>

    </div>

@endsection

