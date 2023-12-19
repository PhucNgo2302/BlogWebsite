<nav class="navbar navbar-expand-lg navbar-light bg-light" id="mainNav">
    <div class="container px-4 px-lg-5">
        <a class="navbar-brand" href="{{route('public.index')}}">Food Blog</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon bi bi-toggles"><p class="bi bi-toggles"></p></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto py-4 py-lg-0">
                <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4 {{ Request::is('/') ? "active" : "" }}" href="{{ route('public.index') }}"><i class="bi bi-house"></i> Home</a></li>
                @if (Auth::check())
                    @if (Auth::user()->role_as == 1)
                        <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4 {{ Request::is('blog') ? "active" : "" }}" href="{{ route('admin.index') }}"><i class="bi bi-speedometer"></i> Dashboard</a></li>

                    @endif
                @endif
                <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4 {{ Request::is('blog') ? "active" : "" }}" href="{{ route('blog.index') }}"><i class="bi bi-newspaper"></i> Blog</a></li>
                <li class="nav-item dropdown">
                    @if (Auth::check())
                    <a class="nav-link dropdown-toggle px-lg-3 py-3 py-lg-4" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-person"> {{ Auth::user()->name}}</i>
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{ route('posts.index') }}">Posts</a>
                        <a class="dropdown-item" href="{{ route('categories.index') }}">Categories</a>
                        <a class="dropdown-item" href="{{ route('tags.index') }}">Tags</a>
                        <a class="dropdown-item" href="{{ route('tags.create') }}">My Tags</a>
                        <div class="dropdown-divider"></div>
                        <form action="{{route('logout')}}" method="post">
                            @csrf
                            <button class="dropdown-item" type="submit">Logout</button>
                        </form>

                    </div>
                    @else
                        <li class="nav-item"><a class="btn btn-info my-3 {{ Request::is('contact') ? "active" : "" }}" href="{{ route('login') }}">Login</a></li>

                    @endif
                </li>
            </ul>

        </div>

    </div>
</nav>
<!-- Navigation Bar -->
