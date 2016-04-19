<?php
/**
 * SP Google Maps Metaboxes for custom post type
 * @since SP Google Maps 1.1.5
 */


add_action( 'cmb2_admin_init', 'cmb2_sample_metaboxes' );

/**
 * Define the metabox and field configurations.
 */
function cmb2_sample_metaboxes() {

	// Start with an underscore to hide fields from custom fields list
	
	/**
	 * Initiate the metabox
	 */
	$cmb = new_cmb2_box( array(
			'id'            => EQCMB . "admin",
			'title'         => __( 'Earthquake Support Information', 'cmb2' ),
			'object_types'  => array( 'support_place', ), // Post type
			'context'       => 'normal',
			'priority'      => 'high',
			'show_names'    => true, // Show field names on the left
			// 'cmb_styles' => false, // false to disable the CMB stylesheet
			// 'closed'     => true, // Keep the metabox closed by default
	) );

	/*
	$cmb->add_field( array(
			'name'       => __( 'Marker Title', 'cmb2' ),
			'desc'       => __( 'field description (optional)', 'cmb2' ),
			'id'         => EQCMB . 'marker_title',
			'type'       => 'text',
			//'show_on_cb' => 'cmb2_hide_if_no_cats', // function should return a bool value
			// 'sanitization_cb' => 'my_custom_sanitization', // custom sanitization callback parameter
			// 'escape_cb'       => 'my_custom_escaping',  // custom escaping callback parameter
			// 'on_front'        => false, // Optionally designate a field to wp-admin only
			// 'repeatable'      => true,
	) );
	*/
	// Regular text field
	$cmb->add_field( array(
			'name'       => __( 'Marker Latitude,Longitude', 'cmb2' ),
			'desc'       => __( 'Input Latitude &amp; Longitude Saperated By Comma. Or Choose The Location From from the map bellow. eg. lat,lan.', 'cmb2' ),
			'id'         => EQCMB . 'marker_latlng',
			'type'       => 'text',
			'after_row'  => '	<div class="cmb-row cmb-type-text cmb2-id--earthquake-map_preview table-layout">
		<div class="cmb-th">
			<label for="_earthquake_eq_map">Map Preview</label>
		</div>
		<div class="cmb-td">
			<div id="eq_map" style="width:550px; height: 250px"></div>
			<p class="cmb2-metabox-description">Choose The Location By Dragging The Marker</p>
		</div>
	</div>',
	) );
	//display: block;font-size: 14px;width: 25em;height: 300px;padding: 5px;position: relative;
	// URL text field
	$cmb->add_field( array(
			'name' => __( 'Reference URL', 'cmb2' ),
			'desc' => __( 'field description (optional)', 'cmb2' ),
			'id'   => EQCMB . 'ref_url',
			'type' => 'text_url',
			// 'protocols' => array('http', 'https', 'ftp', 'ftps', 'mailto', 'news', 'irc', 'gopher', 'nntp', 'feed', 'telnet'), // Array of allowed protocols
			// 'repeatable' => true,
	) );
	//Marker Address
	$cmb->add_field( array(
			'name'       => __( 'Address', 'cmb2' ),
			'desc'       => __( 'field description (optional)', 'cmb2' ),
			'id'         => EQCMB . 'address',
			'type'       => 'textarea',
	) );
	
	//submitter name
	$cmb->add_field( array(
			'name'       => __( 'Submitter Name', 'cmb2' ),
			'desc'       => __( 'field description (optional)', 'cmb2' ),
			'id'         => EQCMB . 'submitter_name',
			'type'       => 'text',
	) );
	
	// Email text field
	$cmb->add_field( array(
			'name' => __( 'Submitter Email', 'cmb2' ),
			'desc' => __( 'field description (optional)', 'cmb2' ),
			'id'   => EQCMB . 'submitter_email',
			'type' => 'text_email',
			// 'repeatable' => true,
	) );
	//submitter phone
	$cmb->add_field( array(
			'name'       => __( 'Submitter Phone', 'cmb2' ),
			'desc'       => __( 'field description (optional)', 'cmb2' ),
			'id'         => EQCMB . 'submitter_phone',
			'type'       => 'text',
	) );

}


//taxonomy metabox
add_action('place_category_add_form_fields','category_add_form_fields');
add_action('place_category_edit_form_fields','category_edit_form_fields', 10,2);
//add_action('marker_type_add_form','category_edit_form');
//add_action('marker_type_edit_form', 'category_edit_form');
function category_add_form_fields(){
?>
<div class="form-field term-description-wrap">
	<label for="catpic"><?php _e('Marker Icon URL', TextDomain); ?></label>
	<input type="url" id="marker_icon" name="marker_icon" size="40"/>
</div>
<?php
}
function category_edit_form_fields($tag,$taxonomy){
	$value = get_term_meta( $tag->term_id, EQCMB.'marker_icon', true );
	?>
	<tr class="form-field term-description-wrap">
		<th scope="row"><label for="catpic"><?php _e('Marker Icon URL', TextDomain); ?></label></th>
		<td>
			<input type="url" id="marker_icon" name="marker_icon" value="<?php echo $value; ?>" size="40"/>
		</td>
	</tr>
	<?php 
}