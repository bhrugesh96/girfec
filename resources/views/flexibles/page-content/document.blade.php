@php
  $fields = [
    'layout_id' => get_sub_field( 'layout_id' ) ? get_sub_field( 'layout_id' ) : uniqid( get_row_layout() . '-' ),
    'title' => get_sub_field( 'title' ),
    'icon' => get_sub_field( 'icon' ),
    'file' => get_sub_field( 'file' ),
  ];
@endphp

@if( ! empty( $fields['file'] ) )
  <section id="{{ $fields['layout_id'] }}" class="content-layout-item {{ get_row_layout() }}">
    <div class="file">
      <i class="{{ $fields['icon'] }}"></i>
      <h4 class="file-title">{{ $fields['title'] }}</h4>
      <a class="btn btn-sm btn-success" href="{{ $fields['file'] }}" download title="{{ __( 'Download', 'girfec' ) }}">
        {{ __( 'Download', 'girfec' ) }}
      </a>
    </div>
  </section>
@endif
