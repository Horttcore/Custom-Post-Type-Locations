<?php

namespace RalfHortt\CustomPostTypeLocations;

use Horttcore\CustomPostType\PostType;

/**
 *  Custom Post Type Produts.
 */
class Locations extends PostType
{
    protected $slug = 'location';

    /**
     * Register post type.
     *
     * @return array Post type configuration
     */
    public function getConfig() : array
    {
        return [
            'public'              => true,
            'show_ui'             => true,
            'query_var'           => true,
            'menu_position'       => null,
            'menu_icon'           => 'dashicons-location',
            'capability_type'     => 'post',
            'hierarchical'        => false,
            'supports'            => [
                'title',
                'editor',
                'thumbnail',
                'custom-fields',
                'revisions',
            ],
            'has_archive'         => true,
            'rewrite'             => [
                'slug'       => _x('locations', 'Post Type Slug', 'custom-post-type-locations'),
                'with_front' => false,
            ],
            'show_in_rest'        => true,
            'rest_base'           => _x('locations', 'Post Type Slug', 'custom-post-type-locations'),
        ];
    }
    // END config

    /**
     * Labels.
     *
     * @return array
     **/
    public function getLabels() : array
    {
        return [
            'name'                  => _x('Locations', 'post type general name', 'custom-post-type-locations'),
            'singular_name'         => _x('Location', 'post type singular name', 'custom-post-type-locations'),
            'add_new'               => _x('Add New', 'Location', 'custom-post-type-locations'),
            'add_new_item'          => __('Add New Location', 'custom-post-type-locations'),
            'edit_item'             => __('Edit Location', 'custom-post-type-locations'),
            'new_item'              => __('New Location', 'custom-post-type-locations'),
            'view_item'             => __('View Location', 'custom-post-type-locations'),
            'view_items'            => __('View Locations', 'custom-post-type-locations'),
            'search_items'          => __('Search Locations', 'custom-post-type-locations'),
            'not_found'             => __('No Locations found', 'custom-post-type-locations'),
            'not_found_in_trash'    => __('No Locations found in Trash', 'custom-post-type-locations'),
            'parent_item_colon'     => __('Parent Location', 'custom-post-type-locations'),
            'all_items'             => __('All Locations', 'custom-post-type-locations'),
            'archives'              => __('Location Archives', 'custom-post-type-locations'),
            'attributes'            => __('Location Attributes', 'custom-post-type-locations'),
            'insert_into_item'      => __('Insert into location', 'custom-post-type-locations'),
            'uploaded_to_this_item' => __('Uploaded to this page', 'custom-post-type-locations'),
            'featured_image'        => __('Location image', 'custom-post-type-locations'),
            'set_featured_image'    => __('Set Location image', 'custom-post-type-locations'),
            'remove_featured_image' => __('Remove Location image', 'custom-post-type-locations'),
            'use_featured_image'    => __('Use as Location image', 'custom-post-type-locations'),
            'menu_name'             => _x('Locations', 'post type general name', 'custom-post-type-locations'),
            'filter_items_list'     => __('Locations', 'custom-post-type-locations'),
            'items_list_navigation' => __('Locations', 'custom-post-type-locations'),
            'items_list'            => __('Locations', 'custom-post-type-locations'),
        ];
    }

    /**
     * Update messages.
     *
     * @param WP_Post      $post     Post object
     * @param string       $postType Post type slug
     * @param WP_Post_Type $postType Post type slug
     *
     * @return array Update messages
     **/
    public function getPostUpdateMessages(\WP_Post $post, string $postType, \WP_Post_Type $postTypeObjects) : array
    {
        $messages = [
            0  => '', // Unused. Messages start at index 1.
            1  => __('Location updated.', 'custom-post-type-locations'),
            2  => __('Custom field updated.'),
            3  => __('Custom field deleted.'),
            4  => __('Location updated.', 'custom-post-type-locations'),
            5  => isset($_GET['revision']) ? sprintf(__('Location restored to revision from %s', 'custom-post-type-locations'), wp_post_revision_title((int) $_GET['revision'], false)) : false,
            6  => __('Location published.', 'custom-post-type-locations'),
            7  => __('Location saved.', 'custom-post-type-locations'),
            8  => __('Location submitted.', 'custom-post-type-locations'),
            9  => sprintf(__('Location scheduled for: <strong>%1$s</strong>.', 'custom-post-type-locations'), date_i18n(__('M j, Y @ G:i', 'custom-post-type-locations'), strtotime($post->post_date))),
            10 => __('Location draft updated.', 'custom-post-type-locations'),
        ];

        if (!$postTypeObjects->publicly_queryable) {
            return $messages;
        }

        $permalink = get_permalink($post->ID);
        $view_link = sprintf(' <a href="%s">%s</a>', esc_url($permalink), __('View location', 'custom-post-type-locations'));
        $messages[1] .= $view_link;
        $messages[6] .= $view_link;
        $messages[9] .= $view_link;

        $preview_permalink = add_query_arg('preview', 'true', $permalink);
        $preview_link = sprintf(' <a target="_blank" href="%s">%s</a>', esc_url($preview_permalink), __('Preview location', 'custom-post-type-locations'));
        $messages[8] .= $preview_link;
        $messages[10] .= $preview_link;

        return $messages;
    }
} // END class Locations
