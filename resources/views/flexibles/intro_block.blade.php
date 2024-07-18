@php
  $fields = [
    'layout_id' => get_sub_field( 'layout_id' ) ? get_sub_field( 'layout_id' ) : uniqid( get_row_layout() . '-' ),
    'overflow' => ( get_sub_field( 'overflow' ) === 'hidden' ) ? 'overflow-hidden' : '',
    'title' => get_sub_field( 'title' ),
    'text' => get_sub_field( 'text' ),
    'pages' => get_sub_field( 'pages' ),
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

@if( ! empty( $fields['pages'] ) )
  <section id="{{ $fields['layout_id'] }}" class="layout-item {{ implode( ' ', $classes ) }}">
    <div class="container">
      @if( ! empty( $fields['title'] ) )
        <h3 class="ib-title">{!! $fields['title'] !!}</h3>
      @endif

      @if( ! empty( $fields['text'] ) )
        <div class="ib-text">{!! $fields['text'] !!}</div>
      @endif

      <div class="ib-pages row">
      @foreach( $fields['pages'] as $page )
        <div class="ib-page col">
          <div class="ib-page-inner">
            <a href="{{ $page['link'] }}" title="{{ $page['title']  }}" style="background-color: {{ $page['color']  }}">
              {!! \App\the_floating_elements( $page['floating_elements'] ) !!}

              @if( ! empty( $page['title'] ) )
                <h4 class="ib-page-title">{!! $page['title'] !!}</h4>
              @endif
            </a>
          </div>
        </div>
      @endforeach
      </div>
    </div>

    {!! \App\the_floating_elements( $fields['floating_elements'] ) !!}
  </section>
@endif
