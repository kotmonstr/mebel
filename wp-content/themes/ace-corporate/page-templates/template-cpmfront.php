<?php
/**
 *
 * Template Name: Frontpage
 * Description: A page template that displays the Homepage or a Front page as in theme main page with slider and some other contents of the
 * post.
 *
 * @package Ace Corporate
 */

get_header();

// Boxed or Fullwidth
$boxedornot = ace_corporate_boxedornot();
$section_background = get_theme_mod('section_background');
$id = get_the_ID();
?>
<!-- End of Home page slider -->

<!-- The Call Out section starts here -->
<?php
$cat_id = get_theme_mod('first_post');

if ($cat_id != 'none') {

    $args = array(
        'post_type' => 'page',
        'post_status' => 'publish',
        'post__in' => (array)$cat_id,
        'posts_per_page' => 3,
    );
    $events = new WP_Query($args);

    if ($events->have_posts()) :?>
        <section class="section aboutbox">
            <?php if ($boxedornot == 'fullwidth') { ?>
            <div class="container">
                <?php } ?>
                <div class="row">
                    <?php if(get_theme_mod('first_post_title')){?>
                    <h2 class="section-title text-center" ><?php echo esc_html(get_theme_mod('first_post_title')); ?></h2>
                    <?php
                    }
                    while ($events->have_posts()) : $events->the_post();
                        $post_thumbnail_id = get_post_thumbnail_id($post->ID);
                        $attachment = get_post_meta($post_thumbnail_id);
                        $featured_image = wp_get_attachment_image_src($post_thumbnail_id, 'full');
                        ?>
                        <div class="col-md-4">
                            <article <?php post_class(); ?>>

                                <div class="service-wrap mob-center">

                                    <div class="media-wrapper">
                                        <div class="media-wrap"
                                             style="background-image:url(<?php echo esc_url($featured_image[0]); ?>)">
                                        </div>
                                    </div>
                                    <div class="service-body">
                                        <h3>
                                            <a href="<?php echo esc_url(get_permalink(get_the_ID())); ?>"> <?php the_title(); ?></a>
                                        </h3>
                                        <p><?php echo wp_kses_post(ace_corporate_strip_url_content( esc_attr(get_theme_mod('excerpt_length', 20)))); ?> </p>
                                        <a href="<?php echo esc_url(get_permalink($events->ID)); ?>"
                                           class="btn service-read"><?php esc_html_e('Read More', 'ace-corporate'); ?></a>
                                    </div>
                                </div>
                            </article>
                        </div>
                        <?php
                    endwhile;
                    ?>
                </div>
                <?php if ($boxedornot == 'fullwidth') { ?>
            </div>
        <?php } ?>

        </section>
        <?php
    endif;
    wp_reset_postdata();

}

