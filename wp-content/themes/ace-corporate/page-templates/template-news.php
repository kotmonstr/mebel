<?php

/*
  Template Name: Новости
 */
get_header();

wp_reset_postdata();
$args  = array(

	'numberposts' => -1,
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
                        <div class="blog-content clearfix" style="position: relative">
                            <div class="blog-content-image effect-thumb">
                                <article id="post-1">
                                    <div class="post-content entry-content">
                                        <div class="featured-image archive-thumb">
                                            <a title="	<?php the_title(); ?>" href="<?php echo get_post_permalink() ?>" class="post-thumbnail">
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

                            </div>
                            <a href="<?php echo get_post_permalink() ?>" class="btn service-read" style="position: absolute; bottom: 30px;left:35px"><?php esc_html_e( 'Читать', 'ace-corporate' ); ?></a>
                        </div>
                    </div>

				<?php }} ?>

			</div>
		</div>
	</section>
<?php wp_reset_postdata(); ?>

<?php get_footer(); ?>
