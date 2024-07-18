@php
  $fields = [
    'layout_id' => get_sub_field( 'layout_id' ) ? get_sub_field( 'layout_id' ) : uniqid( get_row_layout() . '-' ),
    'lead' => get_sub_field( 'lead' ),
    'margin_top' => empty( get_sub_field( 'margin_top' ) ) || is_array( get_sub_field( 'margin_top' ) ) ? 'mt-0' : get_sub_field( 'margin_top' ),
    'margin_bottom' => empty( get_sub_field( 'margin_bottom' ) ) || is_array( get_sub_field( 'margin_bottom' ) ) ? 'mb-3' : get_sub_field( 'margin_bottom' ),
  ];

  $classes = [
    'content-layout-item',
    get_row_layout() . '_block',
    $fields['margin_top'],
    $fields['margin_bottom'],
  ];
@endphp

@if( ! empty( $fields['lead'] ) )
  <section id="{{ $fields['layout_id'] }}" class="{{ implode(' ', $classes) }}">
    <h3 class="lead">{!! $fields['lead'] !!}</h3>
  </section>
@endif