?>
<?php
if (get_theme_mod('homepage_show_content')==1) {
    $post_thumbnail_id = get_post_thumbnail_id(get_the_ID());
    $image = wp_get_attachment_image_src($post_thumbnail_id, 'full');
    if (!empty($image)) {
        $image_style = "style='background-image:url(" . esc_url($image[0]) . ")'";
    } else {
        $image_style = '';
    }
   
    ?>

    <div class="page-content section">
        <div class="container-fluid">
            <div class="row">
            <?php if($image_style){?>
                <div class="page-img" <?php echo wp_kses_post($image_style); ?>>

                </div>
               <?php  }
                else{ ?>
                <div class="page-img page-content-video" ><?php ace_corporate_blog_post_format($post_format, $post_id); ?>

                </div>
               <?php  } ?>
                <div class="page-content-wrap">
                    <h2><?php echo  esc_html(get_the_title($id)); ?></h2>
                    <?php echo wp_kses_post(ace_corporate_get_excerpt($id,900)); ?>
                </div>
            </div>
        </div>
    </div>
<?php }?>
<?php
if (is_front_page()) {


if (post_type_exists('jetpack-portfolio')) {

    $portfolio_args = array(
        'post_type' => 'jetpack-portfolio',
        'orderby' => 'DATE',
        'order' => 'DESC',
    );

    $portfolio_query = new WP_Query($portfolio_args);

    if ($portfolio_query->have_posts()) {
        ?>
        <section id="portfolio" class="section portfolio">
            <?php if ($boxedornot == 'fullwidth') { ?>
            <div class="container">
                <?php } ?>
                <div class="row">
                    <?php if (get_theme_mod('portfolio_post_title')) { ?><h2
                            class="section-title text-center"><?php echo esc_html(get_theme_mod('portfolio_post_title')); ?></h2> <?php } ?>
                    <?php while ($portfolio_query->have_posts()) {
                        $portfolio_query->the_post(); ?>
                        <div class="col-md-4">
                            <div class="box">
                                <?php if (has_post_thumbnail()) {
                                    the_post_thumbnail('ace_corporate_port_size');
                                } ?>
                                <div class="box-content">
                                    <div class="content">
                                        <h3 class="title"><?php the_title(); ?></h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <?php if ($boxedornot == 'fullwidth') { ?>
            </div>
        <?php } ?>
        </section>
    <?php }
    wp_reset_postdata();
}

    if (get_theme_mod('cta_heading') != '' || get_theme_mod('cta_content_text') != '') { ?>
    <section id="promo" class="section promo"
             style="background: #2b2b2b <?php if (!empty($section_background)) { ?>url(<?php echo esc_url($section_background); ?>)repeat center center fixed" <?php } ?>>
        <?php if ($boxedornot == 'fullwidth') { ?>
        <div class="container">
            <?php } ?>
            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="promo-content">
                        <?php
                        if(get_theme_mod('cta_heading'))
                        echo '<h2>'.esc_attr(get_theme_mod('cta_heading')).'</h2>';
                        if(get_theme_mod('cta_content_text'))
                            echo '<p>'.esc_attr(get_theme_mod('cta_content_text')).'</p>';
                        ?>
                    </div>
                    <?php
                    $cta_text = esc_attr(get_theme_mod('cta_link_text'));
                    $cta_link_url = esc_attr(get_theme_mod('cta_link_url'));
                    if (!empty($cta_text) && !empty($cta_link_url)) {
                        ?>
                        <a href="<?php echo esc_url($cta_link_url); ?>" class="pillbtn promo-btn btn" target="_blank">
                            <?php echo esc_html($cta_text); ?>
                        </a>
                    <?php } ?>
                </div>
            </div>
            <?php if ($boxedornot == 'fullwidth') { ?>
        </div>
    <?php } ?>
    </section>
<?php } ?>
<!-- Portfolio section ends -->

<div class="pre-footer">
    <?php
    if (post_type_exists('jetpack-testimonial')) {

        $args = array(
            'post_type' => 'jetpack-testimonial',
            'orderby' => 'DATE',
            'order' => 'DESC',
        );
        $test_query = new WP_Query($args);
        ?>
        <div class="testimonial section">

            <?php if ($boxedornot == 'fullwidth') { ?>
            <div class="container">
                <?php
                }
                if (get_theme_mod('testimonial_section_title') != '')
                    echo '<h2 class="section-title text-center">' . esc_html(get_theme_mod('testimonial_section_title')) . '</h2>';
                ?>
                <div class="row">
                    <div id="testimonial-slider">
                        <?php
                        while ($test_query->have_posts()) :
                        $test_query->the_post();
                        $post_thumbnail_id = get_post_thumbnail_id(get_the_ID());
                        $image = wp_get_attachment_image_src($post_thumbnail_id, 'ace_corporate_test_size');
                        ?>
                        <div class="testimonial">
                            <div class="testimonial-wrap">
                                <div class="pic">
                                    <img src="<?php echo esc_url($image[0]); ?>">
                                </div>
                                <p class="description">
                                    <?php echo wp_kses_post(get_the_content()); ?>
                                </p>
                                <h3 class="title"><?php echo esc_html(get_the_title()) ?></h3>
                            </div>
                        </div>
                    <?php endwhile;
                    wp_reset_postdata();
                    ?>
                    </div>

                </div>
                <?php if ($boxedornot == 'fullwidth') { ?>
            </div>
        <?php } ?>
        </div>

        <?php
    }
    } ?>


