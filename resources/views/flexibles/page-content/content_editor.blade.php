@php
  $fields = [
    'layout_id' => get_sub_field( 'layout_id' ) ? get_sub_field( 'layout_id' ) : uniqid( get_row_layout() . '-' ),
    'text' => get_sub_field( 'text' ),
  ];
@endphp

@if( ! empty( $fields['text'] ) )
<section id="{{ $fields['layout_id'] }}" class="content-layout-item {{ get_row_layout() }}">
  <div class="cb-text">{!! $fields['text'] !!}</div>
</section>
@endif
