<?php
$args = array(
	'numberposts' => - 1,
	'post_type'   => 'testimonal',

);
$query = new WP_Query( $args );
$posts = $query->get_posts();
?>
<a id="develop"></a>
<div class="pre-footer">
    <div class="testimonial section">
        <div class="container">
            <h2 class="section-title text-center">Отзывы наших клиентов</h2>
            <div class="row">
                <div id="testimonial-slider">

	                <?php foreach ( $posts as $post ) { ?>
	                <?php
		            $photo   = get_field( 'photo', $post->ID)['url'];
		            $fio  = get_field( 'fio', $post->ID );
		            $description  = get_field( 'description', $post->ID );

	                ?>

                    <div class="testimonial">
                        <div class="testimonial-wrap">
                            <div class="pic">
                                <img src="<?php echo $photo ?>">
                            </div>
                            <p class="description">
	                            <?php echo $description ?>
                            </p>
                            <h3 class="title"><?php echo $fio ?></h3>
                        </div>
                    </div>

	                <?php } ?>

                </div>
            </div>
        </div>
    </div>
</div>