@extends('main')
@section('title',' | My Tags')

@section('content')
    <hr>
    <div class="row">
        <div class="col-md-8">
            <center><h1>My Tags</h1></center>
        </div>
    </div>
    <div class="row">
        {{-- Table --}}
        <div class="col-md-8">
            <section id="AllPosts" >
                <div class="TableContainer">
                    <table class="table table-hover">
                        <thead class="thead-dark">
                          <tr>
                            <th scope="col">#</th>
                            <th style="width: 70%"  scope="col">Name</th>
                            <th></th>
                          </tr>
                        </thead>
                        <tbody>

                            @foreach ($tags as $tag)
                                <tr>
                                    <th>{{$tag->id}}</th>
                                    <td><a href="{{ route('tags.show',$tag->id) }}">{{substr($tag->name, 0,50)}}{{ strlen($tag->name) > 50 ? "..." : "" }}</a></td>
                                </tr>
                            @endforeach

                        </tbody>
                      </table>
                </div>

                <div class="text-center" style="padding-top: 20px">
                    {!! $tags->links('pagination::bootstrap-5') !!}
                </div>
            </section>
        </div>

        {{-- Side card  --}}
        <div class="col-md-3">
            <div class="card">
                <h5 class="card-header">New Tag</h5>
                <div class="card-body">
                    <Form method = "post" action = "{{ route('tags.store')}}">
                        @csrf
                        <div class="form-outline">

                            <input type="text" name="name" id="name" class="form-control form-control-xl" />
                            <label class="form-label" for="firstName">Tag Name</label>
                        </div><br>
                        <button type="submit" class="btn btn-outline-primary ms-2">Submit</button>
                    </Form>

                </div>
                </div>
        </div>
    </div>

@endsection
