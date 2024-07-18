<?php namespace Girfec\Plugins\EventsCalendar;

/**
 * Remove import/export button
 */
use function App\get_event_cat_color;

add_filter( 'tribe_events_list_show_ical_link', '__return_false' );

/**
 * Shorten events calendar title
 */
add_filter( 'tribe_get_events_title', function ( $title ) {
    return str_replace( 'Events for ', '', $title );
} );

/**
 * Return default page id on single events
 */
add_filter( 'wpc_get_the_id', function ( $id ) {

    if ( is_singular( 'tribe_events' ) ) {
        return wpc_get_default_page_id( 'tribe_events' );
    }

    return $id;
} );

/**
 * Add category select to events calendar filter bar
 */
add_filter( 'tribe-events-bar-filters', function ( $filters ) {

    if ( isset( $filters['tribe-bar-search'] ) ) {
        unset( $filters['tribe-bar-search'] );
    }

    $cats      = get_terms( 'tribe_events_cat' );
    $event_cat = isset( $_REQUEST['tribe-bar-cat'] ) ? $_REQUEST['tribe-bar-cat'] : false;

    if ( is_tax( 'tribe_events_cat' ) ) {
        $event_cat = get_queried_object();
        $event_cat = $event_cat->slug;
    }

    if ( is_array( $filters ) && ! empty( $cats ) ) {

        $html = '<select class="custom-select" name="tribe-bar-cat" id="tribe-bar-cat">';
        $html .= '<option value="0">' . __( 'Show all', 'girfec' ) . '</option>';

        foreach ( $cats as $cat ) {
            if ( ! empty( $event_cat ) && $event_cat === $cat->slug ) {
                $html .= '<option value="' . $cat->slug . '" selected="selected">' . $cat->name . '</option>';
            } else {
                $html .= '<option value="' . $cat->slug . '">' . $cat->name . '</option>';
            }
        }

        $html .= '</select>';

        $filters['tribe-bar-cat'] = [
            'name'    => 'tribe-bar-cat',
            'caption' => __( 'Filter events', 'girfec' ),
            'html'    => $html,
        ];
    }

    return $filters;
} );

/**
 * Filter events based on category
 */
add_action( 'pre_get_posts', function ( $query ) {

    if ( $query->tribe_is_event || $query->tribe_is_event_category ) {

        if ( ! empty( $_REQUEST['tribe-bar-cat'] ) && $_REQUEST['tribe-bar-cat'] != '0' ) {

            $tax_query = [
                'taxonomy' => 'tribe_events_cat',
                'field' => 'slug',
                'terms' => $_REQUEST['tribe-bar-cat'],
            ];

            if ( empty( $temp = $query->get( 'tax_query' ) ) ) {
                $query->set( 'tax_query', [ $tax_query ] );
            } else {
                $temp[] = $tax_query;
                $query->set( 'tax_query', temp );
            }

            do_action( 'log', 'changed tax_query to tribe-bar-cat', 'tribe-events-query', $_REQUEST['tribe-bar-cat'] );
        }
    }
} );
