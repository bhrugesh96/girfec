@extends('layouts.app')

@section('page_header')
  @include('page-headers.page-header')
@endsection

@section('content')
  @include('partials.sub-nav')

  @if( have_rows( 'page_content_layouts', wpc_get_the_id() ) )
    <div class="content-wrap">
      @while( have_rows( 'page_content_layouts', wpc_get_the_id() ) ) @php( the_row() )
        @include( 'flexibles.page-content.' . get_row_layout() )
        @endwhile
    </div>
  @endif

  <div class="posts-wrap">
    @while (have_posts()) @php(the_post())
      @include ('partials.content-'.(get_post_type() !== 'post' ? get_post_type() : get_post_format()))
      @endwhile
  </div>
@endsection
