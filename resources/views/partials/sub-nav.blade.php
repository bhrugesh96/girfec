@php
  global $post, $wp_query, $post;
  $post_id = wpc_get_the_id();

  $post = get_post($post_id);
  $post_ancestors = get_post_ancestors( $post );
  $post_children = get_pages( "child_of=" . $post_id . "&sort_column=menu_order" );

  if( empty( $post_ancestors ) && empty( $post_children ) ) {
    return;
  }

  setup_postdata($post);

  if( empty( $post_ancestors ) || \App\is_intranet_page() ) {
    $parent_id = $post_id;
  } else {
    $parent_id = $post_ancestors[count($post_ancestors) - 1];
  }

  if ( \App\is_intranet_page() && (count($post_ancestors) > 1) ) {
    $parent_id = $post_ancestors[count($post_ancestors) - 2];
  }

  $uniqid       = uniqid( 'sub-nav-' );

  $wp_query = null;
  $args     = array(
    'post_type'      => array( 'page' ),
    'orderby'        => 'menu_order',
    'order'          => 'ASC',
    'posts_per_page' => - 1,
    'post_parent'    => $parent_id
  );
  $wp_query = new WP_Query();
  $wp_query->query( $args );
@endphp

@if( $wp_query->have_posts() )
  <section class="sub-nav sub-nav-main">

    <h4 class="sub-nav-title">{{ get_the_title( $parent_id ) }}</h4>

    <div class="card card-default card-responsive">
      <h4 class="card-header" role="tab">
        <a class="collapsed" href="#{{ $uniqid }}" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="{{ $uniqid }}">
          @if( $post_id === $parent_id )
            {{ __('Introduction', 'girfec') }}
          @elseif ( ! empty( $post_ancestors ) && $post_ancestors[0] === get_the_ID() )
            {{ get_the_title( $post_ancestors[0] ) }}
          @else
            {{ get_the_title( $post_id ) }}
          @endif

          <button type="button" class="btn card-toggle">
            <span class="sr-only">{{ __( 'Open Navigation', 'girfec' ) }}</span>
            <i></i>
          </button>
        </a>
      </h4>
      <div id="{{ $uniqid }}" class="dropdown-content card-collapse collapse">
        <div class="card-block">
          <div class="sub-nav-inner">
            <ul class="nav flex-column">
              <li class="nav-item {{ $post_id === $parent_id ? 'active' : '' }}">
                <a class="nav-link" href="{{ get_the_permalink($parent_id) }}" title="{{ __('Introduction', 'girfec') }}">
                  {{ __('Introduction', 'girfec') }}
                </a>
              </li>

              @while( $wp_query->have_posts() )  @php( $wp_query->the_post() )
              <li class="nav-item {{ ( $post_id === get_the_ID() ) || ( ! empty( $post_ancestors ) && $post_ancestors[0] === get_the_ID() ) ? 'active' : '' }}">
                <a class="nav-link" href="{{ get_the_permalink() }}" title="{{ get_the_title() }}">
                  {{ get_the_title() }}
                </a>
              </li>
              @endwhile
            </ul>
          </div>
        </div>
      </div>
    </div>
  </section>
@endif

@php( wp_reset_query() )
@php( wp_reset_postdata() )
