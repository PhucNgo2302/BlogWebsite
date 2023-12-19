@extends('main')
@section('title',' | All Posts')

@section('content')
    <div class="row">
        <div class="col-md-10">
            <center><h1>All Posts</h1></center>
            <hr class="MedDivider">
        </div>
        <div class="col-md-2">
            <a href="{{route('posts.create')}}" class="btn btn-outline-success">Create New Post</a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12" style="background-color:#fff">
            <div class="input-group">
                <div class="form-outline">
                  <input type="text" id="myInput" onkeyup="myFunction()" class="form-control" />
                  <label class="form-label" for="form1">Search</label>
                </div>
                <button type="button" class="btn btn-primary">
                  <i class="fas fa-search"></i>
                </button>
              </div>
        </div>
    </div>


    <section id="AllPosts" style="background-color: #FED049 ">
        <div class="TableContainer">
            <table id="myTable" class="table table-hover">
                <thead class="thead-dark">
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Body</th>
                    <th scope="col">Category</th>
                    <th scope="col">Tags</th>
                    <th scope="col">Author</th>
                    <th scope="col">Create At</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                    @if (Auth::user()->role_as == 1)
                        @foreach ($allPosts as $post)
                            <tr>
                                <td>{{$post->id}}</td>
                                <td>{{$post->title}}</td>
                                <td>{{substr(strip_tags( $post->body), 0,50)}}{{ strlen(strip_tags( $post->body)) > 50 ? "..." : "" }}</td>
                                <td>{{ $post->category->name }}</td>
                                @if (count($post->tags) > 0)
                                    <td>
                                        @foreach ($post->tags as $tag)
                                        <a class='badge badge-primary' href="{{ route('tags.show',$tag->id) }}">{{substr($tag->name, 0,50)}}{{ strlen($tag->name) > 50 ? "..." : "" }}</a>
                                        @endforeach
                                    </td>
                                @else
                                    <td>Null</td>
                                @endif

                                {{-- Kiem tra nguoi dung  --}}
                                @foreach ($users as $user)
                                    @if ($user->id == $post->user_id)
                                        <td>{{ $user->name }}</td>
                                    @endif
                                @endforeach


                                <td>{{date('M j, Y',strtotime($post->created_at))}}</td>
                                <td><a href="{{ route('posts.show', $post->id) }}" class="btn btn-default">View</a><a href="{{ route('posts.edit', $post->id) }}" class="btn btn-default">Edit</a></td>
                            </tr>
                        @endforeach
                    @else
                        @foreach ($posts as $post)
                            <tr>
                                <td>{{$post->id}}</td>
                                <td>{{$post->title}}</td>
                                <td>{{substr(strip_tags( $post->body), 0,50)}}{{ strlen(strip_tags( $post->body)) > 50 ? "..." : "" }}</td>
                                <td>{{ $post->category->name }}</td>
                                @if (count($post->tags) > 0)
                                    <td>
                                        @foreach ($post->tags as $tag)
                                        <a class='badge badge-primary' href="{{ route('tags.show',$tag->id) }}">{{substr($tag->name, 0,50)}}{{ strlen($tag->name) > 50 ? "..." : "" }}</a>
                                        @endforeach
                                    </td>
                                @else
                                    <td>Null</td>
                                @endif
                                <td>{{ Auth::user()->name }}</td>

                                <td>{{date('M j, Y',strtotime($post->created_at))}}</td>
                                <td><a href="{{ route('posts.show', $post->id) }}" class="btn btn-default">View</a><a href="{{ route('posts.edit', $post->id) }}" class="btn btn-default">Edit</a></td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
              </table>
        </div>
        <div class="text-center" style="padding-top: 20px">
            {!! $posts->links('pagination::bootstrap-4') !!}
        </div>
    </section>






@endsection
@section('javascipt')


@endsection
