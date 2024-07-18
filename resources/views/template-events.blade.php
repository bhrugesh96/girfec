{{--
  Template Name: Events
--}}

@extends('layouts.app')

@if( is_post_type_archive('tribe_events') )
  @section('page_header')
    @include('page-headers.page-header')
  @endsection

  @section('content')
      @include('partials.content-page-events')
  @endsection

  @section('page_footer')
    @include('page-footers.page-footer')
  @endsection
@endif

@if( is_singular('tribe_events') )
  @section('page_header')
    @include('page-headers.page-header-single-tribe_events')
  @endsection

  @section('content')
    @include('partials.content-single-tribe_events')
  @endsection

  @section('page_footer')
    @include('page-footers.page-footer')
  @endsection
@endif
