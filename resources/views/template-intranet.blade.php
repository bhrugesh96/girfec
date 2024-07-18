{{--
  Template Name: Intranet
--}}

@extends('layouts.full-width')

@section('page_header')
  @include('page-headers.page-header')
@endsection

@section('content')
  @while(have_posts()) @php(the_post())
    @if( is_user_logged_in() )
      @include('partials.content-page-full-width')
    @else
      @include('partials.login-form')
    @endif
  @endwhile
@endsection

@section('page_footer')
  @include('page-footers.page-footer')
@endsection
