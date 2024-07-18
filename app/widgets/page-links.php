<?php namespace Girfec\Widgets\PageLinks;

add_action( 'widgets_init', function () {
    register_widget( __NAMESPACE__ . '\\Girfec_Widget_Page_Links' );
} );

class Girfec_Widget_Page_Links extends \WP_Widget {

    public function __construct() {
        $widget_ops = [
            'classname'                   => 'widget_girfec widget_girfec_page_links',
            'description'                 => __( 'Page Links widget.' ),
            'customize_selective_refresh' => true,
        ];

        parent::__construct( 'widget_girfec_page_links', __( 'Girfec: Page Links', 'girfec' ), $widget_ops );
        $this->alt_option_name = 'widget_girfec_page_links';

        add_action( 'save_post', [ &$this, 'flush_widget_cache' ] );
        add_action( 'deleted_post', [ &$this, 'flush_widget_cache' ] );
        add_action( 'switch_theme', [ &$this, 'flush_widget_cache' ] );
    }

    public function widget( $args, $instance ) {
        $cache = wp_cache_get( 'widget_girfec_page_links', 'widget' );
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

        $title      = get_field( 'title', $wid );
        $page_links = get_field( 'page_links', $wid );
        $footnote   = get_field( 'footnote', $wid );

        if ( empty( $page_links ) ) {
            return;
        }

        ob_start();

        echo $args['before_widget'];
        ?>
        <div class="widget-inner bg-gray-darkest">
            <h3 class="wgpl-title"><?= $title; ?></h3>

            <ul class="wgpl-links list-unstyled">
                <?php foreach ( $page_links as $page_link ): $page_link = $page_link['link']; ?>
                    <?php if ( ! empty( $page_link['url'] ) && ! empty( $page_link['title'] ) ): ?>
                        <li class="wgpl-links-item">
                            <a href="<?= $page_link['url']; ?>" class="wgpl-link" title="<?= $page_link['title']; ?>"
                               target="<?= $page_link['target']; ?>">
                                <?= $page_link['title']; ?>
                            </a>
                        </li>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>

            <?php if ( ! empty( $footnote ) ): ?>
                <p class="wgpl-footnote mb-0"><?= $footnote; ?></p>
            <?php endif; ?>
        </div>
        <?php
        echo $args['after_widget'];

        $cache[ $args['widget_id'] ] = ob_get_flush();
        wp_cache_set( 'widget_girfec_page_links', $cache, 'widget' );
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
        wp_cache_delete( 'widget_girfec_page_links', 'widget' );
    }
}
