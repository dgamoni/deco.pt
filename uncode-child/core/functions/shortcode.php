<?php 

add_shortcode( 'curso', 'curso_func' );
function curso_func( $atts ){

	$html = '';
	ob_start();

				$args = array(
				  'post_type'   => 'curso', 
				  'post_status' => 'publish', 
				  'order'       => 'DESC',
				  'orderby'     => 'date',
				);



				if ( !empty($atts['posts_per_page']) ) {					
					$args['posts_per_page'] = $atts['posts_per_page'];
				}

				if ( !empty($atts['taxonomy']) ) {
					$args['tax_query'] = array(
						array(
							'taxonomy' => 'cursos',
							'terms' => $atts['taxonomy'],
							'field' => 'slug',							
						)
					);
				}

			

				$the_query = new WP_Query( $args );

				// $total = $the_query->posts;
				// var_dump( $total );

			if ( $the_query->have_posts() ) :

				?>

					<div class="curso_wrap">

				<?php

					while ( $the_query->have_posts() ) : $the_query->the_post();
						setup_postdata( $post );
						$post_id = get_the_ID();
						$terms = get_the_terms( $post_id, 'cursos' );
						$term = '';
						if( $terms ) {
							$term = array_shift( $terms );
						}
						?>

						<div class="curso_item <?php echo $term->slug; ?>">
							<!-- <a tabindex="-1" href="https://deco.pt/cursosdeco/curso/poupo-logo-invisto/" target="_self"> -->
								<div class="t-entry-visual-overlay">
									<div class="t-entry-visual-overlay-in style-dark-bg"></div>
								</div>
								<div class="t-overlay-wrap">
									<div class="t-overlay-inner">
										<div class="t-overlay-content">
											<div class="cat-cursos">
												<?php echo $term->name; ?>
											</div>
											<div class="t-overlay-text single-block-padding">
												<div class="t-entry">
													<h3 class="t-entry-title h6 title-scale"><?php echo get_the_title($post_id); ?></h3>
													<a href="<?php echo get_the_permalink( $post_id ); ?>" class="curso_link" target="_self">
														<span>Saiba Tudo Aqui</span>
													</a>
												</div>
											</div>
										</div>
									</div>
								</div>
								<img decoding="async" class="wp-image-102768" src="<?php echo get_the_post_thumbnail_url( $post_id ); ?>"  alt="">
							<!-- </a> -->
						</div>



						<?php 

					endwhile;

				?>

					</div>

				<?php

			endif;

		
		wp_reset_query();
?>
<style>
	.curso_wrap {
		display: flex;
		flex-wrap: wrap;
	    margin-right: -15px;
	    margin-left: -15px;		
	}
	.curso_item {
		margin-bottom: 30px;
	    -ms-flex: 0 0 50%;
	    flex: 0 0 50%;
	    max-width: 50%;
	    padding: 0 15px;
	    border: 0;
/*	    width: calc( 100% - 270px);*/
	    position: relative;
    	display: block;
	}
	.curso_item .t-entry-visual-overlay {
	    position: absolute;
	    top: 0;
	    bottom: 3px;
	    left: 0;
	    right: 0;
	    z-index: 2;
	    transition: opacity 0.2s ease-in-out;
	    padding: 0 15px;
	    opacity: 0.1;
	}
	.curso_item .t-entry-visual-overlay .t-entry-visual-overlay-in {
	    width: 100%;
	    height: 100%;
	}

	.curso_item .style-dark-bg {
	    background-color: #141618;
	}
	.curso_item .t-overlay-wrap {
	    position: absolute;
	    top: 0;
	    left: 0;
	    right: 0;
	    bottom: 0;
	    z-index: 2;
	}
	.curso_item .t-entry-title {
		color: white;
	    font-size: 37px;
	    font-weight: bold;
	}
	a.curso_link {
	    color: #ffffff;
	    background-color: #228848;
	    border-color: #228848;
		text-transform: uppercase;
	    font-weight: 500;
	    font-size: 9px;
	    padding: 7px 7px;
	    margin-top: 7px;
	    display: inline-block;	        
	}
	a.curso_link:hover {
		color: white;
	}
	.style-light a.curso_link:not(.btn-text-skin):hover {
		color: white;
	}
	.curso_item .single-block-padding {
	    padding: 36px 36px 22px 36px;
	    position: absolute;
	    bottom: 0;
	    max-width: 70%;
	}
	.cat-cursos {
		color: #ffffff;
	    background-color: #df3426; 
	    border-color: #df3426;
	    text-transform: uppercase;
	    font-weight: 500;
	    font-size: 9px;
	    padding: 7px 7px;
	    margin-top: 7px;
	    display: inline-block;
	    position: absolute;
	    right: 28px;
	    top: 5px;
	}
	@media (max-width: 1098px) {
		.curso_item .t-entry-title {
		    font-size: 22px;
		}
	}
	@media (max-width: 780px) {
		.curso_item .t-entry-title {
		    font-size: 37px;
		}
		.curso_item {
		    flex: 0 0 100%;
		    max-width: 100%;
		    width: 100%;
		}		
	}
	@media (max-width: 780px) {
		.curso_item .t-entry-title {
		    font-size: 22px;
		}		
	}	
	@media (max-width: 410px) {
		.curso_item .t-entry-title {
		    font-size: 17px;
		}		
	}	
</style>
<script>
	jQuery(document).ready(function($) {

	});
</script>

<?php

	$html .= ob_get_contents();
	ob_end_clean();

	return $html;
}