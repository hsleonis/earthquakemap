<?php
/**
 * Custom shortcodes for Visual Composer
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package energy
 */

// Shortcodes
function same_special_heading( $atts ) {
	extract( shortcode_atts( array(
		'special_style' => '',
		'special_title' => '',
		'special_description' => ''
	), $atts ) );

	$output = '';
	$content = '';
	$layout = '';
	$layoutclose = '';


	switch ($special_style) {
		case 'for dark':
			$layout = '<div class="bg-stripe"></div>';
			$layoutclose = '';
			$content .= ($special_description != null)? '<div class="heading-round">' . $special_description .  '</div><div class="clear"></div>' : '';
			$content .= '<h3 class="section-title">' . $special_title .  '</h3>';
			break;

		case 'bordered':
			$layout = '<div class="double-border">';
			$layoutclose = '</div>';
			$content .= '<h3 class="section-title">' . $special_title .  '</h3>';
			$content .= ($special_description != null) ? '<p class="larger">' . $special_description .  '</p>' : '';
			break;

		default:

			$content .= '<h3 class="section-title">' . $special_title .  '</h3>';
			$content .= ($special_description != null)? '<p class="larger">' . $special_description .  '</p>' : '';
			break;
	}

	$output = sprintf('%s<div class="center">%s</div>%s',$layout,$content,$layoutclose);
	return $output;
}
add_shortcode( 'special_heading', 'same_special_heading' );

function same_reason_box( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'reason_top' => '',
		'reason_title' => '',
		'reason_image' => '',
		'reason_count' => 1,
		'reason_sub' => '',
		'reason_diamond' => '',
	), $atts ) );
	$content = wpb_js_remove_wpautop($content, true);

	$description = '';
	$image = wp_get_attachment_url($reason_image);
	$reason_diamond = wp_get_attachment_url($reason_diamond);

	$description .= '<div class="reason-item reason' . $reason_count . '">';
		$diamond = '';
		if($reason_diamond != null) $diamond = ' style="background-image:url(' . $reason_diamond . ');"';
        $description .= '<span class="reason-sub">' . $reason_top . '</span>';
        $description .= '<div class="reason-title">';
            $description .= '<span class="diamond' . $reason_count  .  '"' . $diamond . '></span>';
            $description .= ($reason_sub != null)? '<h5>' . $reason_sub .  '</h5>' : '';
           $description .= '<h3>' . $reason_title . '</h3>';
        $description .= '</div>';

        $description .= '<div class="reason-thumb">';
            $description .= '<img src="' . $image . '" alt="' . $reason_title . '">';
        $description .= '</div>';
        $description .= '<div class="reason-detail">' . $content . '</div>';

    $description .= '</div><!-- .reason-item -->';

	return $description;
}
add_shortcode( 'reason_box', 'same_reason_box' );

function same_next( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'next_link' => '',
	), $atts ) );
	$content = wpb_js_remove_wpautop($content, true);

	$description = '';

	$description .= '<a href="' . $next_link . '" class="btn-next btn-go"></a><div class="center">' . $content . '</div>';

	return $description;
}
add_shortcode( 'next_section', 'same_next' );

function same_voice_item( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'title' => '',
		'image' => '',
		'size' => '',
		'type' => '',
		'video' => ''
	), $atts ) );
	$content = wpb_js_remove_wpautop($content, true);
	$output = '';
	$extraClass = ($type != null) ? ' ' . $type : ' default';
	$size = ($size != null) ? ' ' . $size : ' default';

	$output .= '<div class="voice-item ' . $size . $extraClass . '">';
		if($image != null && $type == 'image'){
			$image = wp_get_attachment_url($image);
			$output .= '<div class="voice-thumb">';
	            $output .= '<img src="' . $image . '" alt="' . $reason_title . '">';
	        $output .= '</div>';
		}
		elseif($video != null && $type == 'video'){
			$output .= '<div class="voice-thumb"><div class="video-container">';
	            $output .= rawurldecode( base64_decode( strip_tags( $video ) ) );;
	        $output .= '</div></div>';

		}
		else{
			$extraClass = ' single-box';
		}

        $output .= '<div class="voice-detail' . $extraClass . '">';
            $output .= '<div class="heading-round pink">' . $title . '</div>';
            $output .= $content;
        $output .= '</div>';
    $output .= '</div><!-- .voice-item -->';



	return $output;
}
add_shortcode( 'voice_item', 'same_voice_item' );

