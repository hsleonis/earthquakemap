<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package energy
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>

<script type='text/javascript'>
    var _glc =_glc || []; _glc.push('ag9zfmNsaWNrZGVza2NoYXRyEQsSB3dpZGdldHMY4Iy6uBMM');
    var glcpath = (('https:' == document.location.protocol) ? 'https://my.clickdesk.com/clickdesk-ui/browser/' : 
    'http://my.clickdesk.com/clickdesk-ui/browser/');
    var glcp = (('https:' == document.location.protocol) ? 'https://' : 'http://');
    var glcspt = document.createElement('script'); glcspt.type = 'text/javascript'; 
    glcspt.async = true; glcspt.src = glcpath + 'livechat-new.js';
    var s = document.getElementsByTagName('script')[0];s.parentNode.insertBefore(glcspt, s);

    // Custom code
    var CLICKDESK_Live_Chat = CLICKDESK_Live_Chat || {};
    CLICKDESK_Live_Chat.on_after_load = function() {
    // Conditional check of widget id
    if (ClickDesk_Widget_Util.widget_id != "ag9zfmNsaWNrZGVza2NoYXRyEQsSB3dpZGdldHMY4Iy6uBMM")
    return;
    setTimeout(
    function() {

    // Avatar image
    var avatar_src = "<?php echo get_stylesheet_directory_uri() ?>/img/kanae.png";
    widgetPrefsJSON.template_prefs.custom_image = avatar_src;
    var avatars = ClickDesk_DOM
    .wrap(".click-desk-visitor img");
    for ( var i = 0; i < avatars.length; i++) {
    var element = avatars[i];
    if (element)
    element.src = avatar_src;
    }
    }, 50);
    };
    </script>
</head>
<?php
    $site_title = get_bloginfo( 'name', 'display' );

    $request_label = get_custom_lang_value('request_label');
    $contact_label = get_custom_lang_value('contact_label');
    
    
?>
<body <?php body_class(); ?>>
<div id="page" class="site">

	<header id="masthead" class="site-header">
         <div class="mobile-trigger"></div>
        <div class="container mobile-nav">

            <div class="top-header">

                <?php get_template_part( 'template-parts/header', 'logo' ); ?>

                <div class="top-contact fr">
                    <?php if(energy_option('contact_link') != null): ?>
                        <a href="<?php echo energy_option('contact_link'); ?>" class="mail-link fl"><?php echo $contact_label; ?></a>
                    <?php endif; ?>
                    <?php if($request_label != null) :?>
                        <?php if ( is_front_page() || is_home() ) : ?>
                        
                            <a href="#estimate" class="btn-request fr btn-go">
                                <?php echo $request_label; ?>
                            </a>
                        <?php else: ?>
                            <a href="<?php echo esc_url( home_url( '/' ) ); ?>#estimate" class="btn-request fr btn-go"><?php echo $request_label; ?></a>
                        <?php endif; ?>
                    <?php endif; ?>

                    <div class="clear"></div>
                </div><!-- .top-contact -->

                <div class="clear"></div>
            </div><!-- .top-header -->

            <nav id="mastnav" class="site-navigation">
                <?php custom_flags(); ?>
            	<div class="menu">
            	   <?php wp_nav_menu( array( 'theme_location' => 'primary-samurai', 'menu_id' => 'primary-menu' ) ); ?>
                    <div class="clear"></div>
                </div>
            </nav><!-- .site-navigation -->
        </div>

        <div class="mobile-only">
            <?php custom_flags(); ?>
        </div>
    </header><!-- .site-header -->

	<div id="content" class="site-content">
		<div class="container">
