<div class="row featured-course">
  <?php 

    $featured_query = new WP_Query(
      array
      (
        'post_type' => array('video-courses'), 
        'post_status' => 'publish',
        'category_name' => single_cat_title( '', false ),
        'posts_per_page' => 1,
        'featured' => 'yes'
      )
    ); 
  ?>

  <?php
    if ($featured_query->have_posts()) :

    while($featured_query->have_posts()) : $featured_query->the_post(); 
 
    $feat_img = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full');
    $videoUrl =  types_render_field("video-url", array("output"=>"raw")); 
    $videoPoster =  types_render_field("video-poster", array("output"=>"raw"));
    $category = get_the_category($post->ID);
    $course_content = get_the_content();
  ?>
    <div class="col-sm-12">
      <h1 class="course-title text-left text-uppercase"><?php the_title(); ?></h1>
    </div>
    <div class="col-sm-8">
      <div class="course-video" style="background:url(<?php echo $feat_img['0']; ?>) no-repeat; background-size:cover; background-position:center center;">
        <div class="play-btn">
            <i class="fa fa-play fa-5x"></i>
        </div>
        <!-- hidden input field to get videoUrl and videoPoster -->
        <input type="hidden" id="videoUrl" value="<?php echo $videoUrl; ?>">
        <input type="hidden" id="videoPoster" value="<?php echo $videoPoster; ?>">
      </div>
    </div>
    <div class="col-sm-4 course-detail">
      <p><?php echo $course_content; ?></p>
      <button class="default-link-black text-uppercase">Buy This Course</button>
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

<div class="row"> 
<div class="col-sm-12">
  <!-- individual video course listing -->
  <section>
      <h1 class="text-uppercase">Course Videos</h1>
  </section>
  <div class="row video-course-list">
    <?php
    if (have_posts()) {
    while(have_posts()) {
        the_post();

      $videoUrl =  types_render_field("video-url", array("output"=>"raw")); 
      $videoPoster =  types_render_field("video-poster", array("output"=>"raw"));

    ?>
    <div class="col-sm-4 tv-list-slide">
      <div class="tv-img">
        <a class="img-hover-link" data-url="<?php echo $videoUrl; ?>" data-poster="<?php echo $videoPoster; ?>" data-category = "<?php echo $cat->cat_name; ?>" data-title="<?php echo get_the_title(); ?>" href="<?php echo get_the_permalink()?>">
          <?php echo get_the_post_thumbnail($page->ID, 'img-responsive');?>
        </a>
      </div>
      <a href="<?php echo get_the_permalink()?>" data-url="<?php echo $videoUrl; ?>" data-poster="<?php echo $videoPoster; ?>" data-category = "<?php echo $cat->cat_name; ?>" data-title="<?php echo get_the_title(); ?>"><p class="text-center"><?php echo get_the_title() ?></p></a>
    </div>
    <?php } ?>
    <?php } else { ?>
    <?php echo get_template_part( '/includes/template/page-not-found' ); ?>
    <?php } ?>
    <?php wp_reset_postdata(); ?>
  </div>
</div>
</div>