function same_flow_item( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'step' => '',
		'icon' => '',
		'title' => '',
		'subtitle' => '',
		'subcontent' => '',
		'color' => '',
	), $atts ) );
	$content = wpb_js_remove_wpautop($content, true);
	$output = '';
	if($step != 1){
		$output .= '<span class="arrow-down arrow-down-' . $color . '"></span>';
	}
	$output .= '<div class="flow-item flow-item' . $step . ' flow-item-' . $color . '">';
	    $output .= '<div class="flow-step">';
	        $output .= '<div class="step-content">';
	        $output .= '<span>step</span>';
	        $output .= '<span class="main"> ' . $step . '</span>';
	        $output .= '</div>';
	    $output .= '</div>';
	    $output .= '<div class="flow-detail">';
	        $output .= '<h4 class="flow-title">';
	            $output .= '<span class="icon-' . $icon . '"></span>';
	            $output .= '<span class="smaller">' . $title;
	            	if($subtitle != null) $output .= '<span class="pink">' . $subtitle . '</span>';
	            $output .= '</span>';
	        $output .= '</h4>';
	        $output .= $content;
	        if($subcontent != null) {
	        	$subcontent = $content = rawurldecode( base64_decode( strip_tags( $subcontent ) ) );
	        	$output .= '<div class="flow-highlight bg-gray">' . $subcontent . '</div>';
	        }

	    $output .= '</div>';
	    $output .= '<div class="clear"></div>';
	$output .= '</div>';



	return $output;
}
add_shortcode( 'flow_item', 'same_flow_item' );

function same_faq_item( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'step' => 1,
		'title' => '',
	), $atts ) );
	$content = wpb_js_remove_wpautop($content, true);
	$output = '';

	$output .= '<div class="faq-item">';
        $output .= '<div class="faq-circle">';
            $output .= '<div class="circle-content">';
                $output .= '<span class="letter">Q</span>';
                $output .= '<span class="main">' . $step . '</span>';
            $output .= '</div>';
        $output .= '</div>';
        $output .= '<div class="faq-question">';
            $output .= '<p class="larger">' . $title . '</p>';
        $output .= '</div>';
        $output .= '<div class="faq-answer">';
            $output .= $content;
        $output .= '</div>';
        $output .= '<div class="clear"></div>';
    $output .= '</div><!-- .faq-item -->';

	return $output;
}
add_shortcode( 'faq_item', 'same_faq_item' );

function same_company_item( $atts ) {
	extract( shortcode_atts( array(
		'name' => '',
		'official' => '',
		'establishment' => '',
		'capital' => '',
		'address' => '',
		'telephone' => '',
		'fax' => '',
	), $atts ) );
	$output = '';

	$output .= '<div class="company-item">';
        $output .= '<div class="company-info">';
            $output .= '<div class="company-label">商号</div>';

            if($name != null):
            	$output .= '<div class="company-detail">';
                	$output .= $name;
            	$output .= '</div>';
            endif;

        $output .= '</div><!-- .company-info -->';
        $output .= '<div class="company-info">';
            $output .= '<div class="company-label">役員</div>';

            if($official != null):
            	$output .= '<div class="company-detail">';
                	$output .= $official;
            	$output .= '</div>';
            endif;

        $output .= '</div><!-- .company-info -->';
        $output .= '<div class="company-info">';
            $output .= '<div class="company-label">設立</div>';

            if($establishment != null):
            	$output .= '<div class="company-detail">';
                	$output .= $establishment;
            	$output .= '</div>';
            endif;

        $output .= '</div><!-- .company-info -->';
        $output .= '<div class="company-info">';
            $output .= '<div class="company-label">資本金</div>';

            if($capital != null):
            	$output .= '<div class="company-detail">';
                	$output .= $capital;
            	$output .= '</div>';
            endif;

        $output .= '</div><!-- .company-info -->';
        $output .= '<div class="company-info">';
            $output .= '<div class="company-label">所在地</div>';

            if($address != null):
            	$output .= '<div class="company-detail">';
                	$output .= $address;
            	$output .= '</div>';
            endif;

        $output .= '</div><!-- .company-info -->';
        $output .= '<div class="company-info">';
            $output .= '<div class="company-label">電話</div>';

            if($telephone != null):
            	$output .= '<div class="company-detail">';
                	$output .= $telephone;
            	$output .= '</div>';
            endif;

        $output .= '</div><!-- .company-info -->';
        $output .= '<div class="company-info">';
            $output .= '<div class="company-label">FAX</div>';

            if($fax != null):
            	$output .= '<div class="company-detail">';
                	$output .= $fax;
            	$output .= '</div>';
            endif;

        $output .= '</div><!-- .company-info -->';
    $output .= '</div>';

	return $output;
}
add_shortcode( 'company_item', 'same_company_item' );

