@php
  $fields = [
    'layout_id' => get_sub_field( 'layout_id' ) ? get_sub_field( 'layout_id' ) : uniqid( get_row_layout() . '-' ),
    'overflow' => ( get_sub_field( 'overflow' ) === 'hidden' ) ? 'overflow-hidden' : '',
    'title' => get_sub_field( 'title' ),
    'text' => get_sub_field( 'text' ),
    'form' => get_sub_field( 'form' ),
    'background_color' => get_sub_field( 'background_color' ),
    'floating_elements' => get_sub_field( 'floating_elements' ),
  ];

	$classes = [
	  'layout-item',
	  get_row_layout(),
	  $fields['background_color'],
	  $fields['overflow'],
	];

	if( ! empty( $fields['floating_elements'] ) ) {
	  $classes[] = 'has-floating-element';
	}
@endphp

@if( ! empty( $fields['form'] ) )
  <section id="{{ $fields['layout_id'] }}" class="{{ implode( ' ', $classes ) }}">
    <div class="container">
      @if( ! empty( $fields['title'] ) )
        <div class="form-title">{!! $fields['title'] !!}</div>
      @endif

      @if( ! empty( $fields['text'] ) )
        <div class="form-text">{!! $fields['text'] !!}</div>
      @endif

      <div class="form-wrap">
      @php
        gravity_form( $fields['form']['id'], false, false, false, '', true, 1 );
      @endphp
      </div>
    </div>

    {!! \App\the_floating_elements( $fields['floating_elements'] ) !!}
  </section>
@endif
