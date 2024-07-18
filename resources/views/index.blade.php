@extends('layouts.app')

@section('page_header')
  @include('page-headers.page-header')
@endsection

@section('content')
  @include('partials.sub-nav')
  @include('partials.sub-nav-categories')

  @if( have_rows( 'page_content_layouts', wpc_get_the_id() ) )
    <div class="content-wrap">
      @while( have_rows( 'page_content_layouts', wpc_get_the_id() ) ) @php( the_row() )
        @include( 'flexibles.page-content.' . get_row_layout() )
      @endwhile
    </div>
  @endif

  @if (!have_posts())
    <div class="alert alert-warning">
      {{ __('Sorry, no results were found.', 'girfec') }}
    </div>
  @endif

  <div class="posts-wrap">
    @while (have_posts()) @php(the_post())
      @include ('partials.content-'.(get_post_type() !== 'post' ? get_post_type() : get_post_format()))
    @endwhile
  </div>

  <nav class="nav-posts">
    {!! paginate_links(array(
      'mid_size' => 5,
      'type' => 'list',
      'prev_next' => false,
    )) !!}
  </nav>
@endsection

@section('page_footer')
  @include('page-footers.page-footer')
@endsection
