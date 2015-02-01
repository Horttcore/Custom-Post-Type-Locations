<?php
/**
 *
 *  Custom Post Type Location
 *
 */
final class Custom_Post_Type_Location
{



	/**
	 * Plugin constructor
	 *
	 * @access public
	 * @return void
	 * @since v0.4
	 * @author Ralf Hortt
	 **/
	public function __construct()
	{

		add_action( 'init', array( $this, 'register_post_type' ) );
		add_action( 'plugins_loaded', array( $this, 'load_plugin_textdomain' ) );
		add_action( 'widgets_init', array( $this, 'widgets_init' ) );

	} // END __construct



	/**
	 * Load plugin translation
	 *
	 * @access public
	 * @return void
	 * @author Ralf Hortt <me@horttcore.de>
	 * @since v0.4
	 **/
	public function load_plugin_textdomain()
	{

		load_plugin_textdomain( 'custom-post-type-locations', false, dirname( plugin_basename( __FILE__ ) ) . '/../languages/'  );

	} // END load_plugin_textdomain



	/**
	 * Register post type
	 *
	 * @access public
	 * @return void
	 * @since v0.4
	 * @author Ralf Hortt
	 */
	public function register_post_type()
	{

		register_post_type( 'location', array(
			'labels' => array(
				'name' => _x( 'Locations', 'post type general name', 'custom-post-type-locations' ),
				'singular_name' => _x( 'Location', 'post type singular name', 'custom-post-type-locations' ),
				'add_new' => _x( 'Add New', 'Location', 'custom-post-type-locations' ),
				'add_new_item' => __( 'Add New Location', 'custom-post-type-locations' ),
				'edit_item' => __( 'Edit Location', 'custom-post-type-locations' ),
				'new_item' => __( 'New Location', 'custom-post-type-locations' ),
				'view_item' => __( 'View Location', 'custom-post-type-locations' ),
				'search_items' => __( 'Search Location', 'custom-post-type-locations' ),
				'not_found' =>  __( 'No Location found', 'custom-post-type-locations' ),
				'not_found_in_trash' => __( 'No Location found in Trash', 'custom-post-type-locations' ),
				'parent_item_colon' => '',
				'menu_name' => __( 'Locations', 'custom-post-type-locations' )
			),
			'public' => TRUE,
			'publicly_queryable' => TRUE,
			'show_ui' => TRUE,
			'show_in_menu' => TRUE,
			'show_in_nav_menus' => TRUE,
			'query_var' => TRUE,
			'rewrite' => array( 'slug' => _x( 'locations', 'Post Type Slug', 'custom-post-type-locations' ) ),
			'capability_type' => 'post',
			'has_archive' => TRUE,
			'hierarchical' => FALSE,
			'menu_position' => NULL,
			'menu_icon' => 'dashicons-location',
			'supports' => array( 'title', 'editor', 'thumbnail', 'page-attributes' )
		));

	} // END register_post_type



	/**
	 * Register widget
	 *
	 * @access public
	 * @return void
	 * @since v0.4
	 * @author Ralf Hortt
	 **/
	public function widgets_init()
	{

		register_widget( 'Custom_Post_Type_Locations_Widget' );

	} // END widgets_init




} // END final class Custom_Post_Type_Location

new Custom_Post_Type_Location;
