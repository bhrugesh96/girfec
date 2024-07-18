@php
  $fields = [
    'layout_id' => get_sub_field( 'layout_id' ) ? get_sub_field( 'layout_id' ) : uniqid( get_row_layout() . '-' ),
    'images_per_row' => get_sub_field( 'images_per_row' ) ? get_sub_field( 'images_per_row' ) : 'one',
  ];
  $sizes = [
    'one'   => 'large',
    'two'   => 'girfec-thumbnail-sm',
    'three' => 'girfec-thumbnail-xs',
  ];
@endphp

@if( have_rows( 'image_grid_' . $fields['images_per_row'] ) )
  <section id="{{ $fields['layout_id'] }}" class="content-layout-item image_grid image-grid-{{ $fields['images_per_row'] }}">
      @while ( have_rows( 'image_grid_' . $fields['images_per_row'] ) ) @php( the_row() )
        @if ( ! empty( $img = get_sub_field( 'image' ) ) )
        <figure class="image-grid-item">
          <a class="image-grid-image" href="{{ $img['url'] }}" title="{{ $img['title'] }}">
            {!! \App\get_responsive_attachment( $img['id'], $sizes[ $fields['images_per_row'] ] ) !!}
          </a>

          @if( array_key_exists( 'caption', $img ) && $img['caption'] !== '' )
            <figcaption>
              {!! $img['caption'] !!}
            </figcaption>
          @endif
        </figure>
        @endif
      @endwhile
  </section>
@endif

