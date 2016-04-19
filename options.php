<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 */

function optionsframework_option_name() {
	// This gets the theme name from the stylesheet
	$themename = wp_get_theme();
	$themename = preg_replace("/\W/", "_", strtolower($themename) );

	$optionsframework_settings = get_option( 'optionsframework' );
	$optionsframework_settings['id'] = $themename;
	update_option( 'optionsframework', $optionsframework_settings );


}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the 'id' fields, make sure to use all lowercase and no spaces.
 *
 * If you are making your theme translatable, you should replace 'options_framework_theme'
 * with the actual text domain for your theme.  Read more:
 * http://codex.wordpress.org/Function_Reference/load_theme_textdomain
 */

function optionsframework_options() {
	$prefix = 'op-';
	$imagepath =  get_stylesheet_directory_uri() . '/inc/options-framework/images/';
	$imagepaththeme =  get_stylesheet_directory_uri() . '/img-samurai/';
	$options = array();

	 // Pull all the pages into an array
	  $options_pages = array();
	  $options_pages_obj = get_pages('sort_column=post_parent,menu_order');
	  $options_pages[''] = 'Select a page:';
	  foreach ($options_pages_obj as $page) {
	    $options_pages[$page->ID] = $page->post_title;
	  }
	  asort( $options_pages );

	$options[] = array(
		'name' => __('Header Settings', 'energy'),
		'type' => 'heading');

	$options[] = array(
		'name' => __( 'Activate Multilingual Menu(Polylang plugin must be activated)', 'energy' ),
		'desc' => __( 'Yes', 'energy' ),
		'id' => "{$prefix}multi_activate",
		'std' => '0',
		'type' => 'checkbox'
	);

	$options[] = array(
		'name'    => __( 'Site Logo', 'energy' ),
		'id'      => "{$prefix}site_logo",
		'desc'    => __( 'Replaces the default header logo of the site', 'energy' ),
		'std'	  => $imagepaththeme . 'site-logo.png',
		'type' => 'upload'
	);
	$options[] = array(
		'name' => __( 'Description', 'energy' ),
		'desc' =>  __( 'Description beside logo(Optional)', 'energy' ),
		'id' => "{$prefix}logo_description",
		'std' => '建設業許可は千代田区ソーシャルサムライ行政書士事務所',
		'type' => 'text'
	);

	$description_option = array(
		'name' => __( 'Description', 'energy' ),
		'desc' =>  __( 'Description beside logo(Optional)', 'energy' ),
		'id' => "{$prefix}logo_description",
		'std' => '',
		'type' => 'text'
	);

	$options = array_merge($options,custom_theme_option($description_option));

	$options[] = array(
		'name' => __( 'Mail Icon', 'energy' ),
		'desc' => __( 'Change Mail(Recommended Size is 18x12)', 'energy' ),
		'id' => "{$prefix}mail_icon",
		'std'	  => $imagepaththeme . 'sprite/email.png',
		'type' => 'upload'
	);

	$options[] = array(
		'name' => __( 'Contact Link', 'energy' ),
		'desc' => __( 'Change Contact Link', 'energy' ),
		'id' => "{$prefix}contact_link",
		'std' => '#contact',
		'type' => 'text'
	);

	$custom_option = array(
		'name' => __( 'Contact Link', 'energy' ),
		'desc' => __( 'Change Contact Link', 'energy' ),
		'id' => "{$prefix}contact_link",
		'std' => '',
		'type' => 'text'
	);

	$options = array_merge($options,custom_theme_option($custom_option));

	$options[] = array(
		'name' => __( 'Contact Label', 'energy' ),
		'desc' => __( 'Change Contact Label', 'energy' ),
		'id' => "{$prefix}contact_label",
		'std' => 'お問い合わせ',
		'type' => 'text'
	);

	$custom_option = array(
		'name' => __( 'Contact Label', 'energy' ),
		'desc' => __( 'Change Contact Label', 'energy' ),
		'id' => "{$prefix}contact_label",
		'std' => '',
		'type' => 'text'
	);

	$options = array_merge($options,custom_theme_option($custom_option));



	$options[] = array(
		'name' => __( 'Request(無料相談) Icon', 'energy' ),
		'desc' => __( 'Change Icon(Recommended Size is 20x20)', 'energy' ),
		'id' => "{$prefix}request_icon",
		'std'	  => $imagepaththeme . 'sprite/print.png',
		'type' => 'upload'
	);

	$options[] = array(
		'name' => __( 'Request(無料相談) Label', 'energy' ),
		'desc' => __( 'Change Label', 'energy' ),
		'id' => "{$prefix}request_label",
		'std'	  => '無料相談',
		'type' => 'text'
	);


	$custom_option = array(
		'name' => __( 'Request(無料相談) Label', 'energy' ),
		'desc' => __( 'Change Label', 'energy' ),
		'id' => "{$prefix}request_label",
		'std'	  => '',
		'type' => 'text'
	);

	$options = array_merge($options,custom_theme_option($custom_option));
	

	$options[] = array(
		'name' => __('Footer Settings', 'energy'),
		'type' => 'heading');

	$options[] = array(
		'name' => __( 'Footer Menu Title', 'energy' ),
		'desc' => __( 'Change Footer Menu Title', 'energy' ),
		'id' => "{$prefix}footer-title",
		'std' => '対応地域',
		'type' => 'text'
	);

	$description_option = array(
		'name' => __( 'Footer Menu Title', 'energy' ),
		'desc' => __( 'Change Footer Menu Title', 'energy' ),
		'id' => "{$prefix}footer-title",
		'std' => '',
		'type' => 'text'
	);

	$options = array_merge($options,custom_theme_option($description_option));

	$options[] = array(
		'name' => __( 'Footer Sub Title', 'energy' ),
		'desc' => __( 'Change Footer Sub Menu Title', 'energy' ),
		'id' => "{$prefix}footer-subtitle",
		'std' => '（基本的に全国対応可能です）',
		'type' => 'text'
	);

	$description_option = array(
		'name' => __( 'Footer Sub Title', 'energy' ),
		'desc' => __( 'Change Footer Sub Menu Title', 'energy' ),
		'id' => "{$prefix}footer-subtitle",
		'std' => '',
		'type' => 'text'
	);

	$options = array_merge($options,custom_theme_option($description_option));

	$options[] = array(
		'name' => __( 'Copyright', 'energy' ),
		'desc' => __( 'Change Copyright', 'energy' ),
		'id' => "{$prefix}copyright",
		'std' => 'Copyright ©' . date('Y') . ' ' . get_bloginfo( 'name' ) . ' All Rights Reserved.',
		'type' => 'text'
	);

	$description_option = array(
		'name' => __( 'Copyright', 'energy' ),
		'desc' => __( 'Change Copyright', 'energy' ),
		'id' => "{$prefix}copyright",
		'std' => '',
		'type' => 'text'
	);

	$options = array_merge($options,custom_theme_option($description_option));


	$options[] = array(
		'name' => __('Color Settings', 'energy'),
		'type' => 'heading');

	$options[] = array(
		'name' => __( 'Base Color', 'theme-textdomain' ),
		'desc' => __( 'Choose the base color of your theme. (default:#ee5500)', 'theme-textdomain' ),
		'id' => "{$prefix}color_base",
		'std' => '#0166bf',
		'type' => 'color'
	);

	$options[] = array(
		'name' => __( 'Sub Color', 'theme-textdomain' ),
		'desc' => __( 'Choose the sub color of your theme. (default:#1cbbb4)', 'theme-textdomain' ),
		'id' => "{$prefix}color_sub",
		'std' => '#1cbbb4',
		'type' => 'color'
	);



	return $options;
}

/*
 * This is an example of how to override a default filter
 * for 'textarea' sanitization and $allowedposttags + embed and script.
 */
add_action('admin_init','optionscheck_change_santiziation', 100);

function optionscheck_change_santiziation() {
    remove_filter( 'of_sanitize_textarea', 'of_sanitize_textarea' );
    add_filter( 'of_sanitize_textarea', 'custom_sanitize_textarea' );
}

function custom_sanitize_textarea($input) {
    global $allowedposttags;
    $custom_allowedtags["script"] = array(
      "src" => array(),
      "type" => array(),
      );

    $custom_allowedtags["img"] = array(
      "src" => array(),
      "alt" => array(),
      );

    $custom_allowedtags["noscript"] = array();

      $custom_allowedtags = array_merge($custom_allowedtags, $allowedposttags);
      $output = wp_kses( $input, $custom_allowedtags);
    return $output;
}
