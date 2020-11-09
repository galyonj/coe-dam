<?php
/**
Plugin Name: COE Data Asset Management System
Plugin URI: https://github.com/galyonj/coe-dam/
Description: Registers a custom post type and custom taxonomy for asset management on coefoodsafetytools.org
Version: 0.1.3
Author: John Galyon
Author URI: https://github.com/galyonj
Textdomain: coe-dams
License: MIT
*/

/**
 * Add custom taxonomies
 *
 * Additional custom taxonomies can be defined here
 * http://codex.wordpress.org/Function_Reference/register_taxonomy
 */
// Register Custom Taxonomy
function coe_register_region() {

	$labels = array(
		'name'                       => _x( 'Regions', 'Taxonomy General Name', 'coe-dams' ),
		'singular_name'              => _x( 'Region', 'Taxonomy Singular Name', 'coe-dams' ),
		'menu_name'                  => __( 'Regions', 'coe-dams' ),
		'all_items'                  => __( 'All Regions', 'coe-dams' ),
		'parent_item'                => __( 'Parent Region', 'coe-dams' ),
		'parent_item_colon'          => __( 'Parent Region:', 'coe-dams' ),
		'new_item_name'              => __( 'New Region Name', 'coe-dams' ),
		'add_new_item'               => __( 'Add New Region', 'coe-dams' ),
		'edit_item'                  => __( 'Edit Region', 'coe-dams' ),
		'update_item'                => __( 'Update Region', 'coe-dams' ),
		'view_item'                  => __( 'View Region', 'coe-dams' ),
		'separate_items_with_commas' => __( 'Separate regions with commas', 'coe-dams' ),
		'add_or_remove_items'        => __( 'Add or remove regions', 'coe-dams' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'coe-dams' ),
		'popular_items'              => __( 'Popular Regions', 'coe-dams' ),
		'search_items'               => __( 'Search Regions', 'coe-dams' ),
		'not_found'                  => __( 'Not Found', 'coe-dams' ),
		'no_terms'                   => __( 'No regions', 'coe-dams' ),
		'items_list'                 => __( 'Regions list', 'coe-dams' ),
		'items_list_navigation'      => __( 'Regions list navigation', 'coe-dams' ),
	);
	$rewrite = array(
		'slug'         => 'region',
		'with_front'   => true,
		'hierarchical' => false,
	);
	$args = array(
		'labels'            => $labels,
		'hierarchical'      => true,
		'public'            => true,
		'show_ui'           => true,
		'show_admin_column' => true,
		'show_in_nav_menus' => false,
		'show_tagcloud'     => true,
		'rewrite'           => $rewrite,
		'show_in_rest'      => true,
		'meta_box_cb'       => 'coe_select_meta_box',
	);
	register_taxonomy( 'region', array( 'asset' ), $args );

}
add_action( 'init', 'coe_register_region', 0 );

