<section id="tv-series" class="site-section container-fluid" style="background:#f0ede9; padding-top:10px; margin-bottom:30px;">
  <div class="container">
    <div class="row section-header">
      <div class="col-sm-12 text-center">
        <a href="./tv-series"><h1 class="text-uppercase">TV Series</h1></a>
      </div>
    </div>
    <div class="row">

    <?php

      $root_category = 6; //category id for video courses
      $subcategories =  get_categories('child_of='.$root_category); 

      foreach  ($subcategories as $cat) {
        $args = array(
          'post_type' => array('tv-series'), 
          'category__in' => array($cat->cat_ID),
          'order' => 'ASC' ,
          // 'featured' => 'yes',
          'orderby'=> 'title',
          'posts_per_page' => 1
        );
        $the_query = new WP_Query($args);
        $category_link = get_category_link($cat->cat_ID);
    ?>
  
    <?php
    if ($the_query->have_posts()) {
    while($the_query->have_posts()) {
        $the_query->the_post();
        $post_archive_url = get_post_type_archive_link( get_post_type( get_the_ID() ));
    ?>

      <div class="col-sm-4">
        <div class="video-course" >
          <a href="<?php echo $post_archive_url; ?>">
            <?php
              echo custom_link_overlay();

              if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
                the_post_thumbnail(array(300, 300), array('class' => 'img-responsive'));
              } 
            ?>
          </a>
        </div>
        <a href="<?php echo $post_archive_url; ?>"><p class="video-course-title text-uppercase"><?php echo $cat->cat_name; ?></p></a>
      </div>
      <?php } ?>
      <?php } else { ?>
      <?php echo get_template_part( '/includes/template/page-not-found' ); ?>
      <?php } ?>
      <?php wp_reset_postdata(); ?>
    <?php } ?>
    </div>
  </div>
</section>