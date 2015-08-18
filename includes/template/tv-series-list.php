<div class="row tv-series-listing"> 
  <div class="col-sm-12">
    <!-- tv-series listing -->
    <?php
      $root_category = 6; //category id for tv-series
      $subcategories =  get_categories('child_of='.$root_category);  
      foreach  ($subcategories as $cat) {
          $args = array(
                      'post_type' => array('tv-series'), 
                      'category__in' => array($cat->cat_ID),
                      'order' => 'ASC' ,
                      'orderby'=> 'title'
                  );
          $the_query = new WP_Query($args);
      ?>
          <section>
              <a href="<?php echo get_category_link($cat->cat_ID); ?>"><h1 class="text-uppercase"><?php echo $cat->cat_name; ?></h1></a>
          </section>
          <div class="row tv-list">
            <?php
            if ($the_query->have_posts()) {
            while($the_query->have_posts()) {
                $the_query->the_post();

              $videoUrl =  types_render_field("video-url", array("output"=>"raw")); 
              $videoPoster =  types_render_field("video-poster", array("output"=>"raw"));

            ?>
            <div class="col-sm-4 tv-list-slide">
              <div class="tv-img">
                <a class="img-hover-link" data-url="<?php echo $videoUrl; ?>" data-poster="<?php echo $videoPoster; ?>" data-category = "<?php echo $cat->cat_name; ?>" data-title="<?php echo get_the_title(); ?>" href="<?php echo get_the_permalink()?>">
                  <?php echo custom_link_overlay(); ?>
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
      <?php } ?>
  </div>
</div>