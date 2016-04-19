<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package energy
 */

?>

<?php
    $footer_title = get_custom_lang_value('footer-title');
    $footer_subtitle = get_custom_lang_value('footer-subtitle');
    $copyright = get_custom_lang_value('copyright');
?>
		 <div class="clear"></div>

        <a href="#page" class="goup"></a>
        <div class="clear"></div>
		</div><!-- .container -->
       
	</div><!-- #content -->

	<div class="footer-links">
        <div class="container">
            <p class="footer-title">

                <strong><?php echo $footer_title  ?></strong><?php echo $footer_subtitle;  ?>

            </p>
                <p class="footer-details">
                <?php $menuParameters = array(
                    'theme_location' => 'footer',
                    'menu_id' => 'footer-menu',
                    'echo'            => false,
                    'items_wrap'      => '%3$s'
                ) ;
                    echo strip_tags(wp_nav_menu( $menuParameters ), '<a>' );
                ?>
                </p>

        </div>

    </div>
    <footer id="mastfood" class="site-footer">
        <div class="container">
            <?php if(energy_option('copyright') != null): ?>
                <div class="site-copyright"><?php echo energy_option('copyright');  ?>   </div>
            <?php else: ?>
                <div class="site-copyright"><?php printf( esc_html__( 'Copyright ©%s %s All Rights Reserved.', 'energy' ), date('Y') , get_bloginfo('title' )); ?>   </div>
            <?php endif; ?>

        </div>
    </footer><!-- .site-footer -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
