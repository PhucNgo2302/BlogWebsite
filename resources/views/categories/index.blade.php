@extends('main')
@section('title',' | All Categories')

@section('content')
    <hr>
    <div class="row">
        <div class="col-md-8">
            <center><h1>All Categories</h1></center>
        </div>
    </div>
    <div class="row">
        {{-- Table --}}
        <div class="col-md-8">
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
                            <th style="width: 80%"  scope="col">Name</th>
                            <th></th>
                          </tr>
                        </thead>
                        <tbody>

                            @foreach ($categories as $category)
                                <tr>
                                    <td>{{$category->id}}</td>
                                    <td>{{substr($category->name, 0,50)}}{{ strlen($category->name) > 50 ? "..." : "" }}</td>
                                    <td><a href="{{route('categories.show',$category->id)}}" class="btn btn-default">View</a>
                                        <form action="{{ route('categories.destroy',$category->id) }}" method="post">
                                            @csrf
                                            @method("delete")
                                            @if (Auth::user()->role_as == 1)
                                                <button class="btn btn-default"type="submit">Delete</button>
                                            @endif
                                        </form>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                      </table>
                </div>
                <div class="text-center" style="padding-top: 20px">

                </div>
            </section>
        </div>

        {{-- Side card  --}}
        @if (Auth::user()->role_as == 1)
        <div class="col-md-3">
            <div class="card">
                <h5 class="card-header">New Category</h5>
                <div class="card-body">
                    <Form method = "post" action = "{{ route('categories.store')}}">
                        @csrf
                        <div class="form-outline">

                            <input type="text" name="name" id="name" class="form-control form-control-xl" />
                            <label class="form-label" for="firstName">Category Name</label>
                        </div><br>
                        <button type="submit" class="btn btn-outline-primary ms-2">Submit</button>
                    </Form>

                </div>
                </div>
        </div>
        @endif

    </div>

@endsection
