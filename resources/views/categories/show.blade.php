@extends('main')
@section("title',' | $category->name Category")

@section('content')
<br>
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
                <h3><Span class="text-primary">{{ $category->name }} </Span> Category</h3>
            </div>
            <div class="col-md-4">

            </div>
        </div>
    </div>

</div><br>
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
<section id="AllPosts" style="background-image: linear-gradient(to top, rgba(205, 156, 242, 1), rgba(246, 243, 255, 1))">
    <div class="TableContainer">
        <table id="myTable" class="table table-hover">
            <thead class="thead-dark">
              <tr>
                <th scope="col">#</th>
                <th scope="col">Title</th>
                <th scope="col">Category</th>
                <th scope="col">Author</th>
                <th></th>
              </tr>
            </thead>
            <tbody>

                @foreach ($posts as $post)
                    <tr>
                        <td>{{$post->id}}</td>
                        <td>{{$post->title}}</td>
                        <td>
                            <span class=" text-primary">{{$category->name}}</span>
                        </td>
                            @foreach ($users as $user)
                                @if ($user->id == $post->user_id)
                                    <td>{{ $user->name }}</td>
                                @endif
                            @endforeach
                        <td><a href="{{route('blog.singer',$post->slug)}}" class="btn btn-primary btn-xs">View</a></td>
                    </tr>
                @endforeach

            </tbody>
          </table>
    </div>
    <div class="text-center" style="padding-top: 20px">
    </div>
</section>


@endsection
