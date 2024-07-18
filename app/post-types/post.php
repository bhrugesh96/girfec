<?php namespace Girfec\PostTypes\Post;

/**
 * Overwrite post type labels
 */
add_filter( 'wpc_get_the_post_type_label', function ( $label, $attr, $post_type ) {

    if ( $post_type === 'post' ) {

        switch ( $attr ) {
            case 'singular_name':
                return __( 'Article', 'girfec' );
                break;
            case 'name':
                return __( 'Articles', 'girfec' );
                break;
        }
    }

    return $label;
}, 10, 3 );
