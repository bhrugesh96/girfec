@php
  $fields = [
    'layout_id' => get_sub_field( 'layout_id' ) ? get_sub_field( 'layout_id' ) : uniqid( get_row_layout() . '-' ),
    'overflow' => ( get_sub_field( 'overflow' ) === 'hidden' ) ? 'overflow-hidden' : '',
    'title' => get_sub_field( 'title' ) ? get_sub_field( 'title' ) : \App\title(),
    'subtitle' => get_sub_field( 'subtitle' ),
    'banner_image' => get_sub_field( 'banner_image' ) ? get_sub_field( 'banner_image' ) : get_field( 'default_banner_image', 'option' ),
    'floating_elements' => get_sub_field( 'floating_elements' ),
  ];

  $classes = [
    'layout-item',
    'page-banner',
    $fields['overflow'],
  ];

  if( ! empty( $fields['floating_elements'] ) ) {
    $classes[] = 'has-floating-element';
  }
@endphp

<section id="{{ $fields['layout_id'] }}" class="{{ implode( ' ', $classes ) }}">
  <figure class="banner-thumbnail img-cover">
    {!! \App\get_responsive_attachment( $fields['banner_image'][ 'id' ], 'full' ) !!}
  </figure>

  <div class="container">
    @if( ! empty( $fields['title'] ) )
      <h1 class="banner-title">{!! $fields['title'] !!}</h1>
    @endif

    @if( ! empty( $fields['subtitle'] ) )
      <h3 class="banner-subtitle">{!! $fields['subtitle'] !!}</h3>
    @endif
  </div>

  {!! \App\the_floating_elements( $fields['floating_elements'] ) !!}
</section>
