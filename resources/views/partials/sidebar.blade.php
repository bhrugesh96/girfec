@php
  $fields = [
	  'sidebar' => get_field( 'sidebar', wpc_get_the_id() ),
	  'sidebar_image' => get_field( 'sidebar_image', wpc_get_the_id() ),
	];
@endphp

@include('partials.sub-nav')
@include('partials.sub-nav-categories')

@if( is_home() || is_category() || is_singular( 'post' ) )
  @php( dynamic_sidebar( 'sidebar-news' ) )
@elseif( ! empty( $fields['sidebar'] ) )
  @php( dynamic_sidebar( $fields['sidebar'] ) )
@else
  @php( dynamic_sidebar( 'sidebar-primary' ) )
@endif

@if( ! empty( $fields['sidebar_image']['element'] ) )
  {!! \App\the_floating_element( $fields['sidebar_image'] ) !!}
@endif
