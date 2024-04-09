<?php

	$args = array(
	  'post_type'   => 'curso', 
	  'post_status' => 'publish',
	  'orderby'     => 'rand',
	  'posts_per_page' => 6,
	  'post__not_in' => array( $post->ID ),
	);

	$terms_ = get_the_terms( $post->ID, 'cursos' );
	$term_ = '';
	if( $terms_ ) {
		$term_ = array_shift( $terms_ );
	}
	//var_dump($term_);

	if ( !empty($term_) ) {
		$args['tax_query'] = array(
			array(
				'taxonomy' => 'cursos',
				'terms' => $term_->slug,
				'field' => 'slug',							
			)
		);
	}

	$the_query = new WP_Query( $args );

?>

	<div class="post-after row-container">
		<div data-parent="true" class="vc_row row-container" id="row-unique-1" data-section="1">
			<div class="row limit-width row-parent" data-imgready="true">
				<div class="wpb_row row-inner">
					<div class="wpb_column pos-top pos-center align_left column_parent col-lg-12 single-internal-gutter">
						<span class="btn-container btn-inline"><a href="mailto:decoforma@deco.pt" class="custom-link btn border-width-0 btn-color-210407 btn-flat btn-icon-left" target="_blank">CONTACTE-NOS</a></span>
					</div>
				</div>
			</div>
		</div>
	</div>



