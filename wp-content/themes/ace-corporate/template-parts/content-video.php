<?php
/**
* The template for displaying Video post formats
*
* @package Ace Corporate
*/
?>
<?php
$metadisplay = get_theme_mod('show_blog_meta',1);
    global $post;
    $post_format = get_post_format($post->ID);
    $featured_image = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) );
    $content =  $post->post_content;
    trim(  get_post_field('post_content', $post->ID) );
    $front = get_option('show_on_front');
    if(! is_single() && !is_archive() && !is_search() &&! is_page_template('page-templates/template-blog.php')){
?>
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>  
        <div class="post-content entry-content">
             <?php if( $front == 'posts' || is_home()){?>
                <div class="clearfix featured-item">
                    <?php ace_corporate_blog_post_format($post_format, $post->ID);?> 
                </div>
            <?php } ?>
            <?php if(  is_front_page() && $front == 'posts'|| is_home()){ ?>
                <header class="entry-header">
                    <?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
                    <?php if($metadisplay==1){?>
                    <div class="entry-meta">
                   <?php ace_corporate_posted_on(); ?>
                    </div>
                  <?php }?> <!-- End Entry-meta -->
                </header>

            <?php }

            if( $front == 'page' && ! is_home()){ ?>
                <div class="entry-wrap clearfix">
                   <?php ace_corporate_blog_post_format($post_format, $post->ID);?> 
                </div>
            <?php } else {  ?>
                <div class="entry-wrap clearfix">
                    <?php echo wp_kses_post(strip_shortcodes($post->post_excerpt)); ?>

                </div>
            <?php } ?>
            <!-- End Entry Content -->

        </div> <!-- End Post Content -->

        <?php if(  is_front_page() && $front == 'posts'|| is_home()){ ?>
        <footer class="entry-footer clearfix">
            <?php ace_corporate_entry_footer(); ?>
        </footer>
        <!-- End Entry-footer -->
        <?php } ?>

    </article>

<?php } else { ?>

    <!-- If the post is single or archive display this block  -->
    <?php if (is_archive() || is_page_template('page-templates/template-blog.php')) { ?>
        <div class="clearfix featured-item">
             <?php ace_corporate_blog_post_format($post_format, $post->ID);?> 
        </div>
    <?php } ?>

    <header class="entry-header">

        <?php if ( is_single() ) {
                the_title( '<h2 class="entry-title">', '</h2>');
        } else {
            the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
        } ?>

        <?php if($metadisplay==1){?>
                    <div class="entry-meta">
                   <?php ace_corporate_posted_on(); ?>
                    </div>
                  <?php }?>

    </header>

    <div class="entry-wrap clearfix">
        <?php
            if(is_search() || is_archive()  || is_page_template('page-templates/template-blog.php')){
                $title = get_the_title();
                    if(empty($title)) { echo '<a href="'.esc_url(get_the_permalink()).'">';}
                         echo wp_kses_post(ace_corporate_strip_url_content($post, 40 ));
                    if(empty($title)) { echo '</a>'; }
            }
            else{
                the_content();

                $default =  array(
                    'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:','ace-corporate' ) . '</span>',
                    'after'       => '</div>',
                    'link_before' => '<span>',
                    'link_after'  => '</span>',
                    'pagelink'    => '<span class="screen-reader-text">' . __( 'Page','ace-corporate' ) . ' </span>%',
                    'separator'   => '<span class="screen-reader-text">, </span>',
                    );

                wp_link_pages( $default );
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