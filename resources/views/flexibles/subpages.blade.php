@php
  $fields = [
    'layout_id' => get_sub_field( 'layout_id' ) ? get_sub_field( 'layout_id' ) : uniqid( get_row_layout() . '-' ),
    'overflow' => ( get_sub_field( 'overflow' ) === 'hidden' ) ? 'overflow-hidden' : '',
    'subpages' => get_sub_field( 'subpages' ),
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

@if( ! empty( $fields['subpages'] ) )
  <section id="{{ $fields['layout_id'] }}" class="{{ implode( ' ', $classes ) }}">
    <div class="container">
      <div class="subpages row justify-content-center">
        @foreach( $fields['subpages'] as $subpage )
          <div class="col-md-6 d-flex align-content-md-stretch">
            <div class="subpage">
              @if( ! empty( $subpage['image'] ) )
                <figure class="subpage-thumbnail">
                  <a href="{{ \App\get_the_wpc_button_link( $subpage['button'] ) }}" title="{{ $subpage['title'] }}">
                    {!! \App\get_responsive_attachment( $subpage['image']['id'], 'large' ) !!}
                  </a>
                </figure>
              @endif

              <div class="subpage-inner">
                <div class="subpage-inner-left">
                  @if( ! empty( $subpage['title'] ) )
                    <h3 class="subpage-title">{{ $subpage['title'] }}</h3>
                  @endif

                  @if( ! empty( $subpage['text'] ) )
                    <div class="subpage-text">{!! $subpage['text'] !!}</div>
                  @endif

                  @if( ! empty( $subpage['button'] ) )
                    {!! \App\the_wpc_button([
                      'data' => $subpage['button'],
                      'classes' => ['btn', 'btn-success']
                    ]) !!}
                  @endif
                </div>

                <div class="subpage-inner-right">
                  @if( ! empty( $subpage['content_image'] ) )
                    <figure class="subpage-image mb-0" style="width: {{ ! empty( $subpage['content_image_width'] ) ? $subpage['content_image_width'] : '100' }}px">
                      <img src="{{ $subpage['content_image']['url'] }}" alt="{{ $subpage['content_image']['alt'] }}"
                           style="width: {{ ! empty( $subpage['content_image_width']) ? $subpage['content_image_width'] : '100' }}px" />
                    </figure>
                  @endif
                </div>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    </div>

    {!! \App\the_floating_elements( $fields['floating_elements'] ) !!}
  </section>
@endif
