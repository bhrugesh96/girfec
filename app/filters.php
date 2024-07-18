<?php

namespace App;

/**
 * Add <body> classes
 */
add_filter('body_class', function (array $classes) {
    /** Add page slug if it doesn't exist */
    if (is_single() || is_page() && !is_front_page()) {
        if (!in_array(basename(get_permalink()), $classes)) {
            $classes[] = basename(get_permalink());
        }
    }

    /** Add class if sidebar is active */
    if (display_sidebar()) {
        $classes[] = 'sidebar-primary';
    }

    /** Clean up class names for custom templates */
    $classes = array_map(function ($class) {
        return preg_replace(['/-blade(-php)?$/', '/^page-template-views/'], '', $class);
    }, $classes);

    /** Font size */
    if(isset($_COOKIE['font'])) {
        $classes[] = $_COOKIE['font'];
    } else {
        $classes[] = 'font-default';
    }

    /** Mobile class */
    if(wp_is_mobile()) {
        $classes[] = 'is-mobile';
    }

    return array_filter($classes);
});

/**
 * Add "… Continued" to the excerpt
 */
add_filter('excerpt_more', function () {
    return ' &hellip;';
});

/**
 * Template Hierarchy should search for .blade.php files
 */
collect([
    'index', '404', 'archive', 'author', 'category', 'tag', 'taxonomy', 'date', 'home',
    'frontpage', 'page', 'paged', 'search', 'single', 'singular', 'attachment'
])->map(function ($type) {
    add_filter("{$type}_template_hierarchy", function ($templates) {
        return collect($templates)->flatMap(function ($template) {
            $transforms = [
                '%^/?(resources[\\/]views)?[\\/]?%' => '',
                '%(\.blade)?(\.php)?$%' => ''
            ];
            $normalizedTemplate = preg_replace(array_keys($transforms), array_values($transforms), $template);
            return ["{$normalizedTemplate}.blade.php", "{$normalizedTemplate}.php"];
        })->toArray();
    });
});

/**
 * Render page using Blade
 */
add_filter('template_include', function ($template) {
    $data = collect(get_body_class())->reduce(function ($data, $class) use ($template) {
        return apply_filters("sage/template/{$class}/data", $data, $template);
    }, []);
    echo template($template, $data);
    // Return a blank file to make WordPress happy
    return get_theme_file_path('index.php');
}, PHP_INT_MAX);

/**
 * Tell WordPress how to find the compiled path of comments.blade.php
 */
add_filter('comments_template', 'App\\template_path');

/**
 * Allow 1920 images in srcset
 */
add_filter( 'max_srcset_image_width', function ( $max_width, $size_array ) {
    return 1920;
}, 10, 2 );

/**
 * Determine which pages should NOT display the sidebar
 * @link https://codex.wordpress.org/Conditional_Tags
 */
add_filter( 'sage/display_sidebar', function ( $display ) {
    // The sidebar will NOT be displayed if ANY of the following return true
    return $display ? ! in_array( true, [
        is_404(),
        is_front_page(),
        'disabled' === get_field( 'sidebar_status', wpc_get_the_id() ),
        is_page_template( ['views/template-events.blade.php', 'views/template-full-width.blade.php', 'views/template-intranet.blade.php'] ),
        is_singular( 'tribe_events' ),
        is_post_type_archive( 'tribe_events' ),
    ] ) : $display;
} );

/**
 * Nav menu css classes
 */
add_filter( 'nav_menu_css_class', function ( $classes, $item ) {

    if ( ! empty( $item->object_id ) ) {
        if ( $item->object_id == wpc_get_default_page_id( 'post' ) && ! is_home() && ! is_singular('post') && ! is_tax() && ! is_category() ) {

            foreach ( $classes as $key => $class ) {

                if ( $class === 'active' ) {
                    unset( $classes[ $key ] );
                }
            }
        }
    }

    return $classes;
}, 99, 2 );
