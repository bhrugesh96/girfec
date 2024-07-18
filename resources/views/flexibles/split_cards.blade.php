@php
  $fields = [
    'layout_id' => get_sub_field( 'layout_id' ) ? get_sub_field( 'layout_id' ) : uniqid( get_row_layout() . '-' ),
    'overflow' => ( get_sub_field( 'overflow' ) === 'hidden' ) ? 'overflow-hidden' : '',
    'cards' => get_sub_field( 'cards' ),
    'floating_elements' => get_sub_field( 'floating_elements' ),
  ];

  $classes = [
    'layout-item',
    get_row_layout(),
    $fields['overflow'],
  ];

  if( ! empty( $fields['floating_elements'] ) ) {
    $classes[] = 'has-floating-element';
  }
@endphp

@if( ! empty( $fields['cards'] ) )
  <section id="{{ $fields['layout_id'] }}" class="{{ implode( ' ', $classes ) }}">
    <div class="container">
      <div class="sc-cards row">
        @foreach( $fields['cards'] as $card )
          <div class="col">
            <div class="sc-card">
              @if( ! empty( $card['image'] ) )
                <figure class="sc-card-thumbnail">
                  <a href="{{ \App\get_the_wpc_button_link( $card['button'] ) }}" title="{{ $card['title'] }}">
                    {!! \App\get_responsive_attachment( $card['image']['id'], 'large' ) !!}
                  </a>
                </figure>
              @endif

              @if( ! empty( $card['title'] ) )
                <h3 class="sc-card-title">{{ $card['title'] }}</h3>
              @endif

              @if( ! empty( $card['text'] ) )
                <div class="sc-card-text">{!! $card['text'] !!}</div>
              @endif

              @if( ! empty( $card['button'] ) )
                {!! \App\the_wpc_button([
                  'data' => $card['button'],
                  'classes' => ['btn', 'btn-success']
                ]) !!}
              @endif
            </div>
          </div>
        @endforeach
      </div>
    </div>

    {!! \App\the_floating_elements( $fields['floating_elements'] ) !!}
  </section>
@endif
