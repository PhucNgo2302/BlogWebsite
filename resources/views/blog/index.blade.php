@extends('main')
@section('title',' | Blog')




@section('category')
    <div class="CategorySection">
        @foreach ($categories as $category)
            <a href="{{ route('blog.category',$category->id) }}"><p class="CategoryLink">{{ $category->name }}</p></a>
        @endforeach

        <!-- Category -->
    </div>
@endsection

@section('content')
    <div class="BlogHeading">
        <h3>All Posts</h3>
        <hr class="MedDivider">
    </div>
    <div class="row">
        <div class="col-md-10 " id="container_all_posts">
            @foreach ($posts as $post)

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
                        {{ strip_tags($post->body)}}
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
        <div class="col-md-2" id="sidebar">
            <h3>Recently Posts</h3>
            <ul class="list-group list-group-light">
                @foreach ($recentposts as $post)
                    <li class="list-group-item bi bi-file-post"><a href="{{ route('blog.singer',$post->slug) }}"> {{ $post->title }}</a></li>
                @endforeach
            </ul>
        </div>
    </div>
    <div class="text-center " style="padding-top: 30px;margin-right: 700px">
        {!! $posts->links('pagination::bootstrap-5') !!}
    </div>

@endsection
