<div class="container related-container">
  <div class="row">
    <?php
      $categories = get_the_category($post->ID);

      if ($categories) {
        $category_ids = array();
        foreach($categories as $individual_category)
          $category_ids[] = $individual_category->term_id;

        $args=array(
          'post_type' => array('articles','videos'),
          'category__in' => $category_ids,
          'post__not_in' => array($post->ID),
          'posts_per_page'=> 6, // Number of related posts that will be displayed.
          'caller_get_posts'=>1,
          'orderby'=>'rand' // Randomize the posts
        );

        $my_query = new wp_query($args);

        if( $my_query->have_posts() ) {
          echo '<div class="col-sm-12 text-center"><h2 class="text-center text-uppercase section-header">You may also like</h2></div>';
          while ($my_query->have_posts()) {
          $my_query->the_post();
        ?>
          <div class="col-sm-4 col-xs-12 related-item">
            <div class="related-img">
              <a class="img-hover-link" href="<?php echo get_the_permalink()?>">
                <?php echo custom_link_overlay(); ?>
                <?php echo get_the_post_thumbnail($page->ID, 'img-responsive');?>
              </a>
            </div>
            <div class="related-title">
              <a href="<?php echo get_the_permalink()?>"><p class="text-center" style="padding-bottom:10px;"><?php echo get_the_title() ?></p></a>
              <p class="text-center text-small text-date"><span><?php echo get_the_date()?></span></p>
            </div>
          </div>

         <?php
          }

        }
      }
    ?>
  </div>
</div>
