<?php
/**
 * EarthQuake functions and definitions
 * 
 */
define("EQCMB", "_earthquake_");
//marker_latlng, ref_url, address, submitter_name, submitter_email, submitter_phone, 
// Hook into the 'init' action
add_action( 'admin_enqueue_scripts', 'load_custom_wp_admin_style_script', 10 );
//add custom admin css
function load_custom_wp_admin_style_script(){
	global $post_type;
	global $post;
	if(($post_type == 'support_place') && isset($_GET["post"])){
		$mapdata = array();
		if($post instanceof WP_Post){
			
			$values = get_post_custom( $post->ID );
			$maps_latlng = isset( $values[EQCMB.'marker_latlng'] ) ? $values[EQCMB.'marker_latlng'][0] : '35.68169,139.765396';
			$maps_latlng = explode(",",$maps_latlng);
			$lat = $maps_latlng[0];
			$lng = $maps_latlng[1];
			
			$mapdata = array(
					'maps_lat'  => $lat,
					'maps_lng'  => $lng,
					'maps_zoom' => 15,
			);
			
			$settings = get_option("eqSettings");
			if(empty($settings['apiKey'])){
				wp_register_script( 'Google-Maps', "//maps.googleapis.com/maps/api/js?v=3.exp", false, null);
			}else{
				wp_register_script( 'Google-Maps', "//maps.googleapis.com/maps/api/js?v=3.exp&key=".$settings['apiKey'], false, null);
			}
			
			if(defined('WP_DEBUG') && WP_DEBUG){
				wp_register_script( 'AdminMapScript', get_template_directory_uri() . "/earthquake/js/admin.js", array('jquery','Google-Maps'), '1.0.0', true);
			}else{
				wp_register_script( 'AdminMapScript', get_template_directory_uri() . "/earthquake/js/admin.js", array('jquery','Google-Maps'), '1.0.0', true);
			}
			
			wp_localize_script( 'Google-Maps', 'mapdata', $mapdata );
			
			wp_enqueue_script('jquery');
			wp_enqueue_script('Google-Maps');
			wp_enqueue_script('AdminMapScript');
		}
	}
}

add_action( 'wp_enqueue_scripts', 'eqsim_frontend_scripts' );
function eqsim_frontend_scripts(){
	if(get_page_template_slug() == 'template-search.php' || get_page_template_slug() == 'registration.php'){
		$settings = get_option("eqSettings");
		if(empty($settings['apiKey'])){
			wp_register_script( 'Google-Maps', "//maps.googleapis.com/maps/api/js?v=3.exp", false, null);
		}else{
			wp_register_script( 'Google-Maps', "//maps.googleapis.com/maps/api/js?v=3.exp&key=".$settings['apiKey'], false, null);
		}
		wp_register_script( 'marker_culsterer', get_template_directory_uri() . "/earthquake/js/markerclusterer_compiled.js", array('Google-Maps'), '1.0.0', true);
		if(defined('WP_DEBUG') && WP_DEBUG){
			wp_register_script( 'AXGMapScript', get_template_directory_uri() . "/earthquake/js/jquery.axgmap.js", array('jquery','Google-Maps'), '1.0.0', true);
			wp_register_script( 'MapScript', get_template_directory_uri() . "/earthquake/js/maps.js", array('jquery','Google-Maps'), '1.0.0', true);
		}else{
			wp_register_script( 'AXGMapScript', get_template_directory_uri() . "/earthquake/js/jquery.axgmap.js", array('jquery','Google-Maps'), '1.0.0', true);
			wp_register_script( 'MapScript', get_template_directory_uri() . "/earthquake/js/maps.js", array('jquery','marker_culsterer'), '1.0.0', true);
		}
		wp_enqueue_script('Google-Maps');
		wp_enqueue_script('marker_culsterer');
		//wp_enqueue_script('AXGMapScript');
		wp_enqueue_script('MapScript');
	}
	wp_enqueue_script('jquery');
}
//custom post type and taxonomy
require 'customPostTypeNTaxonomy.php';
//meta boxes
require 'metaboxes.php';
//frontend place register
require 'frontend_place_register.php';