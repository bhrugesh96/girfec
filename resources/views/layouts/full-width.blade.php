<!doctype html>
<html @php(language_attributes())>
  @include('partials.head')
  <body @php(body_class())>
    @php(do_action('get_header'))
    @include('partials.header')
    <div class="wrap" role="document">
      @yield('page_header')
      <div class="wrap-inner">
        <div class="content">
          <main class="main">
            @yield('content')
          </main>
        </div>
      </div>
      @yield('page_footer')
    </div>
    @php(do_action('get_footer'))
    @include('partials.footer')
    @php(wp_footer())
  </body>
</html>
