<?php

namespace App;

use Illuminate\Contracts\Container\Container as ContainerContract;
use Roots\Sage\Assets\JsonManifest;
use Roots\Sage\Config;
use Roots\Sage\Template\Blade;
use Roots\Sage\Template\BladeProvider;

/**
 * Disable WordPress admin bar
 */
show_admin_bar(false);

/**
 * Theme assets
 */
add_action( 'wp_enqueue_scripts', function () {
    global $wp_styles;

    if ( ! isset( $_COOKIE['theme'] ) ) {
        wp_enqueue_style( 'girfec/main.css', asset_path( 'styles/main.css' ), false, null );
    } else {
        wp_enqueue_style( 'girfec/main.css', asset_path( 'styles/' . $_COOKIE['theme'] . '.css' ), false, null );
    }

    wp_enqueue_script( 'girfec/main.js', asset_path( 'scripts/main.js' ), [ 'jquery', 'jquery-effects-core' ], null, true );

    $wp_styles->add_data( 'girfec/main.css', 'title', 'main-css' );
}, 100 );

/**
 * Theme setup
 */
add_action( 'after_setup_theme', function () {
    /**
     * Enable features from Soil when plugin is activated
     * @link https://roots.io/plugins/soil/
     */
    add_theme_support( 'soil-clean-up' );
    add_theme_support( 'soil-jquery-cdn' );
    add_theme_support( 'soil-nav-walker' );
    add_theme_support( 'soil-nice-search' );
    add_theme_support( 'soil-relative-urls' );

    /**
     * Enable plugins to manage the document title
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#title-tag
     */
    add_theme_support( 'title-tag' );

    /**
     * Register navigation menus
     * @link https://developer.wordpress.org/reference/functions/register_nav_menus/
     */
    register_nav_menus( [
        'top_navigation'     => __( 'Top Navigation', 'girfec' ),
        'primary_navigation' => __( 'Primary Navigation', 'girfec' ),
        'footer_navigation'  => __( 'Footer Navigation', 'girfec' ),
        'mobile_navigation'  => __( 'Mobile Navigation', 'girfec' ),
    ] );

    /**
     * Enable post thumbnails
     * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
     */
    add_theme_support( 'post-thumbnails' );

    add_image_size( 'girfec-thumbnail-xs', 480, 9999 );
    add_image_size( 'girfec-thumbnail-sm', 640, 9999 );
    add_image_size( 'girfec-thumbnail', 960, 9999 );
    add_image_size( 'girfec-thumbnail-md', 1600, 9999 );
    add_image_size( 'girfec-thumbnail-lg', 1920, 9999 );

    /**
     * Enable HTML5 markup support
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#html5
     */
    add_theme_support( 'html5', [ 'caption', 'comment-form', 'comment-list', 'gallery', 'search-form' ] );

    /**
     * Enable selective refresh for widgets in customizer
     * @link https://developer.wordpress.org/themes/advanced-topics/customizer-api/#theme-support-in-sidebars
     */
    add_theme_support( 'customize-selective-refresh-widgets' );

    /**
     * Use main stylesheet for visual editor
     * @see resources/assets/styles/layouts/_tinymce.scss
     */
    add_editor_style( asset_path( 'styles/main.css' ) );
}, 20 );

/**
 * Updates the `$post` variable on each iteration of the loop.
 * Note: updated value is only available for subsequently loaded views, such as partials
 */
add_action( 'the_post', function ( $post ) {
    sage( 'blade' )->share( 'post', $post );
} );

/**
 * Setup Sage options
 */
add_action('after_setup_theme', function () {
    /**
     * Sage config
     */
    $paths = [
        'dir.stylesheet' => get_stylesheet_directory(),
        'dir.template'   => get_template_directory(),
        'dir.upload'     => wp_upload_dir()['basedir'],
        'uri.stylesheet' => get_stylesheet_directory_uri(),
        'uri.template'   => get_template_directory_uri(),
    ];
    $viewPaths = collect(preg_replace('%[\/]?(resources/views)?[\/.]*?$%', '', [STYLESHEETPATH, TEMPLATEPATH]))
        ->flatMap(function ($path) {
            return ["{$path}/resources/views", $path];
        })->unique()->toArray();

    config([
        'assets.manifest' => "{$paths['dir.stylesheet']}/../dist/assets.json",
        'assets.uri'      => "{$paths['uri.stylesheet']}/dist",
        'view.compiled'   => "{$paths['dir.upload']}/cache/compiled",
        'view.namespaces' => ['App' => WP_CONTENT_DIR],
        'view.paths'      => $viewPaths,
    ] + $paths);

    /**
     * Add JsonManifest to Sage container
     */
    sage()->singleton( 'sage.assets', function () {
        return new JsonManifest( config( 'assets.manifest' ), config( 'assets.uri' ) );
    } );

    /**
     * Add Blade to Sage container
     */
    sage()->singleton( 'sage.blade', function ( ContainerContract $app ) {
        $cachePath = config( 'view.compiled' );
        if ( ! file_exists( $cachePath ) ) {
            wp_mkdir_p( $cachePath );
        }
        ( new BladeProvider( $app ) )->register();
        return new Blade( $app['view'], $app );
    });

    /**
     * Create @asset() Blade directive
     */
    sage( 'blade' )->compiler()->directive( 'asset', function ( $asset ) {
        return "<?= App\\asset_path({$asset}); ?>";
    } );
});

/**
 * Init config
 */
sage()->bindIf( 'config', Config::class, true );
