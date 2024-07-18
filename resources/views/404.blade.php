@extends('layouts.app')

@section('page_header')
  @include('page-headers.page-header-404')
@endsection

@section('content')
  <div class="alert alert-warning">
    {{ __('Sorry, but the page you were trying to view does not exist.', 'girfec') }}
  </div>
@endsection
