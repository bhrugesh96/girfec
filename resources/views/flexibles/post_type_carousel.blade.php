@php
  global $post;

  $fields = [
    'layout_id' => get_sub_field( 'layout_id' ) ? get_sub_field( 'layout_id' ) : uniqid( get_row_layout() . '-' ),
    'overflow' => ( get_sub_field( 'overflow' ) === 'hidden' ) ? 'overflow-hidden' : '',
    'title' => get_sub_field( 'title' ),
    'text' => get_sub_field( 'text' ),
    'load_posts' => get_sub_field( 'load_posts' ),
    'read_more_text' => get_sub_field( 'read_more_text' ),
    'post_type' => get_sub_field( 'post_type' ) ? get_sub_field( 'post_type' ) : 'post',
    'posts_to_show' => get_sub_field( 'posts_to_show' ),
    'orderby' => get_sub_field( 'orderby' ),
    'order' => get_sub_field( 'order' ),
    'posts' => get_sub_field( 'posts' ),
    'floating_elements' => get_sub_field( 'floating_elements' ),
  ];

  $args = [
    'post_type' => $fields['post_type'],
    'post_status' => 'publish',
    'order' => $fields['order'],
    'orderby' => $fields['orderby'],
    'posts_per_page' => $fields['posts_to_show'],
  ];

  if( $fields['load_posts'] === 'manual' && ! empty( $fields['posts'] ) ) {
    $args['post_type'] = 'any';
    $args['orderby'] = 'post__in';
    $args['post__in'] = wp_list_pluck( $fields['posts'], 'post' );
    $args['posts_per_page'] = -1;
  }

  if ( empty( $fields['read_more_text'] ) ) {
    if ( empty( $fields['post_type'] ) ) {
      $fields['read_more_text'] = __( 'Read More', 'girfec' );
    } else {
      $fields['read_more_text'] = sprintf( __( 'Read %s', 'girfec' ), wpc_get_the_post_type_label( 'singular_name' ) );
    }
  }

  $posts = get_posts($args);

	$classes = [
	  'layout-item',
	  get_row_layout(),
	  $fields['overflow'],
	];

	if( ! empty( $fields['floating_elements'] ) ) {
	  $classes[] = 'has-floating-element';
	}
@endphp

@if( ! empty( $posts ) )
  <section id="{{ $fields['layout_id'] }}" class="{{ implode( ' ', $classes ) }}">
    <div class="container">
      @if( ! empty( $fields['title'] ) )
        <h3 class="ptc-title">{!! $fields['title'] !!}</h3>
      @endif

      @if( ! empty( $fields['text'] ) )
        <div class="ptc-text">{!! $fields['text'] !!}</div>
      @endif

      <div class="ptc-posts row">
        @foreach( $posts as $post ) @php(setup_postdata($post))
          <div class="col">
            <div class="ptc-post">
              @if( ! empty( $post_thumbnail = get_field( 'thumbnail' ) ) )
                <figure class="ptc-post-thumbnail">
                  <a href="{{ get_the_permalink() }}" title="{{ get_the_title() }}">
                    {!! \App\get_responsive_attachment( $post_thumbnail['id'], 'large' ) !!}
                  </a>
                </figure>
              @endif

              @if( ! empty( $post_title = get_the_title() ) )
                <h3 class="ptc-post-title">{{ $post_title }}</h3>
              @endif

              @if( ! empty( $extra_field = apply_filters( 'girfec_ptc_post_extra_field', get_the_date( '', $post ), $post ) ) )
                <h4 class="ptc-post-extra-field">{{ $extra_field }}</h4>
              @endif

              @if( ! empty( $post_excerpt = get_field( 'excerpt' ) ) )
                <div class="ptc-post-text">{!! $post_excerpt !!}</div>
              @endif

                <a class="btn btn-success" href="{{ get_the_permalink() }}" title="{{ $fields['read_more_text'] }}" role="button">
                  {{ $fields['read_more_text'] }}
                </a>
            </div>
          </div>
        @endforeach
      </div>
      @php( wp_reset_postdata() )
    </div>

    {!! \App\the_floating_elements( $fields['floating_elements'] ) !!}
  </section>
@endif
