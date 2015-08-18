<!--CONTENT TEMPLATE -->
<div class="col-md-3 col-sm-3 col-xs-12 contributor-wrapper">
  <div class="contributor-img">
    <a class="img-hover-link" href="<?php the_permalink() ?>">
    <?php
      echo custom_link_overlay();
      if ( has_post_thumbnail() ) { 
        the_post_thumbnail(array(120, 120), array('class' => 'img-responsive'));
      }  
    ?>
    </a>
  </div>
  <div class="contributor-desc">
    <a href="<?php the_permalink() ?>"><p class="contributor-title text-uppercase"><?php echo get_the_title(); ?></p></a>
    <?php //the_excerpt(); ?>
  </div> 
</div> 
