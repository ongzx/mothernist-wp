<section id="hero-slider" class="site-section">

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
              <i class="fa fa-play-circle-o fa-5x"></i>
          </div>

          <p class="slide-title"><?php the_title(); ?></p>

          <!-- hidden input field to get videoUrl and videoPoster -->
          <input type="hidden" id="videoUrl" value="<?php echo $videoUrl; ?>">
          <input type="hidden" id="videoPoster" value="<?php echo $videoPoster; ?>">

        </div>

      <?php endwhile; ?>
      
      <?php wp_reset_postdata(); 

    else :
      
      echo '<p>Something must have been wrong!</p>';

    endif;

    ?>
  </div>
</section>
