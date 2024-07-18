@php
  $fields = [
    'layout_id' => get_sub_field( 'layout_id' ) ? get_sub_field( 'layout_id' ) : uniqid( get_row_layout() . '-' ),
    'links' => get_sub_field( 'links' ),
  ];
@endphp

@if( ! empty( $fields['links'] ) )
  <section id="{{ $fields['layout_id'] }}" class="content-layout-item {{ get_row_layout() }}">
    <ul class="list-unstyled">
      @foreach( $fields['links'] as $link )
        @if( ! empty( $link['link'] ) )
          <li>
            @if( ! empty( $link['link']['title'] ) )
              <h3 class="lead">{{ $link['link']['title'] }}</h3>
            @endif

            @if( ! empty( $link['link']['url'] ) )
              <a href="{{ $link['link']['url'] }}" title="{{ $link['link']['url'] }}" target="{{ $link['link']['target'] }}">
                {{ $link['link']['url'] }}
              </a>
            @endif
          </li>
        @endif
      @endforeach
    </ul>
  </section>
@endif
