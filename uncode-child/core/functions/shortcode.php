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
	.workshops .cat-cursos {
	    background-color: #6ec280;
	    border-color: #6ec280;
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

add_shortcode( 'curso_info', 'curso_info_func' );
function curso_info_func( $atts ){

	$html = '';
	ob_start();

	global $post;

		if (has_term('acoes-de-formacao', 'cursos', $post->ID)) :

			$sistema = get_field('sistema', $post->ID);
			$data = get_field('data', $post->ID);
			$horario = get_field('horario', $post->ID);
			$modalidade = get_field('modalidade', $post->ID);
			$duracao = get_field('duracao', $post->ID);
			$valor = get_field('valor', $post->ID);
				?>
					<div class="curso_info_wrap">
						<div class="curso_info_col info_col-1">
							<div class="curso_info_row">
								<div class="curso_info_ico">
									<svg xmlns="http://www.w3.org/2000/svg" width="37.8" height="36.4" xmlns:v="https://vecta.io/nano"><linearGradient  gradientUnits="userSpaceOnUse" x1="-269.447" y1="-174.347" x2="-268.74" y2="-173.64"><stop offset="0" stop-color="#e6e6eb"/><stop offset=".174" stop-color="#e2e2e6"/><stop offset=".352" stop-color="#d5d4d8"/><stop offset=".532" stop-color="#c0bfc2"/><stop offset=".714" stop-color="#a4a2a4"/><stop offset=".895" stop-color="#828282"/><stop offset="1" stop-color="#6b6e6e"/></linearGradient><g fill="none" stroke="#9b9594" stroke-width="2.224" stroke-miterlimit="10"><path d="M3.4 29V8.9c0-.9.7-1.5 1.6-1.5h10.8m18.6 10V29"/><path d="M36.7,29H22.8l-1.5,1.5h-3.9L15.8,29H1.1v1.5c0,1.7,1.4,3.1,3.1,3.1h29.4c1.7,0,3.1-1.4,3.1-3.1V29z"/></g><path d="M27 2.7c-5.3 0-9.7 3.3-9.7 7.3 0 1.6.7 3.1 1.8 4.3-.2 1.2-.5 2.6-1 3.8-.2.5.2.9.7.8 2.1-.5 3.7-1.2 4.8-2 1 .3 2.2.5 3.3.5 5.3 0 9.7-3.3 9.7-7.3.1-4.1-4.2-7.4-9.6-7.4" fill="#9b9594"/><path d="M16.6 27.5v-2.3c0-1-2.1-2.3-3.9-2.3-1.7 0-3.9 1.3-3.9 2.3v2.3m3.9-12.4c-1.2 0-2.3.9-2.3 2v1.5c0 1.1 1.1 1.9 2.3 1.9s2.3-.9 2.3-1.9V17c0-1-1.1-1.9-2.3-1.9z" fill="none" stroke="#9b9594" stroke-width="2.224" stroke-miterlimit="10"/></svg>
								</div>
								<div class="curso_info_text">
									<div class="info_title">
										<span><?php _e('Sistema', 'deco'); ?></span>
									</div>
									<div class="info_data">
										<span><?php echo $sistema;?></span>
									</div>
								</div>
							</div>
							<div class="curso_info_row">
								<div class="curso_info_ico">
									<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="37.8" height="36.4" xmlns:v="https://vecta.io/nano"><linearGradient  gradientUnits="userSpaceOnUse" x1="-269.447" y1="-174.347" x2="-268.74" y2="-173.64"><stop offset="0" stop-color="#e6e6eb"/><stop offset=".174" stop-color="#e2e2e6"/><stop offset=".352" stop-color="#d5d4d8"/><stop offset=".532" stop-color="#c0bfc2"/><stop offset=".714" stop-color="#a4a2a4"/><stop offset=".895" stop-color="#828282"/><stop offset="1" stop-color="#6b6e6e"/></linearGradient><g fill="#9b9594"><path d="M3.7 9.4c.2-.2.2-.6.3-.9.7-1.9 2.4-3.1 4.4-3.1h1.4c.2 0 .2 0 .2-.2v-1c0-.7.5-1.2 1.1-1.2.7 0 1.2.5 1.2 1.2v1c0 .1 0 .2.2.2h5c.1 0 .2 0 .2-.2v-1c0-.7.5-1.2 1.2-1.2.6 0 1.1.5 1.1 1.2v.9c0 .1 0 .2.2.2h5c.1 0 .2 0 .2-.2v-1c.1-.6.6-1.1 1.2-1.1.7 0 1.2.5 1.2 1.2v.9c0 .2 0 .3.3.3h2c2 .3 3.7 2 4 4 0 .3.1.6.1.9v6.5c0 .5-.2.9-.6 1.1s-.8.2-1.2 0c-.4-.3-.6-.6-.6-1.1v-6.5c0-.6-.1-1.1-.5-1.6-.5-.6-1.1-.9-1.9-1H28c-.1 0-.2 0-.2.2v1c0 .7-.5 1.2-1.2 1.2s-1.2-.5-1.2-1.2v-1c0-.1 0-.2-.2-.2h-5.1c-.1 0-.2 0-.2.2v1c0 .7-.5 1.2-1.2 1.2s-1.2-.5-1.2-1.2v-1c0-.1 0-.2-.2-.2h-5c-.1 0-.2 0-.2.2v.9c0 .7-.5 1.3-1.2 1.3s-1.2-.5-1.2-1.3v-1c0-.1 0-.2-.1-.2-.7 0-1.3-.1-2 .1-.8.4-1.5 1.3-1.5 2.5V12v16.5c0 1.2.6 2.1 1.8 2.4.2.1.5.1.7.1h8.8c.5 0 .9.2 1.2.6.4.7 0 1.5-.7 1.7 0 0-.1 0-.1.1h-10c0-.1-.1-.1-.2-.1-1.8-.4-3-1.4-3.6-3.2-.1-.3-.1-.6-.2-.9V9.4zm22.5 24c-.3-.1-.6-.1-.9-.2-2.9-.8-4.6-2.6-5.3-5.5-.7-2.8.7-6 3.1-7.5 2.7-1.7 5.9-1.6 8.4.5 2.1 1.7 3 4 2.6 6.7-.5 2.9-2.1 4.7-4.9 5.7-.5.2-.9.3-1.4.3-.1 0-.1 0-.2.1h-1.4zm5.5-7.2c0-2.6-2.2-4.8-4.8-4.8s-4.8 2.2-4.8 4.8 2.2 4.8 4.8 4.8c2.7 0 4.8-2.1 4.8-4.8"/><use xlink:href="#C"/><path d="M17.5 15.4c0 .7-.5 1.2-1.2 1.2s-1.2-.5-1.2-1.2c0-.6.5-1.2 1.2-1.2s1.2.6 1.2 1.2m3.9-1.1c.7 0 1.2.5 1.2 1.2s-.5 1.2-1.2 1.2-1.2-.5-1.2-1.2c.1-.7.6-1.2 1.2-1.2"/><use xlink:href="#C" x="15.5"/><path d="M12.3 20.6c0 .7-.5 1.2-1.2 1.2s-1.2-.5-1.2-1.2.5-1.2 1.2-1.2 1.2.6 1.2 1.2m4-1.2c.7 0 1.2.5 1.2 1.2s-.5 1.2-1.2 1.2-1.2-.5-1.2-1.2c0-.6.6-1.2 1.2-1.2"/><use xlink:href="#C" y="10.3"/><path d="M17.5 25.8c0 .7-.5 1.2-1.2 1.2s-1.2-.5-1.2-1.2.5-1.2 1.2-1.2c.6 0 1.2.5 1.2 1.2m8.2-.8v-1.2c0-.7.5-1.2 1.2-1.2s1.2.5 1.2 1.2v1c0 .1 0 .2.2.2h.6c.6.2.9.7.9 1.2a1.11 1.11 0 0 1-1.1 1.1h-1.9c-.6 0-1.1-.5-1.1-1.2V25"/></g><defs ><path id="C" d="M12.3 15.5c0 .7-.5 1.2-1.2 1.2s-1.2-.5-1.2-1.2.5-1.2 1.2-1.2 1.2.5 1.2 1.2"/></defs></svg>
								</div>
								<div class="curso_info_text">
									<div class="info_title">
										<span><?php _e('Data', 'deco'); ?></span>
									</div>
									<div class="info_data">
										<span><?php echo $data;?></span>
									</div>
								</div>
							</div>
							<div class="curso_info_row noborder border_mobile">
								<div class="curso_info_ico">
									<svg xmlns="http://www.w3.org/2000/svg" width="37.8" height="36.4" xmlns:v="https://vecta.io/nano"><linearGradient  gradientUnits="userSpaceOnUse" x1="-269.447" y1="-174.347" x2="-268.74" y2="-173.64"><stop offset="0" stop-color="#e6e6eb"/><stop offset=".174" stop-color="#e2e2e6"/><stop offset=".352" stop-color="#d5d4d8"/><stop offset=".532" stop-color="#c0bfc2"/><stop offset=".714" stop-color="#a4a2a4"/><stop offset=".895" stop-color="#828282"/><stop offset="1" stop-color="#6b6e6e"/></linearGradient><g fill="#9b9594"><path d="M17.5 1.3h2.6c0 .1.1.1.1.1 1.6.1 3.1.4 4.5 1 6.1 2.5 9.7 6.9 10.8 13.4.1.4 0 .8.2 1.1v2.6c-.1 0-.1.1-.1.2-.1.4-.1.8-.1 1.2-.6 3.5-2.1 6.6-4.6 9-4.6 4.6-10.2 6.2-16.5 4.5C5.6 32.1.4 23.3 2.3 14.5c1.6-6.8 7.3-12.1 14.2-13 .3-.1.7-.1 1-.2m1.4 31.1a14.3 14.3 0 0 0 14.3-14.3c0-7.9-6.4-14.2-14.3-14.3a14.3 14.3 0 1 0 0 28.6m1.3-18.5v-3.4c0-.3-.1-.6-.2-.9-.3-.5-.9-.7-1.4-.5-.6.2-1 .7-1 1.3v7.7c0 .5.2.9.6 1.2l2.7 2 2.5 1.8c.8.6 1.8.2 2.1-.7.1-.6-.1-1.1-.6-1.4l-4.4-3.3c-.1-.1-.2-.2-.2-.4-.1-1.1-.1-2.2-.1-3.4"/><path d="M20.2 13.9v3.4c0 .2.1.3.2.4l4.4 3.3c.5.4.7.8.6 1.4-.2.9-1.3 1.3-2.1.7l-2.5-1.8-2.7-2c-.4-.3-.6-.7-.6-1.2v-7.7c0-.7.4-1.2 1-1.3.5-.2 1.1 0 1.4.5.2.3.2.6.2.9.1 1.2.1 2.3.1 3.4"/></g></svg>
								</div>
								<div class="curso_info_text">
									<div class="info_title">
										<span><?php _e('Horario', 'deco'); ?></span>
									</div>
									<div class="info_data">
										<span><?php echo $horario;?></span>
									</div>
								</div>
							</div>														
						</div>
						<div class="curso_info_col info_col-2">
							<div class="curso_info_row">
								<div class="curso_info_ico">
									<svg xmlns="http://www.w3.org/2000/svg" width="37.8" height="36.4" xmlns:v="https://vecta.io/nano"><linearGradient  gradientUnits="userSpaceOnUse" x1="-269.447" y1="-174.347" x2="-268.74" y2="-173.64"><stop offset="0" stop-color="#e6e6eb"/><stop offset=".174" stop-color="#e2e2e6"/><stop offset=".352" stop-color="#d5d4d8"/><stop offset=".532" stop-color="#c0bfc2"/><stop offset=".714" stop-color="#a4a2a4"/><stop offset=".895" stop-color="#828282"/><stop offset="1" stop-color="#6b6e6e"/></linearGradient><path d="M33.4 13.2c-.8-1.9-1.9-3.5-3.3-5-1.4-1.4-3.1-2.6-5-3.4-1.7-.7-3.4-1.1-5.2-1.2l1.4-.8c.4-.2.5-.7.3-1-.2-.4-.7-.5-1-.3l-4.9 2.8 4.8 2.8c.1.1.2.1.4.1.3 0 .5-.1.6-.4.2-.4.1-.8-.3-1L20 5.1c1.6.1 3.1.5 4.5 1.1C26.2 7 27.7 8 29 9.3s2.3 2.8 3 4.5 1.1 3.6 1.1 5.5-.4 3.8-1.1 5.5-1.8 3.2-3.1 4.5-2.8 2.3-4.5 3-3.6 1.1-5.5 1.1-3.8-.4-5.5-1.1-3.2-1.8-4.5-3.1-2.3-2.8-3-4.5-1.1-3.6-1.1-5.5.4-3.8 1.1-5.5S7.7 10.5 9 9.2c.3-.3.3-.8 0-1.1s-.8-.3-1.1 0c-1.4 1.4-2.6 3.1-3.4 5s-1.3 4-1.3 6.1.4 4.2 1.2 6.1 1.9 3.5 3.3 5c1.4 1.4 3.1 2.6 5 3.4s4 1.3 6.1 1.3 4.2-.4 6.1-1.2 3.5-1.9 5-3.3c1.4-1.4 2.6-3.1 3.4-5s1.3-4 1.3-6.1c0-2.2-.4-4.2-1.2-6.2" fill="#9b9594"/><path d="M33.4 13.2c-.8-1.9-1.9-3.5-3.3-5-1.4-1.4-3.1-2.6-5-3.4-1.7-.7-3.4-1.1-5.2-1.2l1.4-.8c.4-.2.5-.7.3-1-.2-.4-.7-.5-1-.3l-4.9 2.8 4.8 2.8c.1.1.2.1.4.1.3 0 .5-.1.6-.4.2-.4.1-.8-.3-1L20 5.1c1.6.1 3.1.5 4.5 1.1C26.2 7 27.7 8 29 9.3s2.3 2.8 3 4.5 1.1 3.6 1.1 5.5-.4 3.8-1.1 5.5-1.8 3.2-3.1 4.5-2.8 2.3-4.5 3-3.6 1.1-5.5 1.1-3.8-.4-5.5-1.1-3.2-1.8-4.5-3.1-2.3-2.8-3-4.5-1.1-3.6-1.1-5.5.4-3.8 1.1-5.5S7.7 10.5 9 9.2c.3-.3.3-.8 0-1.1s-.8-.3-1.1 0c-1.4 1.4-2.6 3.1-3.4 5s-1.3 4-1.3 6.1.4 4.2 1.2 6.1 1.9 3.5 3.3 5c1.4 1.4 3.1 2.6 5 3.4s4 1.3 6.1 1.3 4.2-.4 6.1-1.2 3.5-1.9 5-3.3c1.4-1.4 2.6-3.1 3.4-5s1.3-4 1.3-6.1c0-2.2-.4-4.2-1.2-6.2z" fill="none" stroke="#9b9594" stroke-width=".859" stroke-miterlimit="10"/></svg>
								</div>
								<div class="curso_info_text">
									<div class="info_title">
										<span><?php _e('Modalidade', 'deco'); ?></span>
									</div>
									<div class="info_data">
										<span><?php echo $modalidade;?></span>
									</div>
								</div>
							</div>
							<div class="curso_info_row">
								<div class="curso_info_ico">
									<svg xmlns="http://www.w3.org/2000/svg" width="37.8" height="36.4" xmlns:v="https://vecta.io/nano"><style><![CDATA[.H{fill:#9b9594}.I{fill:none}.J{stroke:#9b9594}.K{stroke-width:.5}.L{stroke-miterlimit:10}]]></style><linearGradient  gradientUnits="userSpaceOnUse" x1="-269.447" y1="-174.347" x2="-268.74" y2="-173.64"><stop offset="0" stop-color="#e6e6eb"/><stop offset=".174" stop-color="#e2e2e6"/><stop offset=".352" stop-color="#d5d4d8"/><stop offset=".532" stop-color="#c0bfc2"/><stop offset=".714" stop-color="#a4a2a4"/><stop offset=".895" stop-color="#828282"/><stop offset="1" stop-color="#6b6e6e"/></linearGradient><path d="M20.1 2.2h-2.4a.68.68 0 0 1-.7-.7.68.68 0 0 1 .7-.7h2.4a.68.68 0 0 1 .7.7c-.1.4-.4.7-.7.7" class="H"/><path d="M20.1 2.2h-2.4a.68.68 0 0 1-.7-.7.68.68 0 0 1 .7-.7h2.4a.68.68 0 0 1 .7.7c-.1.4-.4.7-.7.7z" class="I J K L"/><path d="M18.8 4.6a.68.68 0 0 1-.7-.7V1.5a.68.68 0 0 1 .7-.7.68.68 0 0 1 .7.7v2.4a.68.68 0 0 1-.7.7" class="H"/><path d="M18.8 4.6a.68.68 0 0 1-.7-.7V1.5a.68.68 0 0 1 .7-.7.68.68 0 0 1 .7.7v2.4a.68.68 0 0 1-.7.7z" class="I J K L"/><path d="M29.9 5.9c-.1 0-.3 0-.4-.1l-2-1.3c-.3-.2-.4-.6-.2-.9s.6-.4.9-.2l2 1.3c.3.2.4.6.2.9a.55.55 0 0 1-.5.3" class="H"/><path d="M29.9 5.9c-.1 0-.3 0-.4-.1l-2-1.3c-.3-.2-.4-.6-.2-.9s.6-.4.9-.2l2 1.3c.3.2.4.6.2.9a.55.55 0 0 1-.5.3z" class="I J K L"/><path d="M27.6 7.2c-.1 0-.3 0-.4-.1-.3-.2-.4-.6-.2-.9l1.3-2c.2-.3.6-.4.9-.2s.4.6.2.9l-1.3 2a.55.55 0 0 1-.5.3" class="H"/><path d="M27.6 7.2c-.1 0-.3 0-.4-.1-.3-.2-.4-.6-.2-.9l1.3-2c.2-.3.6-.4.9-.2s.4.6.2.9l-1.3 2a.55.55 0 0 1-.5.3z" class="I J K L"/><path d="M7.9 5.9c-.2 0-.4-.1-.6-.3-.2-.3-.1-.7.2-.9l2-1.3c.3-.2.7-.1.9.2s.1.7-.2.9l-2 1.3c-.1.1-.2.1-.3.1" class="H"/><path d="M7.9 5.9c-.2 0-.4-.1-.6-.3-.2-.3-.1-.7.2-.9l2-1.3c.3-.2.7-.1.9.2s.1.7-.2.9l-2 1.3c-.1.1-.2.1-.3.1z" class="I J K L"/><path d="M10.2 7.3c-.2 0-.4-.1-.6-.3L8.3 5c-.2-.4-.1-.8.2-1s.7-.1.9.2l1.3 2c.3.4.2.8-.1 1-.1 0-.3.1-.4.1" class="H"/><path d="M10.2 7.3c-.2 0-.4-.1-.6-.3L8.3 5c-.2-.4-.1-.8.2-1s.7-.1.9.2l1.3 2c.3.4.2.8-.1 1-.1 0-.3.1-.4.1z" class="I J K L"/><path d="M18.9 35.5c-8.9 0-16.1-7.2-16.1-16.1S10 3.3 18.9 3.3 35 10.5 35 19.4s-7.2 16.1-16.1 16.1m0-30.9A14.77 14.77 0 0 0 4.1 19.4a14.77 14.77 0 0 0 14.8 14.8 14.77 14.77 0 0 0 14.8-14.8A14.77 14.77 0 0 0 18.9 4.6" class="H"/><path d="M18.9 35.5c-8.9 0-16.1-7.2-16.1-16.1S10 3.3 18.9 3.3 35 10.5 35 19.4s-7.2 16.1-16.1 16.1zm0-30.9A14.77 14.77 0 0 0 4.1 19.4a14.77 14.77 0 0 0 14.8 14.8 14.77 14.77 0 0 0 14.8-14.8A14.77 14.77 0 0 0 18.9 4.6z" class="I J K L"/><path d="M18.9 31.9c-6.9 0-12.5-5.6-12.5-12.5S12 6.9 18.9 6.9s12.5 5.6 12.5 12.5-5.6 12.5-12.5 12.5m0-23.7c-6.1 0-11.1 5-11.1 11.1s5 11.1 11.1 11.1S30 25.4 30 19.3c.1-6.1-4.9-11.1-11.1-11.1" class="H"/><path d="M18.9 31.9c-6.9 0-12.5-5.6-12.5-12.5S12 6.9 18.9 6.9s12.5 5.6 12.5 12.5-5.6 12.5-12.5 12.5zm0-23.7c-6.1 0-11.1 5-11.1 11.1s5 11.1 11.1 11.1S30 25.4 30 19.3c.1-6.1-4.9-11.1-11.1-11.1z" class="I J K L"/><path d="M19.4 17v3.4c0 .2.1.3.2.4l4.4 3.3c.5.4.7.8.6 1.4-.2.9-1.3 1.3-2.1.7L20 24.4l-2.7-2c-.4-.3-.6-.7-.6-1.2v-7.7c0-.7.4-1.2 1-1.3.5-.2 1.1 0 1.4.5.2.3.2.6.2.9.1 1.2.1 2.3.1 3.4" class="H"/></svg>
								</div>
								<div class="curso_info_text">
									<div class="info_title">
										<span><?php _e('Duracao', 'deco'); ?></span>
									</div>
									<div class="info_data">
										<span><?php echo $duracao;?></span>
									</div>
								</div>
							</div>
							<div class="curso_info_row noborder">
								<div class="curso_info_ico">
									<svg xmlns="http://www.w3.org/2000/svg" width="37.8" height="36.4" xmlns:v="https://vecta.io/nano"><linearGradient  gradientUnits="userSpaceOnUse" x1="-269.447" y1="-174.347" x2="-268.74" y2="-173.64"><stop offset="0" stop-color="#e6e6eb"/><stop offset=".174" stop-color="#e2e2e6"/><stop offset=".352" stop-color="#d5d4d8"/><stop offset=".532" stop-color="#c0bfc2"/><stop offset=".714" stop-color="#a4a2a4"/><stop offset=".895" stop-color="#828282"/><stop offset="1" stop-color="#6b6e6e"/></linearGradient><g fill="none" stroke="#9b9594" stroke-width="2.835" stroke-miterlimit="10"><path d="M35.7 18.2c0 9.3-7.5 16.8-16.8 16.8S2.1 27.5 2.1 18.2 9.6 1.4 18.9 1.4s16.8 7.5 16.8 16.8z"/><path d="M12.2 20.7h7.5m-7.5-3.4h7.5"/><path d="M23.9,15.7c0-2.3-1.9-4.2-4.2-4.2h-0.8c-2.3,0-4.2,1.9-4.2,4.2v5.9c0,2.3,1.9,4.2,4.2,4.2h0.8     c2.3,0,4.2-1.9,4.2-4.2"/></g></svg>
								</div>
								<div class="curso_info_text">
									<div class="info_title">
										<span><?php _e('Valor', 'deco'); ?></span>
									</div>
									<div class="info_data">
										<span><?php echo $valor;?></span>
									</div>
								</div>
							</div>														
						</div>
					</div>

				<style>
					.curso_info_wrap {
						display: flex;
						flex-wrap: wrap;
						flex-direction: row;
						justify-content: flex-end;
						margin-right: 50px;
						margin-bottom: 50px;
					}
					.curso_info_col {
						display: flex;
						flex-wrap: wrap;
						flex-direction: column;
						min-width: 323px;
						padding-right: 20px;
					}
					.curso_info_row {
						display: flex;
						flex-wrap: wrap;
						flex-direction: row;
						justify-content: space-between;
						border-bottom: 1px solid #228848;
						min-height: 88px;
						margin-left: 69px;
						align-items: center;
					}
					.curso_info_row.noborder {
						border: none;
					}
					.curso_info_text {
						min-width: 100px;
						text-align: right;
					}
					.info_title {
						color: #228848;
						font-size: 17px;
    					font-weight: 700;
    					line-height: 1.5;
					}
					.info_data {
						font-size: 16px;
				    	font-weight: 500;
					}
					.curso_info_ico {
						min-width: 50px;
					    text-align: center;
					}

					@media (max-width: 780px) {
						.curso_info_row.noborder.border_mobile {
							border-bottom: 1px solid #228848;
						}
					}
					@media (max-width: 390px) {
						.curso_info_wrap {
    						margin-right: 0;
    					}
					}

				</style>


				<?php
		endif;

	$html .= ob_get_contents();
	ob_end_clean();

	return $html;
}


