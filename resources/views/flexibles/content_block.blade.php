@php
  $fields = [
    'layout_id' => get_sub_field( 'layout_id' ) ? get_sub_field( 'layout_id' ) : uniqid( get_row_layout() . '-' ),
    'overflow' => ( get_sub_field( 'overflow' ) === 'hidden' ) ? 'overflow-hidden' : '',
    'title' => get_sub_field( 'title' ),
    'text' => get_sub_field( 'text' ),
    'buttons' => get_sub_field( 'buttons' ),
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

<section id="{{ $fields['layout_id'] }}" class="{{ implode( ' ', $classes ) }}">
  <div class="container">
    @if( ! empty( $fields['title'] ) )
      <h3 class="cb-title">{{ $fields['title'] }}</h3>
    @endif

    @if( ! empty( $fields['text'] ) )
      <div class="cb-text">{!! $fields['text'] !!}</div>
    @endif

    @if( ! empty( $fields['buttons'] ) )
      <div class="cb-buttons">
        @foreach( $fields['buttons'] as $button )
        {!! \App\the_wpc_button([
          'data' => $button['button'],
          'classes' => ['btn', 'btn-success']
        ]) !!}
        @endforeach
      </div>
    @endif
  </div>

  {!! \App\the_floating_elements( $fields['floating_elements'] ) !!}
</section>
