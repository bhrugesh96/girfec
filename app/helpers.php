<?php

namespace App;

use Roots\Sage\Container;
use Illuminate\Contracts\Container\Container as ContainerContract;

/**
 * Get the sage container.
 *
 * @param string $abstract
 * @param array $parameters
 * @param ContainerContract $container
 *
 * @return ContainerContract|mixed
 * @SuppressWarnings(PHPMD.StaticAccess)
 */
function sage( $abstract = null, $parameters = [], ContainerContract $container = null ) {
    $container = $container ?: Container::getInstance();
    if ( ! $abstract ) {
        return $container;
    }

    return $container->bound( $abstract )
        ? $container->makeWith( $abstract, $parameters )
        : $container->makeWith( "sage.{$abstract}", $parameters );
}

/**
 * Get / set the specified configuration value.
 *
 * If an array is passed as the key, we will assume you want to set an array of values.
 *
 * @param array|string $key
 * @param mixed $default
 *
 * @return mixed|\Roots\Sage\Config
 * @copyright Taylor Otwell
 * @link https://github.com/laravel/framework/blob/c0970285/src/Illuminate/Foundation/helpers.php#L254-L265
 */
function config( $key = null, $default = null ) {
    if ( is_null( $key ) ) {
        return sage( 'config' );
    }
    if ( is_array( $key ) ) {
        return sage( 'config' )->set( $key );
    }

    return sage( 'config' )->get( $key, $default );
}

/**
 * @param string $file
 * @param array $data
 *
 * @return string
 */
function template( $file, $data = [] ) {
    return sage( 'blade' )->render( $file, $data );
}

/**
 * Retrieve path to a compiled blade view
 *
 * @param $file
 * @param array $data
 *
 * @return string
 */
function template_path( $file, $data = [] ) {
    return sage( 'blade' )->compiledPath( $file, $data );
}

/**
 * @param $asset
 *
 * @return string
 */
function asset_path( $asset ) {
    return sage( 'assets' )->getUri( $asset );
}

/**
 * Determine whether to show the sidebar
 * @return bool
 */
function display_sidebar() {
    static $display;
    isset( $display ) || $display = apply_filters( 'sage/display_sidebar', true );

    return $display;
}

/**
 * Page titles
 * @return string
 */
function title() {
    if ( is_home() ) {
        if ( $home = get_option( 'page_for_posts', true ) ) {
            return get_the_title( $home );
        }

        return __( 'Latest Posts', 'girfec' );
    }
    if ( is_archive() ) {
        return get_the_archive_title();
    }
    if ( is_search() ) {
        return sprintf( __( 'Search Results for %s', 'girfec' ), get_search_query() );
    }
    if ( is_404() ) {
        return __( 'Not Found', 'girfec' );
    }

    return get_the_title();
}

/**
 * Prints the button markup
 *
 * @param array $args
 *
 * @copyright wpcoders
 * @return string|void
 */
function the_wpc_button( $args ) {

    if ( empty( $args['data'] ) || ( empty( $args['data']['label'] ) && empty( $args['data']['icon'] ) ) ) {
        return;
    }

    $defaults = array(
        'data'    => null,
        'classes' => array( 'btn' )
    );

    $args = wp_parse_args( $args, $defaults );

    switch ( $args['data']['link_type'] ) {
        case 'file':
            $href = $args['data']['file']['url'];
            break;
        case 'anchor':
            $href = $args['data']['anchor'];
            break;
        default:
            $href = $args['data'][ $args['data']['link_type'] . '_link' ];
    }

    $label             = ! empty ( $args['data']['label'] ) ? $args['data']['label'] : '';
    $args['classes'][] = 'type-' . $args['data']['link_type'];

    if ( 'anchor' === $args['data']['link_type'] ) {
        $args['classes'][] = 'scroll-to';
    }

    if ( ! empty ( $args['data']['label'] ) ) {
        $args['classes'][] = 'has-label';
    }

    if ( ! empty ( $args['data']['icon'] ) ) {
        $args['classes'][] = 'has-icon';
    }
    ?>

    <a href="<?= $href; ?>"
       title="<?= $label; ?>"
       class="<?= implode( ' ', $args['classes'] ); ?>"
       <?php if ( 'file' === $args['data']['link_type'] ) : ?>download<?php endif; ?>
       <?php if ( $args['data']['open_in_new_window'] ) : ?>target="_blank" rel="nofollow"<?php endif; ?>>

        <?php if ( ! empty( $args['data']['icon'] ) ) : ?>
            <i class="<?= $args['data']['icon']; ?>"></i>
        <?php endif; ?>

        <?= $args['data']['label']; ?>
    </a>
    <?php
}

