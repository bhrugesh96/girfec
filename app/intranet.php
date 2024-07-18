<?php namespace App;

/**
 * Define Intranet Page options
 */
add_filter( 'wpc_default_pages_custom_pages', function ( $custom_pages ) {
    return array_merge( $custom_pages, array( 'intranet' => __( 'Intranet', 'girfec' ) ) );
} );

/**
 * Force Intranet template for intranet pages
 */
add_filter( 'template_include', function ( $template ) {

    if ( is_page( get_intranet_page( 'post_name' ) ) ) {
        $new_template = locate_template( array( 'template-intranet.blade.php' ) );
        if ( '' != $new_template ) {
            return $new_template;
        }
    }

    return $template;
}, 99 );

/**
 * Add <body> classes
 */
add_filter( 'body_class', function ( array $classes ) {

    if ( is_page( get_intranet_page( 'post_name' ) ) ) {
        $classes[] = 'template-intranet';
    }

    return array_filter( $classes );
} );

/**
 * Retrieve intranet page object
 */
function get_intranet_page( $attr = null ) {

    $intranet_page = wpc_get_default_page( 'intranet' );

    if ( ! empty( $attr ) && ! empty( $intranet_page->$attr ) ) {
        return $intranet_page->$attr;
    } else {
        return $intranet_page;
    }
}

/**
 * Redirect visitors to login page
 */
add_action( 'template_redirect', function () {

    if ( ! is_user_logged_in() && is_intranet_page() ) {
        $redirect_url = get_intranet_page_link();
        $redirect_url .= '?redirect=' . urlencode( get_the_permalink() );

        wp_redirect( $redirect_url );

        exit;
    }

} );

/**
 * Retrieve intranet page id
 */
function get_intranet_page_id() {
    return get_intranet_page( 'ID' );
}

/**
 * Retrieve intranet page url
 */
function get_intranet_page_link() {
    return get_the_permalink( get_intranet_page_id() );
}

/**
 * Check if page is child of intranet page
 */
function is_intranet_page( $post_id = null ) {

    if ( empty( $post_id ) ) {
        $post_id = get_the_ID();
    }

    $post = get_post( $post_id );

    if ( ! empty( $post ) ) {

        if ( $post->post_parent === get_intranet_page_id() ) {
            return true;
        }

        $post_ancestors = get_post_ancestors( $post );

        if ( ! empty( $post_ancestors ) && $post_ancestors[ count( $post_ancestors ) - 1 ] === get_intranet_page_id() ) {
            return true;
        }
    }

    return false;
}
