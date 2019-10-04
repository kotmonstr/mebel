<?php

// args
$args = array(
	'numberposts' => - 1,
	'post_type'   => 'service',

);
// query
$query = new WP_Query( $args );
$posts = $query->get_posts();
?>

<a id="servises"></a>
<section id="services2" class="section portfolio">

    <div class="container">
        <div class="row">
            <h2 class="section-title text-center">Наши услуги</h2>
        </div>
        <div class="row">
            <div class="col-md-12">


	        <?php foreach ( $posts as $post ) { ?>
	        <?php
	        $arr   = get_field( 'photo', $post->ID );
	        $arr2  = get_field( 'name', $post->ID );
	        $arr3  = get_field( 'price', $post->ID );
	        $photo = $arr['url'];
	        $title = $arr2;
	        $price = $arr3;
	        ?>


                <div class="col-md-4">
                <div class="box" style="display: table">
                    <img width="800" height="600"
                         src="<?php echo $photo ?>"
                         class="attachment-ace_corporate_port_size size-ace_corporate_port_size wp-post-image" alt=""
                         data-attachment-id="1894"
                         data-permalink="<?php echo $photo ?>"
                         data-orig-file="<?php echo $photo ?>"
                         data-orig-size="960,681" data-comments-opened="1"
                         data-image-meta="{&quot;aperture&quot;:&quot;0&quot;,&quot;credit&quot;:&quot;&quot;,&quot;camera&quot;:&quot;&quot;,&quot;caption&quot;:&quot;&quot;,&quot;created_timestamp&quot;:&quot;0&quot;,&quot;copyright&quot;:&quot;&quot;,&quot;focal_length&quot;:&quot;0&quot;,&quot;iso&quot;:&quot;0&quot;,&quot;shutter_speed&quot;:&quot;0&quot;,&quot;title&quot;:&quot;&quot;,&quot;orientation&quot;:&quot;1&quot;}"
                         data-image-title="pf03-10" data-image-description=""
                         data-medium-file="<?php echo $photo ?>"?fit=300%2C213&amp;ssl=1"
                         data-large-file="<?php echo $photo ?>"?fit=640%2C454&amp;ssl=1">
                    <div class="box-content">
                        <div class="content">
                            <h2 class="title"><?php echo $title; ?></h2>
                            <h3 class="title"><?php echo $price; ?></h3>
                        </div>
                    </div>
                    </div>
                </div>



	        <?php } ?>
            </div>
        </div>

    </div>

</section>