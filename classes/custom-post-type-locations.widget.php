<?php
/**
 * Widget
 *
 * @author Ralf Hortt
 */
if ( !class_exists( 'Custom_Post_Type_Locations_Widget' ) ) :
class Custom_Post_Type_Locations_Widget extends WP_Widget {



	/**
	 * Constructor
	 *
	 * @access public
	 * @since v2.0
	 * @author Ralf Hortt <me@horttcore.de>
	 */
	public function __construct()
	{

		$widget_ops = array(
			'classname' => 'widget-locations',
			'description' => __( 'List Locations', 'custom-post-type-locations' ),
		);
		$control_ops = array( 'id_base' => 'widget-locations' );
		$this->WP_Widget( 'widget-locations', __( 'Locations', 'custom-post-type-locations' ), $widget_ops, $control_ops );

		add_action( 'custom-post-type-locations-widget-output', array( 'Custom_Post_Type_Locations_Widget', 'widget_output'), 10, 3 );
		add_action( 'custom-post-type-locations-widget-loop-output', array( 'Custom_Post_Type_Locations_Widget', 'widget_loop_output'), 10, 3 );

	} // END __construct



	/**
	 * Output
	 *
	 * @access public
	 * @param array $args Arguments
	 * @param array $instance Widget instance
	 * @since v2.0
	 * @author Ralf Hortt <me@horttcore.de>
	 */
	public function widget( $args, $instance ) {

		$query = array(
			'post_type' => 'location',
			'showposts' => $instance['limit'],
			'orderby' => $instance['orderby'],
			'order' => $instance['order'],
		);

		if ( 0 != $instance['location-category'] ) :
			$query['tax_query'] = array(
				array(
					'taxonomy' => 'location-category',
					'field' => 'term_id',
					'terms' => $instance['location-category'],
				)
			);
		endif;

		if ( 'location-date' == $instance['order'] ) :
			$query['orderby'] = 'meta_key';
			$query['meta_key'] = '_location-date-start';
			$query['meta_value'] = time();
			$query['meta_compare'] = '>=';
		endif;

		$query = new WP_Query( $query );

		if ( $query->have_posts() ) :

			/**
			 * Widget output
			 *
			 * @param array $args Arguments
			 * @param array $instance Widget instance
			 * @param obj $query WP_Query object
			 * @hooked Custom_Post_Type_Widget::widget_output - 10
			 */
			do_action( 'custom-post-type-locations-widget-output', $args, $instance, $query );

		endif;

		wp_reset_query();

	} // END widget



	/**
	 * Save widget settings
	 *
	 * @access public
	 * @param array $new_instance New widget instance
	 * @param array $old_instance Old widget instance
	 * @author Ralf Hortt <me@horttcore.de>
	 */
	public function update( $new_instance, $old_instance )
	{

		$instance = $old_instance;
		$instance['title'] = $new_instance['title'];
		$instance['orderby'] = $new_instance['orderby'];
		$instance['order'] = $new_instance['order'];
		$instance['limit'] = $new_instance['limit'];

		return $instance;

	} // END update



