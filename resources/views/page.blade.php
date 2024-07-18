@extends('layouts.app')

@section('page_header')
  @include('page-headers.page-header')
@endsection

@section('content')
  @while(have_posts()) @php(the_post())
    @include('partials.content-page')
    @endwhile
@endsection

@section('page_footer')
  @include('page-footers.page-footer')
@endsection
