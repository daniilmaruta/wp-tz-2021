<?php
namespace TZ\Realty;

/**
 * Class TZ_Init
 * Theme setup and initialisation
 */
class Init {

	public function __construct() {
		add_action( 'init', [ $this, 'register_post_type_realty' ] );
		add_action( 'init', [ $this, 'register_taxonomy_types_realty' ] );
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
			'taxonomies'          => array( 'type_realty' ),
		);

		register_post_type( 'realty', $args );
	}

	/**
	 * Register new custom taxonomy Types Realty
	 */
	function register_taxonomy_types_realty() {

		/**
		 * Taxonomy: Types Realty.
		 */

		$labels = array(
			'name'          => __( 'Types Realty', 'understrap-child' ),
			'singular_name' => __( 'Type realty', 'understrap-child' ),
		);

		$args = array(
			'label'              => '',
			'labels'             => $labels,
			'public'             => true,
			'hierarchical'       => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'show_in_nav_menus'  => true,
			'query_var'          => true,
			'rewrite'            => array( 'slug' => 'type_realty', 'with_front' => true, ),
			'show_admin_column'  => false,
			'show_in_rest'       => false,
			'rest_base'          => 'type_realty',
			'show_in_quick_edit' => false,
		);

		register_taxonomy( 'type_realty', array( 'realty' ), $args );
	}

}

new Init();