function same_news_item( $atts ) {
	extract( shortcode_atts( array(
		'title' => '',
		'subtitle' => '',
		'post_type' => '',
	), $atts ) );
	$output = '';



	$output .= '<div class="news-items">';
	    $output .= '<h4 class="news-title">';
	        $output .= $title;
	        $output .= '<span class="sub">' . $subtitle . '</span>';
	    $output .= '</h4>';

	    	$query = new WP_Query( array(
		        'post_type' => $post_type,
		        'posts_per_page' => 10,
		        'order' => 'DESC',
		        'orderby' => 'date'
		    ) );

		    if ( $query->have_posts() ) {
		             while ( $query->have_posts() ) : $query->the_post();
		             	$output .= '<div class="news-item">';
		             	$output .= '<span class="news-date">' . get_the_date( '・Y.m.d.' ) . '</span>';
	        			$output .= '<span class="news-link">' . get_the_title( ) . '</span>';
		             	$output .= '</div>';
		             endwhile;
		            wp_reset_postdata();
		    }

	$output .= '</div><!-- .news-item -->';
	return $output;
}
add_shortcode( 'news_item', 'same_news_item' );



function same_presentation_frame( $atts ) {
	extract( shortcode_atts( array(
		'video' => '',
	), $atts ) );
	$output = '';
	
	$output .= '<div class="presentation-frame"><div class="presentation-container">';

	$output .= rawurldecode( base64_decode( strip_tags( $video )));

	$output .= '</div></div><!-- .presentation-frame -->';

	return $output;
}
add_shortcode( 'presentation_frame', 'same_presentation_frame' );

function same_company_single_item( $atts ) {
	extract( shortcode_atts( array(
		'label' => '',
		'description' => '',
	), $atts ) );
	$output = '';

	$output .= '<div class="company-info">';
            $output .= '<div class="company-label">';
            		if($label != null):
	                	$output .= $label;
	                endif;
            $output .= '</div>';

        	$output .= '<div class="company-detail">';
        	if($description != null):
            	$output .= $description;
            endif;
        	$output .= '</div>';


        $output .= '</div><!-- .company-info -->';
	return $output;
}
add_shortcode( 'company_single_item', 'same_company_single_item' );


