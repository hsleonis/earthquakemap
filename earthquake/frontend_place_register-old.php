<?php
//place_confirm_nonce
function place_register(){
	if(isset($_POST['register_plan']) && wp_verify_nonce($_POST['confirm_place_nonce'], 'place_confirm_nonce')){
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
		if(isset($_POST[place_thumb])){
			require_once( ABSPATH . 'wp-admin/includes/admin.php' );
			require_once(ABSPATH . "wp-admin" . '/includes/image.php');
			require_once(ABSPATH . "wp-admin" . '/includes/file.php');
			require_once(ABSPATH . "wp-admin" . '/includes/media.php');
			if($_FILES){
				
				foreach ($_FILES as $file => $array) {
					if ($_FILES[$file]['error'] !== UPLOAD_ERR_OK) {
						switch ($_FILES[$file]['error']){
							case 1 :
							case 2 :
								$errors[] = array('file_upload' => "File upload limit exceeds.");
								break;
							case 3:
								$errors[] = array('file_upload' => "File was only partially uploaded.");
								break;
							case 4:
								$errors[] = array('file_upload' => "You Didn't Select File Or Your Browser Doesn't Send any file to server.");
								break;
							case 6:
								$errors[] = array('file_upload' => "Temporary folder is missing.");
								break;
							case 7:
								$errors[] = array('file_upload' => "File failed to saved in server disk");
								break;
							case 8:
								$errors[] = array('file_upload' => 'A PHP extension stopped the file upload. check phpinfo()');
								break;;
							default:
								break;
						}
							
					}
					$attach_id = media_handle_upload( $file, 0 );
				}
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
			
			$term_id = term_exists($_POST['category'], 'place_category');
			if($term_id!==null){
				$place['tax_input'] = array( 'place_category' => array($term_id['term_id']));
			}
			
			$placeID = wp_insert_post( $place, true );
            
			add_post_meta($placeID, '_thumbnail_id', $attach_id, true);
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