@extends('main')
@section('title',' | Create New Post')

@section('style')





@endsection

@section('content')
    <section id="PostEdit" style="background-image: url(https://superbcatering.com.au/wp-content/uploads/2020/04/contact-frm-bg.jpgo)">
        <center>
            <h1>Create New Post</h1>
            <hr class="MedDivider">
        </center>
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <form data-parsley-validate = '' method="POST" action="{{route('posts.store')}}" enctype="multipart/form-data">
                    @csrf
                    <div required = '' maxlength = '255' class="form-group">
                      <label>Post Title</label>
                      <input required = '' maxlength = '255' type="text" class="form-control" id="title" name="title" placeholder="Post Name">
                    </div>

                    <div class="form-group">
                        <label>Slug</label>
                        <input required = '' maxlength="255" minlength="5" type='text' class="form-control" id="slug" name="slug" placeholder="Slug">
                    </div>

                    <div class="form-group">
                        <label>Category</label>
                        <select class="form-control" id="category_id" name="category_id">
                            @foreach ($categories as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Tags</label>
                        <select class="js-example-basic-multiple form-control" name="tags[]" multiple="multiple">
                            @foreach ($tags as $tag)
                                <option value="{{$tag->id}}">{{$tag->name}}</option>
                            @endforeach

                        </select>
                    </div>

                    <div class="form-group">
                        <label>Thumbnail</label><br>
                        <input type="file" name="thumbnail" id="">
                    </div>

                    <div class="">
                      <label>Content</label>
                      <textarea required = ''  class="form-control" id="body" name="body" rows="6"></textarea>
                    </div><br>


                    <script>
                        ClassicEditor
                                .create( document.querySelector( '#body' ),{
                                    cloudServices: {
                                        tokenUrl: 'https://94371.cke-cs.com/token/dev/gZvAefMG6d7W88sngK0TXy0vh9wrwqcB9PaT?limit=10',
                                        uploadUrl: 'https://94371.cke-cs.com/easyimage/upload/'
                                    }
                                } )
                                .then( editor => {
                                        console.log( editor );
                                } )x

                                .catch( error => {
                                        console.error( error );
                                } );
                    </script>


                    <button class="btn btn-primary" type="submit">Submit</button><hr>
                </form>
            </div>
        </div>
    </section>
@endsection

@section('javascript')



    <script type ="text/javascript" src="{{ URL::asset('js/parsley.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.js-example-basic-multiple').select2();
        });
    </script>

@endsection
