<?php
//place_confirm_nonce
function place_register(){
	if(isset($_POST['register_plan']) && wp_verify_nonce($_POST['place_confirm_nonce'], 'place_confirm_nonce')){
		$errors = array();
		//category
		if(!isset($_POST['category']) || empty($_POST['category']))
			$errors[] = array('category' => 'Place Category required.');
		//post_title
		if(!isset($_POST['post_title']) || empty($_POST['post_title']))
			$errors[] = array('post_title' => 'Place title required.');
		//post_content
		if(!isset($_POST['post_content']) || empty($_POST['post_content']))
			$errors[] = array('post_content' => 'Place Description required.');
		//longlang
		if(!isset($_POST['latlng']) || empty($_POST['latlng']))
			$errors[] = array('latlng' => 'Latitude,Longitude is required.');
		//city_name
		if(!isset($_POST['city_name']) || empty($_POST['city_name']))
			$errors[] = array('city_name' => 'City name is required.');
		//submitter_name
		if(!isset($_POST['submitter_name']) || empty($_POST['submitter_name']))
			$errors[] = array('submitter_name' => 'Your name is required.');
		//submitter_email
		if(!isset($_POST['submitter_email']) || empty($_POST['submitter_email']))
			$errors[] = array('submitter_email' => 'Your email is required.');
		//submitter_phone
		if(!isset($_POST['submitter_phone']) || empty($_POST['submitter_phone']))
			$errors[] = array('submitter_phone' => 'Your phone number is required.');
		if (isset( $_FILES['place_thumb'] ) ) {
            
			require_once( ABSPATH . 'wp-admin/includes/image.php' );
            require_once( ABSPATH . 'wp-admin/includes/file.php' );
            require_once( ABSPATH . 'wp-admin/includes/media.php' );
            $attachment_id = media_handle_upload( 'place_thumb', 0 );
	
            if ( is_wp_error( $attachment_id ) ) {
                //echo "There was an error uploading the image.";
            } else {
                //echo "The image was uploaded successfully!";
            }
		}
		
		
		if(empty($errors)){
			$place = array(
					'post_type'       => 'support_place',
					'post_author'     => 1,
					'post_status'     => 'publish',
					'post_title'      => esc_attr($_POST['post_title']),
					'post_content'    => esc_attr($_POST['post_content']),
					'comment_status'  => 'closed',
                    'tax_input'       => array(),
					'meta_input'      => array(
							EQCMB.'marker_latlng' => $_POST['latlng'],
							EQCMB.'ref_url' => $_POST['link'],
							EQCMB.'address' => $_POST['city_name'],
							EQCMB.'submitter_name' => $_POST['submitter_name'],
							EQCMB.'submitter_email' => $_POST['submitter_email'],
							EQCMB.'submitter_phone' => $_POST['submitter_phone'],
					),
					
			);
			
			$placeID = wp_insert_post( $place, true );
            
            if($attachment_id!=0)
            set_post_thumbnail( $placeID, $attachment_id );
            
            $term_id = term_exists($_POST['category'], 'place_category');
			if($term_id!==null){
                wp_set_post_terms( $placeID, array($term_id['term_id']), 'place_category', true );
            }
            
			if (session_id() == "")
				session_start();
			$_SESSION['place_submission_success'] = array('planID' => $placeID);
			wp_redirect(site_url('registration/'));exit;
		}else{
			if (session_id() == "")
				session_start();
			$_SESSION['place_submission_error'] = $errors;
		}
	}
}
add_action('init', 'place_register');