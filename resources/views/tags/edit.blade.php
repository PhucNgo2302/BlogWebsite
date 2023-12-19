@extends('main')
@section('title',' | Edit Tag')
@section('content')
    <section id="AllPosts">
        <form action="{{route('tags.update',$tag->id)}}" method="post">
            @csrf
            @method('put')
            <div class="row">
                <div class="col-md-12 mb-4">
                    <div class="form-outline">
                        <label class="form-label" for="firstName">Title:</label>
                        <input type="text" id="name" name = "name" class="form-control form-control-lg"/> <br>
                        <button class="btn btn-primary"type="submit">Save Changes</button>
                    </div>

                </div>
            </div>

        </form>
    </section>

@endsection
