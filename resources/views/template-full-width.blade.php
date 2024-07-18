{{--
  Template Name: Full Width
--}}

@extends('layouts.full-width')

@section('content')
  @while(have_posts()) @php(the_post())
    @include('partials.content-page-full-width')
  @endwhile
@endsection