<?php if ( $the_query->have_posts() ) : ?>
	<div class="post-after row-container">
		<div data-parent="true" class="vc_row row-container" id="row-unique-1" data-section="1">
			<div class="row limit-width row-parent" data-imgready="true">
				<div class="wpb_row row-inner">
					<div class="wpb_column pos-top pos-center align_left column_parent col-lg-12 single-internal-gutter">
						<div class="uncol style-light">
							<div class="uncoltable">
								<div class="uncell no-block-padding">
									<div class="uncont">
										<div class="vc_custom_heading_wrap ">
											<div class="heading-text el-text">
												<h2 class="h2"><span>OUTROS CURSOS</span></h2>
												<hr class="separator-break separator-accent">
											</div>
											<div class="clear"></div>

											<div class="swiper-container">
												<div class="curso_wrap swiper-wrapper">
													<?php
														while ( $the_query->have_posts() ) : $the_query->the_post();
															setup_postdata( $post );
															$post_id = get_the_ID();
															$terms = get_the_terms( $post_id, 'cursos' );
															$term = '';
															if( $terms ) {
																$term = array_shift( $terms );
															}
															$destacar = get_field('destacar', $post_id);
															?>
																<div class="curso_item swiper-slide <?php echo $term->slug; ?>">
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
																					<div class="destacar">
																						<?php if ( $destacar ) { ?>
																							<svg xmlns="http://www.w3.org/2000/svg" width="128.7" height="38.2" xmlns:v="https://vecta.io/nano"><linearGradient  gradientUnits="userSpaceOnUse" x1="-233.151" y1="-402.038" x2="-232.443" y2="-401.331"><stop offset="0" stop-color="#e6e6eb"/><stop offset=".174" stop-color="#e2e2e6"/><stop offset=".352" stop-color="#d5d4d8"/><stop offset=".532" stop-color="#c0bfc2"/><stop offset=".714" stop-color="#a4a2a4"/><stop offset=".895" stop-color="#828282"/><stop offset="1" stop-color="#6b6e6e"/></linearGradient><path d="M128.7 6.6H23.4l2 7.2 17.9-.7-14.8 10 3.8 10.4h96.4zM33.3 38h0 0zM27 22.6l12-8.1-14.3.5-.2.1L20.3 0l-4.1 14.4L0 13.8l13.4 9.1L7.9 38l12.7-10 11.8 9.3-1.4-3.8z" fill="#e52d18"/><path d="M32.7 38.2l.6-.2-.9-.7zm10.6-25.1l-17.9.7-2-7.2h-.6-.7l2.4 8.5 14.5-.6-12 8.1 4 10.9h.6.7l-3.8-10.4zm3.4 2.8h4.2c1 0 1.9.2 2.7.6s1.4.9 1.8 1.6.6 1.5.6 2.5c0 .9-.2 1.8-.6 2.5s-1 1.2-1.8 1.6-1.7.6-2.7.6h-4.2v-9.4zm4.1 7.5c.9 0 1.7-.3 2.2-.8.6-.5.8-1.2.8-2.1s-.3-1.6-.8-2.1c-.6-.5-1.3-.8-2.2-.8h-2v5.8h2zm14.1.1v1.7h-7.2v-9.3h7.1v1.7h-4.9v2h4.3v1.7h-4.3v2.2h5zm2.7 1.6c-.7-.2-1.2-.5-1.7-.8l.7-1.6c.4.3.9.5 1.4.7s1.1.3 1.7.3 1.1-.1 1.4-.3.4-.4.4-.7c0-.2-.1-.4-.3-.6s-.4-.3-.7-.4a8.11 8.11 0 0 0-1.1-.3c-.7-.2-1.3-.3-1.7-.5s-.8-.4-1.2-.8c-.3-.4-.5-.9-.5-1.5 0-.5.1-1 .4-1.5.3-.4.7-.8 1.3-1 .6-.3 1.3-.4 2.2-.4.6 0 1.2.1 1.7.2.6.1 1.1.3 1.5.6l-.7 1.6c-.9-.5-1.7-.7-2.6-.7-.6 0-1.1.1-1.3.3-.3.2-.4.5-.4.8s.2.6.5.7c.3.2.8.3 1.5.5s1.3.3 1.7.5c.5.2.8.4 1.2.8.3.4.5.9.5 1.5 0 .5-.1 1-.4 1.5-.3.4-.7.8-1.3 1s-1.3.4-2.2.4a7.47 7.47 0 0 1-2-.3zm9.4-7.5h-3v-1.8h8.1v1.8h-3v7.6H77v-7.6zm12 5.6h-4.3l-.8 2h-2.2l4.2-9.3H88l4.2 9.3h-2.3l-.9-2zm-.7-1.6L86.8 18l-1.5 3.6h3zm14.7 4.6c-.3.4-.7.7-1.1.9s-.9.3-1.4.3c-.7 0-1.3-.1-1.9-.4s-1.2-.8-1.9-1.6c-.8-.1-1.6-.4-2.3-.8a3.53 3.53 0 0 1-1.5-1.7c-.4-.7-.6-1.5-.6-2.3 0-.9.2-1.7.7-2.5s1-1.3 1.8-1.7 1.7-.6 2.6-.6 1.8.2 2.6.6 1.4 1 1.8 1.7.7 1.6.7 2.5c0 1.1-.3 2-.9 2.9-.6.8-1.4 1.4-2.4 1.7.2.2.4.4.6.5s.4.2.7.2c.6 0 1.1-.2 1.5-.7l1 1zm-8.1-4.1c.3.5.6.8 1 1.1s.9.4 1.5.4 1-.1 1.5-.4c.4-.3.8-.6 1-1.1s.4-1 .4-1.5c0-.6-.1-1.1-.4-1.5s-.6-.8-1-1.1-.9-.4-1.5-.4-1 .1-1.5.4c-.4.3-.8.6-1 1.1s-.4 1-.4 1.5.1 1 .4 1.5zm10.3 2.2c-.7-.7-1.1-1.8-1.1-3.2v-5.2h2.2V21c0 1.7.7 2.5 2.1 2.5.7 0 1.2-.2 1.5-.6s.5-1 .5-1.9v-5.1h2.1v5.2c0 1.4-.4 2.4-1.1 3.2-.7.7-1.8 1.1-3.1 1.1s-2.4-.4-3.1-1.1zm16.7-.8v1.7h-7.2v-9.3h7.1v1.7h-4.9v2h4.3v1.7h-4.3v2.2h5z" fill="#fff"/></svg>
																						<?php } ?>
																					</div>																					
																					<div class="t-overlay-text single-block-padding">
																						<div class="t-entry">
																							<h3 class="t-entry-title h6 title-scale fontsize-36"><?php echo get_the_title($post_id); ?></h3>
																							<a href="<?php echo get_the_permalink( $post_id ); ?>" class="curso_link" target="_self">
																								<span>Saiba Tudo Aqui</span>
																							</a>
																						</div>
																					</div>
																				</div>
																			</div>
																		</div>
																		<img decoding="async" class="curso-related-img wp-image-102768" src="<?php echo get_the_post_thumbnail_url( $post_id ); ?>"  alt="">
																	<!-- </a> -->
																</div>
															<?php

														endwhile;
													?>
												</div>
												<div class="swiper-button-prev"></div>
    											<div class="swiper-button-next"></div>
											</div>  <!-- end swiper-container -->
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

<?php endif; ?>
	
<?php

wp_reset_query();




