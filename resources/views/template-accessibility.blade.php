{{--
  Template Name: Accessibility
--}}

@extends('layouts.app')

@section('page_header')
  @include('page-headers.page-header')
@endsection

@section('content')
  @while(have_posts()) @php(the_post())
    @include('partials.sub-nav')

    <div class="content-wrap">
      @if( have_rows( 'page_content_layouts', wpc_get_the_id() ) )
        @while( have_rows( 'page_content_layouts', wpc_get_the_id() ) ) @php( the_row() )
          @include( 'flexibles.page-content.' . get_row_layout() )
          @endwhile
          @endif

          @include('partials.content-accessibility')
          @include('partials.feedback-form')
    </div>

    @endwhile
@endsection

@section('page_footer')
  @include('page-footers.page-footer')
@endsection


