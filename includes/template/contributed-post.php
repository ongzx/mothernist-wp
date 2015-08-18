<div class="row contributed-section">
  <div class="col-sm-12">
    <h1 class="text-uppercase">Contributed posts</h1>
  </div>
  <div class="col-sm-12 contributed-slider">
  <?php
    $args=array(
        'post_type' =>array('articles','videos'),
        'tag' =>  $query_tag
    );
    
    $contributed_post_query = new WP_Query($args);

    if( $contributed_post_query->have_posts() ) :
      while ($contributed_post_query->have_posts()) : $contributed_post_query->the_post(); ?>
        <div class="col-sm-4 contributed-item">
          <a class="img-hover-link contributed-item-img" href="<?php the_permalink() ?>">
            <?php
              echo custom_link_overlay();
              if ( has_post_thumbnail() ) { 
                echo get_the_post_thumbnail($page->ID, 'img-responsive');
                // the_post_thumbnail(array(120, 120), array('class' => 'img-responsive'));
              }  
            ?>
          </a>
          <a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><p class="contributed-item-title"><?php the_title(); ?></p></a>
        </div>
       <?php
      endwhile;
      wp_reset_postdata();
    else :
      echo get_template_part( '/includes/template/page-not-found' ); 
    endif;
  ?>
  </div>
</div>