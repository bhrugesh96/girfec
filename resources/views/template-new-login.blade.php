{{--
  Template Name: New Login
--}}

@extends('layouts.app')

@section('page_header')
  @include('page-headers.page-header')
@endsection

@section('content')
  @while(have_posts()) @php(the_post())
    @include('partials.sub-nav')

    <div class="content-wrap">
      @php echo "test"; @endphp
    </div>

    @endwhile
@endsection

@section('page_footer')
  @include('page-footers.page-footer')
@endsection


