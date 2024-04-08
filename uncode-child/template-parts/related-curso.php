<?php

	$args = array(
	  'post_type'   => 'curso', 
	  'post_status' => 'publish',
	  'orderby'     => 'rand',
	  'posts_per_page' => 3,
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




