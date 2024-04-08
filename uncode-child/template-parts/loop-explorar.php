<?php

//$category = get_the_category($post->ID);
$category = get_the_terms( $post->ID, 'explorars' );

// $queried_object = get_queried_object();

// if ( isset($queried_object->term_id) ) {
// 	$term_id = $queried_object->term_id;
// 	var_dump($queried_object);
// 	$category = $queried_object->name;
// } else {
// 	$categories = get_the_terms( $post->ID, 'explorars' );
// 	$category = array_shift( $categories );
// }




?>

	<div class="noticas-content explorar-content text-uppercase style-light col-lg-3">

			<a tabindex="-1" href="<?php echo get_the_permalink( $post->ID); ?>" class="noticas-image" target="_self" data-lb-index="0">
				<div class="t-entry-visual-overlay">
					<div class="t-entry-visual-overlay-in style-dark-bg" style="opacity: 0.5;"></div>
				</div>
				<img decoding="async" class="wp-image-86140" src="<?php echo get_the_post_thumbnail_url( $post->ID); ?>"  alt="">
			</a>

			<div class="slider-cat"><?php echo $category[0]->name; ?></div>
			<div class="noticia-title">
				<a tabindex="-1" href="<?php echo get_the_permalink( $post->ID); ?>">
					<?php echo $post->post_title; ?>
				</a>
			</div>
			<div class="noticia-descript"><?php echo get_the_date( 'd M / Y' ); ?></div>

	</div>




