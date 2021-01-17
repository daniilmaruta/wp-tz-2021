<?php
/**
 * Class TZ_Init
 * Theme setup and initialisation
 */
class TZ_Init {

	public function __construct() {
		add_action( 'init', [ $this, 'register_post_type_realty' ] );
	}

	/**
	 * Register new custom post type Realty
	 */
	function register_post_type_realty() {

		/**
		 * Post Type: Realty.
		 */

		$labels = array(
			'name'          => __( 'Realty', 'understrap-child' ),
			'singular_name' => __( 'Realty', 'understrap-child' ),
			'all_items'     => __( 'All Realty', 'understrap-child' ),
			'add_new'       => __( 'Add New Realty', 'understrap-child' ),
			'add_new_item'  => __( 'Add New Realty', 'understrap-child' ),
			'edit_item'     => __( 'Edit Realty', 'understrap-child' ),
			'new_item'      => __( 'New Realty', 'understrap-child' ),
			'view_item'     => __( 'View Realty', 'understrap-child' ),
			'view_items'    => __( 'View Realty', 'understrap-child' ),
		);

		$args = array(
			'label'               => '',
			'labels'              => $labels,
			'description'         => '',
			'public'              => true,
			'publicly_queryable'  => true,
			'show_ui'             => true,
			'show_in_rest'        => false,
			'rest_base'           => '',
			'has_archive'         => false,
			'show_in_menu'        => true,
			'show_in_nav_menus'   => true,
			'exclude_from_search' => false,
			'capability_type'     => 'post',
			'map_meta_cap'        => true,
			'hierarchical'        => false,
			'rewrite'             => array( 'slug' => 'realty', 'with_front' => true ),
			'query_var'           => true,
			'menu_icon'           => 'dashicons-admin-home',
			'supports'            => array( 'title', 'editor' ),
		);

		register_post_type( 'realty', $args );
	}

}

new TZ_Init();
