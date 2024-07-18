@php
  $fields = [
    'layout_id' => get_sub_field( 'layout_id' ) ? get_sub_field( 'layout_id' ) : uniqid( get_row_layout() . '-' ),
    'overflow' => ( get_sub_field( 'overflow' ) === 'hidden' ) ? 'overflow-hidden' : '',
    'slides' => get_sub_field( 'slides' ),
    'full_screen' => get_sub_field( 'full_screen' ) === 'enabled' ? 'full-screen-it' : '',
    'autoplay' => get_sub_field( 'autoplay' ),
    'interval' => get_sub_field( 'interval' ) ? absint( get_sub_field( 'interval' ) ) * 1000 : 6000,
    'arrows' => get_sub_field( 'arrows' ),
    'dots' => get_sub_field( 'dots' ),
    'floating_elements' => get_sub_field( 'floating_elements' ),
  ];

	$classes = [
	  'layout-item',
	  get_row_layout(),
	  $fields['full_screen'],
    $fields['overflow'],
	];

	if( ! empty( $fields['floating_elements'] ) ) {
	  $classes[] = 'has-floating-element';
	}
@endphp

@if( ! empty( $fields['slides'] ) )
  <section id="{{ $fields['layout_id'] }}" class="{{ implode( ' ', $classes ) }}">
    <div class="slider-body" data-autoplay="{{ $fields['autoplay'] }}" data-interval="{{ $fields['interval'] }}" data-arrows="{{ $fields['arrows'] }}" data-dots="{{ $fields['dots'] }}">
      @while( have_rows( 'slides' ) ) @php( the_row() )
        @if( ! empty( $slide_image = get_sub_field( 'image' ) ) )
        <div class="slider-slide">
          <figure class="slide-thumbnail img-cover">
            {!! \App\get_responsive_attachment( $slide_image[ 'id' ], 'full' ) !!}
          </figure>

          <div class="slide-content">
            <div class="container">
              @if( ! empty( $slide_title = get_sub_field( 'title' ) ) )
                <h1 class="slide-title">{{ $slide_title }}</h1>
              @endif

              @if( ! empty( $slide_text = get_sub_field( 'text' ) ) )
                <div class="slide-text">{!! $slide_text !!}</div>
              @endif

              @if( have_rows( 'buttons' ) )
                <div class="slide-buttons">
                  @while( have_rows( 'buttons' ) ) @php( the_row() )
                  {!! \App\the_wpc_button([
                    'data' => get_sub_field( 'button' ),
                    'classes' => ['btn', 'btn-blue-dark']
                  ]) !!}
                  @endwhile
                </div>
              @endif
            </div>
          </div>
        </div>
        @endif
      @endwhile
    </div>

    {!! \App\the_floating_elements( $fields['floating_elements'] ) !!}
  </section>
@endif
