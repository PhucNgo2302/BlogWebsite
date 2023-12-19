    @extends("main")

    @section('title', '| HomePage')

    @section('carousel')

    <div class="CarouselContainer">

        <!-- Carousel wrapper -->
        <div id="carouselBasicExample" class="carousel slide carousel-fade" data-mdb-ride="carousel">
    <!-- Indicators -->
    <div class="carousel-indicators">
      <button
        type="button"
        data-mdb-target="#carouselBasicExample"
        data-mdb-slide-to="0"
        class="active"
        aria-current="true"
        aria-label="Slide 1"
      ></button>
      <button
      type="button"
        data-mdb-target="#carouselBasicExample"
        data-mdb-slide-to="1"
        aria-label="Slide 2"
      ></button>
      <button
      type="button"
      data-mdb-target="#carouselBasicExample"
      data-mdb-slide-to="2"
        aria-label="Slide 3"
      ></button>
    </div>

    <!-- Inner -->
    <div class="carousel-inner">
      <!-- Single item -->
      <div class="carousel-item active">
        <img src="https://mdbcdn.b-cdn.net/img/Photos/Slides/img%20(15).webp" class="d-block w-100" alt="Sunset Over the City"/>
        <div class="carousel-caption d-none d-md-block">
            <h5>First slide label</h5>
            <p></p>
        </div>
    </div>

      <!-- Single item -->
      <div class="carousel-item">
        <img src="https://mdbcdn.b-cdn.net/img/Photos/Slides/img%20(22).webp" class="d-block w-100" alt="Canyon at Nigh"/>
        <div class="carousel-caption d-none d-md-block">
            <h5>Second slide label</h5>
          <p>.</p>
        </div>
    </div>

    <!-- Single item -->
    <div class="carousel-item">
        <img src="https://mdbcdn.b-cdn.net/img/Photos/Slides/img%20(23).webp" class="d-block w-100" alt="Cliff Above a Stormy Sea"/>
        <div class="carousel-caption d-none d-md-block">
            <h5>Third slide label</h5>
            <p>.</p>
        </div>
    </div>
</div>
<!-- Inner -->

<!-- Controls -->
<button class="carousel-control-prev" type="button" data-mdb-target="#carouselBasicExample" data-mdb-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
</button>
<button class="carousel-control-next" type="button" data-mdb-target="#carouselBasicExample" data-mdb-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
</button>
</div>
<!-- Carousel wrapper -->
</div>
@endsection

@section('category')
<div class="CategorySection">
    @foreach ($categories as $category)
            <a href="{{ route('blog.category',$category->id) }}"><p class="CategoryLink">{{ $category->name }}</p></a>
    @endforeach
    <!-- Category -->
</div>
@endsection

    @section('search')
        <form action="{{ route('blog.search') }}" method="post">
            @csrf
            <div class="SearchContainer">

                <div class="SearchForm">

                    <div class="form-outline">
                        <input type="search" id="form1" name="search" class="form-control" />
                        <label class="form-label" for="form1">Search</label>
                    </div>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-search"></i>
                    </button>

                </div>
                <hr>
            </div>
        </form>
        <hr>
    @endsection

    @section('content')
    <section id="Blog">
        <!--heading-->
        <div class="BlogHeading">
            <h3>Recent Posts</h3>
            <hr class="MedDivider">
        </div>

        <!--Blog container-->
        <div class="BlogContainer">
            @foreach ($posts as $post)
            <!--Box1-->
            <div class="BlogBox rounded-4 shadow-2-strong">
                <!--img-->
                @if (isset($post->image))
                    <div class="BlogImg">
                        <a href="{{ route('blog.singer',$post->slug) }}"><img src="{{asset('images/'.$post->image)}}" alt=""></a>
                    </div>
                 @else
                    <div class="BlogImg">
                        <img src="https://media.istockphoto.com/id/1295633127/vi/anh/th%E1%BB%8Bt-g%C3%A0-n%C6%B0%E1%BB%9Bng-v%C3%A0-salad-rau-t%C6%B0%C6%A1i-c%C3%A0-chua-b%C6%A1-rau-di%E1%BA%BFp-v%C3%A0-rau-bina-kh%C3%A1i-ni%E1%BB%87m-th%E1%BB%B1c-ph%E1%BA%A9m-l%C3%A0nh-m%E1%BA%A1nh.jpg?s=612x612&w=is&k=20&c=sAEuArleoSfQNXUc_DSPywZ32fR5n85j0qy-gqPfPlo=" alt="Blog">
                    </div>
                @endif
                <!--text-->
                <div class="BlogText">
                    <span>Category: {{$post->category->name}}</span>
                    <div class="row">
                        <div class="col-md-12">
                        <i class="bi bi-tags"></i>
                        @foreach ($post->tags as $tag)
                            <a href="{{ route('tags.show',$tag->id) }}"><span class="badge  badge-primary">{{$tag->name}}</span>
                            </a>
                        @endforeach
                        </div>
                    </div>
                    <a href="{{url('blog/'.$post->slug)}}" class="BlogTitle">{{$post->title}}</a>
                    <p>
                        {{strip_tags($post->body)}}
                    </p>
                    <a href="{{url('blog/'.$post->slug)}}">Read More</a>
                    <span><i class="bi bi-calendar"></i> {{date('M j, Y',strtotime($post->created_at))}}</span>

                    @foreach ($users as $user)
                        @if ($post->user_id == $user->id)
                            <H4><i class="bi bi-person"></i> {{ $user->name}}</H4>
                        @endif
                    @endforeach
                </div>

            </div>

            @endforeach
        </div>
    </section>
    @endsection






















