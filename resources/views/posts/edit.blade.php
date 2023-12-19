@extends('main')

@section('title',' | Edit Blog Post')

@section('content')
    <section id="PostEditor" style="">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <form data-parsley-validate = '' method="Post" action="{{route('posts.update',$post->id)}}" id="submitform" enctype="multipart/form-data">
                    @method('Put')
                    @csrf
                    <div class="form-group">
                        <label><b> Post Title:</b></label>
                        <input required = '' maxlength = '255' value="{{$post->title}}" type="text" class="form-control" id="title" name="title" placeholder="Post Name">
                    </div>

                    <div class="form-group">
                        <label><b> Slug:</b></label>
                        <input required = '' maxlength="255" minlength="5" value="{{$post->slug}}" type='text' class="form-control" id="slug" name="slug" placeholder="Slug">
                    </div>


                    <div class="form-group">
                        <label><b> Category:</b></label>
                        <select class="form-control" id="category_id" name="category_id">
                            @if (isset($post->category->name))
                            
                            @endif
                            @foreach ($categories as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>


                    <div class="form-group">
                        <label><b>Tags:</b></label>
                        <select class="js-example-basic-multiple form-control" name="tags[]" multiple="multiple">
                            @foreach ($tags as $tag)
                                <option value="{{$tag->id}}">{{$tag->name}}</option>
                            @endforeach

                        </select>
                    </div>

                    <div class="form-group">
                        <label><b>Thumbnail:</b> </label><br>
                        <input type="file" name="thumbnail" id="">
                    </div>

                    <div class="form-group">
                        <label><b> Body:</b></label>
                        <textarea required = '' class="form-control" id="body" name="body" rows="6">{{$post->body}}</textarea>
                    </div>

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
                                } )

                                .catch( error => {
                                        console.error( error );
                                } );
                    </script>

                </form>
            </div>
        </div>

    </section>

    <!--Day la side bar -->
    <div class="row">
        <div class="col-md-8">
        </div>
        <div class="col-md-4">
            <div class="card card-body bg-light">
                <dl class="row  ">
                    <dt class="col-sm-4 text-right">Created At:</dt>
                    <dd class="col-sm-8 text-left">{{date('M j, Y H:i',strtotime($post->created_at))}}</dd>
                </dl>
                <dl class="row  ">
                    <dt class="col-sm-4 text-right">Last Updated:</dt>
                    <dd class="col-sm-8 text-left">{{date('M j, Y H:i',strtotime($post->updated_at))}}</dd>
                </dl>
                <hr>
                <div class="row">
                    <div class="col-sm-6">
                        <a href="{{route('posts.show',$post->id)}}" class="btn btn-danger btn-block">Cancel</a>
                    </div>
                    <div class="col-sm-6">
                        <button type="submit" form="submitform" class="btn btn-success btn-block">Save Changes</button>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection

@section('javascript')
    <script type ="text/javascript" src="{{ URL::asset('js/parsley.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.js-example-basic-multiple').select2();
        });
    </script>
    <script type="text/javascript">
        $('.js-example-basic-multiple').select2();
        $('.js-example-basic-multiple').select2().val({!! json_encode( $post->tags() -> allRelatedIds() -> toArray() ) !!}).trigger('change');
    </script>
@endsection
