<?php 
  $post_archive_url = get_post_type_archive_link( get_post_type( get_the_ID() ));
?>

<section id="video-courses" class="site-section">
  <div class="row section-header">
    <div class="col-md-6 col-sm-6 col-xs-6 text-left">
      <h1 class="text-uppercase">Video Courses</h1>
    </div>
    <div class="col-md-6 col-sm-6 col-xs-6 text-right">
      <a href="<?php echo $post_archive_url; ?>" class="text-uppercase viewall-link">View All</a>
    </div>
  </div>
  <div class="row">

<?php

  $root_category = 3; //category id for video courses
  $subcategories =  get_categories('child_of='.$root_category); 

  foreach  ($subcategories as $cat) {
    $args = array(
      'post_type' => array('video-courses'), 
      'category__in' => array($cat->cat_ID),
      'order' => 'ASC' ,
      'featured' => 'yes',
      'orderby'=> 'title',
      'posts_per_page' => 3
    );
    $the_query = new WP_Query($args);
    $category_link = get_category_link($cat->cat_ID);
?>
  
      <?php
      if ($the_query->have_posts()) {
      while($the_query->have_posts()) {
          $the_query->the_post();
      ?>

      <div class="col-sm-4">
        <div class="video-course" >
          <a href="<?php echo $category_link; ?>">
            <?php
              echo custom_link_overlay();

              if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
                the_post_thumbnail(array(300, 300), array('class' => 'img-responsive'));
              } 
            ?>
          </a>
        </div>
        <a href="<?php echo $category_link; ?>"><h2 class="video-course-title"><?php echo $cat->cat_name; ?></h2></a>
      </div>
      <?php } ?>
      <?php } else { ?>
      <?php echo get_template_part( '/includes/template/page-not-found' ); ?>
      <?php } ?>
      <?php wp_reset_postdata(); ?>
  <?php } ?>

  </div>
</section>