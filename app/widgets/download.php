<?php namespace Girfec\Widgets\Download;

add_action( 'widgets_init', function () {
    register_widget( __NAMESPACE__ . '\\Girfec_Widget_Download' );
} );

class Girfec_Widget_Download extends \WP_Widget {

    public function __construct() {
        $widget_ops = [
            'classname'                   => 'widget_girfec widget_girfec_download',
            'description'                 => __( 'File download widget.' ),
            'customize_selective_refresh' => true,
        ];

        parent::__construct( 'widget_girfec_download', __( 'Girfec: Download', 'girfec' ), $widget_ops );
        $this->alt_option_name = 'widget_girfec_download';

        add_action( 'save_post', [ &$this, 'flush_widget_cache' ] );
        add_action( 'deleted_post', [ &$this, 'flush_widget_cache' ] );
        add_action( 'switch_theme', [ &$this, 'flush_widget_cache' ] );
    }

    public function widget( $args, $instance ) {
        $cache = wp_cache_get( 'widget_girfec_download', 'widget' );
        $wid   = "widget_" . $args['widget_id'];

        if ( ! is_array( $cache ) ) {
            $cache = [];
        }

        if ( ! isset( $args['widget_id'] ) ) {
            $args['widget_id'] = $this->id;
        }

        if ( isset( $cache[ $args['widget_id'] ] ) ) {
            echo $cache[ $args['widget_id'] ];

            return;
        }

        $title = get_field( 'title', $wid );
        $file  = get_field( 'file', $wid );
        $icon  = get_field( 'icon', $wid );

        if ( empty( $title ) || empty( $file ) || empty( $icon ) ) {
            return;
        }

        ob_start();

        echo $args['before_widget'];
        ?>
        <a class="widget-inner bg-primary" href="<?= $file['url']; ?>" title="<?= $title; ?>" download>
            <h3 class="wgd-title"><?= $title; ?></h3>
            <i class="wgd-icon <?= $icon; ?>" aria-hidden="true"></i>
        </a>
        <?php
        echo $args['after_widget'];

        $cache[ $args['widget_id'] ] = ob_get_flush();
        wp_cache_set( 'widget_girfec_download', $cache, 'widget' );
    }

    public function update( $new_instance, $old_instance ) {
        $instance = array();

        return $instance;
    }

    public function form( $instance ) {
        ?>

        <p></p>

        <?php
    }

    public function flush_widget_cache() {
        wp_cache_delete( 'widget_girfec_download', 'widget' );
    }
}
