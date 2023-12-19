@extends('main')
@section('title',' | All Tags')

@section('content')
    <hr>
    <div class="row">
        <div class="col-md-12">
            <center><h1>All Tags</h1></center>
        </div>
    </div>
    <div class="row">
        {{-- Table --}}
        <div class="col-md-12">
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
            <section id="AllPosts" >
                <div class="TableContainer">

                    <table id="myTable" class="table table-hover">
                        <thead class="thead-dark">
                          <tr>
                            <th scope="col">#</th>
                            <th style="width: 70%"  scope="col">Name</th>
                            <th scope="col">Author</th>
                            <th></th>
                          </tr>
                        </thead>
                        <tbody>

                            @foreach ($tags as $tag)
                                <tr>
                                    <td>{{$tag->id}}</td>
                                    <td><a href="{{ route('tags.show',$tag->id) }}">{{substr($tag->name, 0,50)}}{{ strlen($tag->name) > 50 ? "..." : "" }}</a></td>
                                    @foreach ($users as $user)
                                        @if ($user->id == $tag->user_id)
                                            <td>{{ $user->name }}</td>
                                        @endif
                                    @endforeach
                                </tr>
                            @endforeach

                        </tbody>
                      </table>
                </div>
                <div class="text-center" style="padding-top: 20px">

                </div>
                <div class="text-center" style="padding-top: 20px">
                    {!! $tags->links('pagination::bootstrap-4') !!}
                </div>
            </section>
        </div>


    </div>

@endsection
@section('javascipt')


@endsection
