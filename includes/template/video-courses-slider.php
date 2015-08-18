<section id="tv-series" class="site-section">

  <h3 class="text-center text-uppercase text-middleline"><span>Video Courses</span></h3>

  <div class="featured-slider">

    <!-- post query -->
    <?php $tv_series_query = new WP_Query(
      array
      (
        'orderby' => 'title',
        'order' => 'ASC' ,
        'post_type' => array('video-courses'),
        'featured' => yes, 
        'post_status' => 'publish'
      )
    ); 

    if ($tv_series_query->have_posts()) :


      $counter = 0;

      while($tv_series_query->have_posts()) : $tv_series_query->the_post(); ?>
        <?php 
          $counter++;
          $feat_img = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full');
          $videoUrl =  types_render_field("video-url", array("output"=>"raw")); 
          $videoPoster =  types_render_field("video-poster", array("output"=>"raw")); 
          $category = get_the_category($post->ID);
          $post_archive_url = get_post_type_archive_link( get_post_type( get_the_ID() ));
        ?> 

        <div <?php post_class(); ?> id="post-<?php the_ID(); ?>" style="background:url(<?php echo $feat_img['0']; ?>) no-repeat; background-size:cover; background-position:center center;">

          <div class="play-btn">
              <i class="fa fa-play-circle-o fa-5x"></i>
          </div>

          <a href="<?php echo $post_archive_url; ?>"><h1 class="tv-category text-center text-uppercase"><?php echo $category[0]->name;  ?></h1></a>
          <!-- <a href="<?php echo $post_archive_url; ?>"><h2 class="tv-title text-center"><?php the_title(); ?></h2></a> -->

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
  <div class="row">
    <div class="col-sm-12 text-center">
      <a href="http://video-course.ongzx.com/courses/" class="rounded-button" target="_blank">View Course</a>
    </div>
  </div>
</section>
