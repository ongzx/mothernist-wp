<!-- CONTENT TEMPLATE -->
<div class="col-sm-4 featured-contributor-img">
  <a class="img-hover-link" href="<?php the_permalink() ?>">
  <?php
    if ( has_post_thumbnail() ) { 
      the_post_thumbnail(array(200, 200), array('class' => 'img-responsive'));
    }  
  ?>
  </a>
</div>
<div class="col-sm-8">
  <div class="row featured-contributor-desc">
    <div class="col-sm-12">
      <?php 
        if (get_the_title() == 'Julie Goldstein')
        {
          echo '<h1>Founder</h1>';
        }
      ?>
      <a href="<?php the_permalink() ?>"><h1><?php echo get_the_title(); ?></h1></a>
      <?php the_content(); ?>
    </div>
  </div>
</div>
