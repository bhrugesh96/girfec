<?php namespace WPCoders\Sidebars;

class WPCodersSidebars {

    /**
     * Stores the sidebars
     */
    private $sidebars = array();

    /**
     * The default config
     */
    private $config = array();

    /**
     * The single instance of the class.
     */
    protected static $_instance = null;

    /**
     * SmarterSidebars Instance.
     * Ensures only one instance of SmarterSidebars is loaded or can be loaded.
     */
    public static function instance() {
        if ( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }

    /**
     * Initialize the class and set its properties.
     */
    public function __construct() {

        // Bail if no ACF enabled
        if ( ! function_exists( 'have_rows' ) ) {
            return;
        }

        $this->register_options_page();
        $this->register_options_page_fields();
        $this->set_config();
        $this->set_default_sidebars();

        add_action( 'widgets_init', array( $this, 'widgets_init' ) );
    }

    /**
     * Set sidebars config
     */
    private function set_config() {

        $this->config = array(
            'before_widget' => '<section class="widget %1$s %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>'
        );
    }

    /**
     * Get sidebars config
     */
    public function get_config() {

        return $this->config;
    }

    /**
     * Add default sidebars
     */
    private function set_default_sidebars() {

        $this->sidebars = array(
            array(
                'name' => __( 'Primary', 'girfec' ),
                'id'   => 'sidebar-primary'
            ) + $this->get_config(),
            array(
                'name' => __( 'News', 'girfec' ),
                'id'   => 'sidebar-news'
            ) + $this->get_config(),
        );
    }

    /**
     * Get SmarterSidebars for ACF
     */
    public function get_sidebars() {

        $sidebars = array();

        foreach ( $this->sidebars as $sidebar ) {
            $sidebars[ $sidebar["id"] ] = $sidebar["name"];
        }

        return $sidebars;
    }

    /**
     * Register sidebars
     */
    public function widgets_init() {

        if ( have_rows( 'sidebars', 'option' ) ) {
            while ( have_rows( 'sidebars', 'option' ) ) {

                the_row();

                array_push( $this->sidebars,
                    array(
                        'name' => get_sub_field( "name" ),
                        'id'   => "sidebar-" . sanitize_title( get_sub_field( "name" ) ),
                    ) + $this->get_config()
                );
            }
        }

        foreach ( $this->sidebars as $sidebar ) {
            register_sidebar( $sidebar );
        }
    }

    /**
     * Register sidebars option page
     */
    private function register_options_page() {
        if ( function_exists( 'acf_add_options_sub_page' ) ) {
            acf_add_options_sub_page( array(
                'page_title'  => 'Sidebar Settings',
                'menu_title'  => 'Sidebars',
                'parent_slug' => 'themes.php',
            ) );
        }
    }

    /**
     * Sidebar option page fields
     */
    private function register_options_page_fields() {
        if ( function_exists( 'acf_add_local_field_group' ) ) :

            acf_add_local_field_group( array(
                'key'                   => 'group_558207db70drt',
                'title'                 => 'Theme Settings: Sidebars',
                'fields'                => array(
                    array(
                        'key'               => 'field_558207e6707e2',
                        'label'             => 'Sidebars',
                        'name'              => 'sidebars',
                        'type'              => 'repeater',
                        'instructions'      => '',
                        'required'          => 0,
                        'conditional_logic' => 0,
                        'wrapper'           => array(
                            'width' => '',
                            'class' => '',
                            'id'    => '',
                        ),
                        'collapsed'         => '',
                        'min'               => '',
                        'max'               => '',
                        'layout'            => 'table',
                        'button_label'      => 'Add Sidebar',
                        'sub_fields'        => array(
                            array(
                                'key'               => 'field_558207fb707e4',
                                'label'             => 'Name',
                                'name'              => 'name',
                                'type'              => 'text',
                                'instructions'      => '',
                                'required'          => 0,
                                'conditional_logic' => 0,
                                'wrapper'           => array(
                                    'width' => 100,
                                    'class' => '',
                                    'id'    => '',
                                ),
                                'default_value'     => '',
                                'placeholder'       => '',
                                'prepend'           => '',
                                'append'            => '',
                                'maxlength'         => '',
                                'readonly'          => 0,
                                'disabled'          => 0,
                            ),
                        ),
                    ),
                ),
                'location'              => array(
                    array(
                        array(
                            'param'    => 'options_page',
                            'operator' => '==',
                            'value'    => 'acf-options-sidebars',
                        ),
                    ),
                ),
                'menu_order'            => 0,
                'position'              => 'normal',
                'style'                 => 'default',
                'label_placement'       => 'top',
                'instruction_placement' => 'label',
                'hide_on_screen'        => '',
                'active'                => 1,
                'description'           => '',
            ) );

        endif;
    }
}

WPCodersSidebars::instance();
