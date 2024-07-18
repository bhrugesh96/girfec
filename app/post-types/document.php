<?php namespace Girfec\PostTypes\Document;

/**
 * Register Document Post Type
 */
add_action( 'init', function () {

    $labels = array(
        'name'                  => _x( 'Documents', 'Post Type General Name', 'girfec' ),
        'singular_name'         => _x( 'Document', 'Post Type Singular Name', 'girfec' ),
        'menu_name'             => __( 'Documents', 'girfec' ),
        'name_admin_bar'        => __( 'Documents', 'girfec' ),
        'archives'              => __( 'Document Archives', 'girfec' ),
        'attributes'            => __( 'Document Attributes', 'girfec' ),
        'parent_item_colon'     => __( 'Parent Document:', 'girfec' ),
        'all_items'             => __( 'All Documents', 'girfec' ),
        'add_new_item'          => __( 'Add New Document', 'girfec' ),
        'add_new'               => __( 'Add New', 'girfec' ),
        'new_item'              => __( 'New Document', 'girfec' ),
        'edit_item'             => __( 'Edit Document', 'girfec' ),
        'update_item'           => __( 'Update Document', 'girfec' ),
        'view_item'             => __( 'View Document', 'girfec' ),
        'view_items'            => __( 'View Documents', 'girfec' ),
        'search_items'          => __( 'Search Document', 'girfec' ),
        'not_found'             => __( 'Not found', 'girfec' ),
        'not_found_in_trash'    => __( 'Not found in Trash', 'girfec' ),
        'featured_image'        => __( 'Featured Image', 'girfec' ),
        'set_featured_image'    => __( 'Set featured image', 'girfec' ),
        'remove_featured_image' => __( 'Remove featured image', 'girfec' ),
        'use_featured_image'    => __( 'Use as featured image', 'girfec' ),
        'insert_into_item'      => __( 'Insert into document', 'girfec' ),
        'uploaded_to_this_item' => __( 'Uploaded to this document', 'girfec' ),
        'items_list'            => __( 'Documents list', 'girfec' ),
        'items_list_navigation' => __( 'Documents list navigation', 'girfec' ),
        'filter_items_list'     => __( 'Filter documents list', 'girfec' ),
    );

    $default_page_id = wpc_get_default_page_id( 'girfec_document' );

    $rewrite = array(
        'slug'       => empty( $default_page_id ) ? 'documents' : get_page_uri( $default_page_id ),
        'with_front' => false,
        'pages'      => true,
        'feeds'      => false,
    );

    $args = array(
        'label'               => __( 'Document', 'girfec' ),
        'description'         => __( 'Document post for Girfec theme.', 'girfec' ),
        'labels'              => $labels,
        'supports'            => array( 'title', 'author', 'revisions', ),
        'taxonomies'          => array(),
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'menu_position'       => 20,
        'menu_icon'           => 'dashicons-welcome-add-page',
        'show_in_admin_bar'   => false,
        'show_in_nav_menus'   => false,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => true,
        'publicly_queryable'  => true,
        'rewrite'             => $rewrite,
        'capability_type'     => 'post',
        'show_in_rest'        => false,
    );

    register_post_type( 'girfec_document', $args );

}, 0 );

/**
 * Return default page id on document singles
 */
add_filter( 'wpc_get_the_id', function ( $id ) {

    if ( is_singular( 'girfec_document' ) ) {
        return wpc_get_default_page_id( 'girfec_document' );
    }

    return $id;
} );