/**
 * Retrieve the button markup
 */
function get_the_wpc_button( $args ) {
    ob_start();
    the_wpc_button( $args );

    return ob_get_clean();
}

/**
 * Retrieve the button link
 *
 * @param array $args
 *
 * @return string
 */
function get_the_wpc_button_link( $args ) {
    return $args[ $args['link_type'] . '_link' ];
}

/**
 * Retrieve responsive image markup
 * @return string
 */
function get_responsive_attachment( $attachment_id, $size = 'medium', $class = null, $sizes = null ) {
    $attr_img_src    = wp_get_attachment_image_url( $attachment_id, $size );
    $attr_img_srcset = wp_get_attachment_image_srcset( $attachment_id, $size );
    $attr_sizes      = empty( $sizes ) ? wp_get_attachment_image_sizes( $attachment_id, $size ) : $sizes;

    if ( ! empty( $sizes ) && defined( $sizes ) ) {
        $attr_sizes = constant( $sizes );
    }

    return "<img class='{$class}' src='" . esc_url( $attr_img_src ) . "' sizes='" . esc_attr( $attr_sizes ) . "' srcset='" . esc_attr( $attr_img_srcset ) . "' title='" . get_the_title( $attachment_id ) . "' alt='" . get_post_meta( $attachment_id, '_wp_attachment_image_alt', true ) . "' />";
}

/**
 * Retrieve event category color
 *
 * @param $event_id
 *
 * @return string
 */
function get_event_cat_color( $event_id ) {

    $terms = get_the_terms( $event_id, 'tribe_events_cat' );

    if ( ! empty( $terms ) ) {
        $term = array_pop( $terms );

        return get_field( 'category_color', $term ) ? get_field( 'category_color', $term ) : '#5db903';
    }

    return '#5db903';
}

/**
 * Generate floating graphics based on settings
 */
function the_floating_elements( $elements ) {

    if ( empty( $elements ) ) {
        return;
    }

    foreach ( $elements as $element ) {

        the_floating_element( $element['floating_element'] );
    }
}

function the_floating_element( $args ) {

    if ( empty( $args['element']['url'] ) ) {
        return;
    }

    $width             = ! empty( $args['width'] ) ? $args['width'] : 200;
    $vpos              = ! empty( $args['position_vertical'] ) ? $args['position_vertical'] : 'bottom';
    $hpos              = ! empty( $args['position_horizontal'] ) ? $args['position_horizontal'] : 'right';
    $offset_helper     = ! empty( $args['offset_helper'] ) ? $args['offset_helper'] : 'disabled';
    $visibility        = ! empty( $args['visibility'] ) ? $args['visibility'] : 'visible';
    $offset_horizontal = ! empty( $args['offset_horizontal'] ) ? $args['offset_horizontal'] : 0;
    $offset_vertical   = ! empty( $args['offset_vertical'] ) ? $args['offset_vertical'] : 0;

    $classes = [
        'floating-element',
        'vpos-' . $vpos,
        'hpos-' . $hpos,
        'offset-helper-' . $offset_helper,
        $visibility,
    ];

    $offset = '-webkit-transform: translate(' . $offset_horizontal . '%, ' . $offset_vertical . '%);';
    $offset .= '-ms-transform: translate(' . $offset_horizontal . '%, ' . $offset_vertical . '%);';
    $offset .= 'transform: translate(' . $offset_horizontal . '%, ' . $offset_vertical . '%);';
    ?>

    <div class="<?= implode( ' ', $classes ); ?>" style="width: <?= $width; ?>px">
        <figure class="floating-element-inner" style="width: <?= $width; ?>px">
            <img src="<?= $args['element']['url']; ?>" alt="<?= $args['element']['alt']; ?>"
                 style="<?= $offset; ?>" class="img-fluid"/>
        </figure>
    </div>

    <?php
}
