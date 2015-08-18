<?php 
  global $query_string;
  query_posts( $query_string . '&featured=yes' );

  while (have_posts()) : the_post();

  $feat_img = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full');
  $videoUrl =  types_render_field("video-url", array("output"=>"raw")); 
  $videoPoster =  types_render_field("video-poster", array("output"=>"raw"));
  $category = get_the_category($post->ID);
?>
  <div class="featured-video" style="background:url(<?php echo $feat_img['0']; ?>) no-repeat; background-size:cover; background-position:center center;">
    <div class="play-btn">
        <i class="fa fa-play fa-5x"></i>
    </div>
    <h1 class="tv-category text-center text-uppercase"><?php echo $category[0]->name;  ?></h1>
    <h2 class="tv-title text-center"><?php the_title(); ?></h2>
    <!-- hidden input field to get videoUrl and videoPoster -->
    <input type="hidden" id="videoUrl" value="<?php echo $videoUrl; ?>">
    <input type="hidden" id="videoPoster" value="<?php echo $videoPoster; ?>">
  </div>
<?php
  endwhile;
  wp_reset_query()
?>