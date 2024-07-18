@php
  $fields = [
    'layout_id' => get_sub_field( 'layout_id' ) ? get_sub_field( 'layout_id' ) : uniqid( get_row_layout() . '-' ),
    'overflow' => ( get_sub_field( 'overflow' ) === 'hidden' ) ? 'overflow-hidden' : '',
    'title' => get_sub_field( 'title' ),
    'text' => get_sub_field( 'text' ),
    'button' => get_sub_field( 'button' ),
    'benefits' => get_sub_field( 'benefits' ),
    'cta_title' => get_sub_field( 'cta_title' ),
    'cta_text' => get_sub_field( 'cta_text' ),
    'cta_button' => get_sub_field( 'cta_button' ),
    'cta_image' => get_sub_field( 'cta_image' ),
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

@if( ! empty( $fields['benefits'] ) && ! empty( $fields['text'] ) )
  <section id="{{ $fields['layout_id'] }}" class="{{ implode( ' ', $classes ) }}">
    <div class="container">
      <div class="row">
        <div class="col-md-7 col-lg-8">
          @if( ! empty( $fields['title'] ) )
            <h3 class="wig-title">{!! $fields['title'] !!}</h3>
          @endif

          @if( ! empty( $fields['text'] ) )
            <div class="wig-text">{!! $fields['text'] !!}</div>
          @endif

          @if( ! empty( $fields['benefits'] ) )
              <ul class="wig-benefits">
                @foreach( $fields['benefits'] as $benefit )
                  <li class="wig-benefit">
                    <i class="wig-benefit-icon {{ $benefit['icon'] }}"></i>

                    @if( ! empty( $benefit['title'] ) )
                      <div class="wig-benefit-title rlpm">
                        <p>{{ $benefit['title'] }}</p>
                      </div>
                    @endif
                  </li>
                @endforeach
              </ul>
          @endif

          @if( ! empty( $fields['button'] ) )
            {!! \App\the_wpc_button([
              'data' => $fields['button'],
              'classes' => ['btn', 'btn-blue-dark', 'wig-button']
            ]) !!}
          @endif
        </div>

        <div class="col-md-5 col-lg-4">
          <div class="wig-cta">
            @if( ! empty( $fields['cta_image'] ) )
              <figure class="wig-cta-thumbnail">
                <a href="{{ \App\get_the_wpc_button_link( $fields['cta_button'] ) }}" title="{{ $fields['cta_title'] }}">
                  {!! \App\get_responsive_attachment( $fields['cta_image']['id'], 'large' ) !!}
                </a>
              </figure>
            @endif

            @if( ! empty( $fields['cta_title'] ) )
              <h3 class="wig-cta-title">{{ $fields['cta_title'] }}</h3>
            @endif

            @if( ! empty( $fields['cta_text'] ) )
              <div class="wig-cta-text">{!! $fields['cta_text'] !!}</div>
            @endif

            @if( ! empty( $fields['cta_button'] ) )
              {!! \App\the_wpc_button([
                'data' => $fields['cta_button'],
                'classes' => ['btn', 'btn-primary']
              ]) !!}
            @endif
          </div>
        </div>
      </div>
    </div>

    {!! \App\the_floating_elements( $fields['floating_elements'] ) !!}
  </section>
@endif
