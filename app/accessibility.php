<?php namespace App;

/**
 * Custom Default Pages
 */
add_filter( 'wpc_default_pages_custom_pages', function ( $custom_def_pages ) {

    return array_merge( $custom_def_pages, array(
        'accessibility' => __( 'Accessibility Page', 'girfec' ),
        'screen_reader' => __( 'Screen Reader Page', 'girfec' ),
    ) );
} );
