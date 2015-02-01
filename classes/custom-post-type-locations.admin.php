<?php
/**
 *
 *  Custom Post Type Locations
 *
 */
final class Custom_Post_Type_Locations_Admin
{



	/**
	 * Plugin constructor
	 *
	 * @access public
	 * @return void
	 * @since v0.4
	 * @author Ralf Hortt <me@horttcore.de>
	 **/
	public function __construct()
	{

		add_action( 'add_meta_boxes', array( $this, 'add_meta_boxes' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ) );
		add_action( 'admin_print_styles-post.php', array( $this, 'admin_enqueue_styles' ), 1000 );
		add_action( 'admin_print_styles-post-new.php', array( $this, 'admin_enqueue_styles' ), 1000 );
		add_filter( 'manage_location_posts_columns' , array( $this, 'manage_location_posts_columns' ) );
		add_action( 'manage_location_posts_custom_column' , array($this,'manage_location_posts_custom_column'), 10, 2 );
		add_filter( 'post_updated_messages', array( $this, 'post_updated_messages' ) );
		add_action( 'save_post', array( $this, 'save_location' ) );
		add_action( 'save_post', array( $this, 'save_contact' ) );
		add_action( 'wp_ajax_get_location_lat_long', array( $this, 'ajax_get_location_lat_long' ) );

	} // END __construct



	/**
	 * Add meta boxes
	 *
	 * @access public
	 * @return void
	 * @since v0.4
	 * @author Ralf Hortt <me@horttcore.de>
	 **/
	public function add_meta_boxes()
	{

		add_meta_box( 'location', __( 'Location', 'custom-post-type-locations' ), array( $this, 'meta_box_location' ), 'location' );
		add_meta_box( 'location-contact', __( 'Contact', 'custom-post-type-locations' ), array( $this, 'meta_box_contact' ), 'location' );

	} // END add_meta_boxes



	/**
	 * Register scripts
	 *
	 * @access public
	 * @return void
	 * @since v0.4
	 * @author Ralf Hortt <me@horttcore.de>
	 **/
	public function admin_enqueue_scripts()
	{

		wp_register_script( 'custom-post-type-locations-admin', plugins_url( dirname( plugin_basename( __FILE__ ) ) . '/../scripts/custom-post-type-locations.admin.js' ), array( 'jquery' ), FALSE, TRUE );

	} // END admin_enqueue_scripts



	/**
	 * Register styles
	 *
	 * @access public
	 * @return void
	 * @since v0.4
	 * @author Ralf Hortt <me@horttcore.de>
	 **/
	public function admin_enqueue_styles()
	{

		wp_register_style( 'custom-post-type-locations-admin', plugins_url( dirname( plugin_basename( __FILE__ ) ) . '/css/custom-post-type-locations-admin.css' ) );
		wp_enqueue_style( 'custom-post-type-locations-admin' );

	} // END admin_enqueue_styles



	/**
	 * undocumented function
	 *
	 * @access public
	 * @return void
	 * @since v0.4
	 * @author Ralf Hortt <me@horttcore.de>
	 **/
	public function ajax_get_location_lat_long()
	{

		$latlong = $this->get_latitude_longitude( array(
			$_POST['street'],
			$_POST['streetnumber'],
			$_POST['zip'],
			$_POST['city'],
			$_POST['country'],
		) );

		die( json_encode( $latlong ) );

	} // END ajax_get_location_lat_long



	/**
	 * Get latitude/longitude
	 * @access public
	 * @param str/array $address Address
	 * @return array Latitude Longitude
	 * @since v0.4
	 * @author Ralf Hortt <me@horttcore.de>
	 */
	public function get_latitude_longitude( $address )
	{

		if ( is_array( $address ) )
			$address = implode( ' ', $address );

		$address = urlencode( strtolower( trim( $address ) ) );
		$url = 'http://maps.googleapis.com/maps/api/geocode/json?address=' . $address . '&sensor=false';
		$data = wp_remote_get( $url );
		$data = json_decode( $data['body'] );

		if ( isset($data->results[0]->geometry->location) ) :

			return array(
				'latitude' => $data->results[0]->geometry->location->lat,
				'longitude' => $data->results[0]->geometry->location->lng,
			);

		else :

			return array(
				'latitude' => '',
				'longitude' => '',
			);

		endif;

	} // END get_latitude_longitude



	/**
	 * Add management columns
	 *
	 * @access public
	 * @param str $column Column name
	 * @param int $post_id Post ID
	 * @return void
	 * @since v0.4
	 * @author Ralf Hortt <me@horttcore.de>
	 **/
	public function manage_location_posts_custom_column( $column, $post_id )
	{
		switch ( $column ) :

			case 'location' :
				$locations[] = get_location( $post_id, 'zip' ) . ' ' . get_location( $post_id, 'city' );
				$locations[] = get_location( $post_id, 'street' ) . ' ' . get_location( $post_id, 'streetnumber' );
				$locations[] = get_location( $post_id, 'country' );
				echo implode( '<br>', $locations );
				break;

			case 'phone' :
				echo get_location_contact( $post_id, 'phone' );
				break;

			case 'fax' :
				echo get_location_contact( $post_id, 'fax' );
				break;

			case 'email' :
				echo get_location_contact( $post_id, 'email' );
				break;

		endswitch;
	}



