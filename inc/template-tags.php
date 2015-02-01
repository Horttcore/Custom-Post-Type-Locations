<?php
if ( !function_exists( 'get_location' ) ) :
/**
 * Get location field
 *
 * @param int $post_id Post ID
 * @param str $field Location field
 * @return str/array Location
 * @author Ralf Hortt
 **/
function get_location( $post_id = FALSE, $field = FALSE )
{

	$post_id = ( FALSE === $post_id ) ? get_the_ID() : $post_id;

	$meta = wp_cache_get( 'location-' . $post_id );

	if ( FALSE === $meta ) :

		$meta = get_post_meta( $post_id, '_location', TRUE );
		wp_cache_set( 'location-' . $post_id, $meta );

	endif;

	if ( FALSE === $field )
		return $meta;

	if ( isset( $meta[$field] ) )
		return $meta[$field];

}
endif;



if ( !function_exists( 'location' ) ) :
/**
 * Output location field
 *
 * @param int $post_id Post ID
 * @param str $field Location field
 * @return str/array Location
 * @author Ralf Hortt
 **/
function location( $field, $post_id = FALSE )
{

	$post_id = ( FALSE === $post_id ) ? get_the_ID() : $post_id;
	echo get_location( $post_id, $field );

}
endif;



if ( !function_exists( 'get_location_contact' ) ) :
/**
 * Get location contact field
 *
 * @param int $post_id Post ID
 * @param str $field Location field
 * @return str/array Location
 * @author Ralf Hortt
 **/
function get_location_contact( $post_id = FALSE, $field = FALSE )
{

	$post_id = ( FALSE === $post_id ) ? get_the_ID() : $post_id;

	$meta = wp_cache_get( 'location-contact-' . $post_id );

	if ( FALSE === $meta ) :

		$meta = get_post_meta( $post_id, '_location-contact', TRUE );
		wp_cache_set( 'location-contact-' . $post_id, $meta );

	endif;

	if ( FALSE === $field )
		return $meta;

	if ( isset( $meta[$field] ) )
		return $meta[$field];

}
endif;



if ( !function_exists( 'location_contact' ) ) :
/**
 * Output location contact field
 *
 * @param int $post_id Post ID
 * @param str $field Location field
 * @return str/array Location
 * @author Ralf Hortt
 **/
function location_contact( $field, $post_id = FALSE )
{

	$post_id = ( FALSE === $post_id ) ? get_the_ID() : $post_id;
	echo get_location_contact( $post_id, $field );

}
endif;
