<?php
$args = array(
	'numberposts' => - 1,
	'post_type'   => 'portfolio',
);
$query = new WP_Query( $args );
$posts = $query->get_posts();
?>
<div class="container full-width-container">
    <div class="content-area full-width-posts">
        <main id="main" class="site-main" role="main">

            <a id="portfolio"></a>
            <section class="section aboutbox">
                <div class="container">
                    <div class="row">
                        <h2 class="section-title text-center">Портфолио</h2>

						<?php foreach ( $posts as $post ) { ?>
							<?php
							$arr   = get_field( 'photo', $post->ID );
							$arr2  = get_field( 'name', $post->ID );
							$photo = $arr['url'];
							$title = $arr2;
							?>

                            <div class="col-md-3">
                                <article>
                                    <div class="service-wrap mob-center">
                                        <div class="media-wrapper">
                                            <div class="media-wrap">
                                                <img src="<?php echo $photo ?>" width="350px" height="200px">
                                            </div>
                                        </div>
                                        <div class="service-body">
                                            <h3>
                                                <a href="/галерея/" class="btn service-read"><?php echo $title; ?></a>
                                            </h3>
                                            <!--                                    <a href="#" class="btn service-read">-->
											<?php //esc_html_e( 'Read More', 'ace-corporate' ); ?><!--</a>-->
                                        </div>
                                    </div>
                                </article>
                            </div>
						<?php } ?>
                    </div>
            </section>
        </main>
    </div>
</div>