	/**
	 * Widget settings
	 *
	 * @access public
	 * @param array $instance Widget instance
	 * @author Ralf Hortt <me@horttcore.de>
	 * @since v2.0
	 */
	public function form( $instance )
	{

		?>

		<p>
			<label for="<?php echo $this->get_field_name( 'title' ); ?>"><?php _e( 'Title:' ); ?></label><br>
			<input type="text" name="<?php echo $this->get_field_name( 'title' ); ?>" id="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php if ( isset( $instance['title'] ) ) echo esc_attr( $instance['title'] ) ?>">
		</p>

		<p>
			<label for="<?php echo $this->get_field_name( 'orderby' ); ?>"><?php _e( 'Order By:', 'custom-post-type-locations' ); ?></label><br>
			<select name="<?php echo $this->get_field_name( 'orderby' ); ?>" id="<?php echo $this->get_field_name( 'orderby' ); ?>">
				<option <?php if ( isset( $instance['orderby'] ) ) selected( $instance['orderby'], '' ) ?> value=""><?php _e( 'None' ); ?></option>
				<option <?php if ( isset( $instance['orderby'] ) ) selected( $instance['orderby'], 'ID' ) ?> value="ID"><?php _e( 'ID', 'custom-post-type-locations' ); ?></option>
				<option <?php if ( isset( $instance['orderby'] ) ) selected( $instance['orderby'], 'title' ) ?> value="title"><?php _e( 'Title' ); ?></option>
				<option <?php if ( isset( $instance['orderby'] ) ) selected( $instance['orderby'], 'menu_order' ) ?> value="menu_order"><?php _e( 'Menu order' ); ?></option>
				<option <?php if ( isset( $instance['orderby'] ) ) selected( $instance['orderby'], 'date' ) ?> value="date"><?php _e( 'Publishing date' ); ?></option>
				<option <?php if ( isset( $instance['orderby'] ) ) selected( $instance['orderby'], 'rand' ) ?> value="rand"><?php _e( 'Random' ); ?></option>
			</select>
		</p>

		<p>
			<label for="<?php echo $this->get_field_name( 'order' ); ?>"><?php _e( 'Order:' ); ?></label><br>
			<select name="<?php echo $this->get_field_name( 'order' ); ?>" id="<?php echo $this->get_field_name( 'order' ); ?>">
				<option <?php if ( isset( $instance['order'] ) ) selected( $instance['order'], 'ASC' ) ?> value="ASC"><?php _e( 'Ascending', 'custom-post-type-locations' ); ?></option>
				<option <?php if ( isset( $instance['order'] ) ) selected( $instance['order'], 'DESC' ) ?> value="DESC"><?php _e( 'Descending', 'custom-post-type-locations' ); ?></option>
			</select>
		</p>

		<p>
			<label for="<?php echo $this->get_field_name( 'limit' ); ?>"><?php _e( 'Count:', 'custom-post-type-locations' ); ?></label><br>
			<input type="text" name="<?php echo $this->get_field_name( 'limit' ); ?>" id="<?php echo $this->get_field_name( 'limit' ); ?>" value="<?php if ( isset( $instance['limit'] ) ) echo esc_attr( $instance['limit'] ) ?>">
		</p>

		<?php

	} // END form



	/**
	 * Widget loop output
	 *
	 * @static
	 * @access public
	 * @param array $args Arguments
	 * @param array $instance Widget instance
	 * @param obj $query WP_Query object
	 * @author Ralf Hortt <me@horttcore.de>
	 * @since v2.0
	 **/
	static public function widget_loop_output( $args, $instance, $query )
	{

		?>

		<li>
			<a href="<?php the_permalink() ?>"><?php the_title() ?></a>
		</li>

		<?php

	} // END widget_loop_output



	/**
	 * Widget output
	 *
	 * @static
	 * @access public
	 * @param array $args Arguments
	 * @param array $instance Widget instance
	 * @param obj $query WP_Query object
	 * @author Ralf Hortt <me@horttcore.de>
	 * @since v2.0
	 **/
	static public function widget_output( $args, $instance, $query )
	{

		echo $args['before_widget'];

		echo $args['before_title'] . $instance['title'] . $args['after_title'];

		?>

		<ul class="location-list">

			<?php

			while ( $query->have_posts() ) : $query->the_post();

				/**
				 * Loop output
				 *
				 * @param array $args Arguments
				 * @param array $instance Widget instance
				 * @param obj $query WP_Query object
				 * @hooked Custom_Post_Type::widget_loop_output - 10
				 */
				do_action( 'custom-post-type-locations-widget-loop-output', $args, $instance, $query );

			endwhile;

			?>

		</ul>

		<?php

		echo $args['after_widget'];

	} // END widget_output



} // END final class Custom_Post_Type_Locations_Widget

endif;


