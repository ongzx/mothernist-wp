<section id="hero-slider">

  <div class="featured-slider">

    <!-- post query -->
    <?php $slider_query = new WP_Query(
      array
      (
        'orderby' => 'rand',
        'order' => 'DESC' ,
        'post_type' => array('videos', 'articles'), 
        'post_status' => 'publish'
      )
    ); 

    if ($slider_query->have_posts()) :

      $counter = 0;

      while($slider_query->have_posts()) : $slider_query->the_post(); ?>
        <?php 

          $counter++;
          $feat_img = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full');
          $videoUrl =  types_render_field("video-url", array("output"=>"raw")); 
          $videoPoster =  types_render_field("video-poster", array("output"=>"raw")); 

        ?>
        <div <?php post_class(); ?> id="post-<?php the_ID(); ?>" style="background:url(<?php echo $feat_img['0']; ?>) no-repeat; background-size:cover; background-position:center center;">

          <div class="play-btn">
              <i class="fa fa-play fa-5x"></i>
          </div>

          <p class="slide-title text-uppercase"><?php the_title(); ?></p>

          <!-- hidden input field to get videoUrl and videoPoster -->
          <input type="hidden" id="videoUrl" value="<?php echo $videoUrl; ?>">
          <input type="hidden" id="videoPoster" value="<?php echo $videoPoster; ?>">

        </div>

      <?php endwhile; ?>
      
      <?php wp_reset_postdata(); 

    else :
      
      echo get_template_part( '/includes/template/page-not-found' );

    endif;

    ?>
  </div>
</section>
