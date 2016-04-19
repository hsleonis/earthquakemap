<?php
add_filter( 'rwmb_meta_boxes', 'gm_register_meta_boxes' );
function gm_register_meta_boxes( $meta_boxes ) {
	$prefix = 'gm_';

	$meta_boxes[] = array(
		'id'       => 'page-settings', // Meta box id, UNIQUE per meta box. Optional since 4.1.5.
		'title'    => __( 'Page Settings', 'samepage' ), // Meta box title - Will appear at the drag and drop handle bar. Required.
		'pages'    => array( 'page' ), // Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
		'context'  => 'normal', // Where the meta box appear: normal (default), advanced, side. Optional.
		'priority' => 'high', // Order of meta box: high (default), low. Optional.
		'autosave' => false, // Auto save: true, false (default). Optional.
		'fields'   => array(

			// Page/Post class
			array(
				'name'    => __( 'Pre Description', 'samepage' ),
				'id'      => "{$prefix}pre_description",
				'desc'    => __( '', 'samepage' ),
				'type'    => 'wysiwyg',
				'rows' => 5,
			),

			array(
				'name'    => __( 'Sub Title', 'samepage' ),
				'id'      => "{$prefix}sub_title",
				'desc'    => __( '', 'samepage' ),
				'type'    => 'text',
			),


		)
	);

	$meta_boxes[] = array(
		'id'       => 'telephone-settings', // Meta box id, UNIQUE per meta box. Optional since 4.1.5.
		'title'    => __( 'Contact Settings', 'samepage' ), // Meta box title - Will appear at the drag and drop handle bar. Required.
		'pages'    => array( 'page' ), // Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
		'context'  => 'normal', // Where the meta box appear: normal (default), advanced, side. Optional.
		'priority' => 'high', // Order of meta box: high (default), low. Optional.
		'autosave' => false, // Auto save: true, false (default). Optional.
		'fields'   => array(

			// Page/Post class
			array(
				'name'    => __( 'Activate Contact Box', 'samepage' ),
				'id'      => "{$prefix}activate_contact",
				'desc'    => __( '', 'samepage' ),
				'type'    => 'checkbox',
				'std'	  => false
			),

			array(
				'name'    => __( '受付時間', 'samepage' ),
				'id'      => "{$prefix}time",
				'desc'    => __( '', 'samepage' ),
				'type'    => 'text',
			),

			array(
				'name'    => __( 'Phone Number', 'samepage' ),
				'id'      => "{$prefix}phone_number",
				'desc'    => __( '', 'samepage' ),
				'type'    => 'image_advanced',
			),

			array(
				'name'    => __( 'Contact Details', 'samepage' ),
				'id'      => "{$prefix}contact_detail",
				'desc'    => __( '', 'samepage' ),
				'type'    => 'wysiwyg',
				'rows' => 3,
			),

		)
	);

	$meta_boxes[] = array(
		'id'       => 'partner-desc-settings', // Meta box id, UNIQUE per meta box. Optional since 4.1.5.
		'title'    => __( 'Description', 'samepage' ), // Meta box title - Will appear at the drag and drop handle bar. Required.
		'pages'    => array( 'housekeep_partner' ), // Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
		'context'  => 'normal', // Where the meta box appear: normal (default), advanced, side. Optional.
		'priority' => 'high', // Order of meta box: high (default), low. Optional.
		'autosave' => false, // Auto save: true, false (default). Optional.
		'fields'   => array(

			// Page/Post class
			array(
				'name'    => __( 'Description', 'samepage' ),
				'id'      => "{$prefix}description",
				'desc'    => __( '', 'samepage' ),
				'type'    => 'textarea',
				'rows' => 5,
			),


		)
	);

	$meta_boxes[] = array(
		'id'       => 'page-post-settings', // Meta box id, UNIQUE per meta box. Optional since 4.1.5.
		'title'    => __( 'Partner Settings', 'samepage' ), // Meta box title - Will appear at the drag and drop handle bar. Required.
		'pages'    => array( 'housekeep_partner' ), // Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
		'context'  => 'normal', // Where the meta box appear: normal (default), advanced, side. Optional.
		'priority' => 'high', // Order of meta box: high (default), low. Optional.
		'autosave' => false, // Auto save: true, false (default). Optional.
		'fields'   => array(

			// Page/Post class
			// array(
			// 	'name'    => __( 'リングネーム', 'samepage' ),
			// 	'id'      => "{$prefix}ring_name",
			// 	'desc'    => __( '', 'samepage' ),
			// 	'type'    => 'text',
			// ),
			array(
				'name'    => __( 'ふりがな', 'samepage' ),
				'id'      => "{$prefix}sub_name",
				'desc'    => __( '', 'samepage' ),
				'type'    => 'text',
			),
			// array(
			// 	'name'    => __( '所属団体', 'samepage' ),
			// 	'id'      => "{$prefix}post_group",
			// 	'desc'    => __( '', 'samepage' ),
			// 	'type'    => 'text',
			// ),
			array(
				'name'    => __( '生年月日', 'samepage' ),
				'id'      => "{$prefix}date_birth",
				'desc'    => __( '(yyyy-mm-dd)', 'samepage' ),
				'type'    => 'date',
				'js_options' => array(
					'appendText'      => __( 'yyyy年mm月dd日', 'samepage' ),
					'dateFormat'      => __( 'yy年mm月dd日', 'samepage' ),
					'changeMonth'     => true,
					'changeYear'      => true,
					'showButtonPanel' => true,
				),
			),
			array(
				'name'    => __( '血液型', 'samepage' ),
				'id'      => "{$prefix}blood_type",
				'desc'    => __( '', 'samepage' ),
				'type'    => 'select',
				'options' => array(
					'A型'             => __( 'A型', 'samepage' ),
					'B型'  => __( 'B型', 'samepage' ),
					'AB型' => __( 'AB型', 'samepage' ),
					'O型'  => __( 'O型', 'samepage' )
				),
				'multiple' => false,
				'std'      => 'A型'
			),
			array(
				'name'    => __( '出身地', 'samepage' ),
				'id'      => "{$prefix}native_place",
				'desc'    => __( '', 'samepage' ),
				'type'    => 'text',
			),
			array(
				'name'    => __( '得意な家事', 'samepage' ),
				'id'      => "{$prefix}proud_housekeeping",
				'desc'    => __( '', 'samepage' ),
				'type'    => 'text',
				'clone'	  => true
			),


		)
	);

	$meta_boxes[] = array(
		'id'       => 'partner-links-settings', // Meta box id, UNIQUE per meta box. Optional since 4.1.5.
		'title'    => __( 'Links', 'samepage' ), // Meta box title - Will appear at the drag and drop handle bar. Required.
		'pages'    => array( 'housekeep_partner' ), // Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
		'context'  => 'normal', // Where the meta box appear: normal (default), advanced, side. Optional.
		'priority' => 'high', // Order of meta box: high (default), low. Optional.
		'autosave' => false, // Auto save: true, false (default). Optional.
		'fields'   => array(

			// Page/Post class
			array(
				'name'    => __( '所属団体ホームページ', 'samepage' ),
				'id'      => "{$prefix}homepage_link",
				'desc'    => __( '', 'samepage' ),
				'type'    => 'text',
			),
			array(
				'name'    => __( 'Facebook Link', 'samepage' ),
				'id'      => "{$prefix}fb_link",
				'desc'    => __( '', 'samepage' ),
				'type'    => 'text',
			),
			array(
				'name'    => __( 'Twitter Link', 'samepage' ),
				'id'      => "{$prefix}tweet_link",
				'desc'    => __( '', 'samepage' ),
				'type'    => 'text',
			),
			array(
				'name'    => __( 'ブログのバナー', 'samepage' ),
				'id'      => "{$prefix}blog_link",
				'desc'    => __( '', 'samepage' ),
				'type'    => 'text',
			),


		)
	);






	return $meta_boxes;
}

