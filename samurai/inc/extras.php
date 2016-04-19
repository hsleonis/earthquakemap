<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package energy
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function energy_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	return $classes;
}
add_filter( 'body_class', 'energy_body_classes' );

// Get Option Value
function energy_option($id){
	$output = of_get_option('op-' . $id);
	return $output;
}

function HTMLToRGB($htmlCode){
    if($htmlCode[0] == '#')
      $htmlCode = substr($htmlCode, 1);

    if (strlen($htmlCode) == 3)
    {
      $htmlCode = $htmlCode[0] . $htmlCode[0] . $htmlCode[1] . $htmlCode[1] . $htmlCode[2] . $htmlCode[2];
    }

    $r = hexdec($htmlCode[0] . $htmlCode[1]);
    $g = hexdec($htmlCode[2] . $htmlCode[3]);
    $b = hexdec($htmlCode[4] . $htmlCode[5]);

    return $b + ($g << 0x8) + ($r << 0x10);
}

function RGBToHSL($RGB) {
	$RGB = HTMLToRGB($RGB);
	$r = 0xFF & ($RGB >> 0x10);
	$g = 0xFF & ($RGB >> 0x8);
	$b = 0xFF & $RGB;

	$r = ((float)$r) / 255.0;
	$g = ((float)$g) / 255.0;
	$b = ((float)$b) / 255.0;

	$maxC = max($r, $g, $b);
	$minC = min($r, $g, $b);

	$l = ($maxC + $minC) / 2.0;

	if($maxC == $minC)
	{
	  $s = 0;
	  $h = 0;
	}
	else
	{
	  if($l < .5)
	  {
	    $s = ($maxC - $minC) / ($maxC + $minC);
	  }
	  else
	  {
	    $s = ($maxC - $minC) / (2.0 - $maxC - $minC);
	  }
	  if($r == $maxC)
	    $h = ($g - $b) / ($maxC - $minC);
	  if($g == $maxC)
	    $h = 2.0 + ($b - $r) / ($maxC - $minC);
	  if($b == $maxC)
	    $h = 4.0 + ($r - $g) / ($maxC - $minC);

	  $h = $h / 6.0;
	}

	$h = (int)round(255.0 * $h);
	$s = (int)round(255.0 * $s);
	$l = (int)round(255.0 * $l);

	return (object) Array('hue' => $h, 'saturation' => $s, 'lightness' => $l);
}

function energy_enqueue_dynamic_css() {
    // Include dynamic CSS file
    include( get_template_directory() . '/samurai/css/custom.php' );
}
add_action( 'wp_head', 'energy_enqueue_dynamic_css' );

// Visual Composer Custom Shortcodes
include get_template_directory() . '/samurai/inc/vc_shortcodes.php';

// If Current Screen is Edit Page or New Page
function is_edit_page($new_edit = null){
    global $pagenow;
    //make sure we are on the backend
    if (!is_admin()) return false;


    if($new_edit == "edit")
        return in_array( $pagenow, array( 'post.php',  ) );
    elseif($new_edit == "new") //check for new post page
        return in_array( $pagenow, array( 'post-new.php' ) );
    else //check for either new or edit
        return in_array( $pagenow, array( 'post.php', 'post-new.php' ) );
}

function custom_flags($show_text = 1){
	if( function_exists('pll_the_languages') && energy_option('multi_activate')){
		$flag_args = array(
			'show_flags' => 1,
			'show_names' => $show_text,
			'raw' => '1'
		);

		$flags = pll_the_languages($flag_args);
		$current = '';
		$flag_list = '';
		foreach ($flags as $key) {
			$flag_img = $key['flag'];
			$name = $key['name'];
			$url = $key['url'];
			if($key['current_lang']){
				$current .= '<span class="flag-current">' . $flag_img . '<span class="flag-text">'  . $name . '</span></span>';
			}
			else{
				$flag_list .= '<li><a href="' . $url  . '">' . $flag_img .'<span class="flag-text">'  . $name . '</span></a></li>';
			}

		}


		?>
			
			<span class="flag-container">
				<?php echo $current; ?>
				<ul class="flags">
					<?php echo $flag_list; ?>
				</ul>
			</span>
		<?php
	}
}

function polylang_is_active(){
	if( function_exists('pll_the_languages')){
		return 1;
	}
	else{
		return 0;
	}
}

function custom_current_lang(){
	if(polylang_is_active()){
		$current_lang = pll_current_language();
		if($current_lang == pll_default_language('slug')){
			return 0;
		}
		else{
			return $current_lang;
		}
	}
	else{
		return 0;
	}
}

function get_custom_lang_value($value){
	if(custom_current_lang()){
		$new_value = energy_option($value . '_' . custom_current_lang());
		if($new_value == null) $new_value = energy_option($value);
	}
	else{
		$new_value = energy_option($value);
	}
	

	
	return $new_value;
}

function custom_lang_loop(){
	if(polylang_is_active()){
		global $polylang;
		$i = 0;
		$langs = array();
		foreach ($polylang->get_languages_list() as $term){
			if($term->slug != pll_default_language('slug')){
				$langs[] = array(
						'slug' => $term->slug,
						'name' => $term->name
					);
			}
			
			
		}

		return $langs;
		    
	}
	else{
		return 0;
	}
}

function custom_theme_option($option = array()){
	$custom_option = array();
	$loop_option = $option;
	if(custom_lang_loop()){
		$lang_list = custom_lang_loop();
		$i = 0;
		foreach ($lang_list as $lang) {
			$i++;
			$name = $lang['name'];
			$slug = $lang['slug'];
			if($i == 1) $option['class'] = 'field-border-top';
			if($i == count($lang_list)) $option['class'] = 'field-border-bottom';

			$option['name'] = $loop_option['name'] . ' (' . $name . ')';
			$option['id'] = $loop_option['id'] . '_' . $slug;
			$custom_option[] = $option;

		}

		
	}

	return $custom_option;
}