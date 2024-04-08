<?php

$queried_object = get_queried_object();
//var_dump($queried_object);
$term_id = $queried_object->term_id;
$description = $queried_object->description;
$parent_description = '';
$parent_id = false;
$parent_slug = '';

if ( isset($queried_object->parent) && !empty($queried_object->parent) ) {
	$parent_id = $queried_object->parent;
	$parent = get_term( $parent_id , 'explora' );
	//var_dump($parent);
	$parent_name = $parent->name;
	$parent_description = $parent->description;
	$parent_slug = '/' . $parent->slug;
} else {
	$parent_name = $queried_object->name;
	$parent_description = $queried_object->description;
	$parent_id = $queried_object->term_id;
}



$page = 1;
$itemsPerPage = 12;

$args = array(
  'post_type'      => 'explorar', // explorar 
  'post_status' => 'publish',
  'order'       => 'DESC',
  'orderby'     => 'date',
  'posts_per_page' => $itemsPerPage,
  'paged'	=> $page,
);

if ( isset($term_id)) {

	$args['tax_query'][] = [
		'relation' => 'AND',
		[
			'taxonomy' => 'explora',
			'field'    => 'id',
			'terms'    =>  $term_id
		]
	];

}

$the_query = new WP_Query( $args );

$total = $the_query->found_posts;

if ( $total < $itemsPerPage ) {
	$pagination_hide = 'pagination_hide';
} else {
	$pagination_hide = '';
}

?>


<div class="post-content un-no-sidebar-layout noticias-block-2 explorars-tax">
	<div data-parent="true" class="vc_row row-container" id="row-unique-999" data-section="0">
		<div class="row limit-width row-parent" data-imgready="true">
			<div class="wpb_row row-inner">
				<div class="wpb_column pos-top pos-center align_left column_parent col-lg-3/5 half-internal-gutter">
					
					<div class="uncol style-light">
						<div class="uncoltable">
							<div class="uncell no-block-padding">
								<div class="uncont">
									<div class="vc_custom_heading_wrap ">
										<div class="heading-text el-text">
											<h2 class="h2 fontspace-210350 text-color-jevc-color explorars-tax-head">
												<span><?php echo $parent_name; ?></span>
											</h2>
										</div>
										<div class="clear"></div>
									</div>
									<div class="divider-wrapper ">
									    <hr class="border-color-jevc-color_ separator-no-padding">
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="row noticas-wraper explorars-wraper">

						<div class="explorars-tax-description">
							<?php echo $parent_description; ?>
						</div>

						<div class="explorars-tax-sub-cat-list row">
							
							<?php 
								if ( $parent_id ) :

									$child_terms = get_terms( [
										'taxonomy' => 'explora', 
										'hide_empty' => false,
										'child_of'	=> $parent_id,
									] );
									?>

									<div class="col-lg-6">

										<?php
											foreach ( $child_terms as $key => $child_term ) :

												if ( $key < round(count($child_terms)/2) ):	

															if ($child_term->term_id == $term_id  ) {
																$active = 'active';
															} else {
																$active = '';
															}

														?>		

															<li class="filter-cat-<?php echo $child_term->term_id; ?> slider-cat filter-cat">
																<span>
																	<a href="<?php echo home_url( 'explora'. $parent_slug. '/'. $child_term->slug); ?>" data-id="<?php echo $child_term->term_id; ?>" class="<?php echo $active; ?> explorar-filter-link-new isotope-nav-link grid-nav-link"><?php echo $child_term->name; ?></a>
																</span>
															</li>

														<?php
												endif;

											endforeach;
										?>

									</div>
									<div class="col-lg-6">

										<?php
											foreach ( $child_terms as $key => $child_term ) :

												if ( $key >= round(count($child_terms)/2) ):	

															if ($child_term->term_id == $term_id  ) {
																$active = 'active';
															} else {
																$active = '';
															}

														?>		

															<li class="filter-cat-<?php echo $child_term->term_id; ?> slider-cat filter-cat">
																<span>
																	<a href="<?php echo home_url( 'explora'. $parent_slug. '/'. $child_term->slug); ?>" data-id="<?php echo $child_term->term_id; ?>" class="<?php echo $active; ?> explorar-filter-link-new isotope-nav-link grid-nav-link"><?php echo $child_term->name; ?></a>
																</span>
															</li>

														<?php
												endif;

											endforeach;
										?>
									</div>

									<?php

								endif;
							 ?>

						</div>

						<div id="noticas_result" class="ajax_search_result explorars-result">

							<?php 
								if ( $the_query->have_posts() ) :

									while ( $the_query->have_posts() ) : $the_query->the_post();

										get_template_part('template-parts/loop', 'explorar');

									endwhile;
								else :
									echo 'No found';
								endif;
							?>

<!-- 							<div id="services-loader" class="spinner-border" role="status">
								<span class="sr-only">Loading...</span>
							</div> -->
		
							<article class="col-xs-12 col-lg-12 pagination_wrap">
								<div class="resource-nav-pagination-filter <?php echo $pagination_hide; ?> tui-pagination" id="resource-nav-pagination-filter"></div>
							</article> 
							<div class="pagination_text">
								<a href="<?php echo home_url( '/explora/' ); ?>">ver todos os destaques</a>
							</div>		

						</div>

					</div>

				</div>
			</div>
		</div>
	</div>
</div>

<script>
	jQuery(document).ready(function($) {

		//var page = e.page;

         window['resource_nav_pagination-filter'] = new tui.Pagination(document.getElementById('resource-nav-pagination-filter'), {
              totalItems: <?php echo $total; ?>,
              itemsPerPage: <?php echo $itemsPerPage; ?>,
              visiblePages: 8,
              centerAlign: true,
              page: <?php echo $page; ?>,
            template: {
                page: '<a href="#" class="tui-page-btn locate-anything-page-nav" data-page="{{page}}">{{page}}</a>',
                currentPage: '<strong class="tui-page-btn tui-is-selected locate-anything-page-nav" data-page="{{page}}">{{page}}</strong>',
                moveButton:
                    '<a href="#" class="tui-page-btn tui-{{type}} custom-class-{{type}}">' +
                        '<span class="tui-ico-{{type}}">{{type}}</span>' +
                    '</a>',
                disabledMoveButton:
                    '<span class="tui-page-btn tui-is-disabled tui-{{type}} custom-class-{{type}}">' +
                        '<span class="tui-ico-{{type}}">{{type}}</span>' +
                    '</span>',
                moreButton:
                    '<a href="#" class="tui-page-btn tui-{{type}}-is-ellip custom-class-{{type}}">' +
                        '<span class="tui-ico-ellip">...</span>' +
                    '</a>'
            }              
          });

        window['resource_nav_pagination-filter'].on('beforeMove', function(e) {
            var page = e.page;
            
            if ( page ) {
              console.log( parseInt(page) );



                $('#noticas_result').css({
                    'opacity': 0.3
                });
                //$('#services-loader').show();

                 $.ajax({
                        type    : "POST",
                        url     : js_url.ajaxurl,
                        dataType: "json",
                        data    : "action=get_explorar-filter-new&cat="+<?php echo $term_id; ?>+"&page="+page+"",
                        success : function (a) {
                            console.log(a);

                            $('#noticas_result').html(a.content).css({
                                'opacity': '1'
                            });
                            //$('#services-loader').hide();


                            var destination = $('#noticas_result').offset().top - 150;
                            $('body,html').animate({scrollTop: destination}, 400);

              
                        }

                }); //end ajax   




            }    
          }); 

    });
</script>



