<?php

/**
 * Do not edit anything in this file unless you know what you're doing
 */

/**
 * Helper function for prettying up errors
 *
 * @param string $message
 * @param string $subtitle
 * @param string $title
 */
$sage_error = function ( $message, $subtitle = '', $title = '' ) {
    $title   = $title ?: __( 'Sage &rsaquo; Error', 'girfec' );
    $footer  = '<a href="https://roots.io/sage/docs/">roots.io/sage/docs/</a>';
    $message = "<h1>{$title}<br><small>{$subtitle}</small></h1><p>{$message}</p><p>{$footer}</p>";
    wp_die( $message, $title );
};

/**
 * Ensure compatible version of PHP is used
 */
if ( version_compare( '5.6.4', phpversion(), '>=' ) ) {
    $sage_error( __( 'You must be using PHP 5.6.4 or greater.', 'girfec' ), __( 'Invalid PHP version', 'girfec' ) );
}

/**
 * Ensure compatible version of WordPress is used
 */
if ( version_compare( '4.7.0', get_bloginfo( 'version' ), '>=' ) ) {
    $sage_error( __( 'You must be using WordPress 4.7.0 or greater.', 'girfec' ), __( 'Invalid WordPress version', 'girfec' ) );
}

/**
 * Ensure dependencies are loaded
 */
if ( ! class_exists( 'Roots\\Sage\\Container' ) ) {
    if ( ! file_exists( $composer = __DIR__ . '/../vendor/autoload.php' ) ) {
        $sage_error(
            __( 'You must run <code>composer install</code> from the Sage directory.', 'girfec' ),
            __( 'Autoloader not found.', 'girfec' )
        );
    }
    require_once $composer;
}

/**
 * Sage required files
 *
 * The mapped array determines the code library included in your theme.
 * Add or remove files to the array as needed. Supports child theme overrides.
 */
array_map( function ( $file ) use ( $sage_error ) {
    $file = "../app/{$file}.php";
    if ( ! locate_template( $file, true, true ) ) {
        $sage_error( sprintf( __( 'Error locating <code>%s</code> for inclusion.', 'girfec' ), $file ), 'File not found' );
    }
}, [
    'sidebars',
    'helpers',
    'setup',
    'filters',
    'admin',
    'intranet',
    'accessibility',
    //Post Types
    'post-types/post',
    'post-types/document',
    //Widgets
    'widgets/download',
    'widgets/page-links',
    //Plugins
    'plugins/advanced-custom-fields',
    'plugins/yoast-seo',
    'plugins/events-calendar',
    'plugins/roots-share-buttons',
    'plugins/gravity-forms',
] );

/**
 * Here's what's happening with these hooks:
 * 1. WordPress initially detects theme in themes/sage/resources
 * 2. Upon activation, we tell WordPress that the theme is actually in themes/sage/resources/views
 * 3. When we call get_template_directory() or get_template_directory_uri(), we point it back to themes/sage/resources
 *
 * We do this so that the Template Hierarchy will look in themes/sage/resources/views for core WordPress themes
 * But functions.php, style.css, and index.php are all still located in themes/sage/resources
 *
 * This is not compatible with the WordPress Customizer theme preview prior to theme activation
 *
 * get_template_directory()   -> /srv/www/example.com/current/web/app/themes/sage/resources
 * get_stylesheet_directory() -> /srv/www/example.com/current/web/app/themes/sage/resources
 * locate_template()
 * ├── STYLESHEETPATH         -> /srv/www/example.com/current/web/app/themes/sage/resources/views
 * └── TEMPLATEPATH           -> /srv/www/example.com/current/web/app/themes/sage/resources
 */
if ( is_customize_preview() && isset( $_GET['theme'] ) ) {
    $sage_error( __( 'Theme must be activated prior to using the customizer.', 'girfec' ) );
}
$sage_views = basename( dirname( __DIR__ ) ) . '/' . basename( __DIR__ ) . '/views';
add_filter( 'stylesheet', function () use ( $sage_views ) {
    return dirname( $sage_views );
} );
add_filter( 'stylesheet_directory_uri', function ( $uri ) {
    return dirname( $uri );
} );
if ( $sage_views !== get_option( 'stylesheet' ) ) {
    update_option( 'stylesheet', $sage_views );
    if ( php_sapi_name() === 'cli' ) {
        return;
    }
    wp_redirect( $_SERVER['REQUEST_URI'] );
    exit();
}
