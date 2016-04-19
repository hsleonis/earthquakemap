<?php
$logo_description = get_custom_lang_value('logo_description');

?>

<div class="logo-container fl">
    <h1 class="site-logo">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
            <?php
                $site_logo = energy_option('site_logo');
                if($site_logo != null):
            ?>
                <img src="<?php echo $site_logo ?>" alt="<?php echo $site_title; ?>">
            <?php else: ?>
                <img src="<?php echo get_template_directory_uri(); ?>/img/site-logo.png" alt="<?php echo $site_title; ?>">
            <?php endif; ?>

        </a>
    </h1>


    <?php if($logo_description != null): ?>
        <span class="site-desc"><?php echo $logo_description; ?></span>
    <?php endif; ?>
</div><!-- .logo-container -->