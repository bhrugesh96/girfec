@php
  $args = [];

  if( is_tax( 'tribe_events_cat' ) ) {
    $event_cat = get_queried_object();

    if( ! empty( $event_cat ) ) {
      $args['category'] = $event_cat->slug;
    }
  }

  $shortcode = new \Tribe__Events__Pro__Shortcodes__Tribe_Events( $args )
@endphp

{!! $shortcode->output() !!}
