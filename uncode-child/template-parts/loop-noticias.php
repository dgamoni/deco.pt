<?php


        $args = array(
          'post_type'      => 'post', // explorar // noticia
          'posts_per_page' => 8,
          'post_status' => 'publish',
          'order'       => 'DESC',
          'orderby'     => 'date',
        );

        $the_query = new WP_Query( $args );


        while ( $the_query->have_posts() ) : $the_query->the_post();

        	$category = get_the_category($post->ID);

        	?>

						<div class="noticas-content col-lg-3">

							<a tabindex="-1" href="<?php echo get_the_permalink( $post->ID); ?>" class="noticas-image" target="_self" data-lb-index="0">
								<div class="t-entry-visual-overlay">
									<div class="t-entry-visual-overlay-in style-dark-bg" style="opacity: 0.5;"></div>
								</div>
								<img decoding="async" class="wp-image-86140" src="<?php echo get_the_post_thumbnail_url( $post->ID); ?>"  alt="">
							</a>

							<div class="slider-cat"><?php echo $category[0]->name; ?></div>
							<div class="noticia-title">
								<a tabindex="-1" href="<?php echo get_the_permalink( $post->ID); ?>">
									<?php echo $post->post_title; ?></div>
								</a>
							<div class="noticia-descript">by <?php echo get_the_author(); ?> <?php echo get_the_date( 'd M / Y' ); ?></div>

						</div>


        	<?php


		endwhile;
		wp_reset_query();        	