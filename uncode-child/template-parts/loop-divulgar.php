<?php

$category = get_the_category($post->ID);
$iframe = get_field( 'youtube', $post->ID );
// preg_match('/src="(.+?)"/', $iframe, $matches);
// $src = $matches[1];

if ( $iframe ) {
	$youtube = $iframe;
} else {
	$youtube = get_the_permalink( $post->ID);
}

?>


	<div class="noticas-content divulgar-content col-lg-3">

			<a tabindex="-1" href="<?php echo $youtube; ?>" class="popup-youtube divulgar-image noticas-image" target="_self" data-lb-index="0">
				<div class="t-entry-visual-overlay">
					<div class="t-entry-visual-overlay-in style-dark-bg" style="opacity: 0.5;"></div>
				</div>
				<img decoding="async" class="wp-image-86140" src="<?php echo get_the_post_thumbnail_url( $post->ID); ?>"  alt="">
				
				<div class="noticia-title divulgar-title">					
						<?php echo $post->post_title; ?>
				</div>

			</a>


	</div>