// Visual Composer add-on modules
function same_integrateWithVC() {
	// Menu Item Module


	vc_map( array(
		'name'              => __( 'Special Heading', 'energy' ),
		'base'              => 'special_heading',
		'class'             => 'gm-special-heading',
		'category'          => __( 'Custom', 'energy'),
		'admin_enqueue_css' => array( get_template_directory_uri() . '/inc/css/vc.css' ),
		'params'            => array(
			array(
				'type'        => 'textfield',
				'holder'      => 'i',
				'heading'     => __( 'Title', 'energy' ),
				'param_name'  => 'special_title',
				'description' => 'The name of the menu item.',
				'admin_label' => true
			),
			array(
				'type'        => 'textfield',
				'holder'      => 'i',
				'heading'     => __( 'Sub title', 'energy' ),
				'description' => '',
				'param_name'  => 'special_description',
				'admin_label' => true
			),
			array(
				'type'        => 'dropdown',
				'holder'      => 'i',
				'heading'     => __( 'Style', 'energy' ),
				'param_name'  => 'special_style',
				'value'      => array('default', 'for dark','bordered'),
				'admin_label' => true
			)
      	)
	) );

	vc_map( array(
		'name'              => __( '選ばれる３つの理由 Box', 'energy' ),
		'base'              => 'reason_box',
		'class'             => 'gm-reason-box',
		'category'          => __( 'Custom', 'energy'),
		'admin_enqueue_css' => array( get_template_directory_uri() . '/inc/css/vc.css' ),
		'params'            => array(
			array(
				'type'        => 'dropdown',
				'holder'      => 'i',
				'heading'     => __( 'Count', 'energy' ),
				'param_name'  => 'reason_count',
				'value'      => array('1', '2','3'),
				'admin_label' => true
			),
			array(
				'type'        => 'attach_image',
				'holder'      => 'i',
				'heading'     => __( 'Or Replace Diamond Image', 'energy' ),
				'param_name'  => 'reason_diamond',
				'description' => '66x65 pixel',
				'admin_label' => true
			),
			array(
				'type'        => 'textfield',
				'holder'      => 'i',
				'heading'     => __( 'Top Title', 'energy' ),
				'param_name'  => 'reason_top',
				'description' => '',
				'admin_label' => true
			),
			array(
				'type'        => 'textfield',
				'holder'      => 'i',
				'heading'     => __( 'Sub Title', 'energy' ),
				'param_name'  => 'reason_sub',
				'description' => '',
				'admin_label' => true
			),
			array(
				'type'        => 'textfield',
				'holder'      => 'i',
				'heading'     => __( 'Main Title', 'energy' ),
				'param_name'  => 'reason_title',
				'admin_label' => true
			),
			array(
				'type'        => 'attach_image',
				'holder'      => 'i',
				'heading'     => __( 'Image', 'energy' ),
				'param_name'  => 'reason_image',
				'admin_label' => true
			),
			array(
				'type'        => 'textarea_html',
				'holder'      => 'i',
				'heading'     => __( 'Description', 'energy' ),
				'param_name'  => 'content',
				"value" => __( "<p>I am test text block. Click edit button to change this text.</p>", "same" ),
				'admin_label' => true
			),
      	)
	) );

	vc_map( array(
		'name'              => __( 'Next Section', 'energy' ),
		'base'              => 'next_section',
		'class'             => 'gm-next-section',
		'category'          => __( 'Custom', 'energy'),
		'admin_enqueue_css' => array( get_template_directory_uri() . '/inc/css/vc.css' ),
		'params'            => array(
			array(
				'type'        => 'textfield',
				'holder'      => 'i',
				'heading'     => __( 'Target', 'energy' ),
				'param_name'  => 'next_link',
				'description' => '',
				'admin_label' => true
			),
			array(
				'type'        => 'textarea_html',
				'holder'      => 'i',
				'heading'     => __( 'Description', 'energy' ),
				'param_name'  => 'content',
				"value" => __( "<p>I am test text block. Click edit button to change this text.</p>", "same" ),
				'admin_label' => true
			),
      	)
	) );

	vc_map( array(
		'name'              => __( '実際にご依頼いただいたお客様の声', 'energy' ),
		'base'              => 'voice_item',
		'class'             => 'gm-voice-item',
		'category'          => __( 'Custom', 'energy'),
		'admin_enqueue_css' => array( get_template_directory_uri() . '/inc/css/vc.css' ),
		'params'            => array(

			array(
				'type'        => 'dropdown',
				'holder'      => 'i',
				'heading'     => __( 'Type', 'energy' ),
				'param_name'  => 'type',
				'value'      => array('default', 'image', 'video'),
				'admin_label' => true
			),

			array(
				'type'        => 'attach_image',
				'holder'      => 'i',
				'heading'     => __( 'Image', 'energy' ),
				'param_name'  => 'image',
				'admin_label' => true
			),

			array(
				'type'        => 'textarea_raw_html',
				'holder'      => 'i',
				'heading'     => __( 'Iframe for Video', 'energy' ),
				'param_name'  => 'video',
				'description' => '',
				'admin_label' => true
			),

			array(
				'type'        => 'textfield',
				'holder'      => 'i',
				'heading'     => __( 'Title', 'energy' ),
				'param_name'  => 'title',
				'description' => '',
				'admin_label' => true
			),

			array(
				'type'        => 'textarea_html',
				'holder'      => 'i',
				'heading'     => __( 'Description', 'energy' ),
				'param_name'  => 'content',
				"value" => __( "<p>I am test text block. Click edit button to change this text.</p>", "same" ),
				'admin_label' => true
			),

			array(
				'type'        => 'dropdown',
				'holder'      => 'i',
				'heading'     => __( 'Size', 'energy' ),
				'param_name'  => 'size',
				'value'      => array('default', 'wide'),
				'admin_label' => true
			)
      	)
	) );

	vc_map( array(
		'name'              => __( 'ご利用の流れ', 'energy' ),
		'base'              => 'flow_item',
		'class'             => 'gm-flow-item',
		'category'          => __( 'Custom', 'energy'),
		'admin_enqueue_css' => array( get_template_directory_uri() . '/inc/css/vc.css' ),
		'params'            => array(

			array(
				'type'        => 'textfield',
				'holder'      => 'i',
				'heading'     => __( 'Step Number', 'energy' ),
				'param_name'  => 'step',
				'description' => '',
				'admin_label' => true
			),
			array(
				'type'        => 'dropdown',
				'holder'      => 'i',
				'heading'     => __( 'Icon', 'energy' ),
				'param_name'  => 'icon',
				'value'      => array('mail', 'write', 'handshake', 'file', 'print'),
				'admin_label' => true
			),
			array(
				'type'        => 'textfield',
				'holder'      => 'i',
				'heading'     => __( 'Title', 'energy' ),
				'param_name'  => 'title',
				'description' => '',
				'admin_label' => true
			),

			array(
				'type'        => 'textfield',
				'holder'      => 'i',
				'heading'     => __( 'Sub title', 'energy' ),
				'param_name'  => 'subtitle',
				'description' => '',
				'admin_label' => true
			),



			array(
				'type'        => 'textarea_html',
				'holder'      => 'i',
				'heading'     => __( 'Content', 'energy' ),
				'param_name'  => 'content',
				"value" => __( "<p>I am test text block. Click edit button to change this text.</p>", "same" ),
				'admin_label' => true
			),
			array(
				'type'        => 'textarea_raw_html',
				'holder'      => 'i',
				'heading'     => __( 'Sub Content', 'energy' ),
				'param_name'  => 'subcontent',
				'description' => '',
				'admin_label' => true
			),
			array(
				'type'        => 'dropdown',
				'holder'      => 'i',
				'heading'     => __( 'Color', 'energy' ),
				'param_name'  => 'color',
				'value'      => array('pink', 'green'),
				'admin_label' => true
			),
      	)
	) );

	vc_map( array(
		'name'              => __( 'よくある質問', 'energy' ),
		'base'              => 'faq_item',
		'class'             => 'gm-faq-item',
		'category'          => __( 'Custom', 'energy'),
		'admin_enqueue_css' => array( get_template_directory_uri() . '/inc/css/vc.css' ),
		'params'            => array(

			array(
				'type'        => 'textfield',
				'holder'      => 'i',
				'heading'     => __( 'Step Number', 'energy' ),
				'param_name'  => 'step',
				'description' => '',
				'admin_label' => true
			),

			array(
				'type'        => 'textfield',
				'holder'      => 'i',
				'heading'     => __( 'Title', 'energy' ),
				'param_name'  => 'title',
				'description' => '',
				'admin_label' => true
			),

			array(
				'type'        => 'textarea_html',
				'holder'      => 'i',
				'heading'     => __( 'Content', 'energy' ),
				'param_name'  => 'content',
				"value" => __( "<p>I am test text block. Click edit button to change this text.</p>", "same" ),
				'admin_label' => true
			),
      	)
	) );

	vc_map( array(
		'name'              => __( '会社概要 Single Item', 'energy' ),
		'base'              => 'company_single_item',
		'class'             => 'gm-faq-item',
		'category'          => __( 'Custom', 'energy'),
		'admin_enqueue_css' => array( get_template_directory_uri() . '/inc/css/vc.css' ),
		'params'            => array(

			array(
				'type'        => 'textfield',
				'holder'      => 'i',
				'heading'     => __( 'Label', 'energy' ),
				'param_name'  => 'label',
				'description' => '',
				'admin_label' => true
			),

			array(
				'type'        => 'textarea',
				'holder'      => 'i',
				'heading'     => __( 'Description', 'energy' ),
				'param_name'  => 'description',
				'description' => '',
				'admin_label' => true
			),
      	)
	) );

	vc_map( array(
		'name'              => __( '会社概要', 'energy' ),
		'base'              => 'company_item',
		'class'             => 'gm-company-item',
		'category'          => __( 'Custom', 'energy'),
		'admin_enqueue_css' => array( get_template_directory_uri() . '/inc/css/vc.css' ),
		'params'            => array(

			array(
				'type'        => 'textfield',
				'holder'      => 'i',
				'heading'     => __( '商号', 'energy' ),
				'param_name'  => 'name',
				'description' => '',
				'admin_label' => true
			),
			array(
				'type'        => 'textfield',
				'holder'      => 'i',
				'heading'     => __( '役員', 'energy' ),
				'param_name'  => 'official',
				'description' => '',
				'admin_label' => true
			),
			array(
				'type'        => 'textfield',
				'holder'      => 'i',
				'heading'     => __( '設立', 'energy' ),
				'param_name'  => 'establishment',
				'description' => '',
				'admin_label' => true
			),
			array(
				'type'        => 'textfield',
				'holder'      => 'i',
				'heading'     => __( '資本金', 'energy' ),
				'param_name'  => 'capital',
				'description' => '',
				'admin_label' => true
			),
			array(
				'type'        => 'textfield',
				'holder'      => 'i',
				'heading'     => __( '所在地', 'energy' ),
				'param_name'  => 'address',
				'description' => '',
				'admin_label' => true
			),
			array(
				'type'        => 'textfield',
				'holder'      => 'i',
				'heading'     => __( '電話', 'energy' ),
				'param_name'  => 'telephone',
				'description' => '',
				'admin_label' => true
			),
			array(
				'type'        => 'textfield',
				'holder'      => 'i',
				'heading'     => __( 'FAX', 'energy' ),
				'param_name'  => 'fax',
				'description' => '',
				'admin_label' => true
			),
      	)
	) );

	vc_map( array(
		'name'              => __( 'News', 'energy' ),
		'base'              => 'news_item',
		'class'             => 'gm-news-item',
		'category'          => __( 'Custom', 'energy'),
		'admin_enqueue_css' => array( get_template_directory_uri() . '/inc/css/vc.css' ),
		'params'            => array(

			array(
				'type'        => 'textfield',
				'holder'      => 'i',
				'heading'     => __( 'Title', 'energy' ),
				'param_name'  => 'title',
				'description' => '',
				'admin_label' => true
			),
			array(
				'type'        => 'textfield',
				'holder'      => 'i',
				'heading'     => __( 'Subtitle', 'energy' ),
				'param_name'  => 'subtitle',
				'description' => '',
				'admin_label' => true
			),
			array(
				'type'        => 'posttypes',
				'holder'      => 'i',
				'heading'     => __( 'Post Type', 'energy' ),
				'param_name'  => 'post_type',
				'description' => '',
				'admin_label' => true
			),
      	)
	) );

	vc_map( array(
		'name'              => __( 'Presentation Frame', 'energy' ),
		'base'              => 'presentation_frame',
		'class'             => 'gm-presentation-item',
		'category'          => __( 'Custom', 'energy'),
		'admin_enqueue_css' => array( get_template_directory_uri() . '/inc/css/vc.css' ),
		'params'            => array(

			array(
				'type'        => 'textarea_raw_html',
				'holder'      => 'i',
				'heading'     => __( 'Slideshare/Prezi Iframe', 'energy' ),
				'param_name'  => 'video',
				'description' => '',
				'admin_label' => true
			),
      	)
	) );
}
add_action( 'vc_before_init', 'same_integrateWithVC' );