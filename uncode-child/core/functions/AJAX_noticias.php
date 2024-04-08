<?php

add_action( 'wp_ajax_get_noticias', 'get_noticias' );
add_action( 'wp_ajax_nopriv_get_noticias', 'get_noticias' );

function get_noticias() {


		$page = $_POST['page'];
		$itemsPerPage = 8;

		$args = array(
		  'post_type'      => 'noticia', // explorar // noticia
		  'post_status' => 'any', // publish
		  'order'       => 'DESC',
		  'orderby'     => 'date',
		  'posts_per_page' => $itemsPerPage,
		  'paged'	=> $page,
		);

		$the_query = new WP_Query( $args );

		$total = $the_query->found_posts;

		if ( $total < $itemsPerPage ) {
			$pagination_hide = 'pagination_hide';
		} else {
			$pagination_hide = '';
		}		

		ob_start();


			if ( $the_query->have_posts() ) :

				while ( $the_query->have_posts() ) : $the_query->the_post();

					get_template_part( 'template-parts/loop', 'noticias' );

				endwhile;

				?>
					<article class="col-xs-12 col-lg-12 pagination_wrap">
						<div class="resource-nav-pagination-filter <?php echo $pagination_hide; ?> tui-pagination" id="resource-nav-pagination-filter"></div>
					</article>
					<div class="pagination_text">
						<a href="<?php echo home_url( '/noticia/' ); ?>">ver todos os destaques</a>
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
					                        data    : "action=get_noticias&page="+page+"",
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

				<?php

			endif;

		wp_reset_postdata();
		wp_reset_query();




	$content = ob_get_contents();
	ob_end_clean();
	$res['content'] = $content;
	$res['total'] = $total;
	$res['arg'] = $args;
	echo json_encode( $res );
	exit;

} 



add_action( 'wp_ajax_get_divulgar', 'get_divulgar' );
add_action( 'wp_ajax_nopriv_get_divulgar', 'get_divulgar' );