</div>
<?php
$args = array(
    'post_type' => 'post',
    'orderby' => 'DATE',
    'order' => 'DESC',
    'posts_per_page' => 3,
);
$featured = new WP_Query($args);
  $loop = 1;

if ($featured->have_posts()) :
    
    ?>
    <section id="about" class="section blogroll aboutbox">
        <?php if ($boxedornot == 'fullwidth') { ?>
        <div class="container">
                  <?php }
            while ($featured->have_posts()): $featured->the_post();
                global $post;
                $post_format = get_post_format($post->ID);
                $blog_title= get_theme_mod('blog_section_title');
                echo(($loop % 3 == 1 || $loop == 1) ? '<div class="row">' : '');
                if ($loop == 1) {
                    echo(($loop == 1 && $blog_title) ? '<h2 class="section-title text-center">' . esc_html($blog_title) . '</h2>' : '');
                }
                if ($loop <= 3) {
                    ?>
                
                    <div class="col-md-4 col-sm-12 text-center">
                        <div <?php post_class(); ?>>

                            <div class="blog-content clearfix">
                                
                                <div class="blog-content-image effect-thumb">
                                    <?php get_template_part('template-parts/content', get_post_format($post->ID)); ?> 
                                    <?php if (get_theme_mod('show_blog_meta', 1)) { ?>
                                        <div class="entry-meta">
                                            <?php
                                            $blog_post_author = get_avatar(get_the_author_meta('ID'), 32);
                                            $author_name = get_the_author_meta('display_name');
                                            $author_firstname = get_the_author_meta('first_name');
                                            $author_lastname = get_the_author_meta('last_name');
                                            $author_id = get_the_author_meta('ID');
                                            $author_image = get_avatar($author_id); ?>
                                            <div class="date"><i class="fa fa-clock-o"
                                                                 aria-hidden="true"></i><span><?php echo esc_html(get_the_date()); ?></span>
                                            </div>
                                            <div class="author">
                                                <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>"
                                                   title="<?php echo esc_attr(get_the_author()); ?>">
                                                    <span><?php echo esc_html($author_name); ?></span><span
                                                            class="author-img"><?php echo get_avatar(get_the_author_meta('ID'), 60, '', 'author-image', ''); ?></span>
                                                </a>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>

                                <div class="blog-content-head">
                                    <h4><a href="<?php echo esc_url(get_permalink()); ?>"><?php the_title(); ?></a></h4>
                                </div>
                                <div class="blog-content-wrap">
                                    <p><?php echo wp_kses_post(ace_corporate_strip_url_content( esc_attr(get_theme_mod('excerpt_length', 20)))); ?></p>
                                     <a href="<?php echo esc_url(get_permalink($post->ID)); ?>"
                                           class="btn service-read"><?php esc_html_e('Read More', 'ace-corporate'); ?></a>
                                </div>

                            </div>
                            <!-- End Blog Content -->

                        </div>
                        <!-- End the Blog wrap -->
                    </div>

                     <?php
                }
                echo(($loop % 3 == 0&& $loop != 0) ? '</div>' : '');
                $loop++;
                endwhile; ?>

                <?php wp_reset_postdata(); ?>

            </div>
            <!-- End Row -->

            <?php if ($boxedornot == 'fullwidth') { ?>
        </div>
    <?php } ?>

    </section>
    <!-- End the blogroll -->

<?php endif; ?>
<?php get_footer(); ?>
