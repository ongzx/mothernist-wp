<div class="container">
  <div class="row">
    <div class="col-sm-12 popular-section">
        <h2 class="text-uppercase">Popular in <?php single_cat_title( '', true ); ?></h2>

        <!-- popular post query -->
        <?php $popular_query = new WP_Query(
          array
          (
            'orderby' => 'rand',
            'order' => 'DESC' ,
            'post_type' => array('videos', 'articles'), 
            'post_status' => 'publish',
            'category_name' => single_cat_title( '', false ),
            'posts_per_page' => 4,
            'featured' => 'yes'
          )
        ); 
        ?>

        <?php
          if ($popular_query->have_posts()) :

          while($popular_query->have_posts()) : $popular_query->the_post(); 
        ?>

        <div class="col-sm-3 col-xs-12 popular-item">
          <div class="media">
            <div class="media-left media-middle">
              <a class="img-hover-link" href="<?php echo get_the_permalink() ?>">
                <?php 
                  if ( has_post_thumbnail() ) { 
                    the_post_thumbnail(array(100,100));
                  } 
                ?>
              </a>
            </div>
            <div class="media-body">
              <a href="<?php echo get_the_permalink() ?>"><label class="media-heading"><?php echo get_the_title(); ?></label></a>
              <label class="post-date"><?php the_date(); ?></label>
            </div>
          </div>
        </div>

        <?php endwhile; ?>
        
        <?php 

        else :
          
          echo get_template_part( '/includes/template/page-not-found' ); 

        endif;

        wp_reset_postdata(); 
        wp_reset_query(); 

        ?>

    </div>
  </div>
</div>
<hr>