function get_divulgar() {


		$page = $_POST['page'];
		$itemsPerPage = 4;

		$args = array(
		  'post_type'      => 'post', // explorar // noticia // divulgar
		  'post_status' => 'publish',
		  'order'       => 'DESC',
		  'orderby'     => 'date',
		  'posts_per_page' => $itemsPerPage,
		  'paged'	=> $page,
		);

		$the_query = new WP_Query( $args );

		$total = $the_query->found_posts;

		if ( $total < $itemsPerPage ) {
			$pagination_hide = 'pagination_hide';
		} else {
			$pagination_hide = '';
		}		

		ob_start();


			if ( $the_query->have_posts() ) :

				while ( $the_query->have_posts() ) : $the_query->the_post();

					get_template_part( 'template-parts/loop', 'divulgar' );

				endwhile;

				?>
					<article class="col-xs-12 col-lg-12 pagination_wrap">
						<div class="resource-nav-pagination-filter2 <?php echo $pagination_hide; ?> tui-pagination" id="resource-nav-pagination-filter2"></div>
					</article>
					<div class="pagination_text">
						<a href="<?php echo home_url( '/divulgar/' ); ?>">ver todos os destaques</a>
					</div>	

					<script>
						jQuery(document).ready(function($) {

							//var page = e.page;

					         window['resource_nav_pagination-filter2'] = new tui.Pagination(document.getElementById('resource-nav-pagination-filter2'), {
					              totalItems: <?php echo $total; ?>,
					              itemsPerPage: <?php echo $itemsPerPage; ?>,
					              visiblePages: 4,
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

					        window['resource_nav_pagination-filter2'].on('beforeMove', function(e) {
					            var page = e.page;
					            
					            if ( page ) {
					              console.log( parseInt(page) );



					                $('#divulgar_result').css({
					                    'opacity': 0.3
					                });
					                //$('#services-loader').show();

					                 $.ajax({
					                        type    : "POST",
					                        url     : js_url.ajaxurl,
					                        dataType: "json",
					                        data    : "action=get_divulgar&page="+page+"",
					                        success : function (a) {
					                            console.log(a);

					                            $('#divulgar_result').html(a.content).css({
					                                'opacity': '1'
					                            });
					                            //$('#services-loader').hide();


					                            var destination = $('#divulgar_result').offset().top - 150;
					                            $('body,html').animate({scrollTop: destination}, 400);

					              
					                        }

					                }); //end ajax   
					            }    
					          }); 

					    });
					</script>

				<?php

			endif;

		wp_reset_postdata();
		wp_reset_query();




	$content = ob_get_contents();
	ob_end_clean();
	$res['content'] = $content;
	$res['total'] = $total;
	$res['arg'] = $args;
	echo json_encode( $res );
	exit;

}

add_action( 'wp_ajax_get_noticia-filter', 'get_noticiafilter' );
add_action( 'wp_ajax_nopriv_get_noticia-filter', 'get_noticiafilter' );

function get_noticiafilter() {


		$page = $_POST['page'];
		$cat = $_POST['cat'];
		$itemsPerPage = 12;

		$args = array(
		  'post_type'      => 'post',  // noticia
		  'post_status' => 'publish',
		  'order'       => 'DESC',
		  'orderby'     => 'date',
		  'cat' 		=> $cat,
		  'posts_per_page' => $itemsPerPage,
		  'paged'	=> $page,
		);

		$the_query = new WP_Query( $args );

		$total = $the_query->found_posts;

		if ( $total < $itemsPerPage ) {
			$pagination_hide = 'pagination_hide';
		} else {
			$pagination_hide = '';
		}		

		ob_start();


			if ( $the_query->have_posts() ) :

				while ( $the_query->have_posts() ) : $the_query->the_post();

					get_template_part( 'template-parts/loop', 'noticias' );

				endwhile;

				?>

					<div id="services-loader" class="spinner-border" role="status">
						<span class="sr-only">Loading...</span>
					</div>

					<article class="col-xs-12 col-lg-12 pagination_wrap">
						<div class="resource-nav-pagination-filter <?php echo $pagination_hide; ?> tui-pagination" id="resource-nav-pagination-filter"></div>
					</article>


					<script>
						jQuery(document).ready(function($) {

							//var page = e.page;

					         window['resource_nav_pagination-filter'] = new tui.Pagination(document.getElementById('resource-nav-pagination-filter'), {
					              totalItems: <?php echo $total; ?>,
					              itemsPerPage: <?php echo $itemsPerPage; ?>,
					              visiblePages: 12,
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
					            var id  = $('.noticia-filter-link.active').attr('data-id');

					            if ( page ) {
					              console.log( parseInt(page) );



					                $('#noticas_result').css({
					                    'opacity': 0.3
					                });
					                $('#services-loader').show();

					                 $.ajax({
					                        type    : "POST",
					                        url     : js_url.ajaxurl,
					                        dataType: "json",
					                        data    : "action=get_noticia-filter&cat="+id+"&page="+page+"",
					                        success : function (a) {
					                            console.log(a);

					                            $('#noticas_result').html(a.content).css({
					                                'opacity': '1'
					                            });
					                            $('#services-loader').hide();


					                            var destination = $('#noticas_result').offset().top - 150;
					                            $('body,html').animate({scrollTop: destination}, 400);

					              
					                        }

					                }); //end ajax   
					            }    
					          }); 

					    });
					</script>

				<?php
			else :

				echo "<div class='nofound'><span>Não encontrado</span></div>";


			endif;

		wp_reset_postdata();
		wp_reset_query();




	$content = ob_get_contents();
	ob_end_clean();
	$res['content'] = $content;
	$res['total'] = $total;
	$res['arg'] = $args;
	echo json_encode( $res );
	exit;

} 

add_action( 'wp_ajax_get_divulgar-filter', 'get_divulgarfilter' );
add_action( 'wp_ajax_nopriv_get_divulgar-filter', 'get_divulgarfilter' );

function get_divulgarfilter() {


		$page = $_POST['page'];
		$cat = $_POST['cat'];
		$itemsPerPage = 12;

		$args = array(
		  'post_type'      => 'post',  // divulgar
		  'post_status' => 'publish',
		  'order'       => 'DESC',
		  'orderby'     => 'date',
		  'cat' 		=> $cat,
		  'posts_per_page' => $itemsPerPage,
		  'paged'	=> $page,
		);

		$the_query = new WP_Query( $args );

		$total = $the_query->found_posts;

		if ( $total < $itemsPerPage ) {
			$pagination_hide = 'pagination_hide';
		} else {
			$pagination_hide = '';
		}		

		ob_start();


			if ( $the_query->have_posts() ) :

				while ( $the_query->have_posts() ) : $the_query->the_post();

					get_template_part( 'template-parts/loop', 'divulgar' );

				endwhile;

				?>

					<div id="services-loader" class="spinner-border" role="status">
						<span class="sr-only">Loading...</span>
					</div>

					<article class="col-xs-12 col-lg-12 pagination_wrap">
						<div class="resource-nav-pagination-filter <?php echo $pagination_hide; ?> tui-pagination" id="resource-nav-pagination-filter"></div>
					</article>


					<script>
						jQuery(document).ready(function($) {

							//var page = e.page;

					         window['resource_nav_pagination-filter'] = new tui.Pagination(document.getElementById('resource-nav-pagination-filter'), {
					              totalItems: <?php echo $total; ?>,
					              itemsPerPage: <?php echo $itemsPerPage; ?>,
					              visiblePages: 12,
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
					            var id  = $('.noticia-filter-link.active').attr('data-id');

					            if ( page ) {
					              console.log( parseInt(page) );



					                $('#noticas_result').css({
					                    'opacity': 0.3
					                });
					                $('#services-loader').show();

					                 $.ajax({
					                        type    : "POST",
					                        url     : js_url.ajaxurl,
					                        dataType: "json",
					                        data    : "action=get_divulgar-filter&cat="+id+"&page="+page+"",
					                        success : function (a) {
					                            console.log(a);

					                            $('#noticas_result').html(a.content).css({
					                                'opacity': '1'
					                            });
					                            $('#services-loader').hide();


					                            var destination = $('#noticas_result').offset().top - 150;
					                            $('body,html').animate({scrollTop: destination}, 400);

					              
					                        }

					                }); //end ajax   
					            }    
					          }); 

					    });
					</script>

				<?php
			else :

				echo "<div class='nofound'><span>Não encontrado</span></div>";


			endif;

		wp_reset_postdata();
		wp_reset_query();




	$content = ob_get_contents();
	ob_end_clean();
	$res['content'] = $content;
	$res['total'] = $total;
	$res['arg'] = $args;
	echo json_encode( $res );
	exit;

}

add_action( 'wp_ajax_get_explorar-filter', 'get_explorarfilter' );
add_action( 'wp_ajax_nopriv_get_explorar-filter', 'get_explorarfilter' );

function get_explorarfilter() {


		$page = $_POST['page'];
		$cat = $_POST['cat'];
		$itemsPerPage = 12;

		$args = array(
		  'post_type'      => 'post',  // explorar
		  'post_status' => 'publish',
		  'order'       => 'DESC',
		  'orderby'     => 'date',
		  'cat' 		=> $cat,
		  'posts_per_page' => $itemsPerPage,
		  'paged'	=> $page,
		);

		$the_query = new WP_Query( $args );

		$total = $the_query->found_posts;

		if ( $total < $itemsPerPage ) {
			$pagination_hide = 'pagination_hide';
		} else {
			$pagination_hide = '';
		}		

		ob_start();


			if ( $the_query->have_posts() ) :

				while ( $the_query->have_posts() ) : $the_query->the_post();

					get_template_part( 'template-parts/loop', 'explorar' );

				endwhile;

				?>

					<div id="services-loader" class="spinner-border" role="status">
						<span class="sr-only">Loading...</span>
					</div>

					<article class="col-xs-12 col-lg-12 pagination_wrap">
						<div class="resource-nav-pagination-filter <?php echo $pagination_hide; ?> tui-pagination" id="resource-nav-pagination-filter"></div>
					</article>


					<script>
						jQuery(document).ready(function($) {

							//var page = e.page;

					         window['resource_nav_pagination-filter'] = new tui.Pagination(document.getElementById('resource-nav-pagination-filter'), {
					              totalItems: <?php echo $total; ?>,
					              itemsPerPage: <?php echo $itemsPerPage; ?>,
					              visiblePages: 12,
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
					            var id  = $('.noticia-filter-link.active').attr('data-id');

					            if ( page ) {
					              console.log( parseInt(page) );



					                $('#noticas_result').css({
					                    'opacity': 0.3
					                });
					                $('#services-loader').show();

					                 $.ajax({
					                        type    : "POST",
					                        url     : js_url.ajaxurl,
					                        dataType: "json",
					                        data    : "action=get_explorar-filter&cat="+id+"&page="+page+"",
					                        success : function (a) {
					                            console.log(a);

					                            $('#noticas_result').html(a.content).css({
					                                'opacity': '1'
					                            });
					                            $('#services-loader').hide();


					                            var destination = $('#noticas_result').offset().top - 150;
					                            $('body,html').animate({scrollTop: destination}, 400);

					              
					                        }

					                }); //end ajax   
					            }    
					          }); 

					    });
					</script>

				<?php
			else :

				echo "<div class='nofound'><span>Não encontrado</span></div>";


			endif;

		wp_reset_postdata();
		wp_reset_query();




	$content = ob_get_contents();
	ob_end_clean();
	$res['content'] = $content;
	$res['total'] = $total;
	$res['arg'] = $args;
	echo json_encode( $res );
	exit;

}


add_action( 'wp_ajax_get_explorar-filter-new', 'get_explorarfilter_new' );
add_action( 'wp_ajax_nopriv_get_explorar-filter-new', 'get_explorarfilter_new' );

function get_explorarfilter_new() {


		$page = $_POST['page'];
		$cat = $_POST['cat'];
		$itemsPerPage = 12;

		$args = array(
		  'post_type'      => 'post',  // explorar
		  'post_status' => 'publish',
		  'order'       => 'DESC',
		  'orderby'     => 'date',
		  'posts_per_page' => $itemsPerPage,
		  'paged'	=> $page,
		);

		if ( isset($cat)) {

			$args['tax_query'][] = [
				'relation' => 'AND',
				[
					'taxonomy' => 'explorars',
					'field'    => 'id',
					'terms'    =>  $cat
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

		ob_start();


			if ( $the_query->have_posts() ) :

				while ( $the_query->have_posts() ) : $the_query->the_post();

					get_template_part( 'template-parts/loop', 'explorars' );

				endwhile;

				?>

					<div id="services-loader" class="spinner-border" role="status">
						<span class="sr-only">Loading...</span>
					</div>

					<article class="col-xs-12 col-lg-12 pagination_wrap">
						<div class="resource-nav-pagination-filter <?php echo $pagination_hide; ?> tui-pagination" id="resource-nav-pagination-filter"></div>
					</article>

					<div class="pagination_text">
						<a href="<?php echo home_url( '/explorars/' ); ?>" target="_blank">ver todos os destaques</a>
					</div>	

					<script>
						jQuery(document).ready(function($) {

							//var page = e.page;

					         window['resource_nav_pagination-filter'] = new tui.Pagination(document.getElementById('resource-nav-pagination-filter'), {
					              totalItems: <?php echo $total; ?>,
					              itemsPerPage: <?php echo $itemsPerPage; ?>,
					              visiblePages: 12,
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
					            var id  = $('.explorar-filter-link.active').attr('data-id');

					            if ( page ) {
					              console.log( parseInt(page) );



					                $('#noticas_result').css({
					                    'opacity': 0.3
					                });
					                $('#services-loader').show();

					                 $.ajax({
					                        type    : "POST",
					                        url     : js_url.ajaxurl,
					                        dataType: "json",
					                        data    : "action=get_explorar-filter-new&cat="+<?php echo $cat; ?>+"&page="+page+"",
					                        success : function (a) {
					                            console.log(a);

					                            $('#noticas_result').html(a.content).css({
					                                'opacity': '1'
					                            });
					                            $('#services-loader').hide();


					                            var destination = $('#noticas_result').offset().top - 150;
					                            $('body,html').animate({scrollTop: destination}, 400);

					              
					                        }

					                }); //end ajax   
					            }    
					          }); 

					    });
					</script>

				<?php
			else :

				echo "<div class='nofound'><span>Não encontrado</span></div>";


			endif;

		wp_reset_postdata();
		wp_reset_query();




	$content = ob_get_contents();
	ob_end_clean();
	$res['content'] = $content;
	$res['total'] = $total;
	$res['arg'] = $args;
	echo json_encode( $res );
	exit;

}




