@php
  $fields = [
    'layout_id' => get_sub_field( 'layout_id' ) ? get_sub_field( 'layout_id' ) : uniqid( get_row_layout() . '-' ),
    'title' => get_sub_field( 'title' ),
    'margin_top' => empty( get_sub_field( 'margin_top' ) ) || is_array( get_sub_field( 'margin_top' ) ) ? 'mt-0' : get_sub_field( 'margin_top' ),
    'margin_bottom' => empty( get_sub_field( 'margin_bottom' ) ) || is_array( get_sub_field( 'margin_bottom' ) ) ? 'mb-3' : get_sub_field( 'margin_bottom' ),
  ];

  $classes = [
    'content-layout-item',
    get_row_layout(),
    $fields['margin_top'],
    $fields['margin_bottom'],
  ];
@endphp

@if( ! empty( $fields['title'] ) )
  <section id="{{ $fields['layout_id'] }}" class="{{ implode(' ', $classes) }}">
    <h2 class="pt-title">{!! $fields['title'] !!}</h2>
  </section>
@endif
