<?php
/*
 Plugin Name: COE Data Asset Management System
 Plugin URI: https://github.com/galyonj/coe-dam/
 Description: Registers a custom post type and custom taxonomy for asset management on coefoodsafetytools.org
 Version: 0.1.2
 Author: John Galyon
 Author URI: https://github.com/galyonj
 Textdomain: coe
 License: MIT
 */

/**
 * Add custom taxonomies
 *
 * Additional custom taxonomies can be defined here
 * http://codex.wordpress.org/Function_Reference/register_taxonomy
 */
// Register Custom Taxonomy
function coe_register_taxonomy() {
	$labels = array(
		'name'                       => _x( 'Regions', 'Taxonomy General Name', 'coe' ),
		'singular_name'              => _x( 'Retion', 'Taxonomy Singular Name', 'coe' ),
		'menu_name'                  => __( 'Regions', 'coe' ),
		'all_items'                  => __( 'All Regions', 'coe' ),
		'parent_item'                => __( 'Parent Region', 'coe' ),
		'parent_item_colon'          => __( 'Parent Region:', 'coe' ),
		'new_item_name'              => __( 'New Region Name', 'coe' ),
		'add_new_item'               => __( 'Add New Region', 'coe' ),
		'edit_item'                  => __( 'Edit Region', 'coe' ),
		'update_item'                => __( 'Update Region', 'coe' ),
		'view_item'                  => __( 'View Region', 'coe' ),
		'separate_items_with_commas' => __( 'Separate regions with commas', 'coe' ),
		'add_or_remove_items'        => __( 'Add or remove regions', 'coe' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'coe' ),
		'popular_items'              => __( 'Popular Regions', 'coe' ),
		'search_items'               => __( 'Search Regions', 'coe' ),
		'not_found'                  => __( 'Not Found', 'coe' ),
		'no_terms'                   => __( 'No regions', 'coe' ),
		'items_list'                 => __( 'Regions list', 'coe' ),
		'items_list_navigation'      => __( 'Regions list navigation', 'coe' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => false,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => false,
		'show_tagcloud'              => false,
		'show_in_rest'               => true,
	);
	register_taxonomy( 'region', array( 'asset' ), $args );

}
add_action( 'init', 'coe_register_taxonomy', 0 );

// Register Custom Post Type
function coe_register_cpt() {

	$labels = array(
		'name'                  => _x( 'Assets', 'Post Type General Name', 'coe' ),
		'singular_name'         => _x( 'Asset', 'Post Type Singular Name', 'coe' ),
		'menu_name'             => __( 'Assets', 'coe' ),
		'name_admin_bar'        => __( 'Asset', 'coe' ),
		'archives'              => __( 'Asset Archives', 'coe' ),
		'attributes'            => __( 'Asset Attributes', 'coe' ),
		'parent_item_colon'     => __( 'Parent Asset:', 'coe' ),
		'all_items'             => __( 'All Assets', 'coe' ),
		'add_new_item'          => __( 'Add New Asset', 'coe' ),
		'add_new'               => __( 'Add New', 'coe' ),
		'new_item'              => __( 'New Asset', 'coe' ),
		'edit_item'             => __( 'Edit Asset', 'coe' ),
		'update_item'           => __( 'Update Asset', 'coe' ),
		'view_item'             => __( 'View Asset', 'coe' ),
		'view_items'            => __( 'View Assets', 'coe' ),
		'search_items'          => __( 'Search Asset', 'coe' ),
		'not_found'             => __( 'Not found', 'coe' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'coe' ),
		'featured_image'        => __( 'Featured Image', 'coe' ),
		'set_featured_image'    => __( 'Set featured image', 'coe' ),
		'remove_featured_image' => __( 'Remove featured image', 'coe' ),
		'use_featured_image'    => __( 'Use as featured image', 'coe' ),
		'insert_into_item'      => __( 'Insert into asset', 'coe' ),
		'uploaded_to_this_item' => __( 'Uploaded to this asset', 'coe' ),
		'items_list'            => __( 'Assets list', 'coe' ),
		'items_list_navigation' => __( 'Assets list navigation', 'coe' ),
		'filter_items_list'     => __( 'Filter assets list', 'coe' ),
	);

	$rewrite = array(
		'slug'			=> 'assets',
		'with_front'	=> true,
		'pages'			=> true,
		'feeds'			=> true,
	);

	$args = array(
		'label'                 => __( 'Asset', 'coe' ),
		'description'           => __( 'Post Type Description', 'coe' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail', 'revisions', 'custom-fields' ),
		'taxonomies'            => array( 'region' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'				=> 'dashicons-clipboard',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
		'rewrite'               => $rewrite,
		'show_in_rest'          => true,
	);
	register_post_type( 'asset', $args );

}
add_action( 'init', 'coe_register_cpt', 0 );

/**
 * Check post age
 */
function coe_post_age($days = 365) {
	$days = (int) days;
	$offset = $days*60*60*24;
}