// Register Custom Post Type
function coe_register_cpt() {

	$labels = array(
		'name'                  => _x( 'Assets', 'Post Type General Name', 'coe-dams' ),
		'singular_name'         => _x( 'Asset', 'Post Type Singular Name', 'coe-dams' ),
		'menu_name'             => __( 'Assets', 'coe-dams' ),
		'name_admin_bar'        => __( 'Asset', 'coe-dams' ),
		'archives'              => __( 'Asset Archives', 'coe-dams' ),
		'attributes'            => __( 'Asset Attributes', 'coe-dams' ),
		'parent_item_colon'     => __( 'Parent Asset:', 'coe-dams' ),
		'all_items'             => __( 'All Assets', 'coe-dams' ),
		'add_new_item'          => __( 'Add New Asset', 'coe-dams' ),
		'add_new'               => __( 'Add New', 'coe-dams' ),
		'new_item'              => __( 'New Asset', 'coe-dams' ),
		'edit_item'             => __( 'Edit Asset', 'coe-dams' ),
		'update_item'           => __( 'Update Asset', 'coe-dams' ),
		'view_item'             => __( 'View Asset', 'coe-dams' ),
		'view_items'            => __( 'View Assets', 'coe-dams' ),
		'search_items'          => __( 'Search Prodict', 'coe-dams' ),
		'not_found'             => __( 'Not found', 'coe-dams' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'coe-dams' ),
		'featured_image'        => __( 'Featured Image', 'coe-dams' ),
		'set_featured_image'    => __( 'Set featured image', 'coe-dams' ),
		'remove_featured_image' => __( 'Remove featured image', 'coe-dams' ),
		'use_featured_image'    => __( 'Use as featured image', 'coe-dams' ),
		'insert_into_item'      => __( 'Insert into asset', 'coe-dams' ),
		'uploaded_to_this_item' => __( 'Uploaded to this asset', 'coe-dams' ),
		'items_list'            => __( 'Assets list', 'coe-dams' ),
		'items_list_navigation' => __( 'Assets list navigation', 'coe-dams' ),
		'filter_items_list'     => __( 'Filter assets list', 'coe-dams' ),
	);
	$rewrite = array(
		'slug'       => 'assets',
		'with_front' => false,
		'pages'      => true,
		'feeds'      => true,
	);
	$args = array(
		'label'               => __( 'Asset', 'coe-dams' ),
		'description'         => __( 'Post Type Description', 'coe-dams' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'thumbnail', 'revisions', 'post-formats' ),
		'taxonomies'          => array( 'region' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'menu_position'       => 5,
		'menu_icon'           => 'dashicons-clipboard',
		'show_in_admin_bar'   => true,
		'show_in_nav_menus'   => true,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'rewrite'             => $rewrite,
		'capability_type'     => 'page',
		'show_in_rest'        => true,
		'rest_base'           => 'asset',
	);
	register_post_type( 'asset', $args );

}
add_action( 'init', 'coe_register_cpt', 0 );

/**
 * Display custom taxonomy as a select box
 * @param WP_POST $post
 * @param array $box
 */

function coe_select_meta_box( $post, $box ) {
	$defaults = array( 'taxonomy' => 'region' );

	if ( ! isset( $box['args'] ) || ! is_array( $box['args'] ) ) {
		$args = array();
	} else {
		$args = $box['args'];
	}

	extract( wp_parse_args( $args, $defaults ), EXTR_SKIP );

	$tax          = get_taxonomy( $taxonomy );
	$selected     = wp_get_object_terms( $post->ID, $taxonomy, array( 'fields' => 'ids' ) );
	$hierarchical = $tax->hierarchical;
	?>
	<div id="taxonomy-<?php echo esc_attr( $taxonomy ); ?>" class="selectdiv">
		<?php if ( current_user_can( $tax->cap->edit_terms ) ) : ?>
			<?php
			if ( $hierarchical ) {
				wp_dropdown_categories(
					array(
						'taxonomy'        => $taxonomy,
						'class'           => 'widefat',
						'hide_empty'      => 0,
						'name'            => "tax_input[$taxonomy][]",
						'selected'        => count( $selected ) >= 1 ? $selected[0] : '',
						'orderby'         => 'name',
						'hierarchical'    => 1,
						'show_option_all' => '',
					)
				);
			} else {
				?>
				<select name="<?php echo esc_html( "tax_input[$taxonomy][]" ); ?> class="widefat">
					<option value="0"></option>
					<?php foreach ( get_terms( $taxonomy, array( 'hide_empty' => false ) )  as $term ) : ?>
						<option value="<?php echo esc_attr( $term->slug ); ?>" <?php echo selected( $term->term_id, count( $selected ) >= 1 ? $selected[0] : '' ); ?>><?php echo esc_html( $term->name ); ?></option>
					<?php endforeach; ?>
				</select>
				<?php
			}
			?>
		<?php endif; ?>
	</div>
	<?php
}

/**
 * Check post age
 */
function coe_post_age( $post, $days = 365 ) {
	$days   = (int) days;
	$offset = $days * 60 * 60 * 24;
}
