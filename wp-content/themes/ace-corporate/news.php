<?php
wp_reset_postdata();

$args  = array(
	'numberposts' => - 1,
	'post_type'   => 'news',
);
$query = new WP_Query( $args );
?>

<a id="news"></a>
<section id="about" class="section blogroll aboutbox">
    <div class="container">
        <div class="row">
            <h2 class="section-title text-center">Новости</h2>

			<?php
			if ( $query->have_posts() ) { while ( $query->have_posts() ) {
					$query->the_post();
					?>

                    <div class="col-md-4 col-sm-12 text-center">
                        <div class="blog-content clearfix">
                            <div class="blog-content-image effect-thumb">
                                <article id="post-1">
                                    <div class="post-content entry-content">
                                        <div class="featured-image archive-thumb">
                                            <a title="	<?php the_title(); ?>" href="#" class="post-thumbnail">
												<?php echo the_post_thumbnail(); ?>
                                                <div class="share-mask">
                                                    <div class="share-wrap">
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </article>
                            </div>
                            <div class="blog-content-head">
                                <h4><a href="#"><?php the_title(); ?></a></h4>
                            </div>
                            <div class="blog-content-wrap">
                                <p><?php echo wp_trim_words(the_excerpt()) ?></p>
                                <a href="<?php the_permalink() ?>" class="btn service-read"><?php esc_html_e( 'Read More', 'ace-corporate' ); ?></a>
                            </div>
                        </div>
                    </div>

				<?php }} ?>

        </div>
    </div>
</section>
<?php wp_reset_postdata(); ?>