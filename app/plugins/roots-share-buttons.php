<?php

/**
 * Custom [share] shortcode template
 */
add_filter( 'roots/share_template', function () {
    return \App\template_path( get_template_directory() . '/views/partials/share.blade.php' );
} );

/**
 * Remove Roots Share Buttons assets
 */
add_action( 'wp_enqueue_scripts', function () {
    wp_dequeue_style( 'roots-share-buttons' );
} );
