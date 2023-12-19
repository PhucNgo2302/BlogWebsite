<!doctype html>
<html lang="en">
    <head>
        @yield('styles')
        @include('partials._head')

    </head>
  <body>

    <header>
        @include('partials._nav')
    </header>
    <!--navbar -->

    <article>
        @yield('posters')
        <!-- Header Poster -->
        @yield('carousel')
        {{-- SlidesShow --}}
        @yield('category')
        <!-- Categories -->
        @yield('search')
        <!-- Blog section-->
        @include('partials._messages')
        @yield('content')
    </article>

    <footer>
        @include('partials._footer')
    </footer>
    <!-- Footer -->

    @include('partials._javascript')
    @yield('javascript')

  </body>
</html>
