@php
  $fields = [
    'layout_id' => get_sub_field( 'layout_id' ) ? get_sub_field( 'layout_id' ) : uniqid( get_row_layout() . '-' ),
    'benefits' => get_sub_field( 'benefits' ),
  ];
@endphp

@if( ! empty( $fields['benefits'] ) )
  <section id="{{ $fields['layout_id'] }}" class="content-layout-item {{ get_row_layout() }}">
    <ul class="benefits">
      @foreach( $fields['benefits'] as $benefit )
        <li class="benefit">
          <i class="benefit-icon {{ $benefit['icon'] }}"></i>

          <div class="benefit-text rlpm">
            @if( ! empty( $benefit['title'] ) )
              <h4>{{ $benefit['title'] }}</h4>
            @endif

            {{ $benefit['text'] }}
          </div>
        </li>
      @endforeach
    </ul>
  </section>
@endif
