@extends('layouts.app')

@section('page_header')
  @include('page-headers.page-header-single')
@endsection

@section('content')
  @while(have_posts()) @php(the_post())
    @include('partials.content-single-'.get_post_type())
  @endwhile
@endsection
