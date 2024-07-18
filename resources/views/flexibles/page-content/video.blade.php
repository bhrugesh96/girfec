@php
  $fields = [
    'layout_id' => get_sub_field( 'layout_id' ) ? get_sub_field( 'layout_id' ) : uniqid( get_row_layout() . '-' ),
    'video_url' => get_sub_field( 'video_url' ),
    'thumbnail' => get_sub_field( 'thumbnail' ),
    'caption' => get_sub_field( 'caption' ),
  ];
@endphp

@if( ! empty( $fields['video_url'] ) )
  <section id="{{ $fields['layout_id'] }}" class="content-layout-item {{ get_row_layout() }}">
      @if( ! empty( $fields['thumbnail'] ) )
      <figure class="video-thumbnail">
        <a class="video-toggle" href="{{ $fields['video_url'] }}" title="{{ __( 'Play Video', 'girfec' ) }}">
          {!! \App\get_responsive_attachment( $fields['thumbnail']['id'], 'girfec-thumbnail-md' ) !!}
        </a>
        @if( ! empty( $fields['caption'] ) )
          <figcaption>{!! $fields['caption'] !!}</figcaption>
        @endif
      </figure>
      @endif
  </section>
@endif
