@php
  $fields = [
    'layout_id' => get_sub_field( 'layout_id' ) ? get_sub_field( 'layout_id' ) : uniqid( get_row_layout() . '-' ),
    'overflow' => ( get_sub_field( 'overflow' ) === 'hidden' ) ? 'overflow-hidden' : '',
    'title' => get_sub_field( 'title' ),
    'text' => get_sub_field( 'text' ),
    'contact_blocks' => get_sub_field( 'contact_blocks' ),
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

@if( ! empty( $fields['contact_blocks'] ) )
  <section id="{{ $fields['layout_id'] }}" class="{{ implode( ' ', $classes ) }}">
    <div class="container">
      @if( ! empty( $fields['title'] ) )
        <h3 class="cd-title">{!! $fields['title'] !!}</h3>
      @endif

      @if( ! empty( $fields['text'] ) )
        <div class="cd-text">{!! $fields['text'] !!}</div>
      @endif

      <div class="cd-contact-blocks row">
      @foreach( $fields['contact_blocks'] as $contact_block )
        <div class="cd-contact-block col">
          @if( ! empty( $contact_block['title'] ) )
            <h4 class="cd-contact-block-title">{{ $contact_block['title'] }}</h4>
          @endif

          @if( ! empty( $contact_block['title'] ) )
            <h5 class="cd-contact-block-contact">{{ $contact_block['contact'] }}</h5>
          @endif

          @if( ! empty( $contact_block['email'] ) )
            <p class="cd-contact-block-email">
              <span>{{ __('E.', 'girfec') }}</span> <a href="mailto:{{ $contact_block['email'] }}" title="{{ __('Email us', 'girfec') }}" rel="nofollow" target="_blank">{{ $contact_block['email'] }}</a>
            </p>
          @endif

          @if( ! empty( $contact_block['phone'] ) )
            <p class="cd-contact-block-phone">
              <span>{{ __('T.', 'girfec') }}</span> <a href="tel:{{ $contact_block['phone'] }}" title="{{ __('Call us', 'girfec') }}" rel="nofollow" target="_blank">{{ $contact_block['phone'] }}</a>
            </p>
          @endif

          @if( ! empty( $contact_block['address'] ) )
            <p class="cd-contact-block-address">
              <span>{{ __('A.', 'girfec') }}</span> {!! $contact_block['address'] !!}
            </p>
          @endif
        </div>
      @endforeach
      </div>
    </div>

    {!! \App\the_floating_elements( $fields['floating_elements'] ) !!}
  </section>
@endif
