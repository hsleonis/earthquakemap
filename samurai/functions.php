<?php
/**
 * energy functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package energy
 */

if ( ! function_exists( 'energy_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function energy_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on energy, use a find and replace
	 * to change 'energy' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'energy', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'energy' ),
		'sub' => esc_html__( 'Sub', 'energy' ),
		'footer' => esc_html__( 'Footer', 'energy' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'energy_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // energy_setup
add_action( 'after_setup_theme', 'energy_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function energy_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'energy_content_width', 640 );
}
add_action( 'after_setup_theme', 'energy_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function energy_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'energy' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'energy_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function energy_scripts() {
	wp_enqueue_style( 'energy-style', get_stylesheet_uri() );
	wp_enqueue_style( 'energy-tablet', get_template_directory_uri() . '/css/tablet.css', null, null, 'only screen and (max-width: 1024px)' );
	wp_enqueue_style( 'energy-mobile', get_template_directory_uri() . '/css/mobile.css', null, null, 'only screen and (max-width: 767px)' );

	wp_enqueue_script( 'energy-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'energy-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'energy_scripts' );

/**
 * Enqueue admin scripts and styles.
 */
function admin_import_scripts() {

    wp_register_script( 'energy-import', get_template_directory_uri() . '/inc/energy-import.js', false, '1.0.0' );
    wp_register_script( 'energy-hopscotch-js', get_template_directory_uri() . '/inc/admin/hopscotch.min.js', array( 'jquery' ), null);
    wp_register_style( 'energy-hopscotch-css', get_template_directory_uri() . '/inc/admin/hopscotch.min.css', $deps, null, $media );

    wp_register_script( 'energy-admin-js', get_template_directory_uri() . '/inc/admin/admin.js', array( 'jquery' ), null);

    wp_enqueue_script( 'energy-import' );
    if(is_edit_page() && get_the_title() == 'Home'){

    	wp_enqueue_script( 'energy-hopscotch-js' );
    	wp_enqueue_script( 'energy-admin-js' );
    	wp_enqueue_style( 'energy-hopscotch-css' );
    	add_action('admin_notices', 'edit_tutorial');
    	wp_localize_script( 'energy-admin-js', 'admin_src', get_template_directory_uri() . '/inc/admin/' );
    }

}
add_action( 'admin_enqueue_scripts', 'admin_import_scripts' );



function edit_tutorial() {
	global $current_user ;
        $user_id = $current_user->ID;
        /* Check that the user hasn't already clicked to ignore the message */
	if ( ! get_user_meta($user_id, 'energy_tutorial') ) {
		echo '<div class="updated is-dismissible notice"><p>';
	    printf(__('チュートリアルを開始するには、<a href="#import" id="tutorial">スタート</a>をクリック'));
	    echo "</p></div>";

	    echo '<div class="import_message"></div>';
	}

}
/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';


/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Notification
 */
function myactivationfunction($oldname, $oldtheme=false) {
	global $current_user ;
        $user_id = $current_user->ID;
 	delete_user_meta( $user_id, 'energy_import_activate', 'true', true );
}
add_action("after_switch_theme", "myactivationfunction", 10 ,  2);


add_action('admin_notices', 'my_admin_notice');

function my_admin_notice() {
	global $current_user ;
        $user_id = $current_user->ID;
        /* Check that the user hasn't already clicked to ignore the message */
	if ( ! get_user_meta($user_id, 'energy_import_activate') ) {
        echo '<div class="updated is-dismissible notice"><p>';
        printf(__('Click <a href="#import" id="energy_import">here</a> to install example page | <a href="%1$s" >Dismiss Notice</a>'), '?energy_activation=0');
        echo "</p></div>";

        echo '<div class="import_message"></div>';
	}
}

add_action('admin_init', 'energy_activation');

function energy_activation() {
	global $current_user;
        $user_id = $current_user->ID;
        /* If user clicks to ignore the notice, add that to their user meta */
    if ( isset($_GET['energy_activation']) && '0' == $_GET['energy_activation'] ) {
        add_user_meta($user_id, 'energy_import_activate', 'true', true);
	}
	if ( isset($_GET['energy_tutorial']) && '0' == $_GET['energy_tutorial'] ) {
        add_user_meta($user_id, 'energy_tutorial', 'true', true);
	}
}

/**
 * One Click Install File
 */
include_once( 'inc/energy-importer.php' );

/**
 * Import Plugin
 */
include get_template_directory() . '/inc/plugin-import.php';

/**
 * Load Options Framework
 */
define( 'OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/inc/options-framework/' );
require_once get_template_directory() . '/inc/options-framework/options-framework.php';

/**
 * Load Meta-Box
 */

/*
define( 'RWMB_URL', trailingslashit( get_template_directory_uri() . '/inc/meta-box' ) );
define( 'RWMB_DIR', trailingslashit( get_template_directory() . '/inc/meta-box' ) );
require_once RWMB_DIR . 'meta-box.php';
include RWMB_DIR . 'config-meta-boxes.php';
*/