	/**
	 * Add management columns
	 *
	 * @access public
	 * @param array $columns Columns
	 * @return array
	 * @since v0.4
	 * @author Ralf Hortt <me@horttcore.de>
	 **/
	public function manage_location_posts_columns( $columns )
	{

		$columns['location'] = __( 'Location', 'custom-post-type-locations' );
		$columns['phone'] = __( 'Phone', 'custom-post-type-locations' );
		$columns['fax'] = __( 'Fax', 'custom-post-type-locations' );
		$columns['email'] = __( 'E-Mail', 'custom-post-type-locations' );

		return $columns;

	} // END manage_location_posts_columns



	/**
	 * Location info meta box
	 *
	 * @access public
	 * @param obj $post Post object
	 * @return void
	 * @since v0.4
	 * @author Ralf Hortt <me@horttcore.de>
	 **/
	public function meta_box_location( $post )
	{

		$location = get_location( $post->ID );

		wp_enqueue_script( 'custom-post-type-locations-admin' );

		?>

		<table class="form-table">

			<tr>
				<th><label for="location-street"><?php _e( 'Street', 'custom-post-type-locations' ); ?></label> / <label for="location-street-number"><?php _e( 'Nr.', 'custom-post-type-locations' ); ?></label></th>
				<td>
					<input type="text" class="regular-text" name="location-street" id="location-street" value="<?php if ( isset( $location['street'] ) ) echo $location['street'] ?>">
					<input type="text" class="regular-text" name="location-street-number" id="location-street-number" value="<?php if ( isset( $location['street-number'] ) ) echo $location['street-number'] ?>">
				</td>
			</tr>

			<tr>
				<th><?php _e( 'Addition to address', 'custom-post-type-locations' ) ?></th>
				<td>
					<input type="text" class="regular-text"  name="location-addition-to-address" id="location-addition-to-address" value="<?php if ( isset( $location['addition-to-address'] ) ) echo $location['addition-to-address'] ?>">
				</td>
			</tr>

			<tr>
				<th><label for="location-zip"><?php _e( 'ZIP', 'custom-post-type-locations' ); ?></label> / <label for="location-city"><?php _e( 'City', 'custom-post-type-locations' ); ?></label></th>
				<td>
					<input type="text" class="regular-text" name="location-zip" id="location-zip" value="<?php if ( isset( $location['zip'] ) ) echo $location['zip'] ?>">
					<input type="text" class="regular-text" name="location-city" id="location-city" value="<?php if ( isset( $location['city'] ) ) echo $location['city'] ?>">
				</td>
			</tr>

			<tr>
				<th><label for="location-country"><?php _e( 'Country', 'custom-post-type-locations'  ); ?></label></th>
				<td><input type="text" class="regular-text" name="location-country" id="location-country" value="<?php if ( isset( $location['country'] ) ) echo $location['country'] ?>" /></td>
			</tr>

			<tr>
				<th><label for="location-zip"><?php _e( 'Latitude', 'custom-post-type-locations' ); ?></label> / <label for="location-city"><?php _e( 'Longitude', 'custom-post-type-locations' ); ?></label></th>
				<td>
					<input type="text" class="regular-text" name="location-latitude" id="location-latitude" value="<?php if ( isset( $location['latitude'] ) ) echo $location['latitude'] ?>">
					<input type="text" class="regular-text" name="location-longitude" id="location-longitude" value="<?php if ( isset( $location['longitude'] ) ) echo $location['longitude'] ?>">
					<a href="#" class="button get-lat-long"><?php _e( 'Get by address', 'custom-post-type-locations' ) ?></a>
				</td>
			</tr>

		</table>

		<?php

		wp_nonce_field( 'save-location', 'location-nonce' );

	} // END meta_box_location



