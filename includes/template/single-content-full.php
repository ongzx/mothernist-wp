<div class="container" id="post-<?php the_ID(); ?>">
  <div class="row">
    <div class="col-sm-12 text-center">
      <h1 class="text-center text-uppercase"><?php echo get_the_title(); ?></h1>
    </div>
    
    <div class="col-sm-12 text-center single-image">
      <?php 

      $feat_img = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full');
      $videoUrl =  types_render_field("video-url", array("output"=>"raw")); 
      $videoPoster =  types_render_field("video-poster", array("output"=>"raw")); 

      // VIDEO POST TYPE

      if ( 'videos' == get_post_type() ) {
      ?>

      <div class="single-video" style="background:url(<?php echo $feat_img['0']; ?>) no-repeat; background-size:cover; background-position:center center;">
        <div class="play-btn">
            <i class="fa fa-play fa-5x"></i>
        </div>
        <!-- hidden input field to get videoUrl and videoPoster -->
        <input type="hidden" id="videoUrl" value="<?php echo $videoUrl; ?>">
        <input type="hidden" id="videoPoster" value="<?php echo $videoPoster; ?>">
      </div>

      <?php 
      
      // ARTICLE POST TYPE

      } else {
        if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
          the_post_thumbnail(array(1024, 512), array('class' => 'img-responsive'));
        } 
      }
      
      ?>
    </div>
    
    <div class="col-sm-12 text-left single-desc">
      <?php the_content(); ?>
    </div>
  </div>
</div>