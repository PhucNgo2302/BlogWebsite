@extends('main')
@section('title'," | $post->title")

@section('content')



    <div class="row">
        <div class="col-md-10" id="postBack">
            @if (isset($post->image))
                <img class ="Header" src="{{asset('images/'.$post->image)}}" alt="">
            @endif
            <section id="Post" style="">
                <center><h1>{{$post->title}}</h1></center>
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

    <br>
    <div class="row">
        <div class="col-md-8 offset-md-2" id="postBack">
            <div class="row d-flex justify-content-center">
                <div class="col-md-8 col-lg-12">
                    @if (session('message'))
                        <h6 class="alert alert-warning mb-3">{{session('message')}}</h6>
                    @endif
                    <h5>{{count($post->comments)}} Comment</h5>
                    <div class="form-outline mb-4">
                        <form id='comment' method="POST" action="{{ route('comments.store')}}">
                            @csrf
                            <input type="hidden" name="slug" value="{{$post->slug}}"    />
                            <input type="hidden" name="post_id" value="{{$post->id}}"    />
                            <textarea class="form-control border" placeholder="Type comment..."name="body" id="" cols="10" rows="3"></textarea>
                            <label class="form-label" for="addANote">+ Comment</label>

                        </form>
                    </div>
                    <button type="submit" class="btn btn-primary" form="comment">Sumbit</button><hr>
                  <div class="card shadow-0 border" style="background-color: #f1f3f6;">
                    <div class="card-body p-4">
                        @foreach ($post->comments as $comment)
                        <div class="comment-container card mb-4">
                            <div class="card-body">
                              <p>{{$comment->body}}</p>
                              <div class="d-flex justify-content-between">
                                <div class="d-flex flex-row align-items-center">
                                  <img src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img%20(4).webp" alt="avatar" width="25"
                                    height="25" />
                                  @if ($comment->user_id)
                                    <p class="small mb-0 ms-3 me-3">{{$comment->users->name}}</p>

                                  @endif
                                  @if (Auth::check())
                                    @if (Auth::user()->id == $comment->user_id || Auth::user()->role_as == 1)

                                    <form action="{{route('comments.delete',$comment->id)}}" method="post">
                                        @csrf
                                        <button type="submit"class="btn btn-danger">Delete</button>
                                    </form>
                                    @endif
                                  @endif

                                </div>
                                <div class="d-flex flex-row align-items-center">
                                  <p class="small text-muted mb-0">{{date('M j, Y',strtotime($comment->created_at))}}</p>

                                </div>
                              </div>
                            </div>
                          </div>
                        @endforeach


                    </div>

                  </div>
                </div>
              </div>
        </div>
    </div><br>


@endsection

@section('javascript')


@endsection
