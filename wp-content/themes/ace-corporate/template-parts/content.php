<?php
/**
 * The template for displaying Stardard post formats
 *
 * @package Ace Corporate
 */
?>

<?php
$metadisplay = get_theme_mod('show_blog_meta',1);

$featured_image = wp_get_attachment_url(get_post_thumbnail_id($post->ID));
$featured_image_id = get_post_thumbnail_id();
$image_alt = get_post_meta($featured_image_id, '_wp_attachment_image_alt', true);
$alttxt = ($image_alt ? $image_alt : '');
$front = get_option('show_on_front');
if (!is_single() && !is_archive() && !is_search() && !is_page_template('page-templates/template-blog.php')) {
    ?>
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>> 

        <div class="post-content entry-content">

            <?php if ($featured_image) { ?>
                <div class="featured-image archive-thumb">

                    <a title="<?php the_title_attribute();?>"<?php the_title(); ?> href="<?php echo esc_url(get_permalink()); ?>"
                       class="post-thumbnail">

                        <img src="<?php echo esc_url($featured_image); ?>" class="attachment-custom_post_size wp-post-image" alt="<?php echo esc_attr($alttxt); ?>">

                        <div class="share-mask">
                            <div class="share-wrap">

                            </div>
                        </div>

                    </a>
                </div>
            <?php } ?>

            <?php if (is_front_page() && $front == 'posts' || is_home()) { ?>

                <header class="entry-header">
                    <?php the_title(sprintf('<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url(get_permalink())), '</a></h2>'); ?>
                     <?php if($metadisplay==1){?>
                    <div class="entry-meta">
                   <?php ace_corporate_posted_on(); ?>
                    </div>
                  <?php }?>
                    <!-- End Entry-meta -->

                </header>
        <?php  $title = get_the_title();
            if (empty($title)) {
                     echo '<a href="' . esc_url(get_the_permalink()) . '">';
                } ?>
                <div class="entry-wrap clearfix">
                    <?php ace_corporate_post_content(); ?>
                     
                </div>

            <?php } ?>

        </div>
        <!-- End Post Content -->

        <?php if (is_front_page() && $front == 'posts' || is_home()) { ?>

            <footer class="entry-footer clearfix">
                <?php ace_corporate_entry_footer(); ?>
                 
            </footer>
            <!-- End Entry Footer -->


        <?php } ?>

    </article>

<?php } else { ?>

    <!-- If the post is single or archive display this block  -->

    <?php if ($featured_image) { ?>

        <?php if (is_single() && !is_attachment()) { ?>

            <div class="featured-image archive-thumb">

                <a title="<?php the_title_attribute();?>"<?php the_title(); ?> href="<?php echo esc_url(get_permalink()); ?>" class="post-thumbnail">
                    <img src="<?php echo esc_url($featured_image); ?>" class="attachment-custom_post_size wp-post-image" alt="<?php echo esc_attr($alttxt); ?>">
                </a>

            </div>

        <?php } else if (!is_attachment()) { ?>

            <div class="featured-image archive-thumb">

                <a title="<?php the_title_attribute();?>"<?php the_title(); ?> href="<?php echo esc_url(get_permalink()); ?>" class="post-thumbnail">

                    <img src="<?php echo esc_url($featured_image); ?>" class="attachment-custom_post_size wp-post-image" alt="<?php echo esc_attr($alttxt); ?>">

                    <div class="share-mask">
                        <div class="share-wrap">

                        </div>
                    </div>

                </a>

            </div>

        <?php } ?>
    <?php } ?>

    <header class="entry-header">

        <?php if (is_single()) {
            the_title('<h2 class="entry-title">', '</h2>');
        } else {
            the_title(sprintf('<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url(get_permalink())), '</a></h2>');
        } ?>

       <?php if($metadisplay==1){?>
                    <div class="entry-meta">
                   <?php ace_corporate_posted_on(); ?>
                    </div>
                  <?php }?>
    </header>

    <div class="entry-wrap clearfix">

        <?php
        if (is_search() || is_archive() || is_page_template('page-templates/template-blog.php')) {
            $title = get_the_title();
            if (empty($title)) {

                echo '<a href="' . esc_url(get_the_permalink()) . '"> ';

            }
           echo wp_kses_post(ace_corporate_strip_url_content( esc_attr(get_theme_mod('excerpt_length', 20)))); 
            if (empty($title)) {
                echo '</a>';
            }
        } else {
            the_content(__('more <span class="meta-nav">...</span>', 'ace-corporate'));

            $default = array(
                'before' => '<div class="page-links"><span class="page-links-title">' . __('Pages:', 'ace-corporate') . '</span>',
                'after' => '</div>',
                'link_before' => '<span>',
                'link_after' => '</span>',
                'pagelink' => '<span class="screen-reader-text">' . __('Page', 'ace-corporate') . ' </span>%',
                'separator' => '<span class="screen-reader-text">, </span>',
            );

            wp_link_pages($default);
        }
        ?>

    </div>

    <?php if (!is_archive() && !is_search()) { ?>

        <footer class="entry-footer clearfix">
            <?php ace_corporate_entry_footer(); ?>
        </footer>

    <?php } ?>
    <!-- End Entry Footer -->

<?php } ?>
