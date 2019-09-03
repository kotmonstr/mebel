<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Ace Corporate
 */
?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) & !(IE 8)]><!-->
<html <?php language_attributes(); ?> class="no-js">
<!--<![endif]-->
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

    <?php wp_head(); ?>
</head>

<?php
$boxedornot = ace_corporate_boxedornot();
$pageclass = 'boxed-layout';
if ($boxedornot == 'fullwidth') {
    $pageclass = 'fullwidth-layout';
} else {
    $pageclass = 'boxed-layout container';
}
$bodyclass = array($pageclass);

?>
<body <?php body_class($bodyclass); ?>>

<div id="themenu" class="hide mobile-navigation">
    <?php
    $args = array(
        'theme_location' => 'primary',
        'depth' => 4,
    );
    wp_nav_menu($args);
    ?>
</div>
<!-- Mobile Navigation -->

<div id="page" class="hfeed site site_wrapper thisismyheader">

    <?php do_action('before'); ?>

    <header id="masthead" class="site-header" role="banner">
        <nav id="site-navigation"
             class="main-navigation navbar <?php if ($boxedornot == 'boxed') { ?>container<?php } ?>" role="navigation">

            <a class="skip-link screen-reader-text"
               href="#content"><?php esc_html_e('Skip to content', 'ace-corporate'); ?></a>

            <?php if ($boxedornot == 'fullwidth') { ?>
            <div class="container">
                <?php } ?>

                <div class="navbar-header">

                    <div class="site-branding navbar-brand">
                        
                        
                             <div class="site-brand text-center">
                           <?php the_custom_logo(); ?>
                        </div>
                        

                            <!-- Remove the site title and desc if logo is specified -->
                            <div class="site-desc site-brand text-center">
                                <h1 class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>"
                                                          rel="home"><?php bloginfo('name'); ?></a></h1>
                                <h5 class="site-description"><?php bloginfo('description'); ?></h5>
                            </div>
                        

                    </div>
                    <!-- End the Site Brand -->

                    <a href="#themenu" type="button" class="navbar-toggle" role="button" id="hambar">
                        <span></span>
                        <span></span>
                        <span></span>
                        <span></span>
                        <span></span>
                        <span></span>
                    </a>

                </div>

                <div class="collapse navbar-collapse" id="navbar-collapse-main">
                    <?php

                    if (has_nav_menu('primary')) {
                        wp_nav_menu(array(
                            'theme_location' => 'primary',
                            'container' => false,
                            'depth' => 4,
                            'menu_class' => 'nav navbar-nav navbar-right main-site-nav',
                            'walker' => new ace_corporate_bootstrap_nav_menu(),
                        ));
                    } else {
                        wp_page_menu(array(
                            'depth' => -1,
                            'menu_class' => 'menu fallback_menu_default'
                        ));
                    }
                    ?>
                </div>
                <!-- End /.navbar-collapse -->

                <?php if ($boxedornot == 'fullwidth') { ?>
            </div>
        <?php } ?>

        </nav>
        <!-- End #site-navigation -->
        <?php
         if (!is_page_template('page-templates/template-cpmfront.php')) {
            // Get Slider Posts from the customizer
            if (get_theme_mod('featured_post') != "") {
               // $slider_posts_id = get_theme_mod('featured_post'); // can't be escaped as it returns value in array.
                $slider_posts_args = array(
                    'post_type' => 'post',
                    //'post_status' => 'publish',
                    //'posts_per_page' => -1,
                   // 'post__in' => (array)$slider_posts_id,
                );
                $slider_variable = new WP_Query($slider_posts_args);
                if($slider_variable-> have_posts()){
                ?>

                <!-- Home page pro Slider -->
                <div id="home-slider" class="featured-slider slick-slider">

                    <?php
                   while($slider_variable->have_posts()) {$slider_variable-> the_post();
                        $image = wp_get_attachment_url(get_post_thumbnail_id($slider_variable->ID));
                        ?>
                        <div class="slide-item" style="background-image: url('<?php echo esc_url($image); ?>');">
                            <div class="container">
                                <div class="slider-image">
                                    <div class="slider-desc-wrapper">

                                        <div class="slider-desc-text">

                                            <div class="slider-desc">
                                                <h1>
                                                    <a href="<?php echo esc_url(get_permalink(get_the_ID())); ?>"> <?php the_title(); ?></a>
                                                </h1>
                                                <p><?php echo wp_trim_words( the_excerpt(), 25, ' ...' ); ?> </p>
                                                <a href="<?php echo esc_url(get_permalink($slider_variable->ID)); ?>"
                                                   class="pillbtn promo-btn btn" role="button">
                                                    <?php esc_html_e('Read More ', 'ace-corporate'); ?><i
                                                            class="fa fa-long-arrow-right"></i>
                                                </a>
                                            </div>

                                        </div>

                                    </div>
                                </div>
                                <!-- Slide Desc Wrapper -->
                            </div>
                        </div>
                        <!-- Slide Item -->
                    <?php } ?>

                </div>

            <?php }}
        }
        if (is_page_template('page-templates/template-cpmfront.php') ) {
            ace_corporate_breadcrumb();
        }?>
    </header>
    <!-- End #masthead -->

    <div id="content-wrap" class="site-content">