	/**
	 * Location info meta box
	 *
	 * @access public
	 * @param obj $post Post object
	 * @return void
	 * @since v0.4
	 * @author Ralf Hortt <me@horttcore.de>
	 **/
	public function meta_box_contact( $post )
	{

		?>

		<table class="form-table">

			<tr>
				<th><?php _e( 'Phone', 'custom-post-type-locations' ) ?></th>
				<td>
					<input type="text" class="regular-text"  name="location-phone" id="location-phone" value="<?php echo get_location_contact( $post->ID, 'phone' ) ?>">
				</td>
			</tr>

			<tr>
				<th><?php _e( 'Fax', 'custom-post-type-locations' ) ?></th>
				<td>
					<input type="text" class="regular-text"  name="location-fax" id="location-fax" value="<?php echo get_location_contact( $post->ID, 'fax' ) ?>">
				</td>
			</tr>

			<tr>
				<th><?php _e( 'E-Mail', 'custom-post-type-locations' ) ?></th>
				<td>
					<input type="text" class="regular-text"  name="location-email" id="location-email" value="<?php echo get_location_contact( $post->ID, 'email' ) ?>">
				</td>
			</tr>

		</table>

		<?php

		wp_nonce_field( 'save-location-contact', 'location-contact-nonce' );

	} // END meta_box_location



	/**
	 * Update messages
	 *
	 * @access public
	 * @param array $messages Messages
	 * @return array Messages
	 * @author Ralf Hortt
	 **/
	public function post_updated_messages( $messages )
	{

		$post             = get_post();
		$post_type        = 'location';
		$post_type_object = get_post_type_object( $post_type );

		$messages['location'] = array(
			0  => '', // Unused. Messages start at index 1.
			1  => __( 'Location updated.', 'custom-post-type-locations' ),
			2  => __( 'Custom field updated.' ),
			3  => __( 'Custom field deleted.' ),
			4  => __( 'Location updated.', 'custom-post-type-locations' ),
			5  => isset( $_GET['revision'] ) ? sprintf( __( 'Location restored to revision from %s', 'custom-post-type-locations' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
			6  => __( 'Location published.', 'custom-post-type-locations' ),
			7  => __( 'Location saved.', 'custom-post-type-locations' ),
			8  => __( 'Location submitted.', 'custom-post-type-locations' ),
			9  => sprintf( __( 'Location scheduled for: <strong>%1$s</strong>.', 'custom-post-type-locations' ), date_i18n( __( 'M j, Y @ G:i', 'custom-post-type-locations' ), strtotime( $post->post_date ) ) ),
			10 => __( 'Location draft updated.', 'custom-post-type-locations' )
		);

		if ( $post_type_object->publicly_queryable ) :

			$permalink = get_permalink( $post->ID );

			$view_link = sprintf( ' <a href="%s">%s</a>', esc_url( $permalink ), __( 'View location', 'custom-post-type-locations' ) );
			$messages[ $post_type ][1] .= $view_link;
			$messages[ $post_type ][6] .= $view_link;
			$messages[ $post_type ][9] .= $view_link;

			$preview_permalink = add_query_arg( 'preview', 'true', $permalink );
			$preview_link = sprintf( ' <a target="_blank" href="%s">%s</a>', esc_url( $preview_permalink ), __( 'Preview location', 'custom-post-type-locations' ) );
			$messages[ $post_type ][8]  .= $preview_link;
			$messages[ $post_type ][10] .= $preview_link;

		endif;

		return $messages;

	} // END post_updated_messages



	/**
	 * Save post callback
	 *
	 * @access public
	 * @param int $post_id Post id
	 * @return void
	 * @since v0.4
	 * @author Ralf Hortt <me@horttcore.de>
	 **/
	public function save_contact( $post_id )
	{

		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
			return;

		if ( !isset( $_POST['location-contact-nonce'] ) || !wp_verify_nonce( $_POST['location-contact-nonce'], 'save-location-contact' ) )
			return;

		// Save lat/long
		update_post_meta( $post_id, '_location-contact', array(
			'phone' => sanitize_text_field( $_POST['location-phone'] ),
			'fax' => sanitize_text_field( $_POST['location-fax'] ),
			'email' => sanitize_email( $_POST['location-email'] ),
		) );

	} // END save_location



	/**
	 * Save post callback
	 *
	 * @access public
	 * @param int $post_id Post id
	 * @return void
	 * @since v0.4
	 * @author Ralf Hortt <me@horttcore.de>
	 **/
	public function save_location( $post_id )
	{

		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
			return;

		if ( !isset( $_POST['location-nonce'] ) || !wp_verify_nonce( $_POST['location-nonce'], 'save-location' ) )
			return;

		// Save lat/long
		update_post_meta( $post_id, '_location', array(
			'street' => sanitize_text_field( $_POST['location-street'] ),
			'street-number' => sanitize_text_field( $_POST['location-street-number'] ),
			'addition-to-address' => sanitize_text_field( $_POST['location-addition-to-address'] ),
			'zip' => sanitize_text_field( $_POST['location-zip'] ),
			'city' => sanitize_text_field( $_POST['location-city'] ),
			'country' => sanitize_text_field( $_POST['location-country'] ),
			'latitude' => sanitize_text_field( $_POST['location-latitude'] ),
			'longitude' => sanitize_text_field( $_POST['location-longitude'] ),
		) );

	} // END save_location



} // END final class Custom_Post_Type_Locations_Admin

new Custom_Post_Type_Locations_Admin;
