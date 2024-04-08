<?php

$hero_articles = get_field('hero_articles');
//var_dump($hero_articles);
?>

<div class="swiper-container">
  <div class="swiper-wrapper _grid-container">

      <?php

        $args = array(
          'post_type'      => array('explorar', 'noticia'), // explorar // noticia
          'post__in'     => $hero_articles,
          //'posts_per_page' => 9,
          //'post_status' => 'publish',
          //'order'       => 'DESC',
          'orderby'     => 'post__in',
        );

        $the_query = new WP_Query( $args );
        $arr = array_chunk($the_query->posts, 3);
            
        foreach ($arr as $key => $post_array) :

            $post0 = $post_array[0];
            $post1 = $post_array[1];
            $post2 = $post_array[2];
            $slide_image_url0 = get_the_post_thumbnail_url( $post0->ID, 'full' );
            $slide_image_url1 = get_the_post_thumbnail_url( $post1->ID, 'full' );
            $slide_image_url2 = get_the_post_thumbnail_url( $post2->ID, 'full' );
            $title0 = $post0->post_title;
            $title1 = $post1->post_title;
            $title2 = $post2->post_title;

            // $category0 = get_the_category($post0->ID);
            // $category1 = get_the_category($post1->ID);
            // $category2 = get_the_category($post2->ID);

            if ( $post0->post_type == 'noticia') {
              $category0 = get_the_terms( $post0->ID, 'noticias' );
            } else if ( $post0->post_type == 'explorar') {          
              $category0 = get_the_terms($post0->ID, 'explora' );
            }

            if ( $post1->post_type == 'noticia') {
              $category1 = get_the_terms( $post1->ID, 'noticias' );
            } else if ( $post1->post_type == 'explorar') {          
              $category1 = get_the_terms($post1->ID, 'explora' );
            }

            if ( $post2->post_type == 'noticia') {
              $category2 = get_the_terms( $post2->ID, 'noticias' );
            } else if ( $post2->post_type == 'explorar') {          
              $category2 = get_the_terms($post2->ID, 'explora' );
            }            

            $permalink0 = get_the_permalink($post0->ID);
            $permalink1 = get_the_permalink($post1->ID);
            $permalink2 = get_the_permalink($post2->ID);
            ?>
                <div class="swiper-slide sub">
                  
                  <a class="subslide-left" href="<?php echo $permalink0; ?>" style="background-image: url(<?php echo $slide_image_url0; ?>);">
                    <div class="subslide-left-content">
                      <div class="slider-content">
                        <div class="slider-cat"><?php echo $category0[0]->name; ?></div>
                        <div class="slider-title"><?php echo $title0; ?></div>
                      </div>
                    </div>
                  </a>

                  <div class="subslide-right">

                      <a href="<?php echo $permalink1; ?>" class="sub-slide" style="background-image: url(<?php echo $slide_image_url1; ?>);">
                        <div class="sub-slide-content">
                            <div class="slider-content">
                              <div class="slider-cat"><?php echo $category1[0]->name; ?></div>
                              <div class="slider-title"><?php echo $title1; ?></div>
                            </div>
                        </div>
                      </a>
                      
                      <a href="<?php echo $permalink2; ?>" class="sub-slide" style="background-image: url(<?php echo $slide_image_url2; ?>);">
                        <div class="sub-slide-content">
                            <div class="slider-content">
                              <div class="slider-cat"><?php echo $category2[0]->name; ?></div>
                              <div class="slider-title"><?php echo $title2; ?></div>
                            </div>
                        </div>
                      </a>

                  </div>

                </div>

             <?php  

        endforeach;

        wp_reset_query();
      ?>

  </div> <!--  /swiper-wrapper -->

  <!-- Add Pagination -->
  <!-- <div class="swiper-pagination"></div> -->

</div>




