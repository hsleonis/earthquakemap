<?php
/**
 * Add custom post-type for earthquake information in google maps.
 * post-type support post title, content, custom-meta-box,
 */

// Register Custom Post Type Creating New Map
function earthquake_support_map() {

	$labels = array(
			'name'                => _x( 'Earthquake Support Map', 'Post Type General Name', TextDomain ),
			'singular_name'       => _x( 'Earthquake Support Map', 'Post Type Singular Name', TextDomain ),
			'menu_name'           => __( 'Earthquake Support Map', TextDomain ),
			'name_admin_bar'      => __( 'Earthquake Support Map', TextDomain ),
			'parent_item_colon'   => __( 'Parent Place:', TextDomain ),
			'all_items'           => __( 'All Place', TextDomain ),
			'add_new_item'        => __( 'Add New Place', TextDomain ),
			'add_new'             => __( 'Add New', TextDomain ),
			'new_item'            => __( 'New Place', TextDomain ),
			'edit_item'           => __( 'Edit Place', TextDomain ),
			'update_item'         => __( 'Update Place', TextDomain ),
			'view_item'           => __( 'View Place', TextDomain ),
			'search_items'        => __( 'Search Place', TextDomain ),
			'not_found'           => __( 'Not found', TextDomain ),
			'not_found_in_trash'  => __( 'Not found in Trash', TextDomain ),
			'featured_image'        => __( 'Featured Image', TextDomain ),
			'set_featured_image'    => __( 'Set Featured image', TextDomain ),
			'remove_featured_image' => __( 'Remove Featured image', TextDomain ),
			'use_featured_image'    => __( 'Use as Featured image', TextDomain ),
			'insert_into_item'      => __( 'Insert into Place', TextDomain ),
			'uploaded_to_this_item' => __( 'Uploaded to this Place', TextDomain ),
			'items_list'            => __( 'Marker list', TextDomain ),
			'items_list_navigation' => __( 'Marker list navigation', TextDomain ),
			'filter_items_list'     => __( 'Filter Place list', TextDomain ),
	);
	$args = array(
			'label'               => __( 'Earthquake Support Map', TextDomain ),
			'description'         => __( 'A simple plugin that embed Google Maps and Google Maps Street View. With Geo Routing Functionality.', TextDomain ),
			'labels'              => $labels,
			'supports'            => array( 'title', 'editor', 'author', 'thumbnail', 'custom-fields', ),
			'taxonomies'          => array( 'place_category' ),
			'hierarchical'        => false,
			'public'              => false,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'menu_position'       => 20,
			'menu_icon'           => 'dashicons-location-alt',
			'show_in_admin_bar'   => false,
			'show_in_nav_menus'   => false,
			'can_export'          => true,
			'has_archive'         => false,
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			//'rewrite'             => false,
			'capability_type'     => 'page',
	);
	register_post_type( 'support_place', $args );
}

// Hook into the 'init' action
add_action( 'init', 'earthquake_support_map', 0 );


/**
 * Marker Type/Category
*/


// Register Custom Taxonomy
function place_category() {

	$labels = array(
			'name'                       => _x( 'Place Categories', 'Taxonomy General Name', 'text_domain' ),
			'singular_name'              => _x( 'Place Category', 'Taxonomy Singular Name', 'text_domain' ),
			'menu_name'                  => __( 'Place Categories', 'text_domain' ),
			'all_items'                  => __( 'All Items', 'text_domain' ),
			'parent_item'                => __( 'Parent Item', 'text_domain' ),
			'parent_item_colon'          => __( 'Parent Item:', 'text_domain' ),
			'new_item_name'              => __( 'New Item Name', 'text_domain' ),
			'add_new_item'               => __( 'Add New Item', 'text_domain' ),
			'edit_item'                  => __( 'Edit Item', 'text_domain' ),
			'update_item'                => __( 'Update Item', 'text_domain' ),
			'view_item'                  => __( 'View Item', 'text_domain' ),
			'separate_items_with_commas' => __( 'Separate items with commas', 'text_domain' ),
			'add_or_remove_items'        => __( 'Add or remove items', 'text_domain' ),
			'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
			'popular_items'              => __( 'Popular Items', 'text_domain' ),
			'search_items'               => __( 'Search Items', 'text_domain' ),
			'not_found'                  => __( 'Not Found', 'text_domain' ),
			'no_terms'                   => __( 'No items', 'text_domain' ),
			'items_list'                 => __( 'Items list', 'text_domain' ),
			'items_list_navigation'      => __( 'Items list navigation', 'text_domain' ),
	);
	$args = array(
			'labels'                     => $labels,
			'hierarchical'               => true,
			'public'                     => true,
			'show_ui'                    => true,
			'show_admin_column'          => true,
			'show_in_nav_menus'          => true,
			'show_tagcloud'              => true,
	);
	register_taxonomy( 'place_category', array( 'support_place' ), $args );

}
add_action( 'init', 'place_category', 0 );

add_action( 'create_term', 'save_tax_meta', 10, 3 );
add_action( 'edit_term', 'save_tax_meta', 10, 3 );
add_action( 'delete_term', 'my_create', 10, 3 );

function save_tax_meta($term_id, $tt_id, $taxonomy){
	if( is_admin() && ($taxonomy == "place_category" && !empty($term_id)) ){
		if(isset($_POST['marker_icon']) && !empty($_POST['marker_icon'])){
			$icon_url = esc_url($_POST['marker_icon']);
			update_term_meta($term_id, EQCMB.'marker_icon', $icon_url);
		}
	}
}
function delete_tax_meta($term_id, $tt_id, $taxonomy){
	if( is_admin() && ($taxonomy == "place_category" && !empty($term_id)) ){
		$value = get_term_meta( $term_id, EQCMB.'marker_icon', true );
		delete_term_meta($term_id, EQCMB.'marker_icon', $value);
	